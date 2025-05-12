<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsB extends Model
{
    protected $table = 'forms_b';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'is_preference',
        'college_preference',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
