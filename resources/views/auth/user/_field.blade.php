<div class="form-group">
  <label for="name">Nama</label>
  <input class="form-control" type="text" name="name" value="{{ $user->name ?? '' }}" required="true" minlength="6" maxlength="45" data-parsley-pattern="^[A-Za-z]*$">
</div>

<div class="form-group">
  <label for="phone">Telepon</label>
  <input class="form-control" type="text" name="phone" value="{{ $user->phone ?? '' }}" required="true" minlength="6" maxlength="13" data-parsley-type="number">
</div>

<div class="form-group">
  <label for="password">Password</label>
  <input class="form-control" id="password{{ $user->id ?? 'New' }}" type="password" name="password" value="{{ old('password') }}" required="true" minlength="6" maxlength="25">
</div>

<div class="form-group">
  <label for="password_confirmation">Konfirmasi Password</label>
  <input class="form-control" type="password" name="password_confirmation" value="{{ old('password') }}" required="true" minlength="6" data-parsley-equalto="#password{{ $user->id ?? 'New' }}">
</div>

<div class="form-group">
  <label for="role">Hak Akses</label>
  <select name="role" class="form-control" required="true">
    @foreach ($roles as $role)
      <option value="{{ $role->slug }}" {{ ($user->role->name ?? null) === $role->name ? 'selected' : null }}>{{ $role->name }}</option>
    @endforeach
  </select>
</div>
