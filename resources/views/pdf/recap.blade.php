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
            padding: 1px;
        }

        td:nth-child(2) {
            width: 180px;
            word-wrap: break-word;
            word-break: break-word;
        }

        td:nth-child(3) {
           max-width: 95px;
        }

        td:nth-child(4) {
           max-width: 150px;
           white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        td:nth-child(6) {
            max-width: 50px;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
        }

        td {
            vertical-align: top;
            word-wrap: break-word;
            word-break: break-word;
        }

        body {
            font-size: 11pt;
            font-family: "Times New Roman", Times, serif;
        }

    </style>
</head>

<body>
    <table width="100%">
        <tr>
            <td width="50%" valign="top">
                <!-- <small>FM/JGU/L.122</small><br> -->
                <!-- <img src="data:image/png;base64, {!! $qr !!}" style="height: 85px;"> -->
                <img src="{{ $qr }}" style="height: 85px;">
            </td>
            <td width="50%" style="text-align: right;vertical-align: top;">
                <img src="{{ public_path('assets/images/logo.png') }}" style="height: 60px;" alt="">
            </td>
        </tr>
    </table>
    <br>
    <center>
        <h5><u>REKAP HASIL <i>PEER OBSERVATION</i></u></h5>
    </center>
    </br>
    <table class="table table-bordered table-sm mb-0" width="100%" style="font-size: 11pt;border:1px solid #000">
        <thead>
            <tr>
                <th scope="col" width="20px" class="text-center">No</th>
                <th scope="col" class="text-center">Dosen</th>
                <th scope="col" class="text-center">Jadwal</th>
                <th scope="col" class="text-center">Auditor</th>
                <th scope="col" class="text-center">Skor</th>
                <th scope="col" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @php $nokey = 0; @endphp
            @foreach($data->sortBy('lecturer.name') as $key => $d)
            <tr>
                <td class="text-center">{{ ++$nokey }}</td>
                <td>{{ $d->lecturer->name_with_title }}</td>
                <td>
                    {{ Date::createFromDate($d->date_start)->format('j/m/Y H:i') }}
                    @if(date('d F Y', strtotime($d->date_start)) == date('d F Y', strtotime($d->date_end)))
                    <br>s.d. {{ Date::createFromDate($d->date_end)->format('H:i') }}
                    @else
                    <br>s.d. {{ Date::createFromDate($d->date_end)->format('j/m/Y H:i') }}
                    @endif
                </td>
                <td>
                    @foreach($d->observations as $o)
                    @if($o->attendance)
                    {{ $o->auditor->name_with_title }}<br>
                    @else
                    <del>{{ $o->auditor->name_with_title }}</del><br>
                    @endif
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
                    $x = ($score / ($weight * $data->max_score) * 100);
                    }
                    @endphp
                    @endif
                    @if($x == 0)
                    <b class="text-danger">-</b>
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
    <table width="100%">
        <tr>
            <td width="200px" style="text-align: center;">
            </td>
            <td width="" style="text-align: center;">
                Depok, {{ Date::now()->format('j F Y') }}<br>
                Mengetahui,<br>Kepala LPM<br><br><br><br>
                <b>( {{ $hod->title }} )</b><br>
                <small>NIK. {{ $hod->content }} </small>
            </td>
        </tr>
    </table>

    <script type="text/php">
        if (isset($pdf)) {
            $x = 505;
            $y = 800;
            $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
            $font = null;
            $size = 8;
            $color = array(255,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>
</body>

</html>
