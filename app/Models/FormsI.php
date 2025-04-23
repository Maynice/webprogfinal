<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsI extends Model
{
    protected $table = 'forms_i';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'has_incomplete_degree',
        'incomplete_degree_details',
        'plans_concurrent_degree',
        'concurrent_degree_details',
    ];

    public function form() { return $this->belongsTo(Form::class); }
    public function education() { return $this->hasMany(FormsIEducation::class); }
    public function educationUK() { return $this->hasMany(FormsIEducationUK::class); }
}
