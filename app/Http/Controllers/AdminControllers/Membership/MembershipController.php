<?php

namespace App\Http\Controllers\AdminControllers\Membership;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Membership\MembershipModel;


class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = MembershipModel::orderBy('id', 'desc')->get();
        return view('admin.membership.index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.membership.create');

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
            'CompanyName' => 'required',
            'PhoneNumber' => 'required',
            'Email' => 'required',
            'MobileNumber' => 'required',
            'DirectorName' => 'required'
        ]);
        $data = $request->all();
        $url = $request->input('Url');
        $CompanyName = $request->input('CompanyName');

        if($url){
            $data['CompanyName'] = "<a href=".$url." target='_blank' class='uk-text-bold'>".$CompanyName."</a>";
        }else{
            $data['CompanyName'] = "<a class='uk-text-bold'>".$CompanyName."</a>";
        }
        $data['Company'] = $CompanyName;

        $result = MembershipModel::create($data);
        if ($result) {
            return redirect()->back()->with('message', 'Successfully added.');
        } else {
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
        $data = MembershipModel::find($id);
        return view('admin.membership.edit', compact('data'));

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
            'CompanyName' => 'required',
            'PhoneNumber' => 'required',
            'Email' => 'required',
            'MobileNumber' => 'required',
            'DirectorName' => 'required',
        ]);

        $data = MembershipModel::find($id);
        $CompanyName = $request->input('CompanyName');
        $Url = $request->input('Url');
        $data['Url'] = $Url;
        if($Url){
            $data['CompanyName'] = "<a href=" . $Url . " target='_blank' class='uk-text-bold'>" . $CompanyName . "</a>";
        }else{
            $data['CompanyName'] = "<a class='uk-text-bold'>".$CompanyName."</a>";
        }

        $data['Company'] = $CompanyName;
        $data['PhoneNumber'] = $request->input('PhoneNumber');
        $data['Email'] = $request->input('Email');
        $data['MobileNumber'] = $request->input('MobileNumber');
        $data['DirectorName'] = $request->input('DirectorName');

        $data->save();
        return redirect()->back()->with('message', 'Update Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MembershipModel::find($id);
        $data->delete();

    }
}
