<?php
namespace MillionGao\DiyForm\Http\Controllers;

use MillionGao\DiyForm\Models\DiyForm as AppModelsForm;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use MillionGao\DiyForm\Renderable\DiyFormOtherTable;
use MillionGao\DiyForm\Repositories\DiyForm;

class DiyFormSolidSetController extends AdminController {

    protected $title = '固定模板表单配置';

    protected function grid()
    {
        return Grid::make(new DiyForm(), function (Grid $grid) {
            $grid->model()->where('is_solid', '=', 1);

            $grid->column('name', '表单名称');
            $grid->column('info', '表单详情')->display('点击查看链接')->modal('表单详情', function () {
                return DiyFormOtherTable::make()->payload(['prefix_uri'=>$this->prefix_uri, 'id'=>$this->getKey(), 'is_have_admin'=>$this->is_have_admin]);
            });
            $grid->column('column', '表单字段')->display(function () {
                $column = array_get(AppModelsForm::column_by_id(), $this->getKey());
                return implode(', ', $column);
            });
            $grid->column('created_at');
            
            $grid->disableViewButton();
            $grid->disableDeleteButton();
            $grid->disableRowSelector();

            if (config('diy-form.solid.is_create') === false) {
                $grid->disableCreateButton();
            }
        });
    }

    protected function form()
    {
        $form_to_info = DiyForm::with('infos');
        return Form::make($form_to_info, function (Form $form) {
            $form->text('name')->rules('required', [
                'required' => '请填写表单名称',
            ]);

            if ($form->isCreating()) {
                //uri前缀
                $form->url('prefix_uri', '表单地址')->rules('required_if:is_solid,1', [
                    'required_if' => '请填写表单地址',
                ])->saving(function ($v) {
                    return $v ?: '';
                });
            } else {
                //uri前缀
                $form->url('prefix_uri', '表单地址')->rules('required_if:is_solid,1', [
                    'required_if' => '请填写表单地址',
                ])->saving(function ($v) {
                    return $v ?: '';
                })->disable();
            }

            $form->hidden('is_solid')->value(1);
            $is_have_admin = $form->model()->is_have_admin;

            $form->hasMany('infos', '渠道以及其他信息', function (Form\NestedForm $form) use ($is_have_admin) {
                $form->text('channel')->label('渠道')->rules('required', [
                    'required' => '渠道不能为空'
                ])->required();
                // if ($is_have_admin) {
                    $form->text('admin_name', '负责人姓名')->saving(function ($v) {
                        return $v ?: '';
                    });
                    $form->image('admin_avater')->uniqueName()->autoUpload()->url(config('diy-form.upload_api'))->label('头像')->saving(function ($v) {
                        return $v ?: '';
                    });
                    $form->text('admin_job', '负责人职位')->saving(function ($v) {
                        return $v ?: '';
                    });
                    $form->text('admin_message', '描述')->saving(function ($v) {
                        return $v ?: '';
                    });
                // }
            });

            $form->disableDeleteButton();
            $form->disableCreatingCheck();
            $form->disableViewButton();
        });
    }

}