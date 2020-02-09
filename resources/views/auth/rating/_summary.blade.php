<div class="row">
    <div class="col-3">
        <employee-attendance-rank-component
            route="{{ route('api.attendance.index') }}"
            token="{{ Auth::user()->api_token }}"></employee-attendance-rank-component>
    </div>

    <div class="col-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>Karyawan</h3>
                <p>Absensi Terbaik</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-times"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>