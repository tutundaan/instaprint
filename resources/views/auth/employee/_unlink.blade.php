<form action="{{ route('auth.failure.unlink', $failure->holder) }}" method="POST">
    @csrf
    @method("DELETE")
    <input type="hidden" value="{{ $failure->holder }}">
    <button class="btn btn-danger btn-xs btn-block">Unlink</button>
</form>
