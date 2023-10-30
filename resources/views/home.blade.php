@extends('layouts.app')


@section('content')
<div class="d-flex flex-column align-items-center">
    <h1>PLAY SMART,</h1>
    <h1 class="text-danger" style="font-weight: 900">WIN BIG!</h1>
    <img class="my-4" style="max-width: 400px" src="{{ asset('images/banner-img.png')}}" alt="">
    <a class="btn btn-primary p-3" style="width: 200px" href="{{ route('choose-game') }}">Start Game</a>
</div>
@endsection
