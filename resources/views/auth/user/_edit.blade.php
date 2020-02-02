<button type="button" class="btn btn-xs btn-block btn-primary" data-toggle="modal" data-target="#editUser{{ $user->id }}">
  Edit
</button>

<div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUserLabel{{ $user->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('auth.user.update', $user) }}" method="POST" data-parsley-validate>
    @csrf
    @method('PUT')

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserLabel{{ $user->id }}">{{ $user->name }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          @include('auth.user._field')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </div>
    </form>
  </div>
</div>
