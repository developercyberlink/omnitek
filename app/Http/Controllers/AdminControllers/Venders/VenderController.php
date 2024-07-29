<?php

namespace App\Http\Controllers\AdminControllers\Venders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenders\VenderModel;
use App\Models\Tenders\TenderCategoryModel;
use Illuminate\Support\Str;

class VenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = VenderModel::all();
        return view('admin.venders.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tender_cat = TenderCategoryModel::all();
         return view('admin.venders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all(); 
        $result = VenderModel::create($data);
        if($result){
            return redirect('awarded-vender/'.$result->id.'/edit')->with('message','Successfully added.');
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
        $data = VenderModel::find($id); 
        return view('admin.venders.edit', compact('data'));
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
       $data = VenderModel::find($id);
       $data->vender_name = $request->vender_name;
       $data->tender_number = $request->tender_number;
       $data->tender_title = $request->tender_title;
       $data->tender_category = $request->tender_category;
       $data->awarded_date = $request->awarded_date;  
       $data->date_of_nit = $request->date_of_nit; 
       $data->value = $request->value; 
       $data->remarks = $request->remarks; 
       //$data->email = $request->email;
       //$data->phone = $request->phone;
       //$data->address = $request->address;
       if($data->save()){
       return redirect()->back()->with('message','Update Successful.');
        }else{
            return "Error";
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
        $data = VenderModel::find($id);
        $data->delete();
        return "Delete Successful!";
    }
}
