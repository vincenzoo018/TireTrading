<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;

class CustomerBookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,services_id',
            'customer_name' => 'required|string|max:255',
            'customer_contact' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'vehicle_info' => 'required|string|max:255',
        ]);

        $booking = new Booking();
        $booking->service_id = $request->service_id;
        $booking->customer_name = $request->customer_name;
        $booking->customer_contact = $request->customer_contact;
        $booking->booking_date = $request->booking_date;
        $booking->vehicle_info = $request->vehicle_info;
        $booking->status = 'pending';
        $booking->save();

        return redirect()->route('customer.booking')->with('success', 'Booking submitted successfully!');
    }
}
