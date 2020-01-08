<div class="form-group">
  <label for="name">Nama</label>
  <input class="form-control" type="text" name="name" value="{{ $employee->name ?? '' }}" required="true" minlength="6" maxlength="255">
</div>

<div class="form-group">
  <label for="number">ID</label>
  <input class="form-control" type="numeric" name="number" value="{{ $employee->number ?? '' }}" required="true">
</div>
