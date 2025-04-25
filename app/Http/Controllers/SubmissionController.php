<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

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

        $submission = Submission::find($id);
        $submission->update(['status' => $request->input('status')]);
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
}
