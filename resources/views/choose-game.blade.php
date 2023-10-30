@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 p-2">
                <x-game-card href="{{ route('sectors', ['gameId' => 1]) }}" icon="clock" header="Win in 2 minutes">
                    Unlock your career path through our easy career assessment
                    test and
                    stand to win vouchers of up to Rs <b>5000</b>.
                </x-game-card>
            </div>
            <div class="col-md-6 p-2">
                <x-game-card href="{{ route('sectors', ['gameId' => 2]) }}" icon="bag-fill" header="Are you job ready?">
                    Know where you stand before you enter the job market
                    through a simple
                    TimesPro
                    AI powered test
                </x-game-card>
            </div>
        </div>
    </div>
@endsection
