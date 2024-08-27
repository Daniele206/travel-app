@extends('layouts.admin')

@section('content')

@php
// Suddividi la stringa della location con il delimitatore '|'
$locationParts = explode('|', $stage->location);
// Prendi la prima parte come location
$locationOnly = $locationParts[0];

$lat = $locationParts[1];
$lon = $locationParts[2];
@endphp

<div class="w-75 h-100 m-auto d-flex align-items-center">
    <div class="my_box">
        <div class="d-flex justify-content-between mx-4 my-3">
            <h2>Nome: <strong>{{$stage->title}}</strong></h2>
            <h2>Posizione: <strong>{{ $locationOnly }}</strong></h2>
        </div>
        <div class="d-flex justify-content-between mx-4">
            <img src="{{asset('storage/'.$stage->image)}}" class=" object-fit-cover" style="height: 250px; width: 48%">
            <div id="map" style="height: 250px; width: 48%"></div>
        </div>
        <h2 class="ms-4 mt-3">Descrizione:</h2>
        <p class="mx-4 fs-5">{{ $stage->description }}</p>
        <a href="javascript:history.back()" class="btn btn-outline-primary ms-4 mb-2">Back</a>
    </div>
</div>

<style lang="scss" scoped>
    .my_box {
        width: 100%;
        height: 75%;
        margin-bottom: 4rem;
        background-color: white;
        border-radius: 0.6rem;
        box-shadow: 0px 0px 10px gray;
        overflow: auto;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        var initialLatLng = [{{ $lat }}, {{ $lon }}];
        var map = L.map('map').setView(initialLatLng, 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker(initialLatLng).addTo(map);
    });
</script>

@endsection
