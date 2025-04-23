<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';
    public $timestamps = false;

    protected $fillable = [
        'submission_id',
        'file',
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }
}
