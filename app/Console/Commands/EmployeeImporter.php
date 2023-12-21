<?php

namespace App\Console\Commands;

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

        DB::beginTransaction();
        try {
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
                $organizer = Organizer::where('fac_id', $row[4])->first();
                if (!$organizer) {
                    $organizer = $this->createOrganizer($row[4], $row[5]);
                }

                $employee = Employee::where('p_id', $row[0])->first();
                if (!$employee) {
                    $employee = new Employee();
                    $employee->p_id = $row[0];
                    $employee->title = $row[1];
                    $employee->name = $row[2] . " " . $row[3];
                    $employee->organizer_id = $organizer->id;
                    if (count($row) >= 7) {
                        $employee->register_at = Carbon::now();
                        $employee->email = $row[6];
                        $employee->qr_code = $employeeRepository->generateCode($employee->p_id);
                        $employee->save();
                        $emailRepository = new EmailRepository();
                        $emailRepository->sendUnsentEmail();
                    }
                    if (count($row) >= 8) {
                        $employee->islam = $row[7] == "1";
                        $employee->save();
                    }
                    $employee->save();
                    $organizer->member_amount = $organizer->member_amount + 1;
                    $organizer->save();

//                    if ($row[6] != null) {
//                        $employee->register_at = Carbon::now();
//                        $employee->qr_code = $employeeRepository->generateCode($employee->p_id);
//                        $employee->save();
//                        $emailRepository = new EmailRepository();
//                        $emailRepository->sendUnsentEmail();
//                    }
                }

                $bar->advance();
            }
            DB::commit();
            $bar->finish();
            $this->line(" Imported Success.");
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
