@if(Auth::user()->id === $employee->openRecomendation()->user_id)
    @if($employee->openRecomendation()->deleteable())
    <form action="{{ route('auth.recomendation.destroy', [$employee, $employee->openRecomendation()]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm btn-block"><i class="fas fa-trash mx-2"></i> Hapus</button>
    </form>
    @endif
@endif
