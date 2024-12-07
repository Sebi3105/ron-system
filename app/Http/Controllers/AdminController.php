<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Models\User; // Import the User model
use Illuminate\Support\Facades\Hash; // For hashing passwords
use App\Models\brand;
use App\Models\inventory;
use App\Models\category;
use App\Models\InventoryItem;
use App\Models\sales;
use Yajra\DataTables\DataTables; 


class AdminController extends Controller
{
    public function dashboard()
    {
        if (Auth::check() && Auth::user()->is_superadmin) {
            // Fetch data for the dashboard
            $totalUsers = User::count();
            $users = User::all(); // Fetch all users

            return view('admin.dashboard', compact('totalUsers', 'users'));
        }

        return redirect('/');
    }

    public function create(Request $request)
    {
        return view('admin.create');
    }

    public function store(Request $request)
{
    
    // Validate the incoming request data
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Password::defaults()],
        'is_superadmin' => ['required', 'boolean'],
    ]);

    $data['password'] = Hash::make($data['password']); // Hash the password

    User::create($data);

    return redirect(route('admin.dashboard'));
}
public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.edit', compact('user'));
}

public function update(Request $request, $id)
{
    // Validate the incoming request data
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $id],
        'is_superadmin' => ['required', 'boolean'],
    ]);

    $user = User::findOrFail($id);
    $user->update($data);

    return redirect(route('admin.dashboard'))->with('success', 'User  updated successfully!');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect(route('admin.dashboard'))->with('success', 'User  deleted successfully!');
}


}


