<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsG extends Model
{
    protected $table = 'forms_g';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'intends_college_accom',
        'accompanying_adults_count',
    ];

    public function form() { return $this->belongsTo(Form::class); }
    public function children() { return $this->hasMany(FormsGChild::class, 'form_id', 'form_id'); }
}
