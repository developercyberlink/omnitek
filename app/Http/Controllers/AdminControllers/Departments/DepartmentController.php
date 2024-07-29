<?php

namespace App\Http\Controllers\AdminControllers\Departments;

use App\Models\Departments\DepartmentModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
     $data = DepartmentModel::all();
     return view('admin.departments.index',compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {             
     return view('admin.departments.create');
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
            'department'=>'required',
        ]);
        $data = $request->all();
        $result = DepartmentModel::create($data);
        if($result){
            return redirect()->back()->with('message','Successfully added.');
        }else{
            return 'Error';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentModel $departmentModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function edit(DepartmentModel $departmentModel, $id)
    {        
     $data = DepartmentModel::find($id);
     return view('admin.departments.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepartmentModel $departmentModel, $id)
    {   
        $data = DepartmentModel::find($id);
        $data->department = $request->department;
        if($data->save()){
            return redirect()->back()->with('message','Update Sucessfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentModel $departmentModel, $id)
    {
        $data = DepartmentModel::find($id);
        $data->delete();
        return 'Are you sure to delete?';
    }

}
