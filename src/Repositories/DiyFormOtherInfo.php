<?php
namespace MillionGao\DiyForm\Repositories;

use MillionGao\DiyForm\Models\DiyFormInfo as FormInfoModel;
use Dcat\Admin\Grid;
use Dcat\Admin\Repositories\QueryBuilderRepository;

class DiyFormOtherInfo extends QueryBuilderRepository {

    public function get(Grid\Model $model)
    {
        // 获取当前页数
        $currentPage = $model->getCurrentPage();
        // 获取每页显示行数
        $perPage = $model->getPerPage();

        $id = request('id');

        $query = FormInfoModel::query();
        $query->where('form_id', $id);
        $data = $query->paginate($perPage)->toArray();

        return $model->makePaginator(
            $data['total']??0, // 传入总记录数
            $data['data']??[] // 传入数据二维数组
        );
    }
}