<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsIEducationUK extends Model
{
    protected $table = 'forms_i_education_uk';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'name',
        'start',
        'end',
        'title',
        'level',
    ];

    public function form() { return $this->belongsTo(Form::class, 'form_id'); }
}
