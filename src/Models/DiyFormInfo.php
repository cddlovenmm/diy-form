<?php
namespace MillionGao\DiyForm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class DiyFormInfo extends Base 
{
    use SoftDeletes;
    
    protected $table = 'diy_form_info';
    protected $fillable = ['id', 'form_id', 'channel', 'images', 'admin_name', 'admin_avater', 'admin_job', 'admin_message', 'created_at', 'updated_at', 'deleted_at'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    } 

    public function form()
    {
        return $this->belongsTo(DiyForm::class, 'form_id');
    }

    public static function getById($id)
    {
        $res = self::query()->where('id', $id)->first();
        if ($res) {
            return $res->toArray();
        }
        return [];
    }
}