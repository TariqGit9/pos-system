<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Modules\Currency\Entities\Currency;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::withCount('users')->get();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'nullable|email|max:255',
            'company_phone' => 'nullable|string|max:255',
            'company_address' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:users,email',
            'admin_password' => 'required|string|min:8|confirmed',
        ]);

        $defaultCurrency = Currency::where('code', 'PKR')->first() ?? Currency::first();

        $logoPath = null;
        if ($request->hasFile('company_logo')) {
            $logoPath = $request->file('company_logo')->store('companies', 'public');
        }

        $company = Company::create([
            'name' => $request->company_name,
            'email' => $request->company_email,
            'phone' => $request->company_phone,
            'address' => $request->company_address,
            'site_logo' => $logoPath,
            'default_currency_id' => $defaultCurrency?->id,
            'default_currency_position' => 'prefix',
            'is_active' => true,
        ]);

        // Create company admin user
        $user = User::create([
            'name' => $request->admin_name,
            'email' => $request->admin_email,
            'password' => Hash::make($request->admin_password),
            'company_id' => $company->id,
            'is_active' => true,
            'is_super_admin' => false,
        ]);

        $user->assignRole('Admin');

        toast('Company created successfully!', 'success');
        return redirect()->route('companies.index');
    }

    public function show(Company $company)
    {
        return redirect()->route('companies.edit', $company);
    }

    public function edit(Company $company)
    {
        $users = User::where('company_id', $company->id)->get();
        return view('companies.edit', compact('company', 'users'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'nullable|email|max:255',
            'company_phone' => 'nullable|string|max:255',
            'company_address' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $data = [
            'name' => $request->company_name,
            'email' => $request->company_email,
            'phone' => $request->company_phone,
            'address' => $request->company_address,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('company_logo')) {
            if ($company->site_logo) {
                Storage::disk('public')->delete($company->site_logo);
            }
            $data['site_logo'] = $request->file('company_logo')->store('companies', 'public');
        }

        $company->update($data);

        cache()->forget('settings_company_' . $company->id);
        cache()->forget('settings_default');

        toast('Company updated successfully!', 'success');
        return redirect()->route('companies.index');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        toast('Company deleted successfully!', 'success');
        return redirect()->route('companies.index');
    }

    public function enter(Company $company)
    {
        session(['impersonating_company_id' => $company->id]);

        toast('Entered ' . $company->name, 'info');
        return redirect()->route('home');
    }

    public function leave()
    {
        session()->forget('impersonating_company_id');

        toast('Returned to company management', 'info');
        return redirect()->route('companies.index');
    }
}
