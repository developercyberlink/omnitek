<?php

namespace App\Http\Controllers\AdminControllers\AdminMenu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminMenu\AdminMenuModel;
use Illuminate\Support\Str;


class AdminMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AdminMenuModel::all();
        return view('admin.admin-menu.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin-menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = AdminMenuModel::create($request->all());
        if($data){
            return redirect()->back()->with('message','Add Successful.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = AdminMenuModel::find($id);
        return view('admin.admin-menu.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = AdminMenuModel::find($id);
        $data->title = $request->title;
        $data->save();
        if($data){
            return redirect()->back()->with('message','Update Successful!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = AdminMenuModel::find($id);
        $data->delete();
        return 'true';
    }
}
