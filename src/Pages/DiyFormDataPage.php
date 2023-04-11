<?php
namespace MillionGao\DiyForm\Pages;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\URL;

class DiyFormDataPage implements Renderable
{
    protected $id;
    protected $data;
    protected $columns;

    public function __construct($id, $data, $columns)
    {
        $this->id = $id;
        $this->data = $data;
        $this->columns = $columns;
    }

    public function render()
    {
        return view('million-gao.diy-form::diy-form-data', [
            'id' => $this->id,
            'columns' => $this->columns,
            'data' => $this->data,
            'url' => URL::current(),
        ]);
    }
}