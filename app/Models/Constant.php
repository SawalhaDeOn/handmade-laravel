<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Constant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['value', 'name', 'module', 'field', 'hayat_id'];

    // public static function getAllConstants($module, $field)
    // {
    //     return self::where('module', $module)
    //         ->where('field', $field)
    //         ->orderBy('name')
    //         ->select('name', 'value');
    // }
    public static function getTypeName($id, $lang = "0", $module = 0)
    {
        try {

            $result = self::select('*')->where('id', $id);

            if ($module > 0)
                $result->where('module', $module);


            if ($lang == 2)
                return $result->get()->first()->name;

            if ($lang == 4)
                return $result->get()->first()->name;
            else
                return $result->get()->first()->name;
        } catch (\Exception $ex) {
            return '';
        }
    }


}
