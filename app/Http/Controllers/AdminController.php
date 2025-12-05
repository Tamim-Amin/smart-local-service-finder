<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_providers' => User::where('role', 'provider')->count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'pending_verifications' => Service::where('verification_status', 'pending')->count(),
            'total_bookings' => Booking::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function blockUser(User $user)
    {
        $user->update(['status' => 'blocked']);
        return back()->with('success', 'User blocked successfully');
    }

    public function unblockUser(User $user)
    {
        $user->update(['status' => 'active']);
        return back()->with('success', 'User unblocked successfully');
    }

    public function pendingVerifications()
    {
        $services = Service::where('verification_status', 'pending')
            ->with(['user', 'category'])
            ->paginate(20);

        return view('admin.verifications.index', compact('services'));
    }

    public function approveService(Service $service)
    {
        $service->update(['verification_status' => 'approved']);
        return back()->with('success', 'Service approved successfully');
    }

    public function rejectService(Service $service)
    {
        $service->update(['verification_status' => 'rejected']);
        return back()->with('success', 'Service rejected');
    }
}