@if($employee->user)
<form action="{{ route('auth.link-account.destroy', $employee) }}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger btn-xs mx-2 btn-block" type="submit">Hapus Link</button>
</form>
@endif
