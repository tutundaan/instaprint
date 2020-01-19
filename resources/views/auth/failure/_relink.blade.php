@if($data->employee_id)

<button type="button" class="btn btn-success btn-xs btn-block" data-toggle="modal" data-target="#relinkFailure{{ $data->id }}">Ganti</button>

<div class="modal fade" id="relinkFailure{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="relinkFailureLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="relinkFailureLabel">Ubah Tautan {{ $data->number }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          @csrf
        <div class="row my-4">
            <div class="col-12">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Atas Nama</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td><strong>{{ $data->employee->name }}</strong></td>
                            <td><span class="badge badge-primary">Tertaut</span></td>
                        </tr>
                        @php
                            $i = 1;
                        @endphp
                        @forelse($data->relatedEmployee() as $employee)
                            <form action="{{ route('auth.failure.relink', $failure) }}" method="POST">
                                @method('PATCH')
                                @if($data->employee->id != $employee->id)
                                    @csrf
                                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td><strong>{{ $employee->name }}</strong></td>
                                        <td><button class="btn btn-success btn-xs">Ubah Tautan</button></td>
                                    </tr>
                                    </form>
                                @endif
                            @empty
                            <tr>
                                <td>Tidak ada data Nama Karyawan mirip ditemukan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-12">
            @include('auth.failure._employees', [ 'action' => route('auth.failure.relink', $failure), 'method' => 'PATCH' ])
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </div>
  </div>
</div>
@endif

