<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::where('company_id', auth()->user()->company_id)
            ->orderBy('name')
            ->paginate(5);
        return view('department.index', compact('departments'));
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'color' => 'required'
        ]);
        $department = Department::where('company_id', auth()->user()->company_id)
            ->where('name', $request->name)
            ->first();
        if ($department) {
            return redirect()->back()->with('error', 'Department already exist');
        }

        try {
            $department = new Department;
            $department->name = $request->name;
            $department->color = $request->color;
            $department->company_id = auth()->user()->company_id;
            $department->save();

            return redirect()->route('dashboard.department')->with('success', 'Department created');
        } catch (\Throwable $th) {
            Log::error('Create department error: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
