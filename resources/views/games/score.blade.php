@extends('layouts.app')

@section('content')
    <div class="bg-dark text-light p-4" style="border-bottom-left-radius: 40%;border-bottom-right-radius: 40%;">
        <div class="d-flex flex-column align-items-center" style="gap: 20px;">
            <h3>Hey, {{ auth()->user()['name'] }}</h3>
            <div class="bg-light d-flex flex-column align-items-center justify-content-center text-dark"
                style="width: 130px;height: 130px;border-radius: 50%;">
                <h5>Your score</h5>
                <h2>{{ $score }}</h2>
            </div>
            <div class="d-flex" style="gap: 10px;130px">
                <div style="width: 200px;">
                    <div class="p-2 d-flex flex-column align-items-center" style="background-color: #ffffff20;">
                        <h3>Questions</h3>
                        <h3>10</h3>
                    </div>
                </div>
                <div style="width: 200px;">
                    <div class="p-2 d-flex flex-column align-items-center" style="background-color: #ffffff20;">
                        <h3>Correct</h3>
                        <h3>{{ $score }}</h3>
                    </div>
                </div>
                <div style="width: 200px;">
                    <div class="p-2 d-flex flex-column align-items-center" style="background-color: #ffffff20;">
                        <h3>Wrong</h3>
                        <h3>{{ 10 - $score }}</h3>
                    </div>
                </div>
            </div>
            @if ($gameId == 1)
                <span>You have won discount voucher of </span>
                <h4>₹ {{ $price }}/-</h4>
            @else
                <span style="max-width: 500px;text-align: center;">{{ $message }}</span>
            @endif
        </div>
    </div>
@endsection
