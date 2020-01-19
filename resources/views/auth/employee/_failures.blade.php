<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Nama SPK</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($employee->failures()->distinct()->get('holder') as $i => $failure)
        <tr>
            <th>{{ ++$i }}</th>
            <td>{{ $failure->holder }}</td>
            <td>
                @include('auth.employee._unlink')
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>
