@extends('layouts.app')

@section('content')
    <div class="container" style="max-width: 700px;">
        <form class="d-flex flex-column" style="gap: 16px;" method="POST">
            @csrf
            <h5>Enter your credentials to proceed</h5>
            @if (session('error'))
                <h6 class="text-danger">{{ session('error') }}</h6>
            @endif
            <div class="form-group">
                <label for="exampleInputEmail1">Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" aria-describedby="emailHelp"
                    placeholder="Enter your name">
                @error('name')
                    <p class="text-danger">{{ $message }}fsdf</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="email" aria-describedby="emailHelp"
                    placeholder="Enter your name">
                @error('email')
                    <p class="text-danger">{{ $message }}dsf</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Phone Number<span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="phone" aria-describedby="emailHelp"
                    placeholder="Enter your name">
                @error('phone')
                    <p class="text-danger">{{ $message }}sdfs</p>
                @enderror
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="agree">
                <label class="form-check-label" for="agree">I agree to Terms and Conditions & Privacy Policy</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="updates">
                <label class="form-check-label" for="updates">Yes, I would like to receive updates via whatsapp.</label>
            </div>
            <x-app-button type="submit">Proceed</x-app-button>
        </form>
    </div>
@endsection
