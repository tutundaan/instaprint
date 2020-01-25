@if(Auth::user()->id === $employee->pendingRecomendation()->user_id)
    <form action="{{ route('auth.recomendation.destroy', [$employee, $employee->pendingRecomendation()]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm btn-block"><i class="fas fa-trash mx-2"></i> Hapus</button>
    </form>
@endif
