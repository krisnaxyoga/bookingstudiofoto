<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Package;

class PackgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Package::all();
        return view('admin.packages.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new Package;

        return view('admin.packages.form',compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        // dd($request->hasFile('image'));
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
                $id = auth()->user()->id;
                $data =  new Package();
                $data->user_id = $id;
                $data->name = $request->name;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->save();
    
                return redirect()
                ->route('package.index')
                ->with('message', 'Data berhasil disimpan.');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Package::find($id);
        return view('admin.packages.form',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        // dd($request->hasFile('image'));
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors())
                ->withInput($request->all());
        } else {
                $id = auth()->user()->id;
                $data =  Package::find($id);
                $data->user_id = $id;
                $data->name = $request->name;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->save();
    
                return redirect()
                ->route('package.index')
                ->with('message', 'Data berhasil disimpan.');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data =  Package::find($id);
        $data->delete();

        return redirect()
        ->back()->with('message','data deleted!');
    }
}
