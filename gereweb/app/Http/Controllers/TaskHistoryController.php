<?php

namespace App\Http\Controllers;

use App\Models\TaskHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskHistoryController extends Controller
{
    public function index()
    {
        $history = Auth::user()->taskHistories()->with('task')->get();
        return response()->json($history);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
        ]);

        $history = Auth::user()->taskHistories()->create([
            'task_id' => $validated['task_id'],
            'completed_at' => now(),
        ]);

        return response()->json($history, 201);
    }
}
