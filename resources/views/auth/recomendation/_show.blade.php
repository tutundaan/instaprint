<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <strong>Atas Nama</strong>
            </div>
            <div class="col-9">
                <span>: {{ $employee->formattedName() }}</span>
            </div>
            <div class="col-3">
                <strong>Status</strong>
            </div>
            <div class="col-9">
                <span>: <span class="badge badge-info">{{ $employee->openRecomendation()->status() }}</span></span>
            </div>
            <div class="col-3">
                <strong>Diajukan</strong>
            </div>
            <div class="col-9">
                <span>: {{ $employee->openRecomendation()->created_at->format('d F Y') }}</span>
            </div>
            <div class="col-3">
                <strong>Oleh</strong>
            </div>
            <div class="col-9">
                <span>: {{ $employee->openRecomendation()->user->name }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        @include('auth.recomendation._accept')
    </div>
    <div class="col-4">
        @include('auth.recomendation._reject')
    </div>
    <div class="col-4">
        @include('auth.recomendation._destroy')
    </div>
</div>
