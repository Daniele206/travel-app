@extends('layouts.admin')

@section('content')

<div class="w-75 h-100 m-auto d-flex flex-column justify-content-between">
    <div class="mt-3 d-flex justify-content-between align-items-center">
        <span class="fs-2 fw-bold">{{ date('d-m-Y', strtotime($day->date)) }}</span>
        <a href="{{route('admin.home')}}" class="btn btn-primary">Back</a>
    </div>
    <div class="my_box">
        @if ($day->stages->isEmpty())
        <div class="my_container h-100 d-flex justify-content-center align-items-center flex-column">
            <h2 class="w-50 text-center fs-2">Aggiungi la tua prima tappa</h2>
            <a href="{{ route('admin.stages.create') }}" id="addStageBtn" class="btn btn-success fs-1 px-5 py-3 mt-3">Tappa +</a>
        </div>
        @else
        <ul class="list-group">
            @foreach ($day->stages as $stage)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $stage->title }}
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-center">
                <a href="{{ route('admin.stages.create') }}" id="addStageBtn" class="btn btn-outline-success border-0 my_btn_t">Tappa +</a>
            </li>
        </ul>
        @endif
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

    .my_btn_t{
        text-decoration: underline;
    }

    .my_btn_t:hover{
        text-decoration: none;
    }
</style>

<script>
    document.getElementById('addStageBtn').addEventListener('click', function(e) {
        e.preventDefault();
        console.log("Bottone cliccato!"); // Debug: verifica se il click funziona
        var dayId = {{ $day->id }};
        console.log("Day ID:", dayId); // Debug: verifica se dayId è corretto
        localStorage.setItem('dayId', dayId);
        console.log("Variabile salvata nel localStorage"); // Debug: verifica se il salvataggio funziona
        window.location.href = "{{ route('admin.stages.create') }}";
    });
</script>

@endsection
