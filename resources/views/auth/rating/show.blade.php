
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12">
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <p class="lead">Riwayat Rating <strong>{{ $employee->formattedName() }}</strong></p>
                    </div>
                    @foreach($employee->orderedRatings()->get() as $rating)
                        <div class="col-6">
                            @include('auth.rating._show', compact('rating'))
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('options')
@endsection
