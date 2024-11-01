<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Fetch categories with optional search functionality
        $categories = Category::when($search, function ($query) use ($search) {
            return $query->where('category_name', 'like', "%{$search}%");
        })->get();

        return view('category.index', [
            'categories' => $categories, // Use 'categories' to refer to the list
            'search' => $search
        ]);
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

    public function delete(Category $category)
    {
        $category->delete();
        return redirect(route('category.index'))->with('success', 'Category Deleted Successfully');
    }
}


