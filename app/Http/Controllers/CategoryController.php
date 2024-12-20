<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;
use App\Models\Category;

use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    // public function index(Request $request)
    // {
    //     $search = $request->input('search');

    //     // Fetch categories with optional search functionality
    //     $categories = Category::when($search, function ($query) use ($search) {
    //         return $query->where('category_name', 'like', "%{$search}%");
    //     })->get();

    //     return view('category.index', [
    //         'categories' => $categories, // Use 'categories' to refer to the list
    //         'search' => $search
    //     ]);
    // }

    public function categoryData(Request $request){  
        if($request->ajax()){
            $data = Category::select(['category_id', 'category_name']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('category.edit', $row->category_id); // Route for edit
                    $deleteUrl = route('category.delete', $row); // Route for delete
    
                    return '<a href="'.$editUrl.'" class="btn btn-sm btn-primary">Edit</a>
                            <button data-url="'.$deleteUrl.'" class="btn btn-sm btn-danger delete-btn">Delete</button>';
                })
                ->rawColumns(['action']) // Mark action column as raw HTML
                ->make(true);
        }
        
        return view("inventory.index");
    }

    public function create()
    {
        return view('category.create'); // This view does not need data passed
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_name' => 'required',
        ]);

        Category::create($data);
        session()->flash('success', 'Category created successfully!');


        return redirect(route('inventory.index'));
    }

    public function edit(Category $category)
    {
        return view('category.edit', ['category' => $category]);
    }

    public function update(Category $category, Request $request)
    {
        $data = $request->validate([
            'category_name' => 'required',
        ]);
        $category->update($data);

        return redirect(route('category.index'))->with('success', 'Category Updated Successfully');
    }

    public function destroy(Category $category){
        $category->delete();
        return response()->json(['message' => 'Category Deleted Successfully'], 200); // Successful deletion response
    }

    public function softDeleted()
{
    $softDeletedItems = Category::onlyTrashed()->get();
   // dd($softDeletedItems); // Check the contents of the soft deleted items

    return view('admin.category.soft_deleted', compact('softDeletedItems'));
}
public function restore($id)
{
    $item = Category::withTrashed()->findOrFail($id);
    $item->restore();

    return redirect()->route('admin.category.soft_deleted')->with('success', 'Category restored successfully!');
}

public function forceDelete($id)
{
    $item = Category::withTrashed()->findOrFail($id);
    $item->forceDelete();

    return redirect()->route('admin.category.soft_deleted')->with('success', 'Category deleted permanently!');
}
}


