<?php

use Illuminate\Support\Facades\Route;
use MillionGao\DiyForm\Http\Controllers\DiyFormController;
use MillionGao\DiyForm\Http\Controllers\DiyFormDataController;
use MillionGao\DiyForm\Http\Controllers\DiyFormExportController;
use MillionGao\DiyForm\Http\Controllers\DiyFormRedirectSetController;
use MillionGao\DiyForm\Http\Controllers\DiyFormSolidSetController;
use MillionGao\DiyForm\Http\Controllers\DiyFormUploadImageController;

Route::resource('diy-forms/solid', DiyFormSolidSetController::class);
Route::get('diy-forms/info/{id}', DiyFormDataController::class . '@info');
Route::resource('diy-forms/data', DiyFormDataController::class);
Route::resource('diy-forms/index', DiyFormController::class);
Route::resource('diy-forms/set', DiyFormRedirectSetController::class);//表单跳转地址设置


Route::any('diy-forms/upload', DiyFormUploadImageController::class . '@upload'); //自定义表单上传图片接口
Route::get('diy-forms/export/formData', DiyFormExportController::class . '@formData');