@if($users->count() == 0)
        <p>Tidak ada akun tanpa link</p>
        @else
        <div class="form-group">
            <label class="label-control" for="">Pilih Akun</label>
            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
            <select class="form-control" name="user_id">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
            </select>
        </div>
@endif
