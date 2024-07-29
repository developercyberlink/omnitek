<?php

namespace App\Http\Controllers\AdminControllers\Members;

use App\Models\Members\RoleModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = RoleModel::orderBy('id','desc')->get();
        return view('admin.roles.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.roles.create');
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
            'role'=>'required|unique:cl_roles'
        ]);
        $data = RoleModel::create($request->all());
        if($data){
            return redirect()->back()->with('message','Successfully added.');
        }else{
            return "Error";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Members\RoleModel  $roleModel
     * @return \Illuminate\Http\Response
     */
    public function show(RoleModel $roleModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Members\RoleModel  $roleModel
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleModel $roleModel, $id)
    {
        $data = RoleModel::find($id);
         return view('admin.roles.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Members\RoleModel  $roleModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoleModel $roleModel, $id)
    {
        $data = RoleModel::find($id);
        $data->role = $request->role;
        $data->save();
        return redirect()->back()->with('message', 'Successfully added.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Members\RoleModel  $roleModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleModel $roleModel, $id)
    {
        $data = RoleModel::find($id);
        $data->delete();
    }
}
