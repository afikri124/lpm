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

    </style>
</head>

<body>
    <table width="100%">
        <tr>
            <td width="50%" valign="top">
                <small>FM/JGU/L.122</small><br>
                <img src="data:image/png;base64, {!! $qr !!}" style="height: 85px;">
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
    <table width="100%" style="font-size: 10pt">
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
            <td width="70%" valign="top">: {{ $data->observations[0]->location }}</td>
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
            <td width="70%" valign="top">: {{ $o->auditor->name_with_title }}
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
    <table width="100%" style="font-size: 10pt">
        <tr>
            <td width="50%"></td>
            <td width="50%" style="text-align: center;">Depok,
                {{ Date::createFromDate($data->observations[0]->updated_at)->format('j F Y') }}</td>
        </tr>
        <tr>
            @if(count($data->observations) <= 2)
            @foreach($data->observations as $key => $o)
            <td width="50%" style="text-align: center;">
                Auditor {{ $key+1 }}<br><br><br><br>
                <b>( {{ $o->auditor->name_with_title }} )</b><br>
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
    @php $total_persentase = 0; @endphp
    @foreach($survey as $key => $s)
    <div class="page-break"></div>
    <table width="100%">
        <tr>
            <td width="50%" valign="top">
                <small>FM/JGU/L.079</small><br>
                <img src="data:image/png;base64, {!! $qr !!}" style="height: 85px;">
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
    <table width="100%" style="font-size: 10pt">
        <tr>
            <th>Nama Dosen</th>
            <td>{{ $data->lecturer->getNameWithTitleAttribute() }}</td>
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
            <td>{{ $s->auditor->getNameWithTitleAttribute() }}</td>
            <th>Jumlah Mahasiswa</th>
            <td>{{ $s->total_students }}</td>
        </tr>
    </table>
    <br>
    <table class="table table-sm" width="100%" style="font-size: 10pt">
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
                <th colspan="4">{{ $q->criteria_category->title }}
                    <u>{{ $q->criteria_category->description }}</u></th>
            </tr>
            @php
            $point = 0;
            @endphp
            @foreach($q->observation_criterias as $no => $c)
            <tr valign="top">
                <td>{{ $q->criteria_category_id }}.{{ $no + 1 }}</td>
                <td>{{ $c->criteria->title }}</td>
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
    <table width="100%" style="font-size: 10pt">
        <thead valign="top">
            <tr>
                <th>Penilaian Keseluruhan</th>
                <th class="text-right">{{ $total }} poin</th>
            </tr>
            <tr>
                <th>Persentase</th>
                <th class="text-right @if(($total/($total_w*5)*100) < $MINSCORE->content) text-danger @endif">
                    {{ number_format($total/($total_w*5)*100, 1); }}%
                    @php $total_persentase += number_format($total/($total_w*5)*100, 1); @endphp
                </th>
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
                    <b>( {{ $s->auditor->getNameWithTitleAttribute() }} )</b><br>
                    <small>NIK. {{ $s->auditor->username }}</small>
                </td>
            </tr>
        </thead>
    </table>
    @endforeach
    <div class="page-break"></div>
    <br>
    <center>
        <h5><u>LAMPIRAN</u></h5>
    </center>
    <br>
    <p style="font-size: 10pt">Dokumentasi: </p>
    @foreach($survey as $key => $s)
    <center>
        <img src="{{ public_path($s->image_path) }}" style="width: 400px;max-height:300px;"><br>
        <small style="font-size: 8pt">Dokumentasi Auditor {{$key+1}}</small>
    </center><br>
    @endforeach
    <p style="font-size: 10pt">Persentase Keseluruhan:
        <br><i style="font-size: 10pt" class="@if(($total_persentase/count($survey)) < $MINSCORE->content) text-danger @endif"><b>{{ ($total_persentase/count($survey)) }}</b>%</i>
    </p>
    @if($data->remark != null || $data->remark != "")
    <p style="font-size: 10pt">Catatan dari LPM:
        <br><i class="text-danger" style="font-size: 10pt">{{ $data->remark }}</i>
    </p>
    @endif

    @if($follow_up != null)
    <div class="page-break"></div>
    <table width="100%">
        <tr>
            <td width="50%" valign="top">
                <img src="data:image/png;base64, {!! $qr !!}" style="height: 85px;"></td>
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
    <p style="font-size: 10pt">Dokumentasi: </p>
    <center>
        <img src="{{ public_path($follow_up->image_path) }}" style="width: 400px;max-height:300px;" alt=""><br>
        <small style="font-size: 8pt">Dokumentasi Dekan</small>
    </center><br>
    <br>
    <p style="font-size: 10pt">Catatan dari Dekan: <br>
        <i class="text-danger" style="font-size: 10pt">{{ $follow_up->remark }}</i>
    </p>
    @else
    <center>
        <i class="text-danger" style="font-size: 10pt">Dekan Belum Melakukan Pemanggilan Tindak Lanjut</i>
    </center><br>
    @endif
    <br><br><br>
    <table width="100%" style="font-size: 10pt">
        <thead valign="top">
            <tr>
                <td width="50%" style="text-align: center;">
                    Mengetahui,<br>Kepala LPM<br><br><br><br>
                    <b>( {{ $hod->title }} )</b><br>
                    <small>NIK. {{ $hod->content }} </small>
                </td>
                <td width="50%" style="text-align: center;">
                    Depok, {{ Date::createFromDate($follow_up->updated_at)->format('j F Y') }}
                    <br>Dekan<br><br><br><br>
                    <b>( {{ $follow_up->dean->getNameWithTitleAttribute() }} )</b><br>
                    <small>NIK. {{ $follow_up->dean->username }}</small>
                </td>
            </tr>
        </thead>
    </table>
    @endif
</body>

</html>
