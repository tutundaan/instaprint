<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>ID</th>
            <th>Akun</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($employees as $i => $employee)
        <tr>
            <th>{{ $i + $employees->firstItem() }}</th>
            <th>{{ $employee->formattedName() }}</th>
            <td>{{ $employee->number }}</td>
            <td><strong>{{ $employee->user ? $employee->user->name : '-' }}</strong></td>
            <td>
                <div class="row">
                    <div class="col-3">@include('auth.employee._edit')</div>
                    <div class="col-3">@include('auth.employee._destroy')</div>
                    <div class="col-3">@include('auth.employee._failure')</div>
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
