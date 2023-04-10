<?php
namespace MillionGao\DiyForm\Renderable;

use MillionGao\DiyForm\Repositories\DiyFormInfo as AppFormInfo;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;

class FormTable extends LazyRenderable
{
    public function grid(): Grid
    {
        return Grid::make(new AppFormInfo(), function (Grid $grid) {
            $grid->column('channel', '渠道');
            $grid->column('url', '表单链接')->display(function () {
                return 'https://y.gkgoo.cn/index?channel='.$this->id;
            })->link();
            $grid->column('images', '背景图')->image(env_new('IMG_URL'), 100, 100);

            $grid->disableActions();
            $grid->disableRowSelector(); 
        });
    }
}