<?php
namespace App\Http\Controllers\Web\Backend\Settings;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
class TapPaymentController extends Controller
{
    public function index( Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('name', 'owner')
            ->where('status', 'active');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('icon', function ($data) {
                    if ($data->icon) {
                        $url = asset($data->icon);
                        return '<img src="' . $url . '" alt="icon" width="50px" height="50px" style="margin-left:20px;">';
                    } else {
                        return '<img src="' . asset('default/logo.png') . '" alt="icon" width="50px" height="50px" style="margin-left:20px;">';
                    }
                })
                ->addColumn('status', function ($data) {
                    $backgroundColor = $data->status == "active" ? '#4CAF50' : '#ccc';
                    $sliderTranslateX = $data->status == "active" ? '26px' : '2px';
                    $sliderStyles = "position: absolute; top: 2px; left: 2px; width: 20px; height: 20px; background-color: white; border-radius: 50%; transition: transform 0.3s ease; transform: translateX($sliderTranslateX);";

                    $status = '<div class="form-check form-switch" style="margin-left:40px; position: relative; width: 50px; height: 24px; background-color: ' . $backgroundColor . '; border-radius: 12px; transition: background-color 0.3s ease; cursor: pointer;">';
                    $status .= '<input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status" style="position: absolute; width: 100%; height: 100%; opacity: 0; z-index: 2; cursor: pointer;">';
                    $status .= '<span style="' . $sliderStyles . '"></span>';
                    $status .= '<label for="customSwitch' . $data->id . '" class="form-check-label" style="margin-left: 10px;"></label>';
                    $status .= '</div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">

                                <a href="#" type="button" onclick="goToEdit(' . $data->id . ')" class="btn btn-primary fs-14 text-white delete-icn" >
                                    <i class="fe fe-edit"></i>
                                </a>

                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns([ 'icon' ,'status', 'action'])
                ->make();
        }
        return view('backend.layouts.tappayment.index');
    }

  

 
     public function edit(User $user, $id)
     {
         $user = User::findOrFail($id);  
         
         return view('backend.layouts.tappayment.edit', compact('user'));
     }
     

     public function update(Request $request, $id = null)
     {
         $request->validate([
             'tap_marcent_id' => 'required|string|max:255',
         ]);
         if ($id) {
             // Update the existing user
             $user = User::findOrFail($id);
             $user->update([
                 'tap_marcent_id' => $request->tap_marcent_id
             ]);
             return redirect()->route('admin.tap.payment')
                              ->with('success', 'Marcent Id updated successfully!');
         } else {
             // Create a new user if no ID is provided
             User::create([
                 'tap_marcent_id' => $request->tap_marcent_id
             ]);
             return redirect()->route('admin.tap.payment')
                              ->with('success', 'Marcent Id created successfully!');
         }
     }
     

    
    

}
