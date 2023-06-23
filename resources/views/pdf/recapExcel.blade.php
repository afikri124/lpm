<html>

<head>
    <title>PO Recap | {{ Date::now()->format('j F Y') }}</title>
</head>

<body>
    <table style="font-size: 11pt;">
        <thead>
            <tr>
                <td></td>
                <td style="text-align: right;vertical-align: top;">
                    <img src="{{ public_path('assets/images/logo_small.png') }}" style="height: 20px;" alt="Logo">
                </td>
                <td colspan="6" style="text-align: center;font-weight: bold;vertical-align: middle;">REKAP HASIL PEER OBSERVATION</td>
            </tr>
            <tr>
                <td colspan="8"></td>
            </tr>
            <tr>
                <th style="text-align: center;font-weight: bold;width:50px">No</th>
                <th style="text-align: center;font-weight: bold;width:200px">Dosen</th>
                <th style="text-align: center;font-weight: bold;" colspan="2">Jadwal</th>
                <th style="text-align: center;font-weight: bold;">Skor (%)</th>
                <th style="text-align: center;font-weight: bold;">Status</th>
                <th style="text-align: center;font-weight: bold;width:200px">Auditor 1</th>
                <th style="text-align: center;font-weight: bold;width:200px">Auditor 2</th>
            </tr>
        </thead>
        <tbody>
            @php $nokey = 0; @endphp
            @foreach($data as $key => $d)
            <tr>
                <td style="vertical-align: top;text-align:center">{{ ++$nokey }}</td>
                <td style="vertical-align: top;">{{ $d->lecturer->name_with_title }}</td>
                <td style="vertical-align: top;width:110px">
                    {{ Date::createFromDate($d->date_start)->format('d/m/Y H:i') }}
                </td>
                <td style="vertical-align: top;width:110px">
                    {{ Date::createFromDate($d->date_end)->format('d/m/Y H:i') }}
                </td>
                <td style="vertical-align: top;text-align:center">
                    @php
                    $x = 0;
                    $x = (float) $d->final;
                    @endphp
                    @if($x == 0)
                    <b>0</b>
                    @elseif($x < $MINSCORE->content)
                        <b style="color:red">{{ number_format($x,1) }}</b>
                        @else
                        <b>{{ number_format($x,1) }}</b>
                        @endif
                </td>
                <td style="vertical-align: top;">{{ $d->status->title }}</td>
                @foreach($d->observations as $o)
                <td>{{ $o->auditor->name_with_title }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8"></td>
            </tr>
            <tr>
                <td colspan="3">
                </td>
                <td colspan="5" style="text-align: center;">
                    Depok, {{ Date::now()->format('j F Y') }}
                </td>
            </tr>
            <tr>
                <td colspan="3">
                </td>
                <td colspan="5" style="text-align: center;">
                    Mengetahui, Kepala LPM
                </td>
            </tr>
            <tr>
                <td colspan="8"></td>
            </tr>
            <tr>
                <td colspan="8"></td>
            </tr>
            <tr>
                <td colspan="8"></td>
            </tr>
            <tr>
                <td colspan="3">
                </td>
                <td colspan="5" style="text-align: center;font-weight: bold;">
                    ( {{ $hod->title }} )
                </td>
            </tr>
            <tr>
                <td colspan="3">
                </td>
                <td colspan="5" style="text-align: center;">
                    <small>NIK. {{ $hod->content }} </small>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
