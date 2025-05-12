<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsLLang extends Model
{
    protected $table = 'forms_l_lang';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'name',
        'reading',
        'writing',
        'speaking',
        'understanding',
    ];

    public function form() { return $this->belongsTo(Form::class, 'form_id'); }
}
