<html>

<head>
    <title>PO Report | {{ $data->lecturer->name_with_title }} - {{date('d/m/Y', strtotime($data->date_start)) }}
    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        html {
            margin: 1cm 2cm
        }

        .page-break {
            page-break-after: always;
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
                <code style="color: black;font-size:9pt">FM/JGU/L.122</code><br>
                <!-- <img src="data:image/png;base64, {!! $qr !!}" style="height: 85px;"> -->
                <a href="{{$link}}"><img src="{!! $qr !!}" style="height: 85px;"></a>
            </td>
            <td width="50%" style="text-align: right;">
                <img src="{{ public_path('assets/images/logo.png') }}" style="height: 60px;" alt="">
            </td>
        </tr>
    </table>
    <br>
    <center>
        <h5><u>BERITA ACARA <i>PEER OBSERVATION</i></u></h5>
    </center>
    <table width="100%">
        <tr>
            <td colspan="2">
                <p style="text-align: justify; margin-top:20px">Dalam rangka Pelaksanaan Penjaminan Mutu di lingkungan
                    Universitas
                    Global Jakarta, maka pada hari ini:</p>
            </td>
        </tr>
        <tr>
            <td width="30%" valign="top">Hari/tanggal</td>
            <td width="70%" valign="top">:
                {{ Date::createFromDate($data->date_start)->format('l, j F Y') }}
                @if(date('d F Y', strtotime($data->date_start)) != date('d F Y', strtotime($data->date_end)))
                - {{ Date::createFromDate($data->date_end)->format('l, j F Y') }}
                @endif
            </td>
        </tr>
        <tr>
            <td width="30%" valign="top">Jam</td>
            <td width="70%" valign="top">:
                {{ Date::createFromDate($data->date_start)->format('H:i') }}
                @if(date('H:i', strtotime($data->date_start)) != date('H:i', strtotime($data->date_end)))
                - {{ Date::createFromDate($data->date_end)->format('H:i') }}
                @endif
                WIB
            </td>
        </tr>
        <tr>
            <td width="30%" valign="top">Tempat</td>
            <td width="70%" valign="top">: 
                @if(count($survey) != 0)
                {{ $data->observations[0]->location }}
                @else
                -
                @endif
                
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p style="text-align: justify;padding-top:15px">Telah diselenggarakan kegiatan <i>Peer Observation</i>
                    di lingkungan Program Studi
                    <b>{{ ($data->study_program==null ? $data->lecturer->study_program : $data->study_program) }}</b>,
                    sebagaimana
                    tercantum dalam daftar hadir terlampir. Unsur kegiatan pada hari ini antara lain:</p>
            </td>
        </tr>
        @foreach($data->observations as $key => $o)
        <tr>
            <td width="30%" valign="top">Auditor {{ $key+1 }}</td>
            <td width="70%" valign="top">: 
                @if($o->attendance)
                {{ $o->auditor->name_with_title }}
                @else
                <del>{{ $o->auditor->name_with_title }}</del>
                @endif
            </td>
        </tr>
        @endforeach
        <tr>
            <td width="30%" valign="top">Auditee</td>
            <td width="70%" valign="top">: {{ $data->lecturer->name_with_title }} </td>
        </tr>
        <tr>
            <td colspan="2">
                <p style="text-align: justify;padding-top:15px">Demikian berita acara ini dibuat dan disahkan dengan
                    sebenar-benarnya dan tanggung jawab agar dapat dipergunakan sebagaimana mestinya.</p>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <td width="50%"></td>
            <td width="50%" style="text-align: center;">Depok,
                @if(count($survey) != 0)
                {{ Date::createFromDate($data->observations[0]->updated_at)->format('j F Y') }}
                @else
                {{ Date::now()->format('j F Y') }}
                @endif
            </td>
        </tr>
        <tr>
            @if(count($data->observations) <= 2)
            @foreach($data->observations as $key => $o)
            <td width="50%" style="text-align: center;">
                Auditor {{ $key+1 }}<br><br><br><br>
                @if($o->attendance)
                <b>( {{ $o->auditor->name_with_title }} )</b><br>
                @else
                <del><b>( {{ $o->auditor->name_with_title }} )</b></del><br>
                @endif
                <small>NIK. {{ $o->auditor->username }}</small>
            </td>
            @endforeach
            @endif
        </tr>
        <tr>
            <td colspan="2"><br></td>
        </tr>
        <tr>
            <td width="50%" style="text-align: center;">
                Mengetahui,<br>Kepala LPM<br><br><br><br>
                <b>( {{ $hod->title }} )</b><br>
                <small>NIK. {{ $hod->content }} </small>
            </td>
            <td width="50%" style="text-align: center;">
                <br>Auditee<br><br><br><br>
                <b>( {{ $data->lecturer->name_with_title }} )</b><br>
                <small>NIK. {{ $data->lecturer->username }}</small>
            </td>
        </tr>
    </table>
    @php $total_persentase = 0; $jumlah_auditor = 0; @endphp
    @if(count($survey) != 0)
    @foreach($survey as $key => $s)
    @if(count($s->observation_categories) != 0)
    <div class="page-break"></div>
    <table width="100%">
        <tr>
            <td width="50%" valign="top">
                <code style="color: black;font-size:9pt">FM/JGU/L.079</code><br>
                <!-- <img src="data:image/png;base64, {!! $qr !!}" style="height: 85px;"> -->
                <img src="{!! $qr !!}" style="height: 85px;">
            </td>
            <td width="50%" style="text-align: right;">
                <img src="{{ public_path('assets/images/logo.png') }}" style="height: 60px;" alt="">
            </td>
        </tr>
    </table>
    <br>
    <center>
        <h6><u>HASIL <i>PEER OBSERVATION</i></u></h6>
        <h6>( Auditor {{ $key+1 }} )</h6>
    </center>
    <br>
    <table width="100%">
        <tr>
            <th>Nama Dosen</th>
            <td>{{ $data->lecturer->name_with_title }}</td>
            <th>Hari/Tanggal</th>
            <td>{{ Date::createFromDate($s->updated_at)->format('l, j F Y') }}</td>
        </tr>
        <tr>
            <th>Mata Kuliah</th>
            <td>{{ $s->subject_course }}</td>
            <th>Topik</th>
            <td>{{ $s->topic }}</td>
        </tr>
        <tr>
            <th>Tipe Perkuliahan</th>
            <td>{{ $s->class_type }}</td>
            <th>Lokasi</th>
            <td>{{ $s->location }}</td>
        </tr>
        <tr>
            <th>Auditor</th>
            <td>{{ $s->auditor->name_with_title }}</td>
            <th>Jumlah Mahasiswa</th>
            <td>{{ $s->total_students }}</td>
        </tr>
    </table>
    <br>
    <table class="table table-sm" width="100%" >
        <thead>
            <tr>
                <th>Kode</th>
                <th>Kriteria Penilaian</th>
                <th class="text-center">Skor</th>
                <th class="text-center">Bobot</th>
                <th class="text-center">Poin</th>
            </tr>
        </thead>
        <tbody>
            @php
            $total = 0;
            $total_w = 0;
            @endphp
            @foreach($s->observation_categories as $key => $q)
            <tr valign="top">
                <th><strong>{{ $q->criteria_category_id }}</strong></th>
                <th colspan="4">{{ ($q->criteria_category == null ? "" : $q->criteria_category->title) }}
                    <u>{{ ($q->criteria_category == null ? "" : $q->criteria_category->description) }}</u></th>
            </tr>
            @php
            $point = 0;
            @endphp
            @foreach($q->observation_criterias as $no => $c)
            <tr valign="top">
                <td>{{ $q->criteria_category_id }}.{{ $no + 1 }}</td>
                <td>{{ ($c->criteria == null ? "" : $c->criteria->title) }}</td>
                <td class="text-center">{{ $c->score }}</td>
                <td class="text-center">{{ $c->weight }}</td>
                <td class="text-center">{{ $c->score*$c->weight }}</td>
            </tr>
            @php
            $point += ($c->score*$c->weight);
            $total_w += $c->weight;
            @endphp
            @endforeach
            @php
            $total += $point;
            @endphp
            @if(count($q->observation_criterias) > 0)
            <tr valign="top">
                <td colspan="2">Total penilaian {{ $q->criteria_category_id }}</td>
                <td colspan="3" class="text-center">{{ $point }} poin</td>
            </tr>
            @endif
            <tr valign="top">
                <td></td>
                <td colspan="4" class="text-danger"><i>{{ $q->remark }}</i></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table width="100%">
        <thead valign="top">
            <tr>
                <th>Penilaian Keseluruhan</th>
                <th class="text-right">{{ $total }} poin</th>
            </tr>
            <tr>
                <th>Persentase</th>
                @if($total != 0)
                <th class="text-right @if(($total/($total_w*5)*100) < $MINSCORE->content) text-danger @endif">
                    {{ number_format($total/($total_w*5)*100, 1); }}%
                    @php $total_persentase += number_format($total/($total_w*5)*100, 1); @endphp
                </th>
                @else
                <th></th>
                @endif
            </tr>
            <tr>
                <th colspan="2">Catatan/Komentar</th>
            </tr>
            <tr style="border: 1px solid #999; text-align: justify;">
                <td colspan="2"><i class="text-danger p-1">{{ $s->remark }}</i></td>
            </tr>
            <tr>
                <td colspan="2"><br></td>
            </tr>
            <tr>
                <td width="50%" style="text-align: center;">
                    Mengetahui,<br>Kepala LPM<br><br><br><br>
                    <b>( {{ $hod->title }} )</b><br>
                    <small>NIK. {{ $hod->content }} </small>
                </td>
                <td width="50%" style="text-align: center;">
                    Depok, {{ Date::createFromDate($s->updated_at)->format('j F Y') }}
                    <br>Auditor<br><br><br><br>
                    <b>( {{ $s->auditor->name_with_title }} )</b><br>
                    <small>NIK. {{ $s->auditor->username }}</small>
                </td>
            </tr>
        </thead>
    </table>
    @endif
    @endforeach
    <div class="page-break"></div>
    <br>

    <center>
        <h5><u>LAMPIRAN</u></h5>
    </center>
    <br>
    @if($total_persentase != 0)
    <p>Dokumentasi: </p>
    @foreach($survey as $key => $s)
    <center>
        @if($s->image_path != null)
        @php $jumlah_auditor++; @endphp
        <img src="{{ public_path($s->image_path) }}" style="width: 400px;max-height:300px;"><br>
        <small style="font-size: 8pt">Dokumentasi Auditor {{$key+1}}</small>
        @endif
    </center><br>
    @endforeach
    <p >Persentase Keseluruhan:
        <br><i class="@if(($total_persentase/$jumlah_auditor) < $MINSCORE->content) text-danger @endif"><b>{{ ($total_persentase/$jumlah_auditor) }}</b>%</i>
    </p>
    @endif
    
    @endif
    @if($total_persentase == 0)
    <p>Catatan dari LPM:</p>
    <ul>
        @foreach($data->histories as $p)
            @if($p->remark != null)
            <li>
                {{ Date::createFromDate($p->created_at)->format('j M Y H:i') }}
                <br><i class="text-danger" style="font-size: 10pt">{{ $p->remark }}</i>
            </li>
            @endif
        @endforeach
    </ul>
    @else
        @if($data->remark != null || $data->remark != "")
        <p>Catatan dari LPM:
            <br><i class="text-danger" style="font-size: 10pt">{{ $data->remark }}</i>
        </p>
        @endif
    @endif

    @if($follow_up != null)
    <div class="page-break"></div>
    <table width="100%">
        <tr>
            <td width="50%" valign="top">
                <!-- <img src="data:image/png;base64, {!! $qr !!}" style="height: 85px;"> -->
                <img src="{!! $qr !!}" style="height: 85px;">
            <td width="50%" style="text-align: right;">
                <img src="{{ public_path('assets/images/logo.png') }}" style="height: 60px;" alt="">
            </td>
        </tr>
    </table>
    <br>
    <center>
        <h5><u>HASIL TINDAK LANJUT</u></h5>
    </center>
    <br>
    @if($follow_up->image_path != null)
    <p>Dokumentasi: </p>
    <center>
        <img src="{{ public_path($follow_up->image_path) }}" style="width: 400px;max-height:300px;" alt=""><br>
        <small style="font-size: 8pt">Dokumentasi Hasil Tindak Lanjut</small>
    </center><br>
    <br>
    <p>Catatan dari hasiil tindak lanjut: <br>
        <i class="text-danger" style="font-size: 10pt">{{ $follow_up->remark }}</i>
    </p>
    @else
    <center>
        <i class="text-danger" style="font-size: 10pt">Belum Dilakukan Pemanggilan Tindak Lanjut</i>
    </center><br>
    @endif
    <br><br><br>
    <table width="100%">
        <thead valign="top">
            <tr>
                <td width="50%" style="text-align: center;">
                    Mengetahui,<br>Kepala LPM<br><br><br><br>
                    <b>( {{ $hod->title }} )</b><br>
                    <small>NIK. {{ $hod->content }} </small>
                </td>
                <td width="50%" style="text-align: center;">
                    Depok, {{ Date::createFromDate($follow_up->updated_at)->format('j F Y') }}
                    <br>Yang Menindaklanjuti<br><br><br><br>
                    <b>( {{ $follow_up->dean->name_with_title }} )</b><br>
                    <small>NIK. {{ $follow_up->dean->username }}</small>
                </td>
            </tr>
        </thead>
    </table>
    @endif
    <script type="text/php">
        if (isset($pdf)) {
            $x = 480;
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
