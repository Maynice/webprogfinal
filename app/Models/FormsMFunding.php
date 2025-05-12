<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsMFunding extends Model
{
    protected $table = 'forms_m_funding';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'source',
        'amount',
        'period',
        'status',
    ];

    public function form() { return $this->belongsTo(Form::class, 'form_id'); }
}
