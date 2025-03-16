<?php

namespace App\Http\Controllers\Web\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BillingAddress;
use App\Models\Order;

class BillingAddressController extends Controller
{


    public function store(Request $request)
    {
        // Log the request data for debugging
       

        $request->validate([
            'order_id' => 'required|exists:orders,id', // Ensures the order exists
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
        ]);

        try {
            // Create a new BillingAddress entry
            $billingAddress = BillingAddress::create([
                'order_id' => $request->order_id,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'postal_code' => $request->postal_code,
            ]);

            // Return success response
            return response()->json([
                'message' => 'Billing Address created successfully!',
                'redirect_url'=> route('billing.redirect'),
               
            ], 201);
        } catch (\Exception $e) {
            // Log any errors

            return response()->json([
                'message' => 'An error occurred while creating the billing address.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // redirect pyament 
    public function Redirect(Request $request)
    {
        return view ('tap');
    }
}
