<?php

namespace App\Http\Controllers\Web\Client;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CampaignDetails;
use App\Models\Signage;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Tutorial;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function tutorials()
    {
        $tutorials = Tutorial::where('section', 'user')->get();
        return view('client.layouts.tutorial', compact('tutorials'));
    }

    public function profile()
    {
        return view('client.layouts.profile');
    }

    public function updateProfile(Request $request)
    {

        try {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'nullable',  // Make password optional
                'confirm_password' => 'nullable|same:password',
                'phone' => 'required',
                'address' => 'required',
                'vat_no' => 'required',
                'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Uncomment if you want to validate the avatar image type
            ]);

            // Get the currently authenticated user
            $user = auth()->user();

            // Update user details
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->vat_no = $request->vat_no;

            // Handle avatar upload (if any)
            $avatar = $request->file('avatar');
            if ($avatar) {
                // Delete existing avatar if it exists
                if ($user->avatar && file_exists(public_path($user->avatar))) {
                    Helper::fileDelete(public_path($user->avatar));
                }


                $imageName = time() . '.' . $avatar->getClientOriginalExtension();
                $imagePath = Helper::fileUpload($avatar, 'client/profile', $imageName);


                if ($imagePath === null) {
                    throw new \Exception('Failed to upload image.');
                }


                $user->avatar = $imagePath;
            }

            // Update password if the user has provided it
            if ($request->password) {

                if (Hash::check($request->password, $user->password)) {

                    $user->password = Hash::make($request->password);
                } else {

                    throw new \Exception('Current password is incorrect');
                }
            }
            $user->save();

            session()->put('t-success', 'Profile updated successfully.');
            return redirect()->route('client.profile');
        } catch (\Exception $e) {


            return redirect()->back()->with('t-error', 'Error: ' . $e->getMessage())->withInput();
        }
    }

    public function invoiceList()
    {
        return view('client.layouts.invoice-list');
    }

    public function invoice()
    {
        return view('client.layouts.invoice');
    }

    public function newCampaigns(Request $request)
    {
        if ($request->ajax()) {
            $query = Signage::query();
    
            // Filter by city (only if city is provided)
            if ($request->has('city') && !empty($request->city)) {
                $query->where('location', $request->city);
            }
    
            // Filter by category (only if category is provided)
            if ($request->has('category') && !empty(trim($request->category))) {
                $query->where('category_name', $request->category);
            }
    
            // Filter by daily views (only if daily_views is provided)
            if ($request->has('daily_views') && !empty($request->daily_views)) {
                $dailyViewsRange = explode('-', $request->daily_views);
                if (count($dailyViewsRange) == 2) {
                    $minViews = (int) $dailyViewsRange[0];
                    $maxViews = (int) $dailyViewsRange[1];
                    $query->whereBetween('avg_daily_views', [$minViews, $maxViews]);
                }
            }
    
            // Filter by exposure time (only if exposure_time is provided)
            if ($request->has('exposure_time') && !empty($request->exposure_time)) {
                $exposureTimeRange = explode('-', $request->exposure_time);
                if (count($exposureTimeRange) == 2) {
                    $minExposureTime = (int) $exposureTimeRange[0];
                    $maxExposureTime = (int) $exposureTimeRange[1];
                    $query->whereBetween('exposure_time', [$minExposureTime, $maxExposureTime]);
                }
            }
    
            // Filter by selected date (only if selected_date is provided)
            if ($request->has('selected_date') && !empty($request->selected_date)) {
                $selectedDate = $request->selected_date; // Format: YYYY-MM-DD
    
                // Filter signages with no campaigns or campaigns that ended before the selected date
                $query->where(function ($query) use ($selectedDate) {
                    // Signages with no campaigns
                    $query->doesntHave('orderItems.campaignDetails')
                          ->orWhereHas('orderItems.campaignDetails', function ($query) use ($selectedDate) {
                              // Signages with campaigns that ended before the selected date
                              $query->whereDate('end_date', '<', $selectedDate);
                          });
                });
    
                // Log the query and bindings
                // \Log::info('Query with selected date:', [
                //     'sql' => $query->toSql(),
                //     'bindings' => $query->getBindings(),
                // ]);
            } else {
                // If no date is selected, return all signages (no date filtering)
                // \Log::info('Query without selected date: Returning all signages.');
            }
    
            // Get the filtered signages
            $signages = $query->get();
    
            // Return JSON response with filtered signages and cities
            $cities = Signage::select('location')->distinct()->get(); // Get unique cities
    
            return response()->json([
                'signages' => $signages,
                'cities' => $cities
            ]);
        }
    
        // Normal page load
        $signages = Signage::take(20)->where('status', 'active')->get(); // You can limit the number of results for better performance
        $categories = Category::all();
        $cities = Signage::select('location')->distinct()->get(); // Get unique cities
    
        return view('client.layouts.new-campaigns', compact('signages', 'categories', 'cities'));
    }

    public function billing()
    {
        return view('client.layouts.billing');
    }

    public function cart()
    {
        return view('client.layouts.cart');
    }

    public function startedForm()
    {
        return view('client.layouts.get-started-form');
    }

    // for detact location according to lat and lan
    public function getLocation($id)
    {
        try {
            $signage = Signage::find($id);
            if (!$signage) {
                return response()->json(['error' => 'Signage not found'], 404);
            }
            return response()->json([
                'name' => $signage->name,
                'image'=>$signage->image,
                'signage_id' => $signage->id,
                'user_id' => $signage->user_id,
                'location' => $signage->location,
                'description' => $signage->description,
                'location' => $signage->location,
                'actual_height' => $signage->actual_height,
                'actual_width' => $signage->actual_width,
                'type' => $signage->type,
                'price_per_day' => $signage->per_day_price,
                'rotation_time' => $signage->rotation_time,
                'total_views' => $signage->total_views,
                'height' => $signage->height,
                'width' => $signage->width,
                'exposure_time' => $signage->exposure_time,
                'category_name' => $signage->category_name,
                'avg_daily_views' => $signage->avg_daily_views
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
    //store 

    public function checkout(Request $request)
    {
         
      
        $request->validate([
            'items' => 'required|array',
            'subtotal' => 'required|numeric',
            'dispatchFee' => 'required|numeric',
            'total' => 'required|numeric',
            'addTitle' => 'nullable|string',
            'description' => 'nullable|string',
            'art_work' => 'nullable|string',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date',
            'artWork' => 'nullable|string',
            'total_days' => 'nullable|string',

            // 'owner_id'=>'required',
            'admin_profit'=>'nullable',
            'owner_profit'=>'nullable',
            'total_charge'=>'nullable',
        ]);

        // Start transaction to ensure atomicity
        DB::beginTransaction();

        try {
            // Generate short UUID
            $shortUuid = $this->generateShortUuid(5);
            // Create the order
            $order = Order::create([
                'user_id' => auth()->id(),
                'uuid' => $shortUuid,
                'subtotal' => $request->subtotal,
                'dispatch_fee' => $request->dispatchFee,
                'total' => $request->total,
                'status' => 'pending',
                'total_days' => $request->total_days,
            ]);

            // Handle Base64 image (artWork)
            $artWorkUrl = null;
            if ($request->artWork) {

                $artWorkUrl = Helper::saveBase64Image($request->artWork);
            }

            CampaignDetails::create([
                'order_id' => $order->id,
                'ad_title' => $request->addTitle ?? '',
                'campaign_description' => $request->description ?? '',
                'start_date' => $request->startDate,
                'end_date' => $request->endDate,
                'art_work' => $artWorkUrl
            ]);

            // Add order items
            foreach ($request->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'signage_id' => $item['signage_id'],
                    'price_per_day' => $item['price_per_day'],
                    'rotation_time' => $item['rotation_time'],
                    'avg_daily_views' => $item['avg_daily_views'],
                    'total' => $item['total'],
                    'owner_id' =>$item['owner_id'],
                    'admin_profit'=>$item['admin_profit'],
                    'owner_profit'=>$item['owner_profit'],
                    
                ]);
            }


            DB::commit();

            Log::info("Order placed successfully");

            return response()->json(['message' => 'Order placed successfully', 'order_id' => $order->id]);
        } catch (\Exception $e) {

            DB::rollback();

            Log::error('Error placing order: ' . $e->getMessage());

            return response()->json(['message' => 'Error placing order'], 500);
        }
    }



    private function generateShortUuid($length = 5)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // Letters and Numbers
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $randomString;
    }
    //show details after click 
    public function showsignageDetails($id)
    {
        $signage = Signage::findOrFail($id);
      return response()->json([
        'data' => $signage
      ]);
    }
}
