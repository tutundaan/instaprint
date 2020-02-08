@php
  $filteredEmployeeRating = ($filteredRating ? $filteredRating->where('employee_id', $employee->id)->first() : false);
@endphp

@if($employee->rating())
<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#ratingEmployeeInfo{{ $employee->id }}">
    @include('auth.rating._rate', ['rate' => ($filteredRating ? $filteredEmployeeRating->evaluate : $employee->rating()) ])
</button>

<div class="modal fade" id="ratingEmployeeInfo{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="ratingEmployeeInfo{{ $employee->id }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ratingEmployeeInfo{{ $employee->id }}">
          {{ $filteredRating ? "Rating " . $employee->formattedName() : "Rating Terakhir " . $employee->formattedName() }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @include('auth.rating._show', ['rating' => ($filteredRating ? $filteredEmployeeRating : $employee->lastRating())])
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <a href="{{ route('auth.rating.show', $employee->lastRating()) }}" class="btn btn-primary">Lihat lebih banyak</a>
      </div>
    </div>
  </div>
</div>
@endif
