<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsL extends Model
{
    protected $table = 'forms_l';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'test_type',
        'test_date',
        'test_overall',
        'test_listening',
        'test_reading',
        'test_writing',
        'test_speaking',
        'requests_waiver',
        'file_waiver',
    ];

    public function form() { return $this->belongsTo(Form::class); }
    public function languages() { return $this->hasMany(FormsLLang::class, 'form_id', 'form_id'); }
}
