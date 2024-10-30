<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    //
    public function index(){
        return view('brand.index');
    }

    public function create(){
        return view('brand.create');
    }

    public function store(Request $request){
       
        $data = $request->validate([
            'brand_name' => 'required',
        ]);

        $new_brand = brand::create($data);

        return redirect(route('brand.create'));
    }

}
