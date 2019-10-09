<?php

namespace App\Http\Controllers;

use App\Result;
use App\User;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\TwiML\MessagingResponse;


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

        $grade = '';
        if(($input['test'] + $input['exam']) >= 40 && (($input['test'] + $input['exam']) <= 44)){
            $grade = 'E';
        }elseif (($input['test'] + $input['exam']) >= 45 && (($input['test'] + $input['exam']) <= 49)) {
            $grade = 'D';
        }elseif (($input['test'] + $input['exam']) >= 50 && (($input['test'] + $input['exam']) <= 59)) {
            $grade = 'C';
        }elseif (($input['test'] + $input['exam']) >= 60 && (($input['test'] + $input['exam']) <= 69)) {
            $grade = 'B';
        }elseif (($input['test'] + $input['exam']) >= 70 && (($input['test'] + $input['exam']) <= 100)) {
            $grade = 'A';
        }else{
            $grade = 'fil';
        }

        $message = ' your result for course '.$input['course_code'] .' year '.$input['session'].', '.$input['semester'].' semester is '.$input['exam'].'  in exam and '.  $input['test'].' in test therefore, your grade in this course is '.$grade;
        // dd(env("TWILIO_SID"));
        // dd($grade);
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


    public function receiveMessage($message){
        header("content-type: text/xml");

        $response = new MessagingResponse();
        $response->message(
            "I'm using the Twilio PHP library to respond to this SMS!"
        );

        echo $response;
    }

}
