<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use App\Models\Contactus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewContactMessageNotification;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;
class ContactUsController extends Controller
{
    public function index()
    {
        //cms start
        $query = CMS::where('page', PageEnum::HOME)->where('status', 'active');
        $cms= $query->get();
        // foreach (SectionEnum::HomePage() as $key => $section) {
        //     $cms[$key] = (clone $query)->where('section', $key)->latest()->take($section['item'])->{$section['type']}();
        // }
        //cms end
        return view('frontend.layouts.contact-us', compact('cms'));
    }

    // store contact us
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:15',
        'message' => 'nullable|string|max:500',
    ]);

    // Save to the database
   $contactMessage= ContactUs::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'],
        'message' => $validated['message'],
    ]);
    
    $admins= Role::where('name','admin')->first()->users;
    if($admins){
        Notification::send($admins, new NewContactMessageNotification($contactMessage));
    }
    return redirect()->back()->with('success', 'Message sent successfully!');
}


public function notifications()
{
    // $notifications = auth()->user()->notifications;
    $notifications = auth()->user()->notifications()->latest()->take(5)->get();
    // return view('backend.partials.header', compact('notifications'));
    return response()->json($notifications);
}



public function markNotificationAsRead(Request $request, $notificationId)
    {
        try {
            // Get the authenticated user
            $user = auth()->user();

            // Find the notification by ID
            $notification = $user->notifications()->where('id', $notificationId)->first();

            if (!$notification) {
                return response()->json([
                    'success' => false,
                    'message' => 'Notification not found.'
                ], 404);
            }

            // Mark the notification as read
            $notification->markAsRead();

            return response()->json([
                'success' => true,
                'message' => 'Notification marked as read.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while marking the notification as read.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
