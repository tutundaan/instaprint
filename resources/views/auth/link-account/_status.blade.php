@if($employee->user)
    <p><strong>{{ $employee->user->name }}</strong></p>
    @else
        <p>-</p>
@endif
