<button type="button" class="btn btn-success btn-sm float-right" data-toggle="modal" data-target="#importMonthAttendance">Import Absensi Bulanan</button>

<div class="modal fade" id="importMonthAttendance" tabindex="-1" role="dialog" aria-labelledby="importMonthAttendance" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('auth.monthly-attendance.store') }}" method="POST" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importMonthAttendance">Import Data Absensi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          @csrf
          @include('auth.monthly-attendance._field')
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-primary">Import</button>
      </div>
    </div>
    </form>
  </div>
</div>
