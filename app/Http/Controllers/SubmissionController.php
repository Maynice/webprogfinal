<?php

namespace App\Http\Controllers;

use App\Mail\UploadDocument;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Request as RequestModel;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicantStatus;
use App\Mail\RequestDocument;

class SubmissionController extends Controller
{
    public function get(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $submissions = Submission::with(['applicant', 'reviewer'])->get();
        return response()->json($submissions);
    }

    public function applicant(Request $request)
    {
        if ($request->user()->role !== 'applicant') {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $submissions = Submission::where('applicant_id', $request->user()->id)
            ->with(['applicant', 'reviewer'])
            ->get();
        return response()->json($submissions);
    }

    public function reviewer(Request $request)
    {
        if ($request->user()->role !== 'reviewer') {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $submissions = Submission::where('reviewer_id', $request->user()->id)
            ->with(['applicant', 'reviewer'])
            ->get();
        return response()->json($submissions);
    }

    public function update(Request $request, $id)
    {
        if ($request->user()->role !== 'reviewer' && $request->user()->role !== 'admin') {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $submission = Submission::with(['applicant'])->find($id);
        $submission->update(['status' => $request->input('status')]);

        // send email
        try {
            Mail::to($submission->applicant->email)
                ->send(new ApplicantStatus(
                    $submission->id,
                    $submission->applicant->name,
                    $submission->applicant->email,
                    $request->user()->name,
                    $request->user()->email,
                    $submission->status    
                ));

             // mail sent!
             \Log::info("Applicant status update email sent successfully for submission ID: {$id} to {$submission->applicant->email}");

        } catch (\Exception $e) {
            // log error if fail
            \Log::error("Failed to send applicant status update email for submission ID: {$id}. Error: " . $e->getMessage());
        }

        return response()->json($submission);
    }

    public function assign(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $submission = Submission::find($request->input('id'));
        $submission->update(['reviewer_id' => $request->input('reviewer_id')]);
        return response()->json($submission);
    }

    public function admin_get_request(Request $request, $submission_id)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $requestData = RequestModel::where('submission_id', $submission_id)->get();
        return response()->json($requestData);
    }
    
    public function reviewer_get_request(Request $request, $submission_id)
    {
        if ($request->user()->role !== 'reviewer') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // check if submission id belong to reviewer
        $submission = Submission::where('id', $submission_id)
            ->where('reviewer_id', $request->user()->id)
            ->first();
        if (!$submission) {
            return response()->json(['error' => 'Submission not found'], 404);
        }

        $requestData = RequestModel::where('submission_id', $submission_id)->get();
        return response()->json($requestData);
    }
    
    public function create_request(Request $request)
    {
        if ($request->user()->role !== 'admin' && $request->user()->role !== 'reviewer') {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $requestData = RequestModel::create([
            'submission_id' => $request->input('submission_id'),
            'info' => $request->input('info'),
        ]);

        $submission = Submission::with('applicant')->find($request->input('submission_id'));
        $applicant = $submission->applicant;
        $reviewer = $submission->reviewer;

        try {
            Mail::to($applicant->email)
                ->send(new RequestDocument(
                    $submission->id,
                    $applicant->name,
                    $request->input('info'),
                    $reviewer->name
                ));

            \Log::info("Request Document email sent successfully for submission ID: {$submission->id} to {$applicant->email}");

        } catch (\Exception $e) {
            \Log::error("Failed to send Request Document email for submission ID: {$submission->id}, request ID: {$requestData->id}. Error: " . $e->getMessage());
            // still return success for the created request, but add warning about the failed email
             return response()->json([
                'data' => $requestData,
                'warning' => 'Created document request but failed to send the notification email'
            ]);
        }

        return response()->json($requestData);
    }

    public function applicant_get_request(Request $request, $submission_id)
    {
        if ($request->user()->role !== 'applicant') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // check if submission id belong to applicant
        $submission = Submission::where('id', $submission_id)
            ->where('applicant_id', $request->user()->id)
            ->first();
        if (!$submission) {
            return response()->json(['error' => 'Submission not found'], 404);
        }

        $requestData = RequestModel::where('submission_id', $submission_id)->get();
        return response()->json($requestData);
    }

    public function applicant_get_single_request(Request $request, $submission_id, $request_id)
    {
        if ($request->user()->role !== 'applicant') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // check if request id and submission id valid
        $requestData = RequestModel::where('id', $request_id)
            ->where('submission_id', $submission_id)
            ->with(['submission'])
            ->first();
        if (!$requestData) {
            return response()->json(['error' => 'Request not found'], 404);
        }

        // check if submission id belong to applicant
        $submission = $requestData->submission;
        if ($submission->applicant_id !== $request->user()->id) {
            return response()->json(['error' => 'Request not found'], 404);
        }

        return response()->json($requestData);
    }

    public function applicant_upload_request(Request $request, $submission_id, $request_id)
    {
        if ($request->user()->role !== 'applicant') {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // check if request id and submission id valid
        $requestData = RequestModel::where('id', $request_id)
            ->where('submission_id', $submission_id)
            ->with(['submission'])
            ->first();
        if (!$requestData) {
            return response()->json(['error' => 'Request not found'], 404);
        }

        // check if submission id belong to applicant
        $submission = $requestData->submission;
        if ($submission->applicant_id !== $request->user()->id) {
            return response()->json(['error' => 'Request not found'], 404);
        }

        $file = $request->file('file');
        $path = $file->store("requests/{$requestData->submission_id}", 'public');
        $requestData->update(['file' => $path]);
        
        $submission->load(['reviewer', 'applicant']);
        $recipient = $submission->reviewer;
        $applicant = $submission->applicant;
        $originalFileName = $file->getClientOriginalName();
        try {
            Mail::to($recipient->email)
               ->send(new UploadDocument(
                   $submission->id,
                   $requestData->id,
                   $applicant->name,
                   $applicant->email,
                   $requestData->info,
                   $originalFileName
               ));
            \Log::info("Sent document uploaded email for Request ID {$request_id} to {$recipient->email}");

       } catch (\Exception $e) {
            \Log::error("Failed to send document uploaded email for Request ID {$request_id} to {$recipient->email}. Error: " . $e->getMessage());
       }

        return response()->json($requestData);
    }

    public function delete(Request $request, $id)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        $submission = Submission::find($id);
        $submission->delete();
        return response()->json($submission);
    }
}
