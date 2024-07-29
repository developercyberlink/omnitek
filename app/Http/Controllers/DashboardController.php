<?php

namespace App\Http\Controllers;

use App\Model\Appointment;
use App\Model\Booking;
use App\Model\Contact;
use App\Model\Inquiry;
use App\Model\Proposal;
use App\Model\TripBooking;
use Illuminate\Http\Request;
use App\Models\Posts\PostModel;
use App\Models\Posts\PostCategoryModel;
use App\Models\Settings\SettingModel;
use Illuminate\Support\Str;


class   DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $recent_posts = PostModel::orderBy('id','desc')->take(10)->get();
       $total_posts = PostModel::count();
       $post_visiters = PostModel::sum('visiter');
       $max_viewed = PostModel::orderBy('visiter','desc')->take(10)->get();
       $total_category = PostCategoryModel::count();
       $num_of_inquiries = SettingModel::first()->num_of_inquiries;
       return view('admin.dashboard',compact('recent_posts','total_posts','total_category','post_visiters','max_viewed','num_of_inquiries'));
    }


    public function trip_booking(Request $request)
    {
        $data=TripBooking::all();
        return view('admin.booking.trip-booking',compact('data'));
    }

    public function vehicle_booking(Request $request)
    {
        $data=Booking::all();
        return view('admin.booking.vehicle-booking',compact('data'));
    }

    public function inquiry(Request $request)
    {
        $data=Inquiry::all();
        return view('admin.booking.inquiry',compact('data'));
    }

    public function contact_us(Request $request)
    {
        $data=Contact::all();
        return view('admin.contact.index',compact('data'));
    }

    public function trip_booking_delete(Request $request)
    {
        $id=TripBooking::findorfail($request->id);
        if ($id->delete())
        {
            return back()->with('success','Trip Booking deleted');
        }
    }

    public function vehicle_booking_delete(Request  $request)
    {
        $id=Booking::findorfail($request->id);
        if ($id->delete())
        {
            return back()->with('success','Vehicle Booking deleted');
        }
    }

    public function inquiry_delete(Request $request)
    {
        $id=Inquiry::findorfail($request->id);
        if ($id->delete())
        {
            return back()->with('success','Inquiry deleted');
        }
    }

    public function contact_us_delete(Request $request)
    {
        $id=Contact::findorfail($request->id);
        if ($id->delete())
        {
            return back()->with('success','Contact deleted');
        }
    }

    public function proposal_request()
    {
        $data=Appointment::orderBy('id','desc')->get();
        return view('admin.proposal.index',compact('data'));
    }

    public function proposal_delete(Request $request)
    {
        $id=Appointment::findorfail($request->id);
        if ($id->delete())
        {
            return back()->with('success','Appointment deleted successfully');
        }
    }
}
