<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsP extends Model
{
    protected $table = 'forms_p';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'sections_complete',
        'materials_gathered',
        'references_requested',
        'fee_paid',
    ];

    public function form() { return $this->belongsTo(Form::class); }
}
