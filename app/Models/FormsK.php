<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsK extends Model
{
    protected $table = 'forms_k';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'english_first_language',
        'english_degree_qualification',
        'tier4_child_visa',
    ];

    public function form() { return $this->belongsTo(Form::class); }
}
