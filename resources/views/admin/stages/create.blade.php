@extends('layouts.admin')

@section('content')

@if ($errors->any())
<div class="alert alert-danger w-75 m-auto mt-3">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form id="travelForm" class="m-3 w-75 d-flex flex-column align-items-center m-auto" action="{{ route('admin.stages.store') }}" method="post">
    @csrf
    <h3 class="mt-3 fw-bold text-success">Progettazione Viaggio</h3>
    <div class="mb-1 w-75 mt-3">
        <label for="title" class="form-label fs-3 fw-bold">Titolo <i class='fs-4 fa-solid fa-star-of-life text-success'></i></label>
        <input value="{{ old('title') }}" name="title" id="title" type="text" class="form-control" aria-describedby="emailHelp">
    </div>
    <div class="mb-1 w-75">
        <label for="location" class="form-label fs-3 fw-bold">Posizione <i class='fs-4 fa-solid fa-star-of-life text-success'></i></label>
        <div class="d-flex">
            <input value="{{ old('location') }}" name="location" id="location" type="text" class="form-control me-2">
            <button type="button" id="searchButton" class="btn btn-primary">Cerca</button>
        </div>
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
        <input type="hidden" id="day_id" name="day_id"> <!-- Campo nascosto per day_id -->
        <div id="map" style="height: 300px; width: 100%; margin: 10px auto;"></div>
    </div>
    <div class="w-75 m-auto d-flex justify-content-end align-items-end">
        <span class="fs-6">Campo obbligatorio: <i class='fa-solid fa-star-of-life text-success'></i></span>
    </div>
    <div class="mb-4">
        <a href="javascript:history.back()" class="btn btn-outline-primary">Back</a>
        <button type="submit" class="btn btn-outline-success">Avanti</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Imposta la mappa e il marker iniziale
        var initialLatLng = [51.505, -0.09]; // Coordinate iniziali
        var map = L.map('map').setView(initialLatLng, 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker(initialLatLng).addTo(map);

        // Funzione per geocodificare l'indirizzo e restituire una promessa
        function geocodeLocation(location) {
            var geocodeUrl = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(location)}`;

            return fetch(geocodeUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        var lat = parseFloat(data[0].lat);
                        var lon = parseFloat(data[0].lon);

                        var newLatLng = [lat, lon];
                        marker.setLatLng(newLatLng);

                        map.setView(newLatLng, 13); // Assicurati che la mappa venga centrata sulla nuova posizione del marker
                        map.invalidateSize(); // Rende sicuro aggiornare la dimensione della mappa

                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lon;

                        return true; // Ritorna true se la ricerca è completata con successo
                    } else {
                        alert('Posizione non trovata.');
                        return false; // Ritorna false se la posizione non è trovata
                    }
                })
                .catch(error => {
                    console.error('Errore:', error);
                    return false; // Ritorna false in caso di errore
                });
        }

        // Funzione per gestire l'invio del form
        function handleFormSubmit(event) {
            event.preventDefault(); // Previeni l'invio immediato del form

            var location = document.getElementById('location').value;

            // Esegui la ricerca della posizione e poi invia il form se ha successo
            geocodeLocation(location).then(success => {
                if (success) {
                    document.getElementById('travelForm').submit(); // Invio del form solo se la ricerca ha successo
                }
            });
        }

        // Aggiungi l'evento di click sul pulsante di ricerca
        document.getElementById('searchButton').addEventListener('click', function(event) {
            geocodeLocation(document.getElementById('location').value); // Esegui la ricerca senza inviare il form
        });

        // Assicurati che il valore di day_id venga impostato correttamente
        var dayId = localStorage.getItem('dayId');
        if (dayId) {
            document.getElementById('day_id').value = dayId;
        } else {
            console.error('dayId non trovato nel localStorage');
        }

        // Aggiungi l'evento di submit al form
        document.getElementById('travelForm').addEventListener('submit', handleFormSubmit);
    });
</script>


@endsection
