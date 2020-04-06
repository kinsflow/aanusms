<?php

namespace App\Http\Controllers;

use App\Imports\ResultImport;
use App\Result;
use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($matric_no)
    {

        $number = User::where('matric_no', $matric_no)->pluck('number')->first();
        $input = Result::whereMatricNo($matric_no)->get()->last();
        $recipients = '+234' . intval($number);

        $grade = '';
        if (($input['test'] + $input['exam']) >= 40 && (($input['test'] + $input['exam']) <= 44)) {
            $grade = 'E';
        } elseif (($input['test'] + $input['exam']) >= 45 && (($input['test'] + $input['exam']) <= 49)) {
            $grade = 'D';
        } elseif (($input['test'] + $input['exam']) >= 50 && (($input['test'] + $input['exam']) <= 59)) {
            $grade = 'C';
        } elseif (($input['test'] + $input['exam']) >= 60 && (($input['test'] + $input['exam']) <= 69)) {
            $grade = 'B';
        } elseif (($input['test'] + $input['exam']) >= 70 && (($input['test'] + $input['exam']) <= 100)) {
            $grade = 'A';
        } else {
            $grade = 'not defined';
        }

        $message = ' your result for course ' . $input['course_code'] . ' year ' . $input['session'] . ', ' . $input['semester'] . ' semester is ' . $input['exam'] . '  in exam and ' . $input['test'] . ' in test therefore, your grade in this course is ' . $grade;


        $sent = $this->sendMessage($message, $recipients);

    }


    /**
     * create multiple result by using excel document to upload
     */


    public function importResult(Request $request)
    {
        Excel::import(new ResultImport, $request->file('file'));
        $test_array = Excel::toArray(new ResultImport, $request->file('file'));
        array_map(function ($test_array_element) {
            array_map(function ($anada_array) {
                $users = User::whereMatricNo($anada_array[0])->get();
                foreach ($users as $user) {
                    $this->store($user->matric_no);
                }
                echo($user);
            }, $test_array_element);
        }, $test_array);
        return redirect()->back()->with('flash', 'Result Has Been Successfully Uploaded And SMS Sent Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Result $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Result $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Result $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Result $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }

    private function sendMessage($message, $recipients)
    {
        $account_sid = config('app.twilio_sid');
        $auth_token = config('app.twilio_auth');
        $twilio_number = config('app.twilio_no');
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients,
            ['from' => $twilio_number, 'body' => $message]);
    }


}
