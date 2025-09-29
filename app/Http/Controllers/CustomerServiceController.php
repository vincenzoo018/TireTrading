<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Booking;

class CustomerServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::where('status', 'active');

        // Filtering
        if ($request->filled('search')) {
            $query->where('service_name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('service_price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('service_price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('service_name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('service_name', 'desc');
                    break;
            }
        }

        $services = $query->get();

        // Get booked service IDs
        $bookedServiceIds = Booking::where('status', 'pending')->pluck('service_id')->toArray();

        return view('customer.services', [
            'services' => $services,
            'bookedServiceIds' => $bookedServiceIds,
        ]);
    }
}
