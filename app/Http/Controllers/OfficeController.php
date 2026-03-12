<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{

public function index()
{
$offices = Office::all();
return view('admin.offices.index', compact('offices'));
}

public function create()
{
return view('admin.offices.create');
}

public function store(Request $request)
{
Office::create($request->all());
return redirect('/admin/offices');
}

public function destroy($id)
{
Office::destroy($id);
return back();
}


public function edit($id)
{
    $office = Office::find($id);

    return view('admin.offices.edit',compact('office'));
}

public function update(Request $request,$id)
{
    $office = Office::find($id);

    $office->name = $request->name;
    $office->municipality = $request->municipality;
    $office->address = $request->address;

    $office->save();

    return redirect('/admin/offices');
}

}