<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label class="label-control" for=""><span>Customer</span></label>
                    <select class="form-control" name="holder">
                    <option value="">-</option>
                    @foreach($failureHolder as $holder)
                        <option value="{{ $holder->holder }}" {{ $holder->holder == Request::input('holder') ? 'selected' : null }}>{{ $holder->holder }}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="col-3">
                <div class="form-group">
                    <label class="label-control" for=""><span>Karyawan</span></label>
                    <select class="form-control" name="employee">
                    <option value="">-</option>
                    @foreach($pristineEmployees as $employee)
                        <option value="{{ $employee->id }}" {{ $employee->id == Request::input('employee') ? 'selected' : null }}>{{ $employee->name }}</option>
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label class="label-control" for=""><span>Notes</span></label>
                    <input class="form-control" type="text" name="notes" value="{{ Request::input('notes') ?? null }}">
                </div>
            </div>
        </div>
    </div>
</div>
