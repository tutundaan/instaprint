<button type="button" class="btn btn-xs btn-block btn-warning" data-toggle="modal" data-target="#linkFailure{{ $employee->id }}">
  SPK Kesalahan
</button>

<div class="modal fade" id="linkFailure{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="linkFailure{{ $employee->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('auth.employee.link', $employee) }}" method="POST">
    @csrf

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="linkFailure{{ $employee->id }}">Tautkan {{ $employee->formattedName() }} dengan SPK Kesalahan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-12 py-4">
                    @include('auth.employee._failures')
                </div>
                <div class="col-12 py-4">
                    <label class="label-control" for="">SPK Kesalahan atas nama</label>
                    <select class="form-control" name="holder">
                        @foreach($failures as $failure)
                            <option value="{{ $failure->holder }}">{{ $failure->holder }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </div>
    </form>
  </div>
</div>
