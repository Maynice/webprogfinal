<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;

class ReportController extends Controller
{
    public function generate_report(HttpRequest $request)
    {
        if ($request->user()->role !== 'admin') {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        // total forms
        $totalForms = Submission::count();
        
        // assigned vs unassigned Forms
        $assignedForms = Submission::whereNotNull('reviewer_id')->count();
        $unassignedForms = $totalForms - $assignedForms;
        
        // count forms by status
        $onHoldForms = Submission::where('status', 'wait')->count();
        $acceptedForms = Submission::where('status', 'approved')->count();
        $rejectedForms = Submission::where('status', 'rejected')->count();

        // forms with open requests or no file uploaded
        $formsWithOpenRequests = Submission::whereHas('requests', function($query) {
            $query->whereNull('file');
        })->count();
        
        return response()->json([
            'report' => [
                'total_forms' => $totalForms,
                'assigned_forms' => $assignedForms,
                'unassigned_forms' => $unassignedForms,
                'forms_with_open_requests' => $formsWithOpenRequests,
                'forms_by_status' => [
                    'on_hold' => $onHoldForms,
                    'accepted' => $acceptedForms,
                    'rejected' => $rejectedForms,
                ],
                'generated_at' => now()->toDateTimeString(),
            ]
        ]);
    }
}
