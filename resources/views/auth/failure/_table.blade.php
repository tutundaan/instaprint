<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Job Order</th>
            <th>Customer</th>
            <th>Karyawan</th>
            <th>Catatan</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @forelse ($failures as $i => $failure)
        <tr>
            <td>{{ $i + $failures->firstItem() }}</td>
            <th>{{ $failure->number }}</th>
            <td>{{ $failure->holder }}</td>
            <th>{{ $failure->employee->name ?? '-' }}</th>
            <td>{{ $failure->note }}</td>
            <td>
                <div class="row">
                    @include('auth.failure._show')
                    @include('auth.failure._relink' , ['data' => $failure])
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
