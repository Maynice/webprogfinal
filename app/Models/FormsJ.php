<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsJ extends Model
{
    protected $table = 'forms_j';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'gre_date',
        'gre_verbal_percent',
        'gre_verbal_score',
        'gre_quant_percent',
        'gre_quant_score',
        'gre_analytical_percent',
        'gre_analytical_score',
    ];

    public function form() { return $this->belongsTo(Form::class); }
}
