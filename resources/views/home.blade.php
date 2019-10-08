@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card text-center">
                <div class="card-header">Results for {{ ucfirst(Auth::user()->last_name).'-'.ucfirst(Auth::user()->first_name) }}</div>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Course Code</th>
                        <th>Test</th>
                        <th>Exam</th>
                        <th>Total</th>
                        <th>Session</th>
                        <th>Number</th>
                        <th>Semester</th>
                        <th>Grade</th>
                        <th>Time Uploaded</th>
                        <th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                        <tr>
                            <td>{{ $result->course_code }}</td>
                            <td>{{ $result->test }}</td>
                            <td>{{ $result->exam }}</td>
                            <td>{{ $result->test + $result->exam }}</td>
                            <td>{{ $result->session }}</td>
                            <td>{{ auth()->user()->number }}</td>
                            <td>{{ $result->semester  == 1 ? 'first semester' : 'second semester' }}</td>
                            <td>
                                @if(($result->test + $result->exam) < 45)

                                   F
                                @elseif(($result->test + $result->exam) >=45 && ($result->test + $result->exam)<50)
                                    D
                                @elseif (($result->test + $result->exam) >=50 && ($result->test + $result->exam)<60)
                                    C

                                @elseif (($result->test + $result->exam) >=60 && ($result->test + $result->exam)<70)
                                    B
                                @elseif (($result->test + $result->exam) >=70 && ($result->test + $result->exam))
                                    A
                                @else
                                   F
                                @endif
                            </td>
                            <td>{{ $result->updated_at ? $result->updated_at->toDayDateTimeString() : 'upload time was not captured' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection
