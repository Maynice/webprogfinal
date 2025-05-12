<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submissions';
    public $timestamps = false;

    protected $fillable = [
        'applicant_id',
        'reviewer_id',
        'active_form_id',
        'status',
    ];

    public function applicant()
    {
        return $this->belongsTo(User::class, 'applicant_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function forms()
    {
        return $this->hasMany(Form::class);
    }

    public function activeForm()
    {
        return $this->belongsTo(Form::class, 'active_form_id');
    }
}
