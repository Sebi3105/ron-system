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

    public function index(Request $request){  
        if($request->ajax()){
            $data = Category::select('category_id', 'category_name', 'created_at', 'updated_at')
                ->get()
                ->map(function ($category) {
                    $category->created_at = $category->created_at->format('yy-m-d H:i:s'); // Format as needed
                    $category->updated_at = $category->updated_at->format('yy-m-d H:i:s');
                    return $category;
                });
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
        
        return view("category.index");
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

        return redirect(route('category.index'));
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

    public function delete(Category $category){
        $category->delete();
        return response()->json(['message' => 'Category Deleted Successfully'], 200); // Successful deletion response
    }
}


