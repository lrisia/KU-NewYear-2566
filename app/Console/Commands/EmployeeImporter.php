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
        $csv = Storage::disk('local')->get("data/{$filename}");
        $skipped_header = false;
        $csv_data = explode("\n", $csv);

        $bar = $this->output->createProgressBar(count($csv_data) - 1);

        $bar->start();

        foreach ($csv_data as $line) {
            if (!$skipped_header) {
                $skipped_header = true;
                continue;
            }
            $row = explode(",", $line);
            $organizer = Organizer::where('fac_id', $row[4])->first();
            if (!$organizer) {
                $organizer = $this->createOrganizer($row[4], $row[5]);
            }
            $organizer->member_amount = $organizer->member_amount + 1;
            $organizer->save();

            $employee = new Employee();
            $employee->p_id = $row[0];
            $employee->title = $row[1];
            $employee->name = $row[2] . " " . $row[3];
            $employee->organizer_id = $organizer->id;
            $employee->save();

            $bar->advance();
        }
        $bar->finish();
        $this->line("Imported Success.");
        return Command::SUCCESS;
    }

    private function createOrganizer($fac_id, $name) {
        $organizer = new Organizer();
        $organizer->fac_id = $fac_id;
        $organizer->name = $name;
        $organizer->save();
        return $organizer;
    }
}
