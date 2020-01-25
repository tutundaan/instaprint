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
                <span>: <span class="badge badge-info">{{ $employee->pendingRecomendation()->status() }}</span></span>
            </div>
            <div class="col-3">
                <strong>Diajukan</strong>
            </div>
            <div class="col-9">
                <span>: {{ $employee->pendingRecomendation()->created_at->format('d F Y') }}</span>
            </div>
            <div class="col-3">
                <strong>Oleh</strong>
            </div>
            <div class="col-9">
                <span>: {{ $employee->pendingRecomendation()->user->name }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
        <form action="{{ route('auth.recomendation.destroy', [$employee, $employee->pendingRecomendation()]) }}" method="POST">
            @csrf
            <button class="btn btn-success btn-sm btn-block"><i class="fas fa-check mx-2"></i> Terima</button>
        </form>
    </div>
    <div class="col-4">
        <form action="{{ route('auth.recomendation.destroy', [$employee, $employee->pendingRecomendation()]) }}" method="POST">
            @csrf
            <button class="btn btn-warning btn-sm btn-block"><i class="fas fa-times mx-2"></i> Tolak</button>
        </form>
    </div>
    <div class="col-4">
        @include('auth.recomendation._destroy')
    </div>
</div>
