
@if($employee->user)
<button type="button" class="btn btn-warning btn-block btn-xs" data-toggle="modal" data-target="#updateLink{{ $employee->id }}">Ubah Link</button>

<div class="modal fade" id="updateLink{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="updateLink" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('auth.link-account.update', $employee) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="linkAccountLabel">Ubah Link Akun</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          @csrf
          @include('auth.link-account._field')
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
