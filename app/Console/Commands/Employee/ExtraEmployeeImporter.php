<?php

namespace App\Console\Commands\Employee;

use App\Models\Employee;
use App\Models\Organizer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ExtraEmployeeImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employee:import-extra {filename}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import extra employee and registered from app/data/filename';

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
            foreach ($csv_data as $line) {
                if (!$skipped_header) {
                    $skipped_header = true;
                    continue;
                }
                if ($line === '') continue;
                $row = explode(",", $line);
                $organizer = Organizer::where('fac_id', $row[4])->first();
                if (!$organizer) {
                    $this->line("FAC_ID Not found: {$row[4]}");
                }

                $employee = new Employee();
                $employee->p_id = $row[0];
                $employee->title = $row[1];
                $employee->name = $row[2] . " " . $row[3];
                $employee->organizer_id = $organizer->id;
                $employee->register_at = Carbon::now();
                $qr_code = fake()->regexify('[A-Z0-9]{32}');
                while (Employee::where('qr_code', $qr_code)->first()) {
                    $qr_code = fake()->regexify('[A-Z0-9]{32}');
                }
                $employee->qr_code = $qr_code;
                if (is_null($row[6]) or $row[6] === '') {
                    $this->line("{$row[0]} has no email");
                }
                else if (Employee::where('email', $row[6])->count() >= 1) {
                    $this->line("{$row[0]} Email {$row[6]} has been used!");
                }
                else {
                    $this->line("{$row[0]} >>> Email: {$row[6]}");
                    $employee->email = $row[6];
                }
                $employee->save();
                $organizer->member_amount = $organizer->member_amount + 1;
                $organizer->save();
            }

            DB::commit();

            $this->line(" Imported Success.");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error(" Something went wrong...");
            $this->error($e);
        }
        return Command::SUCCESS;
    }
}
