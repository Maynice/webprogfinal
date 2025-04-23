<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsM extends Model
{
    protected $table = 'forms_m';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'has_funding_info',
        'applies_studentship',
        'studentship_code',
        'scholarship_hill',
        'scholarship_ertegun',
        'scholarship_ocis',
        'scholarship_weidenfeld',
        'scholarship_ahrc',
        'scholarship_grand_union',
    ];

    public function form() { return $this->belongsTo(Form::class); }
    public function fundings() { return $this->hasMany(FormsMFunding::class); }
}
