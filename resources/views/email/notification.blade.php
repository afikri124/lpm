@extends('email.template')
@section('title', $data['subject'])
@section('content')
<table align="left" border="0" cellpadding="0" cellspacing="0" style="text-align: left;" width="100%">
    <tbody>
        <tr>
            <td style="font-size: 10pt;">
                <p><i>Assalamu'alaikum Warahmatullaahi Wabarakaatuh.</i></p><br>
                <p>Yang Terhormat Bapak/Ibu <b>{{ $data['name'] }}</b>,</p><br>
                <p style="text-align: justify;">{!! $data['messages'] !!}</p>
            </td>
        </tr>
    </tbody>
</table>
@if(isset($data['auditee']))
<table class="order-detail" border="0" cellpadding="0" cellspacing="0" align="left"
    style="width: 100%; font-size:10pt;">
    <tbody>
        <tr class="pad-left-right-space">
            <td align="left">
                <p>Program Studi</p>
            </td>
            <td align="right"><b>{{ $data['study_program'] }}</b></td>
        </tr>
        <tr class="pad-left-right-space">
            <td class="m-t-5" align="left">
                <p>Auditee</p>
            </td>
            <td class="m-t-5" align="right"><b>{{ $data['auditee'] }}</b></td>
        </tr>
        <tr class="pad-left-right-space">
            <td class="m-t-5" align="left">
                <p>No HP</p>
            </td>
            <td class="m-t-5" align="right"><b>{{ $data['auditee_hp'] }}</b></td>
        </tr>
        <tr class="pad-left-right-space">
            <td class="m-t-5" align="left">
                <p>Email</p>
            </td>
            <td class="m-t-5" align="right"><b>{{ $data['auditee_email'] }}</b></td>
        </tr>
        <tr class="pad-left-right-space">
            <td align="left">
                <p>Mulai</p>
            </td>
            <td align="right"><b>{{ $data['start'] }}</b></td>
        </tr>
        <tr class="pad-left-right-space">
            <td align="left">
                <p>Selesai</p>
            </td>
            <td align="right"><b>{{ $data['end'] }}</b></td>
        </tr>
    </tbody>
</table>
@endif
<table align="left" border="0" cellpadding="0" cellspacing="0" style="text-align: left; margin-bottom:50px;"
    width="100%">
    <tbody>
        <tr>
            <td style="font-size: 10pt;">
                <p style="text-align: justify;">Informasi lebih lengkap silahkan login ke dalam <a
                        href="{{url('/dashboard')}}">sistem.</a><br>
                    <br>Jika terdapat kendala atau ingin melakukan perubahan jadwal harap menghubungi Tim LPM JGU.</p>
                <br>
                <p>Terima Kasih,</p>
                <p><i>Wassalamu'alaikum Warahmatullaahi Wabarakaatuh.</i></p>
                <br>
                <strong>Tim LPM</strong>
            </td>
        </tr>
    </tbody>
</table>
@endsection
