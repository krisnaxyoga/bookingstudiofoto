<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\CarbonPeriod;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\Package;

class CalenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $package = Package::all();
       return view('admin.calender.index',compact('package'));
    }

    /**
     * Show the form for creating a new resource.
     */

     public function load_dates(Request $request): JsonResponse
     {
         $from = date('Y-m-d', strtotime($request->start));
         $to = date('Y-m-d', strtotime($request->end));

         $period = CarbonPeriod::create($from, $to);

         $data = [];


         foreach ($period as $date) {

                 $data[] = [
                     'title' => 'click',
                     'date' => date('Y-m-d', strtotime($date)),
                     'color' => '#0077b6',
                 ];
         }

         return response()->json($data);
     }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
