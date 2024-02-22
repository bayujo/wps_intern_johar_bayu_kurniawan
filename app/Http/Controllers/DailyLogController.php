<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyLog as DailyLog;
use App\Models\Employee;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DailyLogController extends Controller
{
    public function getEventsForFullCalendar()
    {
        $loggedInUserId = Auth::id();

        $supervisedEmployeeIds = Employee::where('supervisor_id', $loggedInUserId)->pluck('id');

        $events = DailyLog::whereIn('employee_id', $supervisedEmployeeIds)
            ->whereNotNull('log_text')
            ->get()
            ->map(function ($log) {
                return [
                    'id' => $log->id,
                    'title' => $log->employee->name,
                    'start' => $log->created_at->format('Y-m-d'),
                    'url' => asset(@$log->log_file),
                    'logText' => $log->log_text,
                    'logFileUrl' => asset(@$log->log_file)
                ];
            });

        return response()->json($events);
    }


    public function index()
    {

        $options = [
            'status' => DB::table('statuses')->distinct()->pluck('name')->toArray()
            //'option2' => DB::table('table2')->distinct()->pluck('field2')->toArray()
            //'option3' => DB::table('table3')->distinct()->pluck('filed3')->toArray()
        ];

        return view("log.index", compact("options"));
    }

    public function table()
    {
        $loggedInUserId = Auth::id();

        $supervisedEmployees = Employee::where('supervisor_id', $loggedInUserId)->pluck('id');

        $data = DailyLog::whereIn('employee_id', $supervisedEmployees)
            ->with('statuses')
            ->get()
            ->sortByDesc('created_at');

        return view("log.table", compact("data"));
    }

    public function self()
    {
        $today = Carbon::today();
        $log = DailyLog::where('employee_id', Auth::user()->id)
            ->whereDate('created_at', $today)
            ->first();

        return view("log.self", compact("log"));
    }

    public function add(Request $request)
    {
        $request->validate([
            'log_text' => 'required',
            'log_file' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
        ]);

        $user = auth()->user();

        $dailyLog = new DailyLog();
        $dailyLog->employee_id = $user->employee->id;
        $dailyLog->log_text = $request->log_text;

        if ($request->hasFile('log_file')) {
            $file = $request->file('log_file');
            $fileName = $file->getClientOriginalName();
            $filePath = 'log_files/' . $fileName;
            $file->move(public_path('log_files'), $fileName);
            $dailyLog->log_file = $filePath;
        }

        $dailyLog->save();

        return redirect()->back()->with('success', 'Log added successfully');
    }

    public function update(Request $request)
    {
        if (Auth::user()->id != $request->id) {
            $dailyLog = DailyLog::findOrFail($request->ID);
            $dailyLog->status = Status::where('name', $request->Status)->first()->id;

            $dailyLog->save();

            return response()->json(['message' => 'Log updated successfully']);
        }

        $dailyLog = DailyLog::findOrFail($request->log_id);

        $dailyLog->status = 1;
        $dailyLog->log_text = $request->log_text;

        if ($request->hasFile('log_file')) {
            if ($dailyLog->log_file) {
                $oldFilePath = public_path($dailyLog->log_file);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file = $request->file('log_file');
            $fileName = $file->getClientOriginalName();
            $filePath = 'log_files/' . $fileName;
            $file->move(public_path('log_files'), $fileName);
            $dailyLog->log_file = $filePath;
        }

        $dailyLog->save();

        return redirect()->back()->with('success', 'Log updated successfully');
    }

    public function delete($id)
    {
        $employee = DailyLog::find($id);
        $user = User::find($employee->user->id);

        $employee->delete();
        $user->delete();

        return response()->json(['message' => 'DailyLog deleted successfully']);
    }
}
