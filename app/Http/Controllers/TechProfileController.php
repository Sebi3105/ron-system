<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TechProfile;
use App\DataTables\TechProfileDataTable;
use Yajra\DataTables\Facades\DataTables;

class TechProfileController extends Controller
{
    //
    /*
    *@param ServiceDataTable $dataTable
     * @return \Illuminate\View\View
     */
    // public function index(TechProfileDataTable $dataTable)
    // {
    //     return $dataTable->render('techprofile.index'); // 'techprofile.index' is your blade template
    // }
    public function index(Request $request)
{
    if ($request->ajax()) {
        $data = TechProfile::select('technician_id', 'name','contact_no') // Exclude created_at and updated_at
            ->get()
            ->map(function ($techprofile) {

              
                return $techprofile;
            });

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $editUrl = route('techprofile.edit', $row->technician_id); // Use technician_id instead of 
                $deleteUrl = route('techprofile.delete', $row);

                return '<a href="'.$editUrl.'" class="btn btn-sm btn-primary">Edit</a>
                        <button data-url="'.$deleteUrl.'" class="btn btn-sm btn-danger delete-btn">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view("techreport.index");
}

    

    public function create(){
        return view('techprofile.create');
    }

    public function store(Request $request){
       
        $data = $request->validate([
            'name' => 'required',
            'contact_no' => 'required',
        ]);

        $new_techprofile = TechProfile::create($data);

       
      
      return redirect(route('techreport.index'))->with('success', 'Technician Created Successfully');
        
    }

    public function edit(TechProfile $techprofile){
            return view('techprofile.edit',['techprofile' => $techprofile]);
    }
        
    public function update(TechProfile $techprofile, Request $request){
        $data = $request->validate([
            'name' => 'required',
            'contact_no' => 'required',
        ]);
        $techprofile->update($data);

        return redirect(route('techreport.index'))-> with('success', 'Technician Updated Successfully');

    }

    public function delete(TechProfile $techprofile){
        $techprofile->delete();
        return response()->json(['message' => 'techprofile Deleted Successfully'], 200); // Successful deletion response
    }
    
  
    


    public function getnotif(Request $request)
{
    if ($request->ajax()) {
        // Your existing AJAX code...
    }

    $categories = Category::all();
    $brands = Brand::all();
    $product = Inventory::all(); // Make sure to use a plural variable name

    return view("inventory.index", compact('categories', 'brands', 'product'));
}
   

    public function softDeleted()
    {
        $softDeletedItems = TechProfile::onlyTrashed()->get();
    // dd($softDeletedItems); // Check the contents of the soft deleted items

        return view('admin.techprofile.soft_deleted', compact('softDeletedItems'));
    }
public function restore($id)
{
    $item = TechProfile::withTrashed()->findOrFail($id);
    $item->restore();

    return redirect()->route('admin.techprofile.soft_deleted')->with('success', 'Item restored successfully!');
}

public function forceDelete($id)
{
    $item = TechProfile::withTrashed()->findOrFail($id);
    $item->forceDelete();

    return redirect()->route('admin.techprofile.soft_deleted')->with('success', 'Item deleted permanently!');
}

}






