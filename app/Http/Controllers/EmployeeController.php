<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmRegister;
use App\Models\Employee;
use App\Models\Organizer;
use App\Repositories\EmailRepository;
use App\Repositories\EmployeeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'search']);
    }

    public function index()
    {
        if (Auth::user()) return redirect()->route('/');
        return view('employees.register');
    }

    public function show($qr_code)
    {
        $employee = Employee::where('qr_code', $qr_code)->first();
        if (empty($employee)) {
            return redirect()->to('/');
        }
        $organizer_name = $employee->organizer->name;
        return view('employees.show', [
            'employee' => $employee,
            'organizer_name' => $organizer_name
        ]);
    }

    public function search(Request $request)
    {
        if (Auth::user()) return redirect()->route('/');

        $keyword = $request->input('keyword');
        $employees = Employee::searchName($keyword)->orderBy('name', 'asc')->get();
        return view('employees.search', ['employees' => $employees, 'keyword' => $keyword]);
    }

    # ---------------- Staff and Register zone ----------------
    public function all(Request $request)
    {
        $keyword = $request->query('keyword') ?? null;
        $query = Employee::query();
        if (!is_null($keyword)) {
            $query = $query->searchAllColumn($keyword);
            $employees = $query->oldest('arrive_at')->paginate(200);
            return view('staff.employees.all-employees', ['employees' => $employees, 'keyword' => $keyword]);
        }
        $employees = Employee::oldest('arrive_at')->paginate(200);
        return view('staff.employees.all-employees', ['employees' => $employees, 'keyword' => $keyword]);
    }

    public function registered(Request $request)
    {
        $keyword = $request->query('keyword') ?? null;
        $query = Employee::query();
        if (!is_null($keyword)) {
            $query = $query->searchAllColumn($keyword);
        }
        $employees = $query->whereNotNull('register_at')->latest('register_at')->paginate(200);
        return view('staff.employees.registered', ['employees' => $employees, 'islam' => Employee::where('islam', true)->count(), 'keyword' => $keyword]);
    }

    public function attended(Request $request)
    {
        $keyword = $request->query('keyword') ?? '';
        $query = Employee::query();
        if (!is_null($keyword)) {
            $query = $query->searchAllColumn($keyword);
        }
        $employees = $query->whereNotNull('arrive_at')->latest('arrive_at')->paginate(200);
        return view('staff.employees.attended', ['employees' => $employees, 'keyword' => $keyword]);
    }

    public function scan()
    {
        return view('staff.qr-code.index');
    }

    public function showUpload(Request $request)
    {
        $success = $request->query('success') ?? false;
        return view('staff.employees.upload', [
            'success' => $success
        ]);
    }

    public function createUpload(Request $request)
    {
        $path = Storage::putFile('data', $request->file('upload'));
        $filenames = explode('/', $path);
        $filename = end($filenames);
        Artisan::call('employee:import '.$filename);
        return redirect()->route('staff.employees.upload.show', [
            'success' => true
        ]);
    }

    public function create(Request $request)
    {
        $p_id = $request->input('p_id');
        $pre_t = $request->input('pre_t');
        $tname = $request->input('tname');
        $tsurname = $request->input('tsurname');
        $fac = $request->input('fac');
        $email = $request->input('email') ?? null;
        $t_facname = $request->input('t_facname');
        $islam = $request->input("islam") === "yes";

        // Variable for display at front-end, Is import new employee successful?
        $success = true;
        $employeeRepository = new EmployeeRepository();
        DB::beginTransaction();
        try {
            $organizer = Organizer::where('fac_id', $fac)->first();
            // If organizer not exits, create new one
            if (!$organizer) {
                $organizer = new Organizer();
                $organizer->fac_id = $fac;
                $organizer->name = $t_facname;
                $organizer->save();
            }

            // Save new employee
            $employee = new Employee();
            $employee->p_id = $p_id;
            $employee->title = $pre_t;
            $employee->name = $tname . ' ' . $tsurname;
            $employee->organizer_id = $organizer->id;
            $employee->email = $email;
            $employee->islam = $islam;
            $employee->save();

            // If add email in import form then send qr code via email
            if ($email != null) {
                $employee->register_at = Carbon::now();
                $employee->qr_code = $employeeRepository->generateCode($employee->p_id);
                $employee->save();
                $emailRepository = new EmailRepository();
                $emailRepository->sendUnsentEmail();
            }

            // Count new employee in organize
            $organizer->member_amount = $organizer->member_amount + 1;
            $organizer->save();

            DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            $success = false;
        }
        return redirect()->route('staff.employees.upload.show', [
            'success' => $success
        ]);
    }
}
