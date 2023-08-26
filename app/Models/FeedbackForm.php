<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\FeedbackQuestion;
use App\Models\FeedbackResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeedbackForm extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'link',
    ];


    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->link = self::generateUniqueLink();
            $model->user_id = auth()->user()->id;
        });
    }

    public static function generateUniqueLink($length = 10)
    {
        $link = Str::random($length); // You can use a suitable function to generate a unique string
        // Check if the generated link already exists and regenerate if needed
        while (self::where('link', $link)->exists()) {
            $link = Str::random($length);
        }
        return $link;
    }

    public function responses()
    {
        return $this->hasMany(FeedbackResponse::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(FeedbackQuestion::class);
    }

    public function getLinkAttribute($value)
    {
        return url('/feedback/' . $value);
    }

    public function getResponsesCountAttribute()
    {
        return $this->responses()->count();
    }

    public function getQuestionsCountAttribute()
    {
        return $this->questions()->count();
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getDeletedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getLinkShortAttribute()
    {
        return Str::limit($this->link, 20);
    }

    public function getResponsesCountShortAttribute()
    {
        return Str::limit($this->responses_count, 20);
    }

    public function getQuestionsCountShortAttribute()
    {
        return Str::limit($this->questions_count, 20);
    }


}
