<?php
namespace MillionGao\DiyForm\Http\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use MillionGao\DiyForm\Repositories\DiyForm;

class DiyFormController extends AdminController
{

    protected function grid()
    {
        return Grid::make(new DiyForm(), function (Grid $grid) {
            $grid->model()->where('is_solid', '=', 0);

            $grid->column('name', '表单名称');
            $grid->column('info', '表单详情')->display('点击查看链接')->modal('表单详情', function () {
                if ($this->is_solid) {
                    return FormOtherTable::make()->payload(['prefix_uri'=>$this->prefix_uri, 'id'=>$this->getKey()]);
                } else {
                    return FormTable::make()->payload(['is_solid'=>$this->is_solid, 'id'=>$this->getKey()]);
                }
            });
            $grid->column('is_solid', '模板类型')->display(function ($value) {
                return $value ? '固定模板' : '自定义模板';
            });
            $grid->column('qrcode', '链接二维码')->qrcode(function () {
                return $this->url;
            }, 200, 200);
            $grid->column('created_at');
            
            $grid->disableViewButton();
            $grid->disableRowSelector();
        });
    }

    protected function form()
    {
        $form_to_info = DiyForm::with('infos');
        return Form::make($form_to_info, function (Form $form) {
            $form->text('name')->rules('required', [
                'required' => '请填写表单名称',
            ]);
            $form->hidden('is_solid')->value(0);
            //隐藏掉图片上传和视频上传
            $form->diyForm('field_data', '表单内容')->subComponentTypes(['upload-image', 'upload-vedio', 'select'])
            ->rules('required_if:is_solid,0', [
                'required_if' => '请填充表单后提交'
            ])->saving(function ($v) {
                return $v ?: '';
            });

            $form->hasMany('infos', '渠道以及背景图', function (Form\NestedForm $form) {
                $form->text('channel')->label('渠道')->rules('required', [
                    'required' => '渠道不能为空'
                ]);
                $form->image('images')->uniqueName()->autoUpload()->url('diy-form/upload')->label('背景图')->rules('required_if:is_solid,0', [
                    'required_if' => '请上传背景图片'
                ]);
            });

        });
    }
}