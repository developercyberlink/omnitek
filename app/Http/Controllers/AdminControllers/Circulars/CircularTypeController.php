<?php

namespace App\Http\Controllers\AdminControllers\Circulars;

use App\Models\Circulars\CircularTypeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


class CircularTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CircularTypeModel::orderBy('ordering','asc')->get();
        return view('admin.circular-type.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.circular-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'circular_type'=> 'required|unique:cl_circular_type',
            'uri'=>'required'
        ]);
        $data = $request->all();
        $data['uri'] = Str::slug($request->uri);
        $result = CircularTypeModel::create($data);
        if($result){
            return redirect()->back()->with('message','Stored Successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(CircularTypeModel $circularTypeModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(CircularTypeModel $circularTypeModel, $id)
    {
        $data = CircularTypeModel::find( $id );
        return view('admin.circular-type.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CircularTypeModel $circularTypeModel, $id)
    {
        $request->validate([
            'circular_type'=> 'required',
            'uri'=>'required'
        ]);
        $data = CircularTypeModel::find($id);
        $data->circular_type = $request->circular_type;
        $data->uri = Str::slug($request->uri);
        $data->ordering = $request->ordering;
        $data->save();
        return redirect()->back()->with('message','Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(CircularTypeModel $circularTypeModel, $id)
    {
        $data = CircularTypeModel::find($id);
        $data->delete();
    }
}
