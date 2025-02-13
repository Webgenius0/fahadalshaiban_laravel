<?php
namespace App\Http\Controllers\Web\Owner;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use App\Models\Signage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

use function Laravel\Prompts\alert;

class SignageController extends Controller
{
    public function index()
    {
       
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description'=>'required|string',
            'category_name' => 'required|string|max:255',
            'lat' => 'required|string|max:255',
            'lan' => 'required|string|max:255',
            'avg_daily_views' => 'required|integer|min:0',
            'per_day_price' => 'required|numeric|min:0',
            'display_size' => 'required|string',
            'exposure_time' => 'required|string',
            'on_going_ad' => 'required|integer|min:0',
            'space_left_for_ad' => 'required|integer|min:0',
            'location' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'terms_and_conditions' => 'required|in:on,off',
            'privacy_policy' => 'required|in:on,off',
        ]);
    
        
        $validatedData['user_id'] = auth('web')->id();
    
        
        if ($request->hasFile('image')) {
            $validatedData['image'] = Helper::fileUpload($request->file('image'), 'signage', time() . '_' . getFileName($request->file('image')));
        }
    
       
        $validatedData['slug'] = Helper::makeSlug(Signage::class, $validatedData['name']);
    
        
       // Log::info('Validated Data before insert', ['validated_data' => $validatedData]);
    
        try {
          
            Signage::create($validatedData);
            //Log::info('New signage created', ['signage' => $validatedData]);
            return redirect()->route('owner.dashboard')->with('success', 'Created successfully');
        } catch (Exception $e) {
           
            //Log::error('Error creating signage', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    

    public function showDetails($id)
    {
        
        $billboard= Signage::findOrFail($id);  
        //Log::info('Signage Data:', $billboard->toArray());
        return response()->json([
            'data'=>$billboard

        ]);
    }


    //edit 
    public function editSignage($id)
    {
        $categories =Category::all();
        $signage = Signage::findOrFail($id);
    
        return view('owner.layouts.edit-signaage', compact('signage','categories'));
    }


    //update 
    public function update(Request $request, $id)
    {
    $signage = Signage::findOrFail($id);

    // Validate the data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'category_name' => 'required|string|max:255',
        'description' => 'required|string',
        'lat' => 'required|string|max:255',
        'lan' => 'required|string|max:255',
        'avg_daily_views' => 'required|integer|min:0',
        'per_day_price' => 'required|numeric|min:0',
        'display_size' => 'required|string',
        'exposure_time' => 'required|string',
        'on_going_ad' => 'required|integer|min:0',
        'space_left_for_ad' => 'required|integer|min:0',
        'location' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
    ]);

    
    if ($request->hasFile('image')) {
        
        if ($signage->image && file_exists(public_path('images/signages/' . $signage->image))) {
            unlink(public_path('images/signages/' . $signage->image));
        }

        
        $image = $request->file('image');
        $validatedData['image'] = Helper::fileUpload($image, 'signage', time() . '_' . getFileName($image));
    }

   
    $validatedData['slug'] = Helper::makeSlug(Signage::class, $validatedData['name']);

    
    $signage->fill($validatedData);
    $signage->save();

    return redirect()->route('owner.page.add.signage')->with('success', 'Signage updated successfully');
}
    

    
}