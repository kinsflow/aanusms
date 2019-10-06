@extends('layouts.app')
@section('content')
<div class="container">
    @if(Session::has('flash'))
    <div class="alert alert-success">
        <h1>{{ session('flash') }}</h1>
    </div>
    @endif
    <h1>Admin Page / Upload Result</h1>
    <form class="col-sm-8" action="{{ route('result.store')  }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="matric_no">Matric No:</label>
          <input type="text" class="form-control" id="matric_no" required placeholder="Enter Student Matric No" name="matric_no">
        </div>
        <div class="form-group">
          <label for="password">Course Code:</label>
          <input type="text" class="form-control" id="pwd" required placeholder="Enter Course Code" name="course_code">
        </div>
        <div class="form-group">
                <label for="test">Test:</label>
                <input type="number" class="form-control" required id="test" placeholder="Enter CA" name="test">
        </div>
        <div class="form-group">
                <label for="exam">Course Code:</label>
                <input type="number" class="form-control" required id="exam" placeholder="Enter Exam Score" name="exam">
        </div>
        <div class="form-group">
            <select class="form-control" name="session" id="session">
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
            </select>
        </div>
        <div class="form-group">
            <select class="form-control" name="semester" id="semester">
                <option value="1">first semester</option>
                <option value="2">second semester</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary col-sm-12">Submit</button>
    </form>
</div>

@stop
