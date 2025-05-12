<?php

namespace App\Http\Controllers;

use App\Models\FormsLLang;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Form;
use App\Models\FormsA;
use App\Models\FormsB;
use App\Models\FormsC;
use App\Models\FormsD;
use App\Models\FormsE;
use App\Models\FormsF;
use App\Models\FormsG;
use App\Models\FormsGChild;
use App\Models\FormsHReferee;
use App\Models\FormsI;
use App\Models\FormsIEducation;
use App\Models\FormsIEducationUK;
use App\Models\FormsJ;
use App\Models\FormsK;
use App\Models\FormsL;
use App\Models\FormsM;
use App\Models\FormsMFunding;
use App\Models\FormsN;
use App\Models\FormsO;
use App\Models\FormsP;
use App\Models\FormsQ;
use Illuminate\Support\Facades\Storage;

class FormsController extends Controller
{
    public function create(Request $request)
    {
        $data = json_decode($request->input('payload', '{}'), true);
        // return response()->json($data);

        $submission = Submission::create([
            'applicant_id' => $request->user()->id,
            'status' => 'hold',
        ]);

        $form = Form::create([
            'submission_id' => $submission->id
        ]);
        $submission->update(['active_form_id' => $form->id]);
        $submission->save();

        $dataA = $data['sectionA'] ?? [];
        FormsA::create([
            'form_id'           => $form->id,
            'course_code'       => $dataA['courseCode'] ?? '',
            'course_title'      => $dataA['courseTitle'] ?? '',
            'research_title'    => $dataA['researchField'] ?? '',
            'reserach_spv'      => $dataA['supervisor'] ?? '',
            'unavailable_start' => $dataA['unavailableDates']['start'] ?? null,
            'unavailable_end'   => $dataA['unavailableDates']['end'] ?? null,
            'is_degree'         => $dataA['researchIntent'] ?? '',
        ]);

        $dataB = $data['sectionB'] ?? [];
        FormsB::create([
            'form_id' => $form->id,
            'is_preference' => $dataB['hasPreference'] ?? null,
            'college_preference' => $dataB['collegePreference'] ?? '',
        ]);

        $dataC = $data['sectionC'] ?? [];
        FormsC::create([
            'form_id'                     => $form->id,
            'name_given'                  => $dataC['givenName'] ?? '',
            'name_preferred'              => $dataC['preferredName'] ?? '',
            'name_middle'                 => $dataC['middleName'] ?? '',
            'name_family'                 => $dataC['familyName'] ?? '',
            'name_title'                  => $dataC['title'] ?? '',
            'sex'                         => $dataC['sex'] ?? '',
            'dob'                         => $dataC['dob'] ?? null,
            'name_given_prev'             => $dataC['previousGivenName'] ?? '',
            'name_family_prev'            => $dataC['previousFamilyName'] ?? '',
            'name_given_prev_eff_from'    => $dataC['nameChangeDates']['givenFrom'] ?? null,
            'name_given_prev_eff_to'      => $dataC['nameChangeDates']['givenTo'] ?? null,
            'name_family_prev_eff_from'   => $dataC['nameChangeDates']['familyFrom'] ?? null,
            'name_family_prev_eff_to'     => $dataC['nameChangeDates']['familyTo'] ?? null,
        ]);

        $dataD = $data['sectionD'] ?? [];
        FormsD::create([
            'form_id'            => $form->id,
            'home_address'       => $dataD['homeAddress']['address'] ?? '',
            'home_city'          => $dataD['homeAddress']['city'] ?? '',
            'home_postcode'      => $dataD['homeAddress']['postcode'] ?? '',
            'home_state'         => $dataD['homeAddress']['state'] ?? '',
            'home_country'       => $dataD['homeAddress']['country'] ?? '',
            'corr_address'       => $dataD['correspondenceAddress']['address'] ?? '',
            'corr_city'          => $dataD['correspondenceAddress']['city'] ?? '',
            'corr_postcode'      => $dataD['correspondenceAddress']['postcode'] ?? '',
            'corr_state'         => $dataD['correspondenceAddress']['state'] ?? '',
            'corr_country'       => $dataD['correspondenceAddress']['country'] ?? '',
            'corr_eff_from'      => $dataD['effectiveDates']['from'] ?? null,
            'corr_eff_to'        => $dataD['effectiveDates']['to'] ?? null,
            'phone_country'      => $dataD['phoneNumber']['countryCode'] ?? '',
            'phone_area'         => $dataD['phoneNumber']['areaCode'] ?? '',
            'phone_number'       => $dataD['phoneNumber']['number'] ?? '',
            'phone_alt_country'  => $dataD['altPhoneNumber']['countryCode'] ?? '',
            'phone_alt_area'     => $dataD['altPhoneNumber']['areaCode'] ?? '',
            'phone_alt_number'   => $dataD['altPhoneNumber']['number'] ?? '',
            'email'              => $dataD['email'] ?? '',
            'email_alt'          => $dataD['altEmail'] ?? '',
        ]);

        $dataE = $data['sectionE'] ?? [];
        FormsE::create([
            'form_id'      => $form->id,
            'is_nominated' => $dataE['hasThirdParty'] ?? false,
            'name'         => $dataE['nomineeDetails']['name'] ?? '',
            'email'        => $dataE['nomineeDetails']['email'] ?? '',
            'dob'          => $dataE['nomineeDetails']['dob'] ?? null,
        ]);

        $dataF = $data['sectionF'] ?? [];
        $nationality1 = $dataF['nationality1'] ?? [];
        $nationality2 = $dataF['nationality2'] ?? [];
        $visa = $dataF['visaDetails'] ?? [];
        FormsF::create([
            'form_id'                   => $form->id,
            'country_birth'             => $dataF['birthCountry'] ?? '',
            'requires_visa'             => $dataF['requiresVisa'] ?? '' === 'yes',

            'country_nationality'       => $nationality1['nationality'] ?? '',
            'nationality_start_date'    => $nationality1['startDate'] ?? null,
            'passport_number'           => $nationality1['passportNumber'] ?? '',
            'passport_country'          => $nationality1['issueCountry'] ?? '',
            'passport_expiry'           => $nationality1['expiryDate'] ?? null,

            'country_nationality_2'     => $nationality2['nationality'] ?? '',
            'nationality_start_date_2'  => $nationality2['startDate'] ?? null,
            'passport_number_2'         => $nationality2['passportNumber'] ?? '',
            'passport_country_2'        => $nationality2['issueCountry'] ?? '',
            'passport_expiry_2'         => $nationality2['expiryDate'] ?? null,

            'current_residence_country' => $visa['currentResidence'] ?? '',
            'current_residence_from'    => $visa['residenceDates']['from'] ?? null,
            'current_residence_to'      => $visa['residenceDates']['to'] ?? null,
            'is_eu_uk_education'        => $visa['euNationalInUK'] ?? '',
            'previous_residence_country'=> $visa['previousResidence'] ?? '',
            'previous_residence_from'   => $visa['previousResidenceDates']['from'] ?? null,
            'previous_residence_to'     => $visa['previousResidenceDates']['to'] ?? null,
            'has_indefinite_leave'      => $visa['indefiniteLeave'] ?? '',
            'indefinite_leave_granted'  => $visa['indefiniteLeaveGrantedDate'] ?? null,
        ]);

        $dataG = $data['sectionG'] ?? [];
        $accomDetails = $dataG['accompanyingDetails'] ?? [];
        $formsG = FormsG::create([
            'form_id' => $form->id,
            'intends_college_accom' => $dataG['requiresAccommodation'] ?? 'no',
            'accompanying_adults_count' => $accomDetails['adults'] ?? 0,
        ]);
        if (!empty($accomDetails['children'])) {
            foreach ($accomDetails['children'] as $child) {
                FormsGChild::create([
                    'form_id' => $formsG->id,
                    'sex' => $child['sex'] ?? '',
                    'dob' => $child['dob'] ?? null,
                ]);
            }
        }

        $dataH = $data['sectionH'] ?? [];
        if (!empty($dataH['referees'])) {
            foreach ($dataH['referees'] as $ref) {
                FormsHReferee::create([
                    'form_id' => $form->id,
                    'referee_name' => $ref['name'] ?? '',
                    'referee_address' => $ref['address'] ?? '',
                    'referee_type' => $ref['type'] ?? '',
                    'referee_submission_type' => $ref['submission'] ?? '',
                ]);
            }
        }

        $dataI = $data['sectionI'] ?? [];
        $formI = FormsI::create([
            'form_id' => $form->id,
            'has_incomplete_degree' => $dataI['incompleteStudy'] ?? null,
            'incomplete_degree_details' => $dataI['incompleteStudyDetails'] ?? '',
            'plans_concurrent_degree' => $dataI['concurrentStudy'] ?? null,
            'concurrent_degree_details' => $dataI['concurrentStudyDetails'] ?? '',
        ]);
        if (!empty($dataI['educationHistory'])) {
            foreach ($dataI['educationHistory'] as $edu) {
                FormsIEducation::create([
                    'form_id' => $formI->id,
                    'name' => $edu['institution'] ?? '',
                    'start' => $edu['startDate'] ?? '',
                    'end' => $edu['completionDate'] ?? '',
                    'qualification' => $edu['qualification'] ?? '',
                    'subject' => $edu['subject'] ?? '',
                    'result' => $edu['result'] ?? '',
                ]);
            }
        }
        if (!empty($dataI['ukEducationHistory'])) {
            foreach ($dataI['ukEducationHistory'] as $eduUK) {
                FormsIEducationUK::create([
                    'form_id' => $formI->id,
                    'name' => $eduUK['institution'] ?? '',
                    'start' => $eduUK['startDate'] ?? '',
                    'end' => $eduUK['completionDate'] ?? '',
                    'title' => $eduUK['courseTitle'] ?? '',
                    'level' => $eduUK['level'] ?? '',
                ]);
            }
        }

        $dataJ = $data['sectionJ']['greTest'] ?? [];
        FormsJ::create([
            'form_id' => $form->id,
            'gre_date' => $dataJ['date'] ?? null,
            'gre_verbal_score' => $dataJ['verbalScore'] ?? null,
            'gre_verbal_percent' => $dataJ['verbalPercent'] ?? null,
            'gre_quant_score' => $dataJ['quantitativeScore'] ?? null,
            'gre_quant_percent' => $dataJ['quantitativePercent'] ?? null,
            'gre_analytical_score' => $dataJ['writingScore'] ?? null,
            'gre_analytical_percent' => $dataJ['writingPercent'] ?? null,
        ]);

        $dataK = $data['sectionK'] ?? [];
        FormsK::create([
            'form_id' => $form->id,
            'english_first_language' => $dataK['englishFirstLanguage'] ?? null,
            'english_degree_qualification' => $dataK['englishQualification'] ?? null,
            'tier4_child_visa' => $dataK['tier4Visa'] ?? null,
        ]);

        $dataL = $data['sectionL'] ?? [];
        $formsL = new FormsL([
            'form_id' => $form->id,
            'test_type' => $dataL['englishTest']['testType'] ?? null,
            'test_date' => $dataL['englishTest']['dateTaken'] ?? null,
            'test_overall' => $dataL['englishTest']['overallResult'] ?? null,
            'test_listening' => $dataL['englishTest']['listening'] ?? null,
            'test_reading' => $dataL['englishTest']['reading'] ?? null,
            'test_writing' => $dataL['englishTest']['writing'] ?? null,
            'test_speaking' => $dataL['englishTest']['speaking'] ?? null,
            'requests_waiver' => $dataL['testWaiverRequest'] ?? null,
            'file_waiver' => null,
        ]);
        if ($waiver = $request->file('waiver')) {
            $formsL->file_waiver = $waiver->store("waivers/{$form->id}", 'public');
        }
        $formsL->save();
        foreach ($dataL['otherLanguages'] as $language) {
            FormsLLang::create([
                'form_id' => $form->id,
                'name' => $language['language'],
                'reading' => $language['reading'],
                'writing' => $language['writing'],
                'speaking' => $language['speaking'],
                'understanding' => $language['understanding'],
            ]);
        }

        $dataM = $data['sectionM'] ?? [];
        $formsM = FormsM::create([
            'form_id' => $form->id,
            'has_funding_info' => $dataM['alternativeFunding'] ? 1 : 0,
            'applies_studentship' => $dataM['applyingForStudentship'] ?? null,
            'studentship_code' => $dataM['studentshipReferenceCode'] ?? null,
            'scholarship_hill' => $dataM['oxfordScholarships']['hillFoundation'] ?? 0,
            'scholarship_ertegun' => $dataM['oxfordScholarships']['ertetgun'] ?? 0,
            'scholarship_ocis' => $dataM['oxfordScholarships']['ocis'] ?? 0,
            'scholarship_weidenfeld' => $dataM['oxfordScholarships']['weidenfeld'] ?? 0,
            'scholarship_ahrc' => $dataM['oxfordScholarships']['ahrc'] ?? 0,
            'scholarship_grand_union' => $dataM['oxfordScholarships']['grandUnion'] ?? 0,
        ]);
        if ($dataM['fundingSources'] && count($dataM['fundingSources']) > 0) {
            foreach ($dataM['fundingSources'] as $funding) {
                FormsMFunding::create([
                    'form_id' => $form->id,
                    'source' => $funding['source'] ?? '',
                    'amount' => $funding['amount'] ?? '',
                    'period' => $funding['period'] ?? '',
                    'status' => $funding['status'] ?? '',
                ]);
            }
        }

        $dataN = $data['sectionN'] ?? [];
        $formsN = new FormsN();
        $formsN->form_id = $form->id;
        // handle each file manually
        if ($file = $request->file('transcript')) {
            $formsN->transcripts_submitted = true;
            $formsN->file_transcripts = $file->store("documents/{$form->id}", 'public');
        } else {
            $formsN->transcripts_submitted = false;
        }
        if ($file = $request->file('cv')) {
            $formsN->cv_submitted = true;
            $formsN->file_cv = $file->store("documents/{$form->id}", 'public');
        } else {
            $formsN->cv_submitted = false;
        }
        if ($file = $request->file('statement')) {
            $formsN->statement_submitted = true;
            $formsN->file_statement = $file->store("documents/{$form->id}", 'public');
        } else {
            $formsN->statement_submitted = false;
        }
        if ($file = $request->file('written1')) {
            $formsN->written_work1_submitted = true;
            $formsN->file_written1 = $file->store("documents/{$form->id}", 'public');
        } else {
            $formsN->written_work1_submitted = false;
        }
        if ($file = $request->file('written2')) {
            $formsN->written_work2_submitted = true;
            $formsN->file_written2 = $file->store("documents/{$form->id}", 'public');
        } else {
            $formsN->written_work2_submitted = false;
        }
        if ($file = $request->file('singleWritten')) {
            $formsN->alternative_work_submitted = true;
            $formsN->file_work = $file->store("documents/{$form->id}", 'public');
        } else {
            $formsN->alternative_work_submitted = false;
        }
        if ($file = $request->file('portfolio')) {
            $formsN->portfolio_submitted = true;
            $formsN->file_portfolio = $file->store("documents/{$form->id}", 'public');
        } else {
            $formsN->portfolio_submitted = false;
        }
        if ($file = $request->file('englishTest')) {
            $formsN->english_test_submitted = true;
            $formsN->file_english_test = $file->store("documents/{$form->id}", 'public');
        } else {
            $formsN->english_test_submitted = false;
        }
        if ($file = $request->file('gre')) {
            $formsN->gre_submitted = true;
            $formsN->file_gre = $file->store("documents/{$form->id}", 'public');
        } else {
            $formsN->gre_submitted = false;
        }
        if ($file = $request->file('waiverLetter')) {
            $formsN->waiver_letter_submitted = true;
            $formsN->file_waiver = $file->store("documents/{$form->id}", 'public');
        } else {
            $formsN->waiver_letter_submitted = false;
        }
        if ($file = $request->file('scholarshipSupport')) {
            $formsN->scholarship_statement  = true;
            $formsN->file_scholarship = $file->store("documents/{$form->id}", 'public');
        } else {
            $formsN->scholarship_statement  = false;
        }
        $formsN->scholarship_statements_count = $dataN['numScholarships'];
        $formsN->save(); // save to db

        $dataO = $data['sectionO'] ?? [];
        $formsO = FormsO::create([
            'form_id' => $form->id,
            'payment_method' => $dataO['paymentMethod'] ?? null,
            'order_number' => $dataO['paymentMethod'] !== 'waiver' ? $dataO['orderNumber'] : null,
            'cannot_afford' => $dataO['waiverRequested'] ?? false,
            'meet_req' => $dataO['waiverRequested'] && $dataO['waiverConfirmed'] ?? false,
        ]);

        $dataP = $data['sectionP'] ?? [];
        $formsP = FormsP::create([
            'form_id' => $form->id,
            'sections_complete' => $dataP['checklistComplete']['formComplete'] ?? false,
            'materials_gathered' => $dataP['checklistComplete']['materialsGathered'] ?? false,
            'references_requested' => $dataP['checklistComplete']['referencesRequested'] ?? false,
            'fee_paid' => $dataP['checklistComplete']['paymentArranged'] ?? false,
        ]);

        $dataQ = $data['sectionQ'] ?? [];
        $formsQ = new FormsQ([
            'form_id' => $form->id,
            'file_signature' => null,
            'declaration_date' => $dataQ['declaration']['date'] ?? null,
            'declaration_name' => $dataQ['declaration']['printedName'] ?? null,
        ]);
        if ($file = $request->file('signature')) {
            $formsQ->file_signature = $file->store("signatures/{$form->id}", 'public');
        }
        $formsQ->save();

        return response()->json([
            'message' => 'Form created successfully',
            'form_id' => $form->id
        ]);
    }

    public function get(Request $request, $form_id)
    {
        $submission = Submission::where('active_form_id', $form_id)->first();

        if (!$request->user()) {
            return response()->json(['error' => 'Forbidden'], 403);
        }
        else if ($request->user()->role === 'reviewer') {
            // reviewer can only access their own form
            if ($request->user()->id !== $submission->reviewer_id)
            {
                return response()->json(['error' => 'Forbidden'], 403);
            }
        }
        else if ($request->user()->role === 'applicant') {
            // applicant can only access their own form
            if ($request->user()->id !== $submission->applicant_id)
            {
                return response()->json(['error' => 'Forbidden'], 403);
            }
        }

        $formA = FormsA::where('form_id', $form_id)->first();
        $formB = FormsB::where('form_id', $form_id)->first();
        $formC = FormsC::where('form_id', $form_id)->first();
        $formD = FormsD::where('form_id', $form_id)->first();
        $formE = FormsE::where('form_id', $form_id)->first();
        $formF = FormsF::where('form_id', $form_id)->first();
        $formG = FormsG::where('form_id', $form_id)->with('children')->first();
        $formH = FormsHReferee::where('form_id', $form_id)->get();
        $formI = FormsI::where('form_id', $form_id)->with(['education', 'educationUk'])->first();
        $formJ = FormsJ::where('form_id', $form_id)->first();
        $formK = FormsK::where('form_id', $form_id)->first();
        $formL = FormsL::where('form_id', $form_id)->with('languages')->first();
        $formM = FormsM::where('form_id', $form_id)->with('fundings')->first();
        $formN = FormsN::where('form_id', $form_id)->first();
        $formO = FormsO::where('form_id', $form_id)->first();
        $formP = FormsP::where('form_id', $form_id)->first();
        $formQ = FormsQ::where('form_id', $form_id)->first();
        return response()->json([
            'forms_a' => $formA,
            'forms_b' => $formB,
            'forms_c' => $formC,
            'forms_d' => $formD,
            'forms_e' => $formE,
            'forms_f' => $formF,
            'forms_g' => $formG,
            'forms_h_referee' => $formH,
            'forms_i' => $formI,
            'forms_j' => $formJ,
            'forms_k' => $formK,
            'forms_l' => $formL,
            'forms_m' => $formM,
            'forms_n' => $formN,
            'forms_o' => $formO,
            'forms_p' => $formP,
            'forms_q' => $formQ,
            'submission' => $submission,
        ]);
    }
}
