@extends('layouts.main')

@section('content')
<div class="row">
	<div class="col-12 mb-2">
        <div class="card card-default">
            <div class="card-body">
                <form action="{{ route('auth.monthly-attendance.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <input type="file" name="attendance" class="btn btn-link">
                            </div>
                            <div class="col-6">
                                <input type="submit" value="Import" class="btn btn-success float-right">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
</div>
@endsection
