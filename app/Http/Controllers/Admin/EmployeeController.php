<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Display all employees
    public function index()
    {
        $employees = Employee::all();
        return view('admin.employee', compact('employees'));
    }

    // Store new employee
    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required|string|max:255',
            'email'         => 'required|email|unique:employees,email',
            'contact_number'         => 'required|string|max:20',
            'position'      => 'required|string|max:100',
        ]);

        Employee::create($request->all());

        return redirect()->route('admin.employee')->with('success', 'Employee added successfully.');
    }

    // Show edit form
    public function edit(Employee $employee)
    {
        return view('admin.employee_edit', compact('employee'));
    }

    // Update employee
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'employee_name' => 'required|string|max:255',
            'email'         => 'required|email|unique:employees,email,' . $employee->employee_id . ',employee_id',
            'contact_number'         => 'required|string|max:20',
            'position'      => 'required|string|max:100',
            'status'        => 'required|in:active,on_leave,inactive',
        ]);

        $employee->update($request->all());

        return redirect()->route('admin.employee')->with('success', 'Employee updated successfully.');
    }

    // Delete employee
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('admin.employee')->with('success', 'Employee deleted successfully.');
    }
}