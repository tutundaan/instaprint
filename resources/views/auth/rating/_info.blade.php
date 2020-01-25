<button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#ratingInfo">Info</button>

<div class="modal fade" id="ratingInfo" tabindex="-1" role="dialog" aria-labelledby="ratingInfo" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('auth.user.store') }}" method="POST">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ratingInfo">Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Rating Hanya bisa diberikan oleh <strong>Supervisor</strong> terhadap Karyawan dengan parameter seperti.</p>
        <ul>
            <li>Kedisiplinan</li>
            <li>Kerjasama</li>
            <li>Kecepatan Bekerja</li>
            <li>Kemampuan Bekerja</li>
            <li>Ketelitian</li>
        </ul>
        <p>Rating dapat dirubah dalam kurun bulan yang sama. <br/> Rating dikalkulasi tiap bulan.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
    </form>
  </div>
</div>
