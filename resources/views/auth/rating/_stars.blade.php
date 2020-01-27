@if($employee->rating())
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ratingEmployeeInfo">
    @include('auth.rating._rate', ['rate' => $employee->rating() ])
</button>

<div class="modal fade" id="ratingEmployeeInfo" tabindex="-1" role="dialog" aria-labelledby="ratingEmployeeInfo" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ratingEmployeeInfo">Rating Terakhir</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('auth.rating._show', ['rating' => $employee->lastRating()])
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <a href="{{ route('auth.rating.show', $employee->lastRating()) }}" class="btn btn-primary">Lihat lebih banyak</a>
      </div>
    </div>
  </div>
</div>
@endif