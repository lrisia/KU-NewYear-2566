<?php

namespace App\Console\Commands\Employee;

use App\Models\Employee;
use App\Models\Organizer;
use App\Repositories\EmailRepository;
use App\Repositories\EmployeeRepository;
use Carbon\Carbon;
use Exception;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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


        try {
            DB::beginTransaction();
            $bar = $this->output->createProgressBar(count($csv_data) - 1);

            $bar->start();

            $employeeRepository = new EmployeeRepository();
            foreach ($csv_data as $line) {
                if (empty($line)) continue;
                if (!$skipped_header) {
                    $skipped_header = true;
                    continue;
                }
                $row = explode(",", $line);
                $organizer = Organizer::where('fac_id', trim($row[4]))->first();
                if (!$organizer) {
                    $organizer = $this->createOrganizer(trim($row[4]), trim($row[5]));
                }

                $employee = Employee::where('p_id', trim($row[0]))->first();
                if (!$employee) {
                    $employee = new Employee();
                    $employee->p_id = trim($row[0]);
                    $employee->title = trim($row[1]);
                    $employee->name = trim($row[2]) . " " . trim($row[3]);
                    $employee->organizer_id = $organizer->id;
                    if (count($row) >= 7) {
                        $employee->register_at = Carbon::now();
                        $employee->email = trim($row[6]);
                        $employee->qr_code = $employeeRepository->generateCode($employee->p_id);
                        $employee->save();
                    }
                    if (count($row) >= 8) {
                        $employee->islam = trim($row[7]) === "1";
                        $employee->save();
                    }
                    $employee->save();
                    $organizer->member_amount += 1;
                    $organizer->save();
                }

                $bar->advance();
            }
            DB::commit();
            $bar->finish();
            $this->line(" Imported Success.");

            // Send email after imported success
            $emailRepository = new EmailRepository();
            $emailRepository->sendUnsentEmail();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            $this->error(" Something went wrong...");
        }

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
