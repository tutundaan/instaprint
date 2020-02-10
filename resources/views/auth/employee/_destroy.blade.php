@if (!$employee->user and Auth::user()->isAdmin())
<button type="button" class="btn btn-xs btn-block btn-danger" data-toggle="modal" data-target="#employeeDestroy{{ $employee->id }}">
    Hapus
</button>

<div class="modal fade" id="employeeDestroy{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="employeeDestroyLabel{{ $employee->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="employeeDestroyLabel{{ $employee->id }}">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body border-danger">
        <p class="lead text-danger">Yakin menghapus <strong>{{ $employee->formattedName() }}</strong> ?</p>
        <form action="{{ route('auth.employee.destroy', $employee) }}" method="POST">
            @csrf
            @method('DELETE')

            <input type="submit" value="Hapus" class="btn btn-block btn-danger">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif
