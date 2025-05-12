<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsF extends Model
{
    protected $table = 'forms_f';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'country_birth',
        'requires_visa',
        'country_nationality',
        'nationality_start_date',
        'passport_number',
        'passport_country',
        'passport_expiry',
        'country_nationality_2',
        'nationality_start_date_2',
        'passport_number_2',
        'passport_country_2',
        'passport_expiry_2',
        'current_residence_country',
        'current_residence_from',
        'current_residence_to',
        'is_eu_uk_education',
        'previous_residence_country',
        'previous_residence_from',
        'previous_residence_to',
        'has_indefinite_leave',
        'indefinite_leave_granted',
    ];

    public function form() { return $this->belongsTo(Form::class); }
}
