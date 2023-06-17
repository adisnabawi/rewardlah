<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function verify(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function registerCompany(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8',
            'company_name' => 'required',
            'company_address' => 'required',
            'company_ssm' => 'required'
        ]);

        try {
            DB::beginTransaction();
            $company = new Company;
            $company->name = $request->company_name;
            $company->address = $request->company_address;
            $company->ssm = $request->company_ssm;
            $company->save();

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->level = 1;
            $user->password = bcrypt($request->password);
            $user->company_id = $company->id;
            $user->save();
            DB::commit();
            Auth::login($user);

            return redirect()->route('dashboard.index');
        } catch (\Throwable $th) {
            Log::error('Register company error: ' . $th->getMessage());
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}
