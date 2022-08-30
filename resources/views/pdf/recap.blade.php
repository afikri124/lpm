<html>

<head>
    <title>PO Recap | {{ Date::now()->format('j F Y') }}
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        html {
            margin: 1cm 1cm
        }

        .page-break {
            page-break-after: always;
        }

    </style>
    <style>
        tbody td {
            vertical-align: middle;
        }

        td:nth-child(2) {
            max-width: 120px;
        }

        td:nth-child(3) {
            max-width: 175px;
        }

        td:nth-child(4) {
            max-width: 120px;
        }

        td:nth-child(6) {
            max-width: 50px;
        }

        td {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

    </style>
</head>

<body>
    <table width="100%">
        <tr>
            <td width="50%" valign="top">
                <!-- <small>FM/JGU/L.122</small><br> -->
                <img src="data:image/png;base64, {!! $qr !!}" style="height: 85px;">
            </td>
            <td width="50%" style="text-align: right;">
                <img src="{{ public_path('assets/images/logo.png') }}" style="height: 60px;" alt="">
            </td>
        </tr>
    </table>
    <br>
    <center>
        <h5><u>REKAP HASIL <i>PEER OBSERVATION</i></u></h5>
    </center>
    </br>
    <table class="table table-bordered table-sm" width="100%" style="font-size: 10pt;">
        <thead>
            <tr>
                <th scope="col" width="20px" class="text-center">No</th>
                <th scope="col">Dosen</th>
                <th scope="col">Jadwal</th>
                <th scope="col">Auditor</th>
                <th scope="col" class="text-center">Skor</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $key => $d)
            <tr>
                <td class="text-center">{{ $key+1 }}</td>
                <td>{{ $d->lecturer->name_with_title }}</td>
                <td>
                    {{ Date::createFromDate($d->date_start)->format('j/m/Y H:i') }}
                    @if(date('d F Y', strtotime($d->date_start)) == date('d F Y', strtotime($d->date_end)))
                    - {{ Date::createFromDate($d->date_end)->format('H:i') }}
                    @else
                    - {{ Date::createFromDate($d->date_end)->format('j/m/Y H:i') }}
                    @endif
                </td>
                <td>
                    @foreach($d->observations as $o)
                    {{ $o->auditor->name_with_title }}<br>
                    @endforeach
                </td>
                <td class="text-center">
                    @php
                    $x = 0;
                    $score = 0.0;
                    $weight = 0.0;
                    @endphp
                    @if(count($d->observations) != 0)
                    @foreach($d->observations as $o)
                    @foreach($o->observation_criterias as $q)
                    @php
                    $score += $q->score * $q->weight;
                    $weight += $q->weight;
                    @endphp
                    @endforeach
                    @endforeach
                    @php
                    if($weight != 0){
                    $x = ($score / ($weight * 5) * 100);
                    }
                    @endphp
                    @endif
                    @if($x == 0)
                    <b>-</b>
                    @elseif($x < $MINSCORE->content)
                        <b class="text-danger">{{ number_format($x,1) }}%</b>
                        @else
                        <b>{{ number_format($x,1) }}%</b>
                        @endif
                </td>
                <td class="text-{{ $d->status->color }}">{{ $d->status->title }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <table width="100%" style="font-size: 10pt;">
        <tr>
            <td width="50%" style="text-align: center;">
            </td>
            <td width="50%" style="text-align: center;">
                Depok, {{ Date::now()->format('j F Y') }}<br>
                Mengetahui,<br>Kepala LPM<br><br><br><br>
                <b>( {{ $hod->title }} )</b><br>
                <small>NIK. {{ $hod->content }} </small>
            </td>
        </tr>
    </table>
    <small style="font-size: 6pt;">
        @php
        if (!empty($request->get('range'))) {
            if($request->get('range') != "" && $request->get('range') != null && $request->get('range') != "Invalid date - Invalid date"){
                $x = explode(" - ",$request->get('range'));
                echo "- Tanggal (".date('d/m/Y 23:59',strtotime($x[1]))." - ".date('d/m/Y H:i',strtotime($x[0])).")<br>";
            }
        }
        if (!empty($request->get('study_program'))) {
            echo "- Program Studi (".$request->get('study_program').")<br>";
        }
        if (!empty($request->get('status_id'))) {
            echo "- Status<br>";
        }
        if (!empty($request->get('lecturer_id'))) {
            echo "- Dosen<br>";
        }
        @endphp
    </small>
</body>

</html>
