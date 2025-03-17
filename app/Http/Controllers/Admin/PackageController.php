<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_name' => 'required|string|max:255',
            'package_price' => 'required|numeric|min:0',
            'package_maxparticipants' => 'nullable|integer|min:0',
            'package_extra_fee_per_person' => 'required|numeric|min:0',
        ]);

        Package::create($request->all());

        return redirect()->route('admin.packages.index')->with('status', 'Package created successfully.');
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'package_name' => 'required|string|max:255',
            'package_price' => 'required|numeric|min:0',
            'package_maxparticipants' => 'nullable|integer|min:0',
            'package_extra_fee_per_person' => 'required|numeric|min:0',
        ]);

        $package = Package::findOrFail($id);
        $package->update($request->all());

        return redirect()->route('admin.packages.index')->with('status', 'Package updated successfully.');
    }

    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();

        return redirect()->route('admin.packages.index')->with('status', 'Package deleted successfully.');
    }
}
