<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Display all bookings with optional filters
    public function index(Request $request)
    {
        $query = Booking::with(['service', 'customer']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        if ($request->has('date') && $request->date != '') {
            $query->whereDate('booking_date', $request->date);
        }

        if ($request->has('service_id') && $request->service_id != '') {
            $query->where('service_id', $request->service_id);
        }

        $bookings = $query->paginate(10);
        $services = Service::all();

        $stats = [
            'totalBookings' => Booking::count(),
            'confirmedBookings' => Booking::where('status', 'confirmed')->count(),
            'pendingBookings' => Booking::where('status', 'pending')->count(),
            'cancelledBookings' => Booking::where('status', 'cancelled')->count(),
        ];

        return view('admin.bookings', compact('bookings', 'services') + $stats);
    }

    // Update booking status
    public function update(Request $request, $bookingId)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $booking = Booking::findOrFail($bookingId);
        $booking->update($request->only('status'));

        return redirect()->route('admin.bookings')
            ->with('success', 'Booking status updated successfully.');
    }

    // Delete booking
    public function destroy($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        $booking->delete();

        return redirect()->route('admin.bookings')
            ->with('success', 'Booking deleted successfully.');
    }
}