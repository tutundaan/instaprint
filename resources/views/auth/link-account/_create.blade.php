@if(is_null($employee->user))
<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#linkAccount{{ $employee->id }}">Sambungkan</button>

<div class="modal fade" id="linkAccount{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="linkAccountLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('auth.link-account.store') }}" method="POST">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="linkAccountLabel">Link Akun</h5>
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
@else
    <p><strong> {{ $employee->user->name }}</strong></p>
@endif
