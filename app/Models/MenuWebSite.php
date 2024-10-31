<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuWebSite extends Model
{
    use HasFactory;
    protected $table = 'menuswebsites';

    protected $fillable = [
        'name',
        'name_en',
        'name_he',
        'route',
        'icon_svg',
        'parent_id',
        'order',
        'permission_name'
    ];

    public function parent()
    {
        return $this->belongsTo(MenuWebSite::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuWebSite::class, 'parent_id')->orderBy('order');
    }

    public function routeList(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => explode("|", $attributes['route']),
        );
    }

    protected function permissionName(): Attribute
    {
        try {
            //code...

            return Attribute::make(
                get: fn (string $value) => explode("|", $value),
            );
        } catch (\Throwable $th) {
            dd($this);
        }
    }
}
