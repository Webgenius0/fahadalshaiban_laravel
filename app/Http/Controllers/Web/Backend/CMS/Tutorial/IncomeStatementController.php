<?php

namespace App\Http\Controllers\web\Backend\CMS\Tutorial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use App\Enums\PageEnum;
use App\Enums\SectionEnum;
use App\Models\Tutorial;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;
class IncomeStatementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tutorial::where('section', SectionEnum::OWNER->value)->where('page', PageEnum::INCOME_STATEMENT->value)->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('rating', function ($data) {
                    return isset($data->metadata) && json_decode($data->metadata)->rating ? json_decode($data->metadata)->rating : '';
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
                                <a href="' . route('admin.income.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary fs-14 text-white edit-icn" title="Edit">
                                    <i class="fe fe-edit"></i>
                                </a>

                                <a href="#" type="button" onclick="showDeleteConfirm(' . $data->id . ')" class="btn btn-danger fs-14 text-white delete-icn" title="Delete">
                                    <i class="fe fe-trash"></i>
                                </a>
                            </div>';
                })
                ->rawColumns(['rating', 'status', 'action'])
                ->make();
        }
        return view('backend.layouts.tutorial.incomestatement.index');
    }

    public function create()
   {
       return view('backend.layouts.tutorial.incomestatement.create');
   }

   //store
   public function store(Request $request)
    {
      
        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'video'=>'required|mimetypes:video/mp4,video/quicktime,video/x-matroska,video/x-flv,video/x-msvideo,video/x-m4v,video/webm|max:100000'
        ]);

        try {
            // $validatedData['page'] = PageEnum::HOME->value;
            $validatedData['section'] = SectionEnum::OWNER->value;
            $validatedData['page'] = PageEnum::INCOME_STATEMENT->value;
            $validatedData['slug'] = Str::slug($validatedData['title']);
            if ($request->hasFile('video')) {
                $validatedData['video'] = Helper::fileUpload($request->file('video'), 'tutorial/incomeStatement', time() . '_' . getFileName($request->file('video')));
            }
          if(Tutorial::create($validatedData)){
            return redirect()->route('admin.income.index')->with('t-success', 'Created successfully');
          }
         
        } catch (\Throwable $th) {
           
            return redirect()->back()->with('t-error', $th->getMessage());
        }
 
    }
    // edit
    public function edit(string $id)
    {
        $homeAbout = Tutorial::findOrFail($id);
        return view("backend.layouts.tutorial.incomestatement.update", compact("homeAbout"));
    }

    //update
    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:50',
            'video'=>'mimetypes:video/mp4,video/quicktime,video/x-matroska,video/x-flv,video/x-msvideo,video/x-m4v,video/webm|max:100000'
        ]);

        try {
            $homeAbout = Tutorial::findOrFail($id);
            $validatedData['page'] = PageEnum::INCOME_STATEMENT->value;
            $validatedData['section'] = SectionEnum::OWNER->value;
            $validatedData['slug'] = Str::slug($validatedData['title']);

            if ($request->hasFile('video')) {
                if ($homeAbout->video && file_exists(public_path($homeAbout->video))) {
                    Helper::fileDelete(public_path($homeAbout->video));
                }
                $validatedData['video'] = Helper::fileUpload($request->file('video'), 'tutorial/incomeStatement', time() . '_' . getFileName($request->file('video')));
               
            }
            $homeAbout->update($validatedData);
            return redirect()->route('admin.income.index')->with('t-success', 'Updated successfully');
        } catch (\Throwable $th) {
           
            return redirect()->back()->with('t-error', $th->getMessage());
        }
    }
    //status change
    public function status(int $id): JsonResponse
    {
        // Find the CMS entry by ID
        $data = Tutorial::findOrFail($id);

        // Check if the record was found
        if (!$data) {
            return response()->json([
                "success" => false,
                "message" => "Item not found.",
                "data" => $data,
            ]);
        }

        // Toggle the status
        $data->status = $data->status === 'active' ? 'inactive' : 'active';

        // Save the changes
        $data->save();

        return response()->json([
            't-success' => true,
            'message' => 'Item status changed successfully.',
            'data'    => $data,
        ]);
    }

    //delete

    public function destroy(string $id)
    {
        try {
            // Find the CMS entry by ID
            $data = Tutorial::findOrFail($id);

            // Check if there is an image associated with this CMS entry
            if ($data->video && file_exists(public_path($data->video))) {
                // Delete the image file from the server
                Helper::fileDelete(public_path($data->video));
            }

            // Delete the CMS entry
            $data->delete();

            return response()->json([
                't-success' => true,
                'message' => 'Deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                't-success' => false,
                'message' => 'Failed to delete.',
            ]);
        }
    }
}
