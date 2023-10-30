@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>To begin, first select the sector of your choice</h4>
        <div class="row mt-2">
            @foreach ($sectors as $sector)
                <div class="col-md-6 p-2">
                    <x-game-card href="{{ route('sectors.user-form', ['gameId' => $gameId, 'sectorId' => $sector->id]) }}"
                        icon="{{ $sector->icon }}" header="{{ $sector->name }}" />
                </div>
            @endforeach
        </div>
    </div>
@endsection
