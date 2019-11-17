<div class="form-group">
  <label for="name">Name</label>
  <input class="form-control" type="text" name="name" value="{{ $user->name ?? '' }}">
</div>

<div class="form-group">
  <label for="email">Email</label>
  <input class="form-control" type="email" name="email" value="{{ $user->email ?? '' }}">
</div>

<div class="form-group">
  <label for="password">Password</label>
  <input class="form-control" type="password" name="password" value="{{ old('password') }}">
</div>

<div class="form-group">
  <label for="password_confirmation">Password Confirmation</label>
  <input class="form-control" type="password" name="password_confirmation" value="{{ old('password') }}">
</div>

<div class="form-group">
  <label for="role">Role</label>
  <select name="role" class="form-control">
    @foreach ($roles as $role)
      <option value="{{ $role->slug }}" {{ ($user->role->name ?? null) === $role->name ? 'selected' : null }}>{{ $role->name }}</option>
    @endforeach
  </select>
</div>