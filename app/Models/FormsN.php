<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormsN extends Model
{
    protected $table = 'forms_n';
    public $timestamps = false;

    protected $fillable = [
        'form_id',
        'transcripts_submitted',
        'file_transcripts',
        'cv_submitted',
        'file_cv',
        'statement_submitted',
        'file_statement',
        'written_work1_submitted',
        'file_written1',
        'written_work2_submitted',
        'file_written2',
        'alternative_work_submitted',
        'file_work',
        'portfolio_submitted',
        'file_portfolio',
        'english_test_submitted',
        'file_english_test',
        'gre_submitted',
        'file_gre',
        'waiver_letter_submitted',
        'file_waiver',
        'scholarship_statement',
        'scholarship_statements_count',
        'file_scholarship',
    ];

    public function form() { return $this->belongsTo(Form::class); }
}
