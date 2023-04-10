<?php

namespace MillionGao\DiyForm;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;

class DiyFormServiceProvider extends ServiceProvider
{
	protected $js = [
        'js/index.js',
    ];
	protected $css = [
		'css/index.css',
	];
	protected $menu = [
		[
			'title' => '自定义表单',
			'uri'   => '',
			'icon'  => 'feather icon-x', 
		],
		[
			'parent' => '自定义表单', // 指定父级菜单
			'title'  => '固定模板配置',
			'uri'    => 'diy-forms/solid',
			'icon'   => 'fa-adjust',
		],
		[
			'parent' => '自定义表单', // 指定父级菜单
			'title'  => '自定义模板配置',
			'uri'    => 'diy-form/index',
			'icon'   => 'fa-align-justify',
		],
		[
			'parent' => '自定义表单', // 指定父级菜单
			'title'  => '表单数据',
			'uri'    => 'diy-forms/data',
			'icon'   => 'fa-align-left',
		],
		[
			'parent' => '自定义表单', // 指定父级菜单
			'title'  => '跳转表单地址',
			'uri'    => 'diy-forms/set',
			'icon'   => 'fa-align-right',
		],
	];

	public function register()
	{
		//
	}

	public function init()
	{
		parent::init();

		if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()]);
        }
		//
	}

	public function settingForm()
	{
		return new Setting($this);
	}
}
