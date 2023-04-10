<?php
namespace MillionGao\DiyForm\Http\Controllers;

use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use MillionGao\DiyForm\Exports\DiyFormDataExport;

class DiyFormExportController extends AdminController
{
    public function formData(Request $request)
    {
        $id = $request->get('id');
        return Excel::download(new DiyFormDataExport($id), date("Y-m-d").'-表单数据详情.xlsx');
    }
}