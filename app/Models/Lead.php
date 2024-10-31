<?php

namespace App\Models;

use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;
use App\Traits\HasLocalizedNameAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class Lead extends Model implements Auditable
{
    use HasFactory, SoftDeletes, EagerLoadPivotTrait, HasLocalizedNameAttribute, AuditingAuditable;

    protected $guarded = ['id'];



    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id')->with('type','categorys');
    }



    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function statuss()
    {
        return $this->belongsTo(Constant::class, 'status')->withDefault(['name' => 'NA']);
    }
    public function type()
    {
        return $this->belongsTo(Constant::class, 'type_id')->withDefault(['name' => 'NA']);
    }



}
