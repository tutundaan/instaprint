<button type="button" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#createUser">Daftarkan Pengguna Baru</button>

<div class="modal fade" id="createUser" tabindex="-1" role="dialog" aria-labelledby="createUserLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('auth.user.store') }}" method="POST" data-parsley-validate>
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createUserLabel">Daftarkan Pengguna Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          @csrf
          @include('auth.user._field')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
    </form>
  </div>
</div>
