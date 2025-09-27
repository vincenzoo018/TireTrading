<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Employee;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Display all services
    public function index()
    {
        $services = Service::with('employee')->get();
        $employees = Employee::all();

        $stats = [
            'totalServices' => Service::count(),
            'activeServices' => Service::where('status', 'active')->count(),
            'pendingServices' => Service::where('status', 'pending')->count(),
            'totalEmployees' => Employee::count(),
        ];

        return view('admin.services', compact('services', 'employees') + $stats);
    }

    // Store new service
    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'service_price' => 'required|numeric|min:0',
            'employee_id' => 'required|exists:employees,employee_id',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        Service::create($request->all());

        return redirect()->route('admin.services')
            ->with('success', 'Service created successfully.');
    }

    // Update existing service
    public function update(Request $request, $serviceId)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'service_price' => 'required|numeric|min:0',
            'employee_id' => 'required|exists:employees,employee_id',
            'status' => 'required|in:active,inactive',
            'description' => 'nullable|string',
        ]);

        $service = Service::findOrFail($serviceId);
        $service->update($request->all());

        return redirect()->route('admin.services')
            ->with('success', 'Service updated successfully.');
    }

    // Delete service
    public function destroy($serviceId)
    {
        $service = Service::findOrFail($serviceId);
        $service->delete();

        return redirect()->route('admin.services')
            ->with('success', 'Service deleted successfully.');
    }
}