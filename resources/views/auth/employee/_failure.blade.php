<button type="button" class="btn btn-xs btn-block btn-warning" data-toggle="modal" data-target="#linkFailure{{ $employee->id }}">
  SPK Kesalahan
</button>

<div class="modal fade" id="linkFailure{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="linkFailure{{ $employee->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
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
                    <form action="{{ route('auth.employee.link', $employee) }}" method="POST">
                        @csrf
                        @include('auth.employee._link')
                    </form>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </div>
  </div>
</div>
