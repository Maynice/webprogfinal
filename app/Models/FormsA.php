<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsA extends Model
{
    protected $table = 'forms_a';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'course_code',
        'course_title',
        'research_title',
        'reserach_spv',
        'unavailable_start',
        'unavailable_end',
        'is_degree',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
