@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Karyawan hadir pada tanggal <strong>{{ $carbon->format('d F Y') }}</strong></h3>
              <div class="card-tools">
              </div>
            </div>
            <div class="card-body">
                @include('auth.monthly-attendance._employee')
            </div>
        </div>
    </div>
</div>
@endsection
