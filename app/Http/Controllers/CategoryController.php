<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index(){
        return view('category.index');
    }

    public function create(){
        return view('category.create');
    }/*
    public function store(Request $request){
       
        $data = $request->validate([
            'category_name' => 'required',
        ]);

        $new_category = category::create($data);

        return redirect(route('category.create'));
    }*/

    public function store(Request $request){
       
        $data = $request->validate([
            'category_name' => 'required',
        ]);

        $new_category = category::create($data);

        return redirect(route('category.create'));
    }
    
}
