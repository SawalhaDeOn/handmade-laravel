<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TawkHistory extends Model
{
    use HasFactory;
    protected $table = "tawktomessage";
    protected $guarded = ['id'];
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function status()
    {
        return $this->belongsTo(Constant::class, 'status_id')->withDefault(['name' => 'NA']);;
    }
    public function instance()
    {
        return $this->morphTo();
    }

}
