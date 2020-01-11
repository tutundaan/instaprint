@if(!$failure->employee_id)
<div class="row my-4">
    <div class="col-12">
        <p>Nama Karyawan yang sesuai dengan Nama Customer SPK diatas. Jika menautkan SPK dengan nama Customer <strong>{{ $failure->holder }}</strong> dengan Karyawan. SPK baru dan SPK lama dengan Nama tersebut juga akan ditautkan dengan Karyawan yang dipilih.</p>
    </div>

    <div class="col-12">
        <table class="table table-hover">
            <tbody>
                @foreach($failure->relatedEmployee() as $i => $employee)
                <form action="{{ route('auth.failure.link', $failure) }}" method="POST">
                @csrf
                <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                <tr>
                    <td>{{ ++$i }}</td>
                    <td><strong>{{ $employee->name }}</strong></td>
                    <td><button class="btn btn-success btn-xs">Tautkan Karyawan</button></td>
                </tr>
                </form>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-12">
        @include('auth.failure._employees')
    </div>
</div>
@endif
