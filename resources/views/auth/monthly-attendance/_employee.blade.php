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
                            if ($time::parse($attendance->recorded_time)->lessThan($time::parse('03:00:00'))) {
                                $indicateOverNight = true;
                            } else if($time::parse($attendance->recorded_time)->greaterThan($time::parse('12:00:00')) and $time::parse($attendance->recorded_time)->lessThan($time::parse('16:00:00'))) {
                                $indicateOverNight = true;
                                $in = $time::parse($attendance->recorded_time);
                            } else  {
                                $in = $time::parse($attendance->recorded_time);
                            }
                        } else  {
                            if ($time::parse($attendance->recorded_time)->lessThan($in)) {
                                $in = $time::parse($attendance->recorded_time);
                            }
                        }

                        if (is_null($out)) {
                            if ($time::parse('16:00:00')->lessThan($time::parse($attendance->recorded_time))) {
                                $out = $time::parse($attendance->recorded_time);
                            }
                        } else  {
                            if ($time::parse($attendance->recorded_time)->greaterThan($out)) {
                                $out = $time::parse($attendance->recorded_time);
                            }
                        }

                        if ($indicateOverNight) {
                            $nextDay = $attendance->with(['employee'])
                                ->where('recorded_at', $time::parse($attendance->recorded_at)->addDay())
                                ->where('employee_id', $attendance->employee->id)
                                ->orderBy('recorded_time')
                                ->first();

                            if ($nextDay) {
                                if ($time::parse($nextDay->recorded_time)->lessThan($time::parse('03:00:00'))) {
                                    $out = $time::parse($nextDay->recorded_time);
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
