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
        <h2>{{$stage->title}}</h2>
        <h2>{{ $locationOnly }}</h2>
        <p>{{ $stage->description }}</p>
        <img src="{{asset('storage/'.$stage->image)}}" alt="immagine">
        <div id="map" style="height: 250px; width: 50%; margin-top: 10px"></div>
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
