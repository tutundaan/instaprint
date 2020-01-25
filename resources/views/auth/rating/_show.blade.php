<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <p><i class="far fa-calendar mx-2"></i>{{ $rating->created_at->format('F Y') }}</p>
            </div>
            <div class="col-6">
                <p>
                    Kedisiplinan <br>
                    @include('auth.rating._rate', ['rate' => $rating->discipline ])
                </p>
            </div>
            <div class="col-6">
                <p>
                    Kerjasama <br>
                    @include('auth.rating._rate', ['rate' => $rating->teamwork ])
                </p>
            </div>
            <div class="col-6">
                <p>
                    Kecepatan <br>
                    @include('auth.rating._rate', ['rate' => $rating->speed ])
                </p>
            </div>
            <div class="col-6">
                <p>
                    Kemampuan <br>
                    @include('auth.rating._rate', ['rate' => $rating->skill ])
                </p>
            </div>
            <div class="col-6">
                <p>
                    Ketelitian <br>
                    @include('auth.rating._rate', ['rate' => $rating->accuracy ])
                </p>
            </div>
        </div>
    </div>
</div>
