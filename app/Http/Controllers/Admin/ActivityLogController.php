<?php
declare(strict_types=1);
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(Request $request): View
    {
        $query = ActivityLog::with('user');
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }
        $logs = $query->latest()->paginate(20);
        return view('admin.activity-logs.index', compact('logs'));
    }
}
