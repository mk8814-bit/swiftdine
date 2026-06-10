<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $today = Carbon::today()->toDateString();
        $users = User::whereIn('role', ['admin', 'waiter', 'kasir', 'barista', 'koki', 'baker', 'staf_gudang'])->get();

        foreach ($users as $user) {
            Attendance::create([
                'user_id' => $user->id,
                'date' => $today,
                'clock_in' => Carbon::now()->setHour(8)->setMinute(rand(0, 30)),
                'clock_out' => Carbon::now()->setHour(17)->setMinute(rand(0, 30)),
                'status' => 'present'
            ]);
        }
    }
}
