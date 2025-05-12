<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('reviewer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->unsignedBigInteger('active_form_id')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });

        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained()->onDelete('cascade');
            $table->string('info')->nullable();
            $table->string('file')->nullable();
            $table->timestamps();
        });

        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('forms_a', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->string('course_code')->nullable();
            $table->string('course_title')->nullable();
            $table->text('research_title')->nullable();
            $table->string('reserach_spv')->nullable();
            $table->date('unavailable_start')->nullable();
            $table->date('unavailable_end')->nullable();
            $table->string('is_degree')->nullable();
        });

        Schema::create('forms_b', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->boolean('is_preference')->nullable();
            $table->string('college_preference')->nullable();
        });

        Schema::create('forms_c', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->string('name_given')->nullable();
            $table->string('name_preferred')->nullable();
            $table->string('name_middle')->nullable();
            $table->string('name_family')->nullable();
            $table->string('name_title')->nullable();
            $table->string('sex')->nullable();
            $table->date('dob')->nullable();
            $table->string('name_given_prev')->nullable();
            $table->string('name_family_prev')->nullable();
            $table->date('name_given_prev_eff_from')->nullable();
            $table->date('name_given_prev_eff_to')->nullable();
            $table->date('name_family_prev_eff_from')->nullable();
            $table->date('name_family_prev_eff_to')->nullable();
        });

        Schema::create('forms_d', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->string('home_address')->nullable();
            $table->string('home_city')->nullable();
            $table->string('home_postcode')->nullable();
            $table->string('home_state')->nullable();
            $table->string('home_country')->nullable();
            $table->string('corr_address')->nullable();
            $table->string('corr_city')->nullable();
            $table->string('corr_postcode')->nullable();
            $table->string('corr_state')->nullable();
            $table->string('corr_country')->nullable();
            $table->date('corr_eff_from')->nullable();
            $table->date('corr_eff_to')->nullable();
            $table->string('phone_country')->nullable();
            $table->string('phone_area')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('phone_alt_country')->nullable();
            $table->string('phone_alt_area')->nullable();
            $table->string('phone_alt_number')->nullable();
            $table->string('email')->nullable();
            $table->string('email_alt')->nullable();
        });

        Schema::create('forms_e', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->boolean('is_nominated')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->date('dob')->nullable();
        });

        Schema::create('forms_f', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->string('country_birth')->nullable();
            $table->string('requires_visa')->nullable();
            $table->string('country_nationality')->nullable();
            $table->date('nationality_start_date')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_country')->nullable();
            $table->date('passport_expiry')->nullable();
            $table->string('country_nationality_2')->nullable();
            $table->date('nationality_start_date_2')->nullable();
            $table->string('passport_number_2')->nullable();
            $table->string('passport_country_2')->nullable();
            $table->date('passport_expiry_2')->nullable();
            $table->string('current_residence_country')->nullable();
            $table->date('current_residence_from')->nullable();
            $table->date('current_residence_to')->nullable();
            $table->boolean('is_eu_uk_education')->nullable();
            $table->string('previous_residence_country')->nullable();
            $table->date('previous_residence_from')->nullable();
            $table->date('previous_residence_to')->nullable();
            $table->boolean('has_indefinite_leave')->nullable();
            $table->date('indefinite_leave_granted')->nullable();
        });

        Schema::create('forms_g', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->boolean('intends_college_accom')->nullable();
            $table->integer('accompanying_adults_count')->nullable();
        });

        Schema::create('forms_g_children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->references('form_id')->on('forms_g')->onDelete('cascade');
            $table->string('sex')->nullable();
            $table->date('dob')->nullable();
        });

        Schema::create('forms_h_referee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->string('referee_name')->nullable();
            $table->string('referee_address')->nullable();
            $table->string('referee_type')->nullable();
            $table->string('referee_submission_type')->nullable();
        });

        Schema::create('forms_i', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->boolean('has_incomplete_degree')->nullable();
            $table->text('incomplete_degree_details')->nullable();
            $table->boolean('plans_concurrent_degree')->nullable();
            $table->text('concurrent_degree_details')->nullable();
        });

        Schema::create('forms_i_education', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->references('form_id')->on('forms_i')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->string('qualification')->nullable();
            $table->string('subject')->nullable();
            $table->string('result')->nullable();
        });

        Schema::create('forms_i_education_uk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->references('form_id')->on('forms_i')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->date('start')->nullable();
            $table->date('end')->nullable();
            $table->string('title')->nullable();
            $table->string('level')->nullable();
        });

        Schema::create('forms_j', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->date('gre_date')->nullable();
            $table->string('gre_verbal_percent')->nullable();
            $table->string('gre_verbal_score')->nullable();
            $table->string('gre_quant_percent')->nullable();
            $table->string('gre_quant_score')->nullable();
            $table->string('gre_analytical_percent')->nullable();
            $table->string('gre_analytical_score')->nullable();
        });

        Schema::create('forms_k', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->boolean('english_first_language')->nullable();
            $table->boolean('english_degree_qualification')->nullable();
            $table->boolean('tier4_child_visa')->nullable();
        });

        Schema::create('forms_l', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->string('test_type')->nullable();
            $table->date('test_date')->nullable();
            $table->string('test_overall')->nullable();
            $table->string('test_listening')->nullable();
            $table->string('test_reading')->nullable();
            $table->string('test_writing')->nullable();
            $table->string('test_speaking')->nullable();
            $table->boolean('requests_waiver')->nullable();
            $table->string('file_waiver')->nullable();
        });

        Schema::create('forms_l_lang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->references('form_id')->on('forms_l')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('reading')->nullable();
            $table->string('writing')->nullable();
            $table->string('speaking')->nullable();
            $table->string('understanding')->nullable();
        });

        Schema::create('forms_m', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->boolean('has_funding_info')->nullable();
            $table->boolean('applies_studentship')->nullable();
            $table->string('studentship_code')->nullable();
            $table->boolean('scholarship_hill')->nullable();
            $table->boolean('scholarship_ertegun')->nullable();
            $table->boolean('scholarship_ocis')->nullable();
            $table->boolean('scholarship_weidenfeld')->nullable();
            $table->boolean('scholarship_ahrc')->nullable();
            $table->boolean('scholarship_grand_union')->nullable();
        });

        Schema::create('forms_m_funding', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->references('form_id')->on('forms_m')->onDelete('cascade');
            $table->string('source')->nullable();
            $table->integer('amount')->nullable();
            $table->string('period')->nullable();
            $table->string('status')->nullable();
        });

        Schema::create('forms_n', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->boolean('transcripts_submitted')->nullable();
            $table->string('file_transcripts')->nullable();
            $table->boolean('cv_submitted')->nullable();
            $table->string('file_cv')->nullable();
            $table->boolean('statement_submitted')->nullable();
            $table->string('file_statement')->nullable();
            $table->boolean('written_work1_submitted')->nullable();
            $table->string('file_written1')->nullable();
            $table->boolean('written_work2_submitted')->nullable();
            $table->string('file_written2')->nullable();
            $table->boolean('alternative_work_submitted')->nullable();
            $table->string('file_work')->nullable();
            $table->boolean('portfolio_submitted')->nullable();
            $table->string('file_portfolio')->nullable();
            $table->boolean('english_test_submitted')->nullable();
            $table->string('file_english_test')->nullable();
            $table->boolean('gre_submitted')->nullable();
            $table->string('file_gre')->nullable();
            $table->boolean('waiver_letter_submitted')->nullable();
            $table->string('file_waiver')->nullable();
            $table->boolean('scholarship_statement')->nullable();
            $table->integer('scholarship_statements_count')->nullable();
            $table->string('file_scholarship')->nullable();
        });

        Schema::create('forms_o', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->string('payment_method')->nullable();
            $table->string('order_number')->nullable();
            $table->boolean('cannot_afford')->nullable();
            $table->boolean('meet_req')->nullable();
        });

        Schema::create('forms_p', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->boolean('sections_complete')->nullable();
            $table->boolean('materials_gathered')->nullable();
            $table->boolean('references_requested')->nullable();
            $table->boolean('fee_paid')->nullable();
        });

        Schema::create('forms_q', function (Blueprint $table) {
            $table->id('form_id');
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
            $table->string('file_signature')->nullable();
            $table->date('declaration_date')->nullable();
            $table->string('declaration_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms_q');
        Schema::dropIfExists('forms_p');
        Schema::dropIfExists('forms_o');
        Schema::dropIfExists('forms_n');
        Schema::dropIfExists('forms_m_funding');
        Schema::dropIfExists('forms_m');
        Schema::dropIfExists('forms_l_lang');
        Schema::dropIfExists('forms_l');
        Schema::dropIfExists('forms_k');
        Schema::dropIfExists('forms_j');
        Schema::dropIfExists('forms_i_education_uk');
        Schema::dropIfExists('forms_i_education');
        Schema::dropIfExists('forms_i');
        Schema::dropIfExists('forms_h_referee');
        Schema::dropIfExists('forms_g_children');
        Schema::dropIfExists('forms_g');
        Schema::dropIfExists('forms_f');
        Schema::dropIfExists('forms_e');
        Schema::dropIfExists('forms_d');
        Schema::dropIfExists('forms_c');
        Schema::dropIfExists('forms_b');
        Schema::dropIfExists('forms_a');
        Schema::dropIfExists('forms');
        Schema::dropIfExists('requests');
        Schema::dropIfExists('submissions');
    }
};


