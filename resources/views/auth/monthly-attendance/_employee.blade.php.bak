<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            <th>Keterangan</th>
        </tr>
    </thead>

    @php
        $i = 0;
    @endphp
    <tbody>
        @foreach($attendances as $attendance)
            <tr>
                <th>{{ ++$i }}</th>
                <th>{{ $attendance->first()->employee->formattedName() }}</th>
                @php
                    $in = null;
                    $out = null;
                @endphp
                @foreach($attendance as $attendance)
                    @php
                        $indicateOverNight = false;
                        if (is_null($in)) {
                            if ($attendance->earlyMorning()) {
                                $indicateOverNight = true;
                            } else if($attendance->overnightTime()) {
                                $indicateOverNight = true;
                                $in = $attendance->recordedTime();
                            } else  {
                                $in = $attendance->recordedTime();
                            }
                        } else  {
                            if ($attendance->recordedTime()->lessThan($in)) {
                                $in = $attendance->recordedTime();
                            }
                        }

                        if (is_null($out)) {
                            if ($attendance->noonTime()) {
                                $out = $attendance->recordedTime();
                            }
                        } else  {
                            if ($attendance->recordedTime()->greaterThan($out)) {
                                $out = $attendance->recordedTime();
                            }
                        }

                        if ($indicateOverNight) {
                            $tomorrow = $attendance->recordedAt()->addDay()->toDateString();
                            $nextDay = $attendance->with(['employee'])
                                ->where('recorded_at', $tomorrow)
                                ->where('employee_id', $attendance->employee->id)
                                ->orderBy('recorded_time')
                                ->first();

                            if ($nextDay) {
                                if ($nextDay->earlyMorning()) {
                                    $out = $nextDay->recordedTime();
                                }
                            }
                        }

                    @endphp
                @endforeach
                <td>{{ $in ? ($in == $out ? '-' : $in->format('H:i')) : '-' }}</td>
                <td>{{ is_null($out) ? '-' : $out->format('H:i') }}</td>
                <td>{{ $indicateOverNight ? ((is_null($in) and is_null($out)) ?  'Bebas setelah lembur' : 'Lembur') : null }}</td>
                @php
                    $in = null;
                    $out = null;
                    $indicateOverNight = false;
                @endphp
            </tr>
        @endforeach
    </tbody>
</table>
