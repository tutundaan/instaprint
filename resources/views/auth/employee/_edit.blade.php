<button type="button" class="btn btn-xs btn-block btn-primary" data-toggle="modal" data-target="#editEmployee{{ $employee->id }}">
  Ubah
</button>

<div class="modal fade" id="editEmployee{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="editEmployeeLabel{{ $employee->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('auth.employee.update', $employee) }}" method="POST" data-parsley-validate>
    @csrf
    @method('PUT')

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editEmployeeLabel{{ $employee->id }}">{{ $employee->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" value="{{ $employee->id }}" name="id">
        @include('auth.employee._field')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </div>
    </form>
  </div>
</div>
