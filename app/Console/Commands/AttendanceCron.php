<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Models\Attendance;

class AttendanceCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customcmd:attendancecron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command used for attendance';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $attendance = Attendance::whereNull('date_day_out')->update(['status'=>3]);
        // \Log::info("Cron is working fine at 5 minut ".date('Y-m-d H:i:s')." !");
        // DB::table('test_tbl')->insert(['datas'=>date('Y-m-d H:i:s')]);
        // $attendance = Attendance::whereDate('date', '<', "2022-06-03")->whereNull('date_day_out')->update(['status'=>3]);
        //where(['date_day_out'=>''])->
        return 1;
    }
}
