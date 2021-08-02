@extends('layout')

@section('main')
    <div class="row justify-content-md-center" style="padding: 100px 0">
        <div class="col col-lg-6">
            <form method="post" name="" action="{{route('generate_url')}}">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="username" name="username" class="form-control" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label>Phone number</label>
                    <input type="text" class="form-control" name="phone"  placeholder="Enter phone" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    @if (session('temporary-url'))
        
        <div class="alert alert-success">
            <a href="{{ session('temporary-url') }}">{{ session('temporary-url') }}</a>
        </div>
    @endif
@stop