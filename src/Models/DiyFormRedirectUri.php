<?php
namespace MillionGao\DiyForm\Models;

class DiyFormRedirectUri extends Base
{
    protected $table = 'diy_form_redirect_uri';
    protected $fillable = ['id', 'uri', 'created_at', 'updated_at'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    } 
}