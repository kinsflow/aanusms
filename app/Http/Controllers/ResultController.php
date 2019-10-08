<?php

namespace App\Http\Controllers;

use App\Result;
use App\User;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $input = $request->all();
        $number = User::where('matric_no', $input['matric_no'])->pluck('number')->first();
        $recipients = '+234'.intval($number);
        $message = ' your result for year '.$input['session'].', '.$input['semester'].' semester is '.$input['exam']+$input['test'];
        dd(env("TWILIO_SID"));
        $store = Result::create([
            'matric_no' => $input['matric_no'],
            'course_code' => $input['course_code'],
            'test' => $input['test'],
            'exam' => $input['exam'],
            'session' => $input['session'],
            'semester' => $input['semester'],
        ]);



        if($store){
            $this->sendMessage($message, $recipients);
            return redirect()->back()->with('flash', 'result successfully uploaded');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }

    private function sendMessage($message, $recipients)
    {
    $account_sid = 'ACb6324caf4877ebe8a3064d347a1955de';
    $auth_token = '35c0a445a1efc2613315458463f01ff7';
    $twilio_number = '+15138029723';
    $client = new Client($account_sid, $auth_token);
    $client->messages->create($recipients,
            ['from' => $twilio_number, 'body' => $message] );
    }

}
