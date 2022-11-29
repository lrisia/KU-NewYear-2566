<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\Organizer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EmployeeImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employee:import {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import employee csv data from app/data/filename';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = $this->argument('filename');
        $csv = Storage::disk('local')->get('data/' . $filename);
        $skipped_header = false;
        foreach (explode("\n", $csv) as $line) {
            if (!$skipped_header) {
                $skipped_header = true;
                continue;
            }
            $row = explode(",", $line);
            $organizer = Organizer::where('fac_id', $row[4])->first();
            if (!$organizer) $this->createOrganizer($row[4], $row[5]);
            $organizer = Organizer::where('fac_id', $row[4])->first();
            $organizer->member_amount += 1;
            $organizer->save();

            $employee = new Employee();
            $employee->p_id = $row[0];
            $employee->title = $row[1];
            $employee->name = $row[2] . " " . $row[3];
            $employee->organizer_id = Organizer::where('fac_id', $row[4])->first()->id;
            $employee->save();


        }
        return Command::SUCCESS;
    }

    private function createOrganizer($fac_id, $name) {
        $organizer = new Organizer();
        $organizer->fac_id = $fac_id;
        $organizer->name = $name;
        $organizer->save();
    }
}
