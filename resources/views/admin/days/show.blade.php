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
        <ul class="list-group overflow-auto h-100">
            @foreach ($day->stages as $stage)
                @php
                // Suddividi la stringa della location con il delimitatore '|'
                $locationParts = explode('|', $stage->location);
                // Prendi la prima parte come location
                $locationOnly = $locationParts[0];
                @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="my_w d-flex justify-content-between">
                        <span>{{ $stage->title }}</span>
                        <span>{{ $locationOnly }}</span>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input mouse_h" type="checkbox" role="switch" id="flexSwitchCheck{{ $stage->id }}">
                        <label class="form-check-label" for="flexSwitchCheck{{ $stage->id }}">Visitata</label>
                    </div>
                    <div>
                        <a href="{{ route('admin.stages.show', $stage) }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                        <a href="{{ route('admin.stages.edit', $stage) }}" class="btn btn-success"><i class="fa-solid fa-plus"></i> <i class="fa-solid fa-pen"></i></a>
                        <form onsubmit="return confirm('Sei sicuro/a di voler cancellare la tappa \{{$stage->title}}\?')" class="d-inline-block" action="{{route('admin.stages.destroy', $stage)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger "><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
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

    .my_w{
        width: 30%;
    }

    .mouse_h:hover{
        cursor: pointer;
    }
</style>

<script>
    document.querySelectorAll('.form-check-input').forEach(function(checkbox) {
        const stageTitle = checkbox.closest('li').querySelector('.my_w span').textContent;

        // Imposta lo stato iniziale della checkbox
        if (localStorage.getItem(stageTitle) === '1') {
            checkbox.checked = true;
            checkbox.id = 'flexSwitchCheckChecked';
        } else {
            checkbox.checked = false;
            checkbox.id = 'flexSwitchCheckDefault';
        }

        checkbox.addEventListener('change', function() {
            if (this.checked) {
                localStorage.setItem(stageTitle, '1');
                this.id = 'flexSwitchCheckChecked';
            } else {
                localStorage.setItem(stageTitle, '0');
                this.id = 'flexSwitchCheckDefault';
            }
        });
    });

    document.getElementById('addStageBtn').addEventListener('click', function(e) {
        e.preventDefault();
        var dayId = {{ $day->id }};
        localStorage.setItem('dayId', dayId);
        window.location.href = "{{ route('admin.stages.create') }}";
    });
</script>

@endsection
