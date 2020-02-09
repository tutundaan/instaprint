@extends('layouts.main')

@section('content')
<div class="row" id="app">
    <div class="col-12">
        @include('auth.rating._summary')
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Penilaian Rating Karyawan</h3>
              <div class="card-tools">
                {{ $employees->appends(Request::all())->links() }}
              </div>
            </div>
            <div class="card-body">
                @include('auth.rating._employees')
                {{ $employees->appends(Request::all())->links() }}
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

@section('scripts')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection