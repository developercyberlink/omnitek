<?php

namespace App\Http\Controllers\AdminControllers\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;
use Gate;
use App\User;
use App\Models\Members\RoleModel;
use App\Models\AdminMenu\AdminMenuModel;
use App\Models\AdminMenu\AdminMenuUserModel;
use Illuminate\Support\Str;


use Validator;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('id','<>',Auth::id())->get();
       return view('admin.users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
        $data = RoleModel::all();
        return view('admin.users.create',compact('data'));
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
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'pin'=> $request->pin

        ]);

        $roles = RoleModel::select('id')->where('role','General')->first();
        $user->roles()->attach($roles);
        return redirect()->back()->with('message','New user created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // if(Gate::denies('edit')){
        //     $request->session()->flash('error','Permission denied!');
        //     return redirect()->back();
        // }
        $data = User::find($id);
        return view('admin.users.edit',compact('data'));
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
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->pin = $request->pin;
        $data->save();
        return redirect()->back()->with('message','User update successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // if(Gate::denies('delete')){
        //     $request->session->flash('error','Permission denied!');
        //     return redirect()->back();
        // };
        $data = User::find($id);
        $data->delete();
        return "User Deleted.";
    }

    public function admin_user()
    {        
        return "Admin user";
    }

    public function agent_user(){
        return "Agent user";
    }

    public function userprofile(){
        $data = Auth::user();
        return view('admin.users.userprofile',compact('data'));
    }

    public function update_password(Request $request){

        $validator = Validator::make($request->all(), [
            'old_password' => 'required|min:5|max:15',
            'password' => 'required|min:5|max:15|required_with:cpassword',
            'cpassword' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return redirect()->back();
        }

        $user = User::find(Auth::user()->id);  
        if($user){           
           if(Hash::check($request['old_password'],$user->password)){
            $user->password = bcrypt($request['password']);
            $user->save();
            return redirect()->back()->with('message','Your password has been updated.');
           }else{
            return redirect()->back()->with('message','The entered does not match your current password!');
           }           
        }

       // return view('admin.users.passwordEdit');
    }

    public function changepassword(){
        if(Auth::user()){
            return view('admin.users.changepassword');
        }else{
            return redirect()->back();
        }        
    }

    public function assign_roles($id){
            $user = User::find($id);
            $data = RoleModel::all();
            return view('admin.users.assign-roles',compact('data','user'));
    }

    public function update_roles(Request $request,User $user){
            $user->roles()->sync($request->roles);    
            $request->session()->flash('message', 'Roles updated.');
            return redirect()->route('user.index');            
    }

    public function permission_edit($id){
            $user = User::find($id);
            $data = AdminMenuModel::all();
            return view('admin.users.permission-edit',compact('data','user'));
    }

    public function permission_update(Request $request, User $user){
            $user->adminmenu()->sync($request->adminmenu_id);
            $request->session()->flash('message', 'Menu updated.');
            return redirect()->route('user.index');      
    }

}
