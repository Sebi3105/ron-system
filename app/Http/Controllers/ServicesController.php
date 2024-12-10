<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Services;
use App\DataTables\ServiceDataTable;
use Yajra\DataTables\Facades\DataTables;

class ServicesController extends Controller
{
    //
    /*
    *@param ServiceDataTable $dataTable
     * @return \Illuminate\View\View
     */
    // public function index(ServiceDataTable $dataTable)
    // {
    //     return $dataTable->render('services.index'); // 'services.index' is your blade template
    // }
    public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Services::select('service_id', 'service_name') // Exclude created_at and updated_at
            ->get()
            ->map(function ($service) {
                return $service;
            });

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $editUrl = route('service.edit', $row->service_id); // Use service_id instead of 
                $deleteUrl = route('services.delete', $row);

                return '<a href="'.$editUrl.'" class="btn btn-sm btn-primary">Edit</a>
                        <button data-url="'.$deleteUrl.'" class="btn btn-sm btn-danger delete-btn">Delete</button>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    return view("services.index");
}

    

    public function create(){
        return view('services.create');
    }

    public function store(Request $request){
       
        $data = $request->validate([
            'service_name' => 'required',
        ]);

        $new_service = Services::create($data);

        return redirect(route('techreport.index'));
    }

    public function edit(Services $service){
            return view('services.edit',['service' => $service]);
    }
        
    public function update(Services $service, Request $request){
        $data = $request->validate([
            'service_name' => 'required',
        ]);
        $service->update($data);

        return redirect(route('techreport.index'))-> with('success', 'Services Updated Successfully');

    }

    public function delete(Services $service){
        $service->delete();
        return response()->json(['message' => 'Services Deleted Successfully'], 200); // Successful deletion response
    }
    
  

    public function softDeleted()
    {
        $softDeletedItems = Services::onlyTrashed()->get();
    // dd($softDeletedItems); // Check the contents of the soft deleted items

        return view('admin.services.soft_deleted', compact('softDeletedItems'));
    }
public function restore($id)
{
    $item = Services::withTrashed()->findOrFail($id);
    $item->restore();

    return redirect()->route('admin.services.soft_deleted')->with('success', 'Service restored successfully!');
}

public function forceDelete($id)
{
    $item = Services::withTrashed()->findOrFail($id);
    $item->forceDelete();

    return redirect()->route('admin.services.soft_deleted')->with('success', 'Service deleted permanently!');
}

}



