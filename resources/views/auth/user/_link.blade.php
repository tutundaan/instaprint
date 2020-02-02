<input type="hidden" name="employee_id" value="{{ $employee_id }}">

<div class="form-group">
  <label for="name">Nama</label>
  <input class="form-control" type="text" name="name" value="{{ old('name') ?? $name }}" required="true" minlength="6" maxlength="255">
</div>

<div class="form-group">
  <label for="phone">Telepon</label>
  <input class="form-control" type="text" name="phone" value="{{ old('phone') }}" required="true" minlength="6" maxlength="13" data-parsley-type="number">
</div>

<div class="form-group">
  <label for="password">Password</label>
  <input id="link{{ $employee_id ?? 'New' }}" class="form-control" type="password" name="password" value="{{ old('password') }}" required="true" minlength="6" maxlength="255">
</div>

<div class="form-group">
  <label for="password_confirmation">Konfirmasi Password</label>
  <input class="form-control" type="password" name="password_confirmation" value="{{ old('password') }}" required="true" minlength="6"  data-parsley-equalto="#link{{ $employee_id ?? 'New' }}">
</div>

<div class="form-group">
  <label for="role">Hak Akses</label>
  <select name="role" class="form-control" required="true">
    @foreach ($roles as $role)
      <option value="{{ $role->slug }}" {{ ($user->role->name ?? null) === $role->name ? 'selected' : null }}>{{ $role->name }}</option>
    @endforeach
  </select>
</div>
