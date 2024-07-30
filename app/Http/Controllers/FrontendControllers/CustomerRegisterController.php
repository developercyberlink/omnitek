<?php

namespace App\Http\Controllers\FrontendControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\MemberRegister;
use Illuminate\Support\Facades\Hash;
use App\Models\Members\MemberModel;
use App\Models\Circulars\CircularModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CustomerRegisterController extends Controller
{
    // Create 
    public function create()
    {
        return view('themes.default.applicants.register');
    }

    // Store
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:cl_members|max:255',
            'password' => 'required|max:20|confirmed'
        ]);

        $req = $request->all();
        $req['password'] = Hash::make($request->password);
        $req['activation_code'] = bin2hex(random_bytes(16));

        $data = MemberModel::create($req);
        $verificationUrl = route('applicant.verify', ['token' => $data->activation_code]);

        if ($data) {
            return new MemberRegister($data, $verificationUrl);

            $this->sendVerificationEmail($data);
            // Mail::send(new MemberRegister($data));
            return redirect()->back()->with('message', 'Successfully Registered.');
        } else {
            return redirect()->back()->with('error', 'Error occurred during registration.');
        }
    }

    public function verify($token)
    {
        $member = MemberModel::where('activation_code', $token)->first();

        if (!$member) {
            // If no member is found with the provided token
            return redirect('/')->with('applicant_message', 'Invalid or expired verification token.');
        }

        // Mark the member as verified
        $member->email_verified_at = now();
        $member->status =  1;
        $member->activation_code = null; // Clear the token

        $member->save();

        // Redirect to a success page
        return redirect('/page/career.html')->with('applicant_message', 'Your email has been verified successfully!');
    }

    // Login Form
    public function customerlogin()
    {
        // session()->flash('success', 'Please log in to see the details');
        return view('themes.default.applicants.login')->with('success', 'Please log in to see the details');
    }

    // Login Action
    public function customerlogin_action(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');
        // Retrieve the user by email
        $customer = MemberModel::where('email', $credentials['email'])->first();
        
        if(Auth::guard('applicant')->attempt($credentials)){
            if ($customer->role_id == 2){
                return redirect('page/career.html')->with('applicant_message', 'You are a member!');
            }
            else {
                return redirect()->back()->with('applicant_message', 'You are not a member!');
            }
        }

        // if ($customer && Hash::check($credentials['password'], $customer->password)) {
        //     // 1 Administrator
        //     // 2 Member
        //     // 3 Wholesaler

        //     if ($customer->role_id == 2) {
        //         session(['customer_id' => $customer->id, 'member_type' => 'member', 'loginstatus' => true]);

        //         if (Auth::guard('applicant')->attempt(['email' => $credentials['email'], 'password' => $request->password])) {
        //             return redirect('page/career.html')->with('applicant_message', 'You are a member!');
        //         } else {
        //             return redirect()->back()->with('applicant_message', 'Authentication attempt failed.');
        //         }
        //     } else {
        //         return redirect()->back()->with('applicant_message', 'You are not a member!');
        //     }
        // } 
        else {
            // dd('test');
            return redirect()->back()->with('applicant_message', 'Invalid Email or Password!');
        }
    }

    public function customer_logout(){
        Session::flush();
        Auth::guard('applicant')->logout();
        return redirect('/');
    }

    // Customer Logout
    public function employeelogout(Request $request)
    {
        $request->session()->forget('customer_id');
        $request->session()->forget('loginstatus');
        $request->session()->forget('member_type');
        Auth::guard('applicant')->logout();
        return redirect('page/employeelogin')->with('message', 'Successfully logged out.');
    }

    // Customer Dashboard
    public function customer_dashboard()
    {
        if (!session('loginstatus')) {
            return redirect('customerlogin');
        }
        $data = CircularModel::orderBy('id', 'DESC')->paginate(20);
        return view('themes.default.employee.employee-dashboard', compact('data'));
    }

    public function accountdetail()
    {
        if (!session('loginstatus')) {
            return redirect('customerlogin');
        }
        $customer_id = session('customer_id');
        $customer = MemberModel::where('id', $customer_id)->first();
        return view('themes.default.customer.accountdetail', compact('customer'));
    }

    public function editaccountdetail()
    {
        if (!session('loginstatus')) {
            return redirect('customerlogin');
        }
        $customer_id = session('customer_id');
        $customer = MemberModel::where('id', $customer_id)->first();
        return view('themes.default.customer.editaccountdetail', compact('customer'));
    }

    public function updateaccountdetail(Request $request)
    {
        if (!session('loginstatus')) {
            return redirect('customerlogin');
        }
        $customer_id = session('customer_id');
        $data = DB::table('cl_members')
            ->where('id', $customer_id)
            ->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email
            ]);
        if ($data) {
            return redirect()->back()->with('message', 'Account detail updated.');
        } else {
            return redirect()->back()->with('error', 'Error updating account details.');
        }
    }

    public function changepassword()
    {
        if (!session('loginstatus')) {
            return redirect('customerlogin');
        }
        return view('themes.default.customer.changepassword');
    }

    public function changepassword_action(Request $request)
    {
        if (!session('loginstatus')) {
            return redirect('customerlogin');
        }
        $customer_id = session('customer_id');
        $member = MemberModel::find($customer_id);

        if (Hash::check($request->oldpassword, $member->password)) {
            $member->password = Hash::make($request->newpassword);
            $member->save();
            return redirect()->back()->with('message', 'Password updated successfully.');
        } else {
            return redirect()->back()->with('message', 'Current password does not match.');
        }
    }

    // Wholesaler Login 
    public function employeelogin()
    {
        return view('themes.default.employee.employeelogin');
    }

    // Wholesaler Login Action
    public function employeelogin_action(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $email = $request->email;
        $password = $request->password;

        $customer = MemberModel::where('email', $email)->first();

        if ($customer && Hash::check($password, $customer->password)) {
            // 1 Administrator // 2 Employee

            if ($customer->role_id == 2) {
                session(['customer_id' => $customer->id, 'member_type' => 'employee', 'loginstatus' => true]);
                return redirect('customer/dashboard');
            } else {
                return redirect()->back()->with('message', 'You are not a member as an employee!');
            }
        } else {
            return redirect()->back()->with('message', 'Invalid Email or Password!');
        }
    }

    public function password_recover()
    {
        return view('themes.default.password-recover');
    }

    public function circular_detail($uri)
    {
        $data = CircularModel::where('uri', $uri)->first();
        return view('themes.default.employee.circular-detail', compact('data'));
    }
}
