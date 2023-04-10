<?php
namespace MillionGao\DiyForm\Models;

class DiyFormDataCount extends Base
{
    protected $table = 'diy_form_data_count';
    protected $fillable = ['id', 'form_id', 'channel', 'data_count', 'created_at', 'updated_at'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    } 
}