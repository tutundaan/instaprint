@if($employee->hasNoOpenRecomendation() and Auth::user()->isSupervisor())
<button type="button" class="btn btn-info btn-xs px-2" data-toggle="modal" data-target="#recomendEmployee{{ $employee->id }}">Rekomendasikan</button>

<div class="modal fade" id="recomendEmployee{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="recomendEmployee{{ $employee->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('auth.recomendation.store', $employee) }}" method="POST">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="recomendEmployee{{ $employee->id }}">Yakin untuk merekomendasikan {{ $employee->formattedName() }} ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p class="my-2">
            Rekomendasi akan diinfokan ke Dashboard Manager. <br>
            Status Rekomendasi juga dapat dilihat oleh Karyawan terkait.
        </p>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Ya Rekomendasikan Karyawan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
    </form>
  </div>
</div>
@endif
