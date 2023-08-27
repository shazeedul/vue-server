<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeedbackResponseAnswer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'feedback_response_id',
        'feedback_question_id',
        'answer',
    ];
}
