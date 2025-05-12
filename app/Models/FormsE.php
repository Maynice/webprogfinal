<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsE extends Model
{
    protected $table = 'forms_e';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'is_nominated',
        'name',
        'email',
        'dob',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
