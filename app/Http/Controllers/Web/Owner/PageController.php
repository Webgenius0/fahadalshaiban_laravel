<?php

namespace App\Http\Controllers\Web\Owner;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tutorial;
//use Google\Rpc\Context\AttributeContext\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    public function tutorials()
    {
        $tutorials = Tutorial::where('section', 'owner')->get();
        return view('owner.layouts.tutorial', compact('tutorials'));
    }
    public function signage()
    {
        $categories= Category::all();
        return view('owner.layouts.new-signage', compact('categories'));
    }
    public function incomeStatement()
    {
        return view('owner.layouts.income-statement');
    }

    public function profile()
    {

        return view('owner.layouts.profile');
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
                $imagePath = Helper::fileUpload($avatar, 'owner/profile', $imageName);
    
               
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
            return redirect()->route('owner.profile');
    
        } catch (\Exception $e) {
            
           
            return redirect()->back()->with('t-error', 'Error: ' . $e->getMessage())->withInput();
        }
    }
}