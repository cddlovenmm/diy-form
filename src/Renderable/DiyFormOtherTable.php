<?php
namespace MillionGao\DiyForm\Renderable;

use MillionGao\DiyForm\Http\Repositories\DiyFormOtherInfo as AppFormOtherInfo;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;

class DiyFormOtherTable extends LazyRenderable
{
    public function grid(): Grid
    {
        return Grid::make(new AppFormOtherInfo(), function (Grid $grid) {
            $grid->column('channel', '渠道');
            $grid->column('url', '表单链接')->display(function () {
                return request('prefix_uri').'?channel='.$this->id;
            })->link();

            if (request('is_have_admin')) {
                $grid->column('admin_name', '负责人名称');
                $grid->column('admin_avater', '头像')->image(env_new('IMG_URL'), 100, 100);
                $grid->column('admin_job', '职位');
                $grid->column('admin_message', '描述');
            }
            
            $grid->disableRowSelector();
            $grid->disableActions();        
        });
    }
}