<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsC extends Model
{
    protected $table = 'forms_c';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'name_given',
        'name_preferred',
        'name_middle',
        'name_family',
        'name_title',
        'sex',
        'dob',
        'name_given_prev',
        'name_family_prev',
        'name_given_prev_eff_from',
        'name_given_prev_eff_to',
        'name_family_prev_eff_from',
        'name_family_prev_eff_to',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
