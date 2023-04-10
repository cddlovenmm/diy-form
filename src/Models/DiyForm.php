<?php
namespace MillionGao\DiyForm\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class DiyForm extends Base 
{
    use SoftDeletes;
    
    protected $table = 'diy_form';
    protected $fillable = ['id', 'name', 'is_solid', 'is_have_admin', 'prefix_uri', 'field_data', 'created_at', 'updated_at', 'deleted_at'];

    // const column_by_id = config('diy-form.solid.column_by_id');

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format($this->dateFormat ?: 'Y-m-d H:i:s');
    }
    
    // 一对多
    public function infos()
    {
        return $this->hasMany(DiyFormInfo::class, 'form_id');
    }

    /**
     * 获取固定表单id与字段的配置
     *
     * @return array
     */
    public static function column_by_id()
    {
        return config('diy-form.solid.column_by_id');
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