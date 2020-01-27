@if (Auth::user()->isManager() and $employee->hasPendingRecomendation())
<form action="{{ route('auth.recomendation.reject', [$employee, $employee->pendingRecomendation()]) }}" method="POST">
    @csrf
    @method('PUT')
    <button class="btn btn-warning btn-sm btn-block"><i class="fas fa-times mx-2"></i> Tolak</button>
</form>
@endif
