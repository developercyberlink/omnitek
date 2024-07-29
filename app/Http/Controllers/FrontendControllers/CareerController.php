<?php

namespace App\Http\Controllers\FrontendControllers;

use App\Models\Career;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

use App\Mail\Applicant;

class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Career::all();
        return view('admin.career.index', compact('data'));
    }
    private function getCaptcha($secretKey)
    {
        $secret_key = env('SECRET_KEY');
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secret_key . "&response={$secretKey}");
        $result = json_decode($response);
        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $g_recaptcha_response = $request->input('g_recaptcha_response');
        // $result = $this->getCaptcha($g_recaptcha_response);
        // if ($result->success == true && $result->score > 0.3) {
        $formFields = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'agree' => 'required',
            'contact' => 'required',
            'email' => ['required', 'email'],
            'file' => 'required|mimes:jpg,png,pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file1 = $request->file('file');
            $doc = $file1->getClientOriginalName();
            $extension = $file1->getClientOriginalExtension();
            $doc = explode('.', $doc);
            $document = Str::slug($doc[0]) . '-' . uniqid() . '.' . $extension;
            $path = public_path() . '/uploads/doc';
            $file1->move($path, $document);

            $data['file'] = $document;
        }

        $data = Career::create([
            'first_name' => $request->name,
            'email' => $request->email,
            'last_name' => $request->last_name,
            'agree' => $request->agree,
            'contact' => $request->contact,
            'file' => $document,
        ]);
        if ($data) {
            return new Applicant();
            Mail::send(new Applicant($data)); // Pass $data to populate email content
            return redirect()->back()->with('message', 'Thank you for contacting us.');
        } else {
            return redirect()->back()->with('fmessage', 'Failed to submit form.');
        }
        return redirect()->back()->with('message', 'Submit successfully.');
        // } else {
        //     return back()->with('fmessage', 'You are a robot!, Please try again.');
        // }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function show(Career $career)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function edit(Career $career)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Career $career)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy(Career $career)
    {
        //
    }
    public function apply_form()
    {
        return view('themes.default.applicants.application-form');
    }
}
