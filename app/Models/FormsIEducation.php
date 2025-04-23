<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsIEducation extends Model
{
    protected $table = 'forms_i_education';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'name',
        'start',
        'end',
        'qualification',
        'subject',
        'result',
    ];

    public function form() { return $this->belongsTo(Form::class, 'form_id'); }
}
