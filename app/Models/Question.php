<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'body', 'type'
    ];

     // create constant for question types
    public const QUESTION_TYPES = [
        'text', 'textarea', 'checkbox', 'radio'
    ];

    public function getType(){
        return $this->type;
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
