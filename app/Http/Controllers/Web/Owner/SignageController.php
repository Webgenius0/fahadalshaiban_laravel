<?php

namespace App\Http\Controllers\Web\Owner;

use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\Models\Signage;
use App\Models\Category;
use Illuminate\Http\Request;


class SignageController extends Controller
{
    public function index()
    {
        // Logic for displaying all signages
    }

    public function create()
    {
        // Logic for creating a new signage
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'description' => 'required|string',
            'avg_daily_views' => 'required|integer|min:0',
            'per_day_price' => 'required|numeric|min:0',
            'height' => 'required|string|max:255',
            'width' => 'required|string|max:255',
            'on_going_ad' => 'nullable|integer|min:0',
            'exposure_time' => 'required|string|max:255',
            'space_left_for_ad' => 'nullable|integer|min:0',
            'location' => 'required|string|max:255',
            'lat' => 'required|string|max:255',
            'lan' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'terms_and_conditions' => 'required|in:on',
            'privacy_policy' => 'required|in:on',
        ]);

        // Handle file upload for the image using the custom Helper
        if ($request->hasFile('image')) {
            $validatedData['image'] = Helper::fileUpload(
                $request->file('image'),
                'signages', // Correct directory name
                time() . '_' . $request->file('image')->getClientOriginalName()
            );
        }

        // Create the slug using the custom Helper method
        $slug = Helper::makeSlug(Signage::class, $validatedData['name']);

        // Create the new signage record
        Signage::create([
            'user_id' => auth()->id(),
            'name' => $validatedData['name'],
            'category_name' => $validatedData['category_name'],
            'slug' => $slug,
            'description' => $validatedData['description'],
            'avg_daily_views' => $validatedData['avg_daily_views'],
            'per_day_price' => $validatedData['per_day_price'],
            'height' => $validatedData['height'],
            'width' => $validatedData['width'],
            'exposure_time' => $validatedData['exposure_time'], // Assuming exposure time is the current time
            // 'on_going_ad' => $validatedData['on_going_ad'],
            // 'space_left_for_ad' => $validatedData['space_left_for_ad'],
            'location' => $validatedData['location'],
            'lat' => $validatedData['lat'],
            'lan' => $validatedData['lan'],
            'image' => $validatedData['image'] ?? null,
            'terms_and_conditions' => 'on',
            'privacy_policy' => 'on',
            'status' => 'inactive',
        ]);

        flash('Signage created successfully.');
        return redirect()->route('owner.dashboard');
    }

    public function showDetails($id)
    {
        $billboard = Signage::findOrFail($id);
        return response()->json([
            'data' => $billboard
        ]);
    }

    public function editSignage($id)
    {
        $categories = Category::all();
        $signage = Signage::findOrFail($id);

        return view('owner.layouts.edit-signaage', compact('signage', 'categories'));
    }

    public function update(Request $request, $id)
{
   
    // Find the signage by ID
    $signage = Signage::findOrFail($id);

    // Validate the incoming request
    $validatedData = $request->validate([
        'name' => 'nullable|string|max:255',
        'category_name' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'avg_daily_views' => 'nullable|integer|min:0',
        'per_day_price' => 'nullable|numeric|min:0',
        'exposure_time' => 'nullable|string|max:255',
        'height' => 'nullable|string|max:255',
        'width' => 'nullable|string|max:255',
        'location' => 'nullable|string|max:255',
        'lat' => 'nullable|string|max:255',
        'lan' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'terms_and_conditions' => 'nullable|in:on',
        'privacy_policy' => 'nullable|in:on',
    ]);

    // Debug the request data
 

    // Handle file upload for the image using the custom Helper
    if ($request->hasFile('image')) {
        // Debug file upload logic
       

        // Delete the old image file if it exists
        if ($signage->image && file_exists(public_path('images/signages/' . $signage->image))) {
            unlink(public_path('images/signages/' . $signage->image));
        }

        // Upload the new image
        $validatedData['image'] = Helper::fileUpload(
            $request->file('image'),
            'signages', // Correct directory name
            time() . '_' . $request->file('image')->getClientOriginalName()
        );
    }

    // Create the slug using the custom Helper method
    $slug = Helper::makeSlug(Signage::class, $validatedData['name']);
   

    // Update the signage record
    $signage->update([
        'name' => $validatedData['name'],
        'category_name' => $validatedData['category_name'],
        'slug' => $slug,
        'description' => $validatedData['description'],
        'avg_daily_views' => $validatedData['avg_daily_views'],
        'per_day_price' => $validatedData['per_day_price'],
       'exposure_time' => $validatedData['exposure_time'],
        'height' => $validatedData['height'],
        'width' => $validatedData['width'],
        'location' => $validatedData['location'],
        'lat' => $validatedData['lat'],
        'lan' => $validatedData['lan'],
        'image' => $validatedData['image'] ?? $signage->image,
        'terms_and_conditions' => 'on',
        'privacy_policy' => 'on',
    ]);

    session()->flash('success', 'Signage updated successfully');
    return redirect()->route('owner.dashboard');
}

}
