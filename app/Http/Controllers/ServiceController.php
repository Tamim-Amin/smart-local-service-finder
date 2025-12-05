<?php
namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::where('verification_status', 'approved');

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->has('min_rating')) {
            $query->where('average_rating', '>=', $request->min_rating);
        }

        $services = $query->paginate(12);
        $categories = Category::where('is_active', true)->get();

        return view('services.index', compact('services', 'categories'));
    }

    public function show(Service $service)
    {
        $service->load(['user', 'category', 'reviews.customer']);
        return view('services.show', compact('service'));
    }

    // Provider Methods
    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('provider.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'bio' => 'required|string',
            'years_of_experience' => 'required|integer|min:0',
            'hourly_rate' => 'required|numeric|min:0',
            'location' => 'required|string',
            'skills' => 'nullable|array',
        ]);

        $validated['user_id'] = auth()->id();
        Service::create($validated);

        return redirect()->route('provider.dashboard')
            ->with('success', 'Service profile created successfully');
    }

    public function edit(Service $service)
    {
        $this->authorize('update', $service);
        $categories = Category::where('is_active', true)->get();
        return view('provider.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $this->authorize('update', $service);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'bio' => 'required|string',
            'years_of_experience' => 'required|integer|min:0',
            'hourly_rate' => 'required|numeric|min:0',
            'location' => 'required|string',
            'skills' => 'nullable|array',
            'availability_status' => 'in:available,busy,offline',
        ]);

        $service->update($validated);

        return redirect()->route('provider.dashboard')
            ->with('success', 'Service profile updated successfully');
    }
}