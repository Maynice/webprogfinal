<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsO extends Model
{
    protected $table = 'forms_o';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'payment_method',
        'order_number',
        'cannot_afford',
        'meet_req',
    ];

    public function form() { return $this->belongsTo(Form::class); }
}
