<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsGChild extends Model
{
    protected $table = 'forms_g_children';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'sex',
        'dob',
    ];

    public function forms_g() { return $this->belongsTo(FormsG::class, 'form_id'); }
}
