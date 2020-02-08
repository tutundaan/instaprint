<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Total Rating</th>
            <th>
                @include('auth.rating._filter')
            </th>
        </tr>
    </thead>

    <tbody>
        @forelse ($employees as $i => $employee)
        <tr>
            <th>{{ $i + $employees->firstItem() }}</th>
            <th>{{ $employee->formattedName() }}</th>
            <td>@include('auth.rating._stars')</td>
            <td>
                <div class="row">
                    <div class="col-3">
                        @include('auth.rating._create')
                    </div>
                    <div class="col-3">
                        @include('auth.recomendation._recomend')
                    </div>
                    <div class="col-3">
                        @include('auth.recomendation._status')
                    </div>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td>Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>
