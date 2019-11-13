<form action="{{ route('auth.user.destroy', $user) }}" method="POST">
  @csrf
  @method('DELETE')

  <input type="submit" value="Delete">
</form>