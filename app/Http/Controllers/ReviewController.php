<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Booking;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Booking $booking)
    {
        if ($booking->customer_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->status !== 'completed') {
            return back()->with('error', 'Can only review completed bookings');
        }

        if ($booking->review) {
            return back()->with('error', 'You have already reviewed this service');
        }

        return view('reviews.create', compact('booking'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000',
        ]);

        $booking = Booking::findOrFail($validated['booking_id']);

        if ($booking->customer_id !== auth()->id()) {
            abort(403);
        }

        if ($booking->review) {
            return back()->with('error', 'Review already exists');
        }

        $validated['customer_id'] = auth()->id();
        $validated['service_id'] = $booking->service_id;

        Review::create($validated);

        return redirect()->route('customer.bookings')
            ->with('success', 'Review submitted successfully');
    }
}