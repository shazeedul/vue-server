<?php

namespace App\Models;

use App\Models\FeedbackForm;
use App\Models\FeedbackResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeedbackQuestion extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'feedback_form_id',
        'question',
    ];

    public function form()
    {
        return $this->belongsTo(FeedbackForm::class);
    }


    public function responses()
    {
        return $this->hasMany(FeedbackResponse::class);
    }
}
