<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::where('company_id', auth()->user()->company_id)
            ->where('level', 2)
            ->orderBy('name')
            ->paginate(8);
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::where('company_id', auth()->user()->company_id)
            ->orderBy('name')
            ->get();
        return view('employee.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users',
            'department_id' => 'required',
            'password' => 'required',
        ]);

        try {
            $data['password'] = bcrypt($data['password']);
            $data['level'] = 2;
            $data['points'] = 0;
            $data['company_id'] = auth()->user()->company_id;
            User::create($data);
            return redirect()->route('dashboard.employee')->with('success', 'Employee created successfully');
        } catch (\Throwable $th) {
            Log::error($th);
            return redirect()->route('dashboard.employee.create')->with('error', 'Something went wrong. Please try again later.');
        }
    }
}
