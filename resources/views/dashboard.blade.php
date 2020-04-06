@extends('layouts.app')
@section('content')
    <div class="container">
        @if(Session::has('flash'))
            <div class="alert alert-success">
                <h1>{{ session('flash') }}</h1>
            </div>
        @endif
        <h1>Admin Page / Upload Result</h1>
        <form action="{{ route('uploadResult')  }}" method="POST" enctype="multipart/form-data">

            @csrf
            <label for="file">Choose / Select Your File To Be Uploaded</label>
            <input class="form form-control" type="file" name="file">
            <br>
            <input class="form-control btn-success form" type="submit" value="Upload Result">
        </form>
    </div>

@stop
