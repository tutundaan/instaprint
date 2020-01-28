@if(Auth::user()->isSupervisor())
    @if($employee->lastSupervisorRating())
        <button type="button" class="btn btn-warning btn-xs px-2" data-toggle="modal" data-target="#ratingCreate{{ $employee->id }}">Ubah Rating</button>
    @else
        <button type="button" class="btn btn-success btn-xs px-2" data-toggle="modal" data-target="#ratingCreate{{ $employee->id }}">Buat Rating</button>
    @endif

    <div class="modal fade" id="ratingCreate{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="ratingCreate{{ $employee->id }}" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form action="{{ route('auth.rating.store') }}" method="POST">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ratingCreate{{ $employee->id }}">Buat Rating untuk {{ $employee->formattedName() }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <input type="hidden" value="{{ $employee->id }}" name="employee">
              @csrf
              @include('auth.rating._field')
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
