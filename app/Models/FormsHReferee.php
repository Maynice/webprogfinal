<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsHReferee extends Model
{
    protected $table = 'forms_h_referee';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'referee_name',
        'referee_address',
        'referee_type',
        'referee_submission_type',
    ];

    public function form() { return $this->belongsTo(Form::class); }
}
