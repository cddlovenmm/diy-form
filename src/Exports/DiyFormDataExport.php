<?php
namespace MillionGao\DiyForm\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use MillionGao\DiyForm\Models\DiyForm;
use MillionGao\DiyForm\Models\DiyFormData;
use MillionGao\DiyForm\Models\DiyFormInfo;

class DiyFormDataExport implements FromCollection, WithHeadings
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id; 
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //获取数据
        $formData = DiyFormData::query()->where('form_id', $this->id)->pluck('data')->toArray();
        //获取表单详情
        $formInfo = DiyFormInfo::query()->where('id', $this->id)->first();
        $formId = $formInfo->form_id;
        if ($formData) {
            $formData = array_map(function ($value) {
                return json_decode($value, true);
            }, $formData);
            if ($formId === 3 && $formData) {
                foreach ($formData as & $tmp) {
                    unset($tmp['邮箱']);
                }
            }
        }
        return collect($formData);
    }

    public function headings(): array
    {
        //获取表头
        $formInfo = DiyFormInfo::getById($this->id);
        $form = DiyForm::getById($formInfo['form_id']);
        if ($form['is_solid']) {
            $field_data = array_get(DiyForm::column_by_id(), $form['id']);
        } else {
            $field_data = json_decode(array_get($form, 'field_data'),true);
            $field_data = array_column($field_data, 'label');
        }
        return $field_data;
    }
}
