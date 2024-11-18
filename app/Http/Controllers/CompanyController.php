<?php

namespace App\Http\Controllers;

use App\DataTables\CompaniesDataTable;
use App\Http\Requests\CompanyCreateRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index(CompaniesDataTable $dataTable)
    {
        return $dataTable->render('companies.index');
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(CompanyCreateRequest $request)
    {
        $input = $request->validated();

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $fileName = 'logo_' . time() . rand(1, 1000) . '.' . $logo->getClientOriginalExtension();
            $input['logo'] = Storage::disk('public')->putFileAs('logo', $logo, $fileName);
        }

        Company::create($input);


        return redirect()->route('companies.index')->with('success', 'Company addedd successfully.');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(CompanyCreateRequest $request, Company $company)
    {
        $input = $request->validated();

        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::delete($company->logo);
            }
            // Store the new logo
            $logo = $request->file('logo');
            $fileName = 'logo_' . time() . rand(1, 1000) . '.' . $logo->getClientOriginalExtension();
            $input['logo'] = Storage::disk('public')->putFileAs('logo', $logo, $fileName);
        }

        $company->update($input);


        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
