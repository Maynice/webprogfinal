<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsQ extends Model
{
    protected $table = 'forms_q';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'file_signature',
        'declaration_date',
        'declaration_name',
    ];

    public function form() { return $this->belongsTo(Form::class); }
}
