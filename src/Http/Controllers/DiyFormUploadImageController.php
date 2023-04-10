<?php
namespace MillionGao\DiyForm\Http\Controllers;

use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Traits\HasUploadedFile;
use Exception;
use Ixudra\Curl\Facades\Curl;
use Intervention\Image\ImageManagerStatic as Image;

class DiyFormUploadImageController extends AdminController {

    use HasUploadedFile;

    // 后台图片上传
    public function upload($handleImg = 1)
    {
        $isDeleted = false;
        if ($this->isDeleteRequest()) {
            // 删除的
            $isDeleted = true;
            // 获取文件名
            $image = request()->key;
            $image_arr = explode('/', $image);
            if (!$image_arr) {
                return $this->responseErrorMessage('文件上传失败');
            }
            $fileName = end($image_arr);
        } else {
            // 上传的
            //获取上传的文件    
            $file = $this->file('images');
            $fileName = md5(time().rand(1, 10000).time().rand(1,100)).'.'.$file->getClientOriginalExtension();
            //压缩
            $info = @getimagesize($file);
            if (!$info) {
                return $this->responseErrorMessage('文件上传失败');
            }
            $filePath = sprintf("%s/%s", storage_path('app/public'), $fileName);
            try {
                Image::make($file)->save($filePath);
            } catch (Exception $e) {
                return $this->responseErrorMessage($e->getMessage());
            }    
            //读取
            $image = file_get_contents($filePath);
            //获取到图片内容后，删除本地图片
            @unlink($filePath);
        }

        $url = "https://img1.yonyou.com/upload.php";
        $date = date("Ym");
        $res = Curl::to($url)
            ->withData([
                'file' => $image,
                'path' => sprintf("yongyou_ys/%s", $date),
                'is_deleted' => $isDeleted,
                'file_name' => $fileName,
            ])->post();
        
        $res = json_decode($res, true);
        if (array_get($res, 'code') === 200) {
            //返回图片路径
            return $isDeleted ? $this->responseDeleted() : $this->responseUploaded(sprintf("yongyou_ys/%s/%s", $date, $res['file_name']), env_new('IMG_URL'));
        }
        return $this->responseErrorMessage('文件处理失败'); 
    }
}
