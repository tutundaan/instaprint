@if($employee->user)
    <strong>{{ $employee->user->name }}</strong>
    @else
    <span>-</span>
@endif
