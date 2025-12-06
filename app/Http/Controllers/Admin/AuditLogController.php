<?php

// app/Http/Controllers/Admin/AuditLogController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua log, urutkan dari yang terbaru, dan lakukan pagination (misalnya 20 per halaman)
        $logs = AuditLog::with('user')->latest()->paginate(20);
        
        return view('admin.audit-log.index', compact('logs'));
    }
}