<?php

namespace App\Models;

use App\Models\User;
use App\Models\FeedbackForm;
use App\Models\FeedbackResponseAnswer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeedbackResponse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'feedback_form_id',
        'user_id',
    ];

    public function form()
    {
        return $this->belongsTo(FeedbackForm::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(FeedbackResponseAnswer::class);
    }
}
