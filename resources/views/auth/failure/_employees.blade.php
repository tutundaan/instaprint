<form action="{{ $action ?? route('auth.failure.link', $failure) }}" method="POST">
    @csrf
    @isset($method)
        @method($method)
    @endisset
    <div class="form-group">
        <label class="label-control" for="">Nama Karyawan</label>
        <select class="form-control" name="employee_id">
        @foreach($employees as $employee)
            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
        @endforeach
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-sm btn-success">Tautkan</button>
    </div>
</form>

