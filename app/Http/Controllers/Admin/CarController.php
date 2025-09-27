<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of cars.
     */
    public function cars()
    {
        $cars = Car::orderBy('car_id', 'desc')->paginate(10);
        
        // Calculate stats
        $stats = [
            'totalCars' => Car::count(),
            'availableCars' => Car::available()->count(),
            'rentedCars' => Car::rented()->count(),
            'maintenanceCars' => Car::maintenance()->count(),
        ];

        return view('admin.cars', compact('cars') + $stats);
    }

    /**
     * Store a newly created car in the database.
     */
    public function storeCar(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'plate_number' => 'required|string|max:255|unique:cars',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string',
            'mileage' => 'required|integer|min:0',
            'type' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('images'), $photoName);
            $validated['photo'] = 'images/' . $photoName;
        }

        Car::create($validated);

        return redirect()->route('admin.cars')->with('success', 'Car added successfully!');
    }

    /**
     * Update the given car.
     */
    public function updateCar(Request $request, $carId)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'plate_number' => 'required|string|max:255|unique:cars,plate_number,' . $carId . ',car_id',
            'price' => 'required|numeric|min:0',
            'status' => 'required|string',
            'mileage' => 'required|integer|min:0',
            'type' => 'required|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $car = Car::findOrFail($carId);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete the old photo if it exists
            if ($car->photo && file_exists(public_path($car->photo))) {
                unlink(public_path($car->photo));
            }

            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('images'), $photoName);
            $validated['photo'] = 'images/' . $photoName;
        }

        $car->update($validated);

        return redirect()->route('admin.cars')->with('success', 'Car updated successfully!');
    }

    /**
     * Delete a car.
     */
    public function deleteCar($carId)
    {
        $car = Car::findOrFail($carId);

        // Delete the photo if it exists
        if ($car->photo && file_exists(public_path($car->photo))) {
            unlink(public_path($car->photo));
        }

        $car->delete();

        return redirect()->route('admin.cars')->with('success', 'Car deleted successfully!');
    }
}
