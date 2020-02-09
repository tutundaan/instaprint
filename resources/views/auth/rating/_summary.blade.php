<div class="row">
    <div class="col-3">
        <employee-attendance-rank-component
            route="{{ route('api.attendance.index') }}"
            token="{{ Auth::user()->api_token }}"></employee-attendance-rank-component>
    </div>

    <div class="col-3">
        <employee-failure-rank-component
            route="{{ route('api.failure.index') }}"
            token="{{ Auth::user()->api_token }}"></employee-failure-rank-component>
    </div>
</div>