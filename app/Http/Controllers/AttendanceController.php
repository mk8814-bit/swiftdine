<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today()->toDateString();
        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today)
            ->first();

        return view('dashboard.attendance.index', compact('attendance'));
    }

    public function clockIn(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);

        $user = auth()->user();
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::firstOrCreate(
            ['user_id' => $user->id, 'date' => $today],
            ['status' => 'present']
        );

        if ($attendance->clock_in) {
            return response()->json(['success' => false, 'message' => 'Sudah absen datang hari ini.']);
        }

        $image = $request->image; // base64
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'attendance/in/' . $user->id . '_' . time() . '.png';
        Storage::disk('public')->put($imageName, base64_decode($image));

        $attendance->update([
            'clock_in' => now(),
            'face_verification_in' => $imageName,
        ]);

        return response()->json(['success' => true, 'message' => 'Absen datang berhasil!']);
    }

    public function clockOut(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);

        $user = auth()->user();
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today)
            ->first();

        if (!$attendance || !$attendance->clock_in) {
            return response()->json(['success' => false, 'message' => 'Belum absen datang hari ini.']);
        }

        if ($attendance->clock_out) {
            return response()->json(['success' => false, 'message' => 'Sudah absen pulang hari ini.']);
        }

        $image = $request->image; // base64
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'attendance/out/' . $user->id . '_' . time() . '.png';
        Storage::disk('public')->put($imageName, base64_decode($image));

        $attendance->update([
            'clock_out' => now(),
            'face_verification_out' => $imageName,
        ]);

        return response()->json(['success' => true, 'message' => 'Absen pulang berhasil!']);
    }
    public function report()
    {
        $attendances = Attendance::with('user')
            ->orderBy('date', 'desc')
            ->orderBy('clock_in', 'desc')
            ->paginate(10);

        return view('dashboard.attendance.report', compact('attendances'));
    }
}
