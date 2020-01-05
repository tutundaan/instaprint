@if($employee->user)
<form action="{{ route('auth.link-account.destroy', $employee) }}" method="POST">
    @csrf
    @method('DELETE')
    <p>
        <button class="btn btn-danger btn-xs mx-2" type="submit">Unlink</button>
    </p>
</form>
@endif
