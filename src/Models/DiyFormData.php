<?php
namespace MillionGao\DiyForm\Models;

class DiyFormData extends Base
{
    protected $table = 'diy_form_data';
    protected $fillable = ['id', 'form_id', 'data', 'created_at', 'updated_at'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    } 
}