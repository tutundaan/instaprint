@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12">
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Penilaian Rating Karyawan</h3>
              <div class="card-tools">
              </div>
            </div>
            <div class="card-body">
                @include('auth.rating._employees')
            </div>
        </div>
    </div>
</div>
@endsection

@section('options')
    <div class="col-3 offset-9">
        @include('auth.rating._info')
    </div>
@endsection
