@if(!$employee->user)
<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#linkEmployee{{ $employee->id }}">Tautan Baru</button>

<div class="modal fade" id="linkEmployee{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="linkEmployeeLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('auth.user.link') }}" method="POST" data-parsley-validate>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="linkEmployee{{ $employee->id }}">Tautkan {{ $employee->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          @csrf
          @include('auth.user._link', ['name' => $employee->name, 'employee_id' => $employee->id ])
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
    </form>
  </div>
</div>
@endif
