@if(Auth::user()->isManager() and $employee->hasPendingRecomendation())
    <form action="{{ route('auth.recomendation.accept', [$employee, $employee->pendingRecomendation()]) }}" method="POST">
        @csrf
        @method('PUT')
        <button class="btn btn-success btn-sm btn-block"><i class="fas fa-check mx-2"></i> Terima</button>
    </form>
@endif
