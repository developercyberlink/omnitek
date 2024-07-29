<?php

namespace App\Http\Controllers\AdminControllers\Tenders;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenders\TenderModel;
use App\Models\Tenders\VenderModel;
use App\Models\Tenders\TenderCategoryModel;
use Illuminate\Support\Str;


class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TenderModel::orderBy('id','DESC')->get();
        return view('admin.tenders.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tendercat = TenderCategoryModel::all();
       return view('admin.tenders.create', compact('tendercat'));
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
        'tender_number'=>'required',
        'tender_subject'=>'required',
        'tender_location'=>'required',
        'tender_detail'=>'required',
        'nit_date'=>'required',
        'last_date_of_submittion'=>'required',
        'time_of_submittion'=>'required',
    ]);

      $data = $request->all();  
      $result = TenderModel::create($data);
      if($result){
        return redirect()->back()->with('message','Successfully added.');
    }else{
        return "Error";
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
        $data = TenderModel::where('id',$id)->first();
        $tendercat = TenderCategoryModel::all();
        return view('admin.tenders.edit', compact('data','tendercat'));
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
        $request->validate([
            'tender_number'=>'required',
            'tender_subject'=>'required',
            'tender_location'=>'required',
            'tender_detail'=>'required',
            'nit_date'=>'required',
            'last_date_of_submittion'=>'required',
            'time_of_submittion'=>'required',
        ]);

        $data = TenderModel::find($id);
        $data->tender_number = $request->tender_number;
        $data->tender_subject = $request->tender_subject;
        $data->tender_location = $request->tender_location;
        $data->tender_detail = $request->tender_detail;
        $data->is_new = ($request->is_new)?$request->is_new:'0';
        $data->nit_date = $request->nit_date;
        $data->category_id = $request->category;
        $data->last_date_of_submittion = $request->last_date_of_submittion;
        $data->time_of_submittion = $request->time_of_submittion;

        if($data->save()){
            return redirect()->back()->with('message','Successfully updated');
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
        $data = TenderModel::find($id);
        $data->delete();
        return "Are you sure you want to delete?";
    }

}
