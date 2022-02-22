<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {

        $admins = Admin::all();
        return view('admin.admin.index', compact('admins'));
    }

    public function create()
    {
        $regions = Region::all();
        return view('admin.admin.create', compact('regions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'required|string|unique:admins,email',
            'is_superadmin' => 'required|int|in:0,1',
            'region_id' => 'required_if:is_superadmin,0|int',

        ]);

        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $email = $request->input('email');
        $isSuperadmin = $request->input('is_superadmin');
        $regionId = $request->input('region_id');

        $admin = new Admin();
        $admin->first_name = $firstName;
        $admin->last_name = $lastName;
        $admin->email = $email;
        $admin->password = Hash::make('test1234');
        $admin->is_superadmin = $isSuperadmin;
        $admin->region_id = $regionId;
        $admin->save();

        return redirect()->to('/admin/admins');
    }

    public function edit($adminId)
    {
        $admin = Admin::query()->findOrFail($adminId);
        $regions=Region::all();
        return view('admin.admin.create', compact('admin','regions'));
    }

    public function update(Request $request, $adminId)
    {
        $admin = Admin::query()->findOrFail($adminId);

        $request->validate([
            'is_superadmin' => 'required|int|in:0,1',
            'region_id' => 'required_if:is_superadmin,0|int',

        ]);

        $isSuperadmin = $request->input('is_superadmin');
        $regionId = $request->input('region_id');

        $admin->is_superadmin = $isSuperadmin;
        $admin->region_id = $regionId;
        $admin->save();

        return redirect()->to('/admin/admins');
    }

    public function delete($adminId)
    {
        $admin = Admin::query()->findOrFail($adminId);

        if ($admin->email == Admin::DEFAULT_ADMIN['email']) {
            abort(403);
        }

        $admin->delete();

        return redirect()->to('/admin/admins');
    }
}
