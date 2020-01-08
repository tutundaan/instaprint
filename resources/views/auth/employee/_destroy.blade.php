@if (!$employee->user and Auth::user()->isAdmin())
<form action="{{ route('auth.employee.destroy', $employee) }}" method="POST">
  @csrf
  @method('DELETE')

  <input type="submit" value="Hapus" class="btn btn-xs btn-block btn-danger">
</form>
@endif
