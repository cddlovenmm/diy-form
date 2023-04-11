<?php

namespace MillionGao\DiyForm\Http\Controllers;

use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use MillionGao\DiyForm\Models\DiyForm;
use MillionGao\DiyForm\Models\DiyFormData;
use MillionGao\DiyForm\Models\DiyFormDataCount;
use MillionGao\DiyForm\Models\DiyFormInfo;
use MillionGao\DiyForm\Pages\DiyFormDataPage;

class DiyFormDataController extends AdminController
{
    protected $title = '表单数据管理';

    protected function grid()
    {
        return Grid::make(new DiyFormDataCount(), function (Grid $grid) {

            $grid->column('channel', '表单渠道')->display(function () {
                return DiyFormInfo::query()->where('id', $this->form_id)->first()->channel ?? '';
            });

            $grid->column('form_name', '表单名称')->display(function () {
                $formInfo = DiyFormInfo::query()->where('id', $this->form_id)->first();
                return DiyForm::query()->where('id', $formInfo->form_id)->first()->name ?? '';
            });

            $grid->column('data_count', '留资数量');
            $grid->column('updated_at', '最后一次留资时间');

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->append('<a href="/admin/diy-forms/data/info/'.$this->form_id.'" target=""><i class="fa fa-eye"> 详细数据</i></a>');
            });

            $grid->quickSearch('channel');
 
            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->disableViewButton();
            $grid->disableEditButton();
            $grid->disableDeleteButton();

        });
    }

    public function info(Content $content, Request $request, $id)
    {
        $per_page = $request->get('per_page', 20);
        //获取数据
        $formData = DiyFormData::query()->where('form_id', $id)->orderBy('id', 'desc')->paginate($per_page)->toArray();
        //获取表单详情
        $formInfo = DiyFormInfo::query()->where('id', $id)->first();
        $formId = $formInfo->form_id;
        if (array_get($formData, 'data', [])) {
            foreach ($formData['data'] as & $value) {
                $d = array_get($value, 'data');
                $tmp = json_decode($d, true);
                if ($formId === 3) {
                    unset($tmp['邮箱']);
                }
                $tmp = array_values($tmp);
                if ($tmp) {
                    foreach ($tmp as & $t) {
                        //如果是数组，给他逗号分割
                        $v = json_decode($t, true);
                        if (is_array($v)) {
                            $t = implode(',', $v);
                        } 
                    }
                    $tmp['created_at'] = $value['created_at'];
                }
                $value = $tmp;
            }
        }

        //获取表头
        $formInfo = DiyFormInfo::getById($id);
        $form = DiyForm::getById($formInfo['form_id']);
        if ($form['is_solid']) {
            $field_data = array_get(DiyForm::column_by_id(), $form['id']);
        } else {
            $field_data = json_decode(array_get($form, 'field_data'),true);
            $field_data = array_column($field_data, 'label');
        }
        $field_data[] = '留资时间';

        return $content
            ->title('表单数据详情')
            ->body(new DiyFormDataPage($id, $formData, $field_data));
    }
}