<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryitemController extends Controller
{
    //
    public function index(){
        return view('inventoryitem.index');
    }

    public function create(){
        return view('inventoryitem.create');
    }
}
