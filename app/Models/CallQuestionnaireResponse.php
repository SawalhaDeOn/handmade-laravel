<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallQuestionnaireResponse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'call_id',
        'patient_id',
        'call_questionnaire_id',
        'cq_question_id',
        'answer'
    ];

    protected $with = ['questionnaire', 'question', 'patient', 'call'];

    public function call()
    {
        return $this->belongsTo(Call::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function questionnaire()
    {
        return $this->belongsTo(CallQuestionnaire::class, 'call_questionnaire_id');
    }

    public function question()
    {
        return $this->belongsTo(CallQuestionnaireQuestion::class, 'cq_question_id');
    }
}
