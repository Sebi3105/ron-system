<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    //
    public function index(Request $request){
        $brands = Brand::all();
        return view('brand.index',['brands' => $brands]);
    }

    public function create(){
        return view('brand.create');
    }

    public function store(Request $request){
       
        $data = $request->validate([
            'brand_name' => 'required',
        ]);

        $new_brand = brand::create($data);

        return redirect(route('brand.index'));
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
        return redirect(route('brand.index'))-> with('success', 'Brand Deleted Successfully');
    }

}
