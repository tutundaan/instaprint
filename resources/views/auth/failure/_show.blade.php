<button type="button" class="btn btn-info btn-xs btn-block" data-toggle="modal" data-target="#showFailure{{ $failure->id }}">Detail</button>

<div class="modal fade" id="showFailure{{ $failure->id }}" tabindex="-1" role="dialog" aria-labelledby="showFailureLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showFailureLabel">Detail SPK nomor <strong>{{ $failure->number }}</strong></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
            <div class="col-6"><strong>Job Order</strong></div>
            <div class="col-6">: {{ $failure->number }}</div>
            <div class="col-6"><strong>Tanggal</strong></div>
            <div class="col-6">: {{ $failure->created_at->format('d F Y') }}</div>
            <div class="col-6"><strong>Customer</strong></div>
            <div class="col-6">: {{ $failure->holder }}</div>
            <div class="col-6"><strong>Subtotal</strong></div>
            <div class="col-6">: {{ Str::formatRupiah($failure->subtotal) }}</div>
            <div class="col-6"><strong>Discount</strong></div>
            <div class="col-6">: {{ Str::formatRupiah($failure->discount) }}</div>
            <div class="col-6"><strong>Tax</strong></div>
            <div class="col-6">: {{ Str::formatRupiah($failure->tax) }}</div>
            <div class="col-6"><strong>Freight</strong></div>
            <div class="col-6">: {{ Str::formatRupiah($failure->freight) }}</div>
            <div class="col-6"><strong>Total</strong></div>
            <div class="col-6">: {{ Str::formatRupiah($failure->total) }}</div>
            <div class="col-6"><strong>Paid</strong></div>
            <div class="col-6">: {{ Str::formatRupiah($failure->paid) }}</div>
            <div class="col-6"><strong>Input By</strong></div>
            <div class="col-6">: {{ $failure->signed }}</div>
            <div class="col-6"><strong>Rating</strong></div>
            <div class="col-6">:
                @for($i = 0; $i < $failure->rating; $i++)
                <i class="fas fa-star"></i>
                @endfor
            </div>
            <div class="col-6"><strong>Note</strong></div>
            <div class="col-6">: {{ $failure->note }}</div>
            @if($failure->employee_id)
            <div class="col-6"><strong>Karyawan Tertaut</strong></div>
            <div class="col-6">: {{ $failure->employee->name }}</div>
            @endif
        </div>
        @include('auth.failure._related')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
