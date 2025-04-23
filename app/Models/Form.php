<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'forms';
    public $timestamps = false;

    protected $fillable = [
        'submission_id',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function formA() { return $this->hasOne(FormsA::class); }
    public function formB() { return $this->hasOne(FormsB::class); }
    public function formC() { return $this->hasOne(FormsC::class); }
    public function formD() { return $this->hasOne(FormsD::class); }
    public function formE() { return $this->hasOne(FormsE::class); }
    public function formF() { return $this->hasOne(FormsF::class); }
    public function formG() { return $this->hasOne(FormsG::class); }
    public function formGChild() { return $this->hasMany(FormsGChild::class); }
    public function formHReferee() { return $this->hasMany(FormsHReferee::class); }
    public function formI() { return $this->hasOne(FormsI::class); }
    public function formIEducation() { return $this->hasMany(FormsIEducation::class); }
    public function formIEducationUK() { return $this->hasMany(FormsIEducationUK::class); }
    public function formJ() { return $this->hasOne(FormsJ::class); }
    public function formK() { return $this->hasOne(FormsK::class); }
    public function formL() { return $this->hasOne(FormsL::class); }
    public function formLLang() { return $this->hasMany(FormsLLang::class); }
    public function formM() { return $this->hasOne(FormsM::class); }
    public function formMFunding() { return $this->hasMany(FormsMFunding::class); }
    public function formN() { return $this->hasOne(FormsN::class); }
    public function formO() { return $this->hasOne(FormsO::class); }
    public function formP() { return $this->hasOne(FormsP::class); }
    public function formQ() { return $this->hasOne(FormsQ::class); }
}
