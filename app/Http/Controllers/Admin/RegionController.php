<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::query()->withCount('admins')
            ->withCount('users')
            ->get();
        return view('admin.region.index', compact('regions'));
    }

    public function create()
    {
        return view('admin.region.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:20|unique:regions,name',
            'postal_code' => 'required|integer|digits:4'
        ]);

        $name = $request->input('name');
        $postalCode = $request->input('postal_code');

        $region = new Region();
        $region->name = $name;
        $region->postal_code = $postalCode;
        $region->save();

        return redirect()->to('/admin/regions');
    }

    public function edit($regionId)
    {
        $region = Region::query()->findOrFail($regionId);

        return view('admin.region.create', compact('region'));
    }

    public function update(Request $request, $regionId)
    {
        $region = Region::query()->findOrFail($regionId);

        $request->validate([
            'name' => 'required|string|max:20|unique:regions,name,' . $regionId,
            'postal_code' => 'required|integer|digits:4'
        ]);

        $name = $request->input('name');
        $postalCode = $request->input('postal_code');

        $region->name = $name;
        $region->postal_code = $postalCode;
        $region->save();

        return redirect()->to('/admin/regions');

    }

    public function delete($regionId)
    {
        $region = Region::query()->findOrFail($regionId);

        $region->delete();

        return redirect()->to('/admin/regions');
    }
}
