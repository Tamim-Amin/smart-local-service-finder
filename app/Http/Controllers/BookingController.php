<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Customer Methods
    public function create(Service $service)
    {
        return view('bookings.create', compact('service'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'problem_description' => 'required|string',
            'preferred_date' => 'required|date|after:today',
            'preferred_time' => 'required|string',
            'customer_location' => 'required|string',
        ]);

        $validated['customer_id'] = auth()->id();
        Booking::create($validated);

        return redirect()->route('customer.bookings')
            ->with('success', 'Booking request sent successfully');
    }

    public function customerIndex()
    {
        $bookings = Booking::where('customer_id', auth()->id())
            ->with(['service.user', 'service.category'])
            ->latest()
            ->paginate(10);

        return view('customer.bookings.index', compact('bookings'));
    }

    // Provider Methods
    public function providerIndex()
    {
        $service = auth()->user()->service;
        if (!$service) {
        return redirect()->route('provider.services.create')
            ->with('warning', 'Please create a service profile first.');
    }
        $bookings = Booking::where('service_id', $service->id)
            ->with('customer')
            ->latest()
            ->paginate(10);

        return view('provider.bookings.index', compact('bookings'));
    }

    public function accept(Booking $booking)
    {
        $this->authorize('manage', $booking);
        $booking->update(['status' => 'accepted']);

        return back()->with('success', 'Booking accepted successfully');
    }

    public function reject(Booking $booking)
    {
        $this->authorize('manage', $booking);
        $booking->update(['status' => 'rejected']);

        return back()->with('success', 'Booking rejected');
    }

    public function complete(Booking $booking)
    {
        $this->authorize('manage', $booking);
        $booking->update(['status' => 'completed']);

        return back()->with('success', 'Booking marked as completed');
    }
}