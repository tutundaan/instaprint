<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
    Rating Bulan {{ $filteredRating ? $filteredRating->first()->created_at->locale('id')->monthName : now()->locale('id')->monthName }}
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="text-dark">Filter Rating</p>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('auth.rating.index') }}" method="GET">
            @csrf
            <div class="form-group">
                <label for="filter">Filter</label>
                <select name="filter" class="form-control">
                    @foreach ($ranges as $range)
                        <option value="{{ $range->format('F Y') }}">{{ $range->format('F Y') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Filter</button>
                <a href="{{ route('auth.rating.index') }}" class="btn btn-success btn-block">Reset</a>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>