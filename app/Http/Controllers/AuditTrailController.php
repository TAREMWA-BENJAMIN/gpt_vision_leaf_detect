<?php

namespace App\Http\Controllers;

use App\Models\AuditTrail;
use Illuminate\Http\Request;

class AuditTrailController extends Controller
{
    /**
     * Display a listing of the audit logs.
     */
    public function index(Request $request)
    {
        $logs = AuditTrail::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('audit_trail.index', compact('logs'));
    }
}
