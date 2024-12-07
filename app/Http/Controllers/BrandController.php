<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\BrandDataTable;
use App\Models\Brand;

use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    //
    // public function index(Request $request){
    //     $search = $request->input('search');

    //     // Fetch brands based on the search term
    //     $brands = Brand::when($search, function ($query, $search) {
    //         return $query->where('brand_name', 'like', "%{$search}%");
    //     })->get();
    
    //     return view('brand.index', ['brands' => $brands]);
      
    // }

    public function index(Request $request)
    {
        
        if($request->ajax()){
            $data = Brand::select('brand_id', 'brand_name', 'created_at', 'updated_at')
                ->get()
                ->map(function ($brand) {
                    $brand->created_at = $brand->created_at->format('yy-m-d H:i:s'); // Format as needed
                    $brand->updated_at = $brand->updated_at->format('yy-m-d H:i:s');
                    return $brand;
                });
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('brand.edit', $row->brand_id); // Route for edit
                    $deleteUrl = route('brand.delete', $row); // Route for delete
    
                    return '<a href="'.$editUrl.'" class="btn btn-sm btn-primary">Edit</a>
                            <button data-url="'.$deleteUrl.'" class="btn btn-sm btn-danger delete-btn">Delete</button>';
                })
                ->rawColumns(['action']) // Mark action column as raw HTML
                ->make(true);
        }
        
        return view("brand.index");
    }

    public function create(){
        return view('brand.create');
    }

    public function store(Request $request){
       
        $data = $request->validate([
            'brand_name' => 'required',
        ]);

        $new_brand = brand::create($data);

        return redirect(route('inventory.index'));
    }

    public function edit(Brand $brand){
            return view('brand.edit',['brand' => $brand]);
    }
        
    public function update(Brand $brand, Request $request){
        $data = $request->validate([
            'brand_name' => 'required',
        ]);
        $brand->update($data);

        return redirect(route('brand.index'))-> with('success', 'Brand Updated Successfully');

    }

    public function delete(Brand $brand){
        $brand->delete();
        return response()->json(['message' => 'Brand Deleted Successfully'], 200); // Successful deletion response
    }
    
    public function softDeleted()
    {
        $softDeletedItems = Brand::onlyTrashed()->get();
       // dd($softDeletedItems); // Check the contents of the soft deleted items
    
        return view('admin.brand.soft_deleted', compact('softDeletedItems'));
    }
    public function restore($id)
    {
        $item = Brand::withTrashed()->findOrFail($id);
        $item->restore();
    
        return redirect()->route('admin.brand.soft_deleted')->with('success', 'Brand restored successfully!');
    }
    
    public function forceDelete($id)
    {
        $item = Brand::withTrashed()->findOrFail($id);
        $item->forceDelete();
    
        return redirect()->route('admin.brand.soft_deleted')->with('success', 'Brand deleted permanently!');
    }

}
