@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-header">Results for {{ ucfirst(Auth::user()->last_name).'-'.ucfirst(Auth::user()->first_name) }}</div>
                <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Course Code</th>
                        <th>Test</th>
                        <th>Exam</th>
                        <th>Total</th>
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
