<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PasFoto;

class PasFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = PasFoto::all();
        return view('admin.pasfoto.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new PasFoto;

        return view('admin.pasfoto.form',compact('model'));
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
                $data =  new PasFoto();
                $data->name = $request->name;
                $data->description = $request->description;
                $data->save();
    
                return redirect()
                ->route('pasfoto.index')
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
        $model = PasFoto::find($id);

        return view('admin.pasfoto.form',compact('model'));
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
                $data = PasFoto::find($id);
                $data->name = $request->name;
                $data->description = $request->description;
                $data->save();
    
                return redirect()
                ->route('pasfoto.index')
                ->with('message', 'Data berhasil disimpan.');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = PasFoto::find($id);

        $model->delete();

        return redirect()
        ->back()->with('message','data deleted!');
    }
}
