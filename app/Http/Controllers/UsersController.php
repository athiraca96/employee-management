<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Http\Requests\EmployeeCreateRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * @group Employee Management
     * @unauthenticated
     *
     * List all employees.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    public function create()
    {
        $companies = Company::all();

        return view('users.create', compact('companies'));
    }

    public function store(EmployeeCreateRequest $request)
    {
        $input = $request->validated();

        $user = User::create($input);
        $user->assignRole('employee');

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }

    public function show(User $employee)
    {
        return view('users.show', compact('employee'));
    }

    public function edit(User $employee)
    {
        $companies = Company::all();

        return view('users.edit', compact('employee', 'companies'));
    }

    public function update(EmployeeCreateRequest $request, User $employee)
    {
        $input = $request->validated();

        if ($request->has('password') && $input['password'] !== null) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }

        $employee->update($input);


        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(User $employee)
    {
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
