<?php
namespace MillionGao\DiyForm\Http\Controllers;

use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use MillionGao\DiyForm\Repositories\DiyFormRedirectUri;

class DiyFormRedirectSetController extends AdminController
{
    protected $title = '表单跳转地址';
    
    protected function grid()
    {
        return Grid::make(new DiyFormRedirectUri(), function (Grid $grid) {

            $grid->column('uri', '跳转表单地址')->link();
            $grid->column('created_at');
            
            $grid->disableViewButton();
            $grid->disableRowSelector();
        });
    }

    protected function form()
    {
        return Form::make(new DiyFormRedirectUri(), function (Form $form) {
            $form->url('uri', '跳转表单地址')->rules('required', [
                'required' => '请填写表单地址'
            ]);

        });
    }
}