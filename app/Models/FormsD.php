<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsD extends Model
{
    protected $table = 'forms_d';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'home_address',
        'home_city',
        'home_postcode',
        'home_state',
        'home_country',
        'corr_address',
        'corr_city',
        'corr_postcode',
        'corr_state',
        'corr_country',
        'corr_eff_from',
        'corr_eff_to',
        'phone_country',
        'phone_area',
        'phone_number',
        'phone_alt_country',
        'phone_alt_area',
        'phone_alt_number',
        'email',
        'email_alt',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
