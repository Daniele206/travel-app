@php
    use Carbon\Carbon;

    $leavingDate = Carbon::createFromFormat('d/m/Y', $jurney['leaving']);
@endphp

@extends('layouts.admin')

@section('content')
    <div class="w-75 h-100 m-auto d-flex flex-column justify-content-between">
        <div class="d-flex justify-content-between mt-3 mb-3">
            <h2>{{$jurney['title']}} - {{$jurney['destination']}}</h2>
            <a href="{{route('admin.jurney.edit', $jurney)}}" class="btn btn-warning" style="height: 2.6rem"><i class="fa-solid fa-pen"></i></a>
        </div>
        <div class=" overflow-auto">

            <ul class="list-group">
                @for ($i = 0; $i < $jurney_length+1; $i++)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Giorno: {{ $leavingDate->copy()->addDays($i)->format('d-m-Y') }}
                        <button class="btn btn-success">Vai al giorno</button>
                    </li>
                @endfor
            </ul>

        </div>
        <div class="d-flex justify-content-between mt-4 mb-3">
            <span class="d-block fw-bold fs-4 me-3">{{$jurney['leaving']}} - {{$jurney['return']}}</span>
            <button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
        </div>
    </div>

@endsection
