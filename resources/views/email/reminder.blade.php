@extends('email.template')
@section('title', $data['subject'])
@section('content')
<table align="left" border="0" cellpadding="0" cellspacing="0" style="text-align: left;" width="100%">
    <tbody>
        <tr>
            <td style="font-size: 10pt;">
                <p style="color: red;"><i><b>Email Pengingat!</b></i></p><br>
                <p><i>Assalamu'alaikum Warahmatullaahi Wabarakaatuh.</i></p><br>
                <p>Yang Terhormat Bapak/Ibu <b>{{ $data['name'] }}</b>,</p><br>
                <p style="text-align: justify;">Mengingatkan bahwa anda memiliki jadwal <u>{!! $data['messages'] !!}</u>, informasi lebih lanjut silahkan masuk ke dalam sistem <a href="{{url('/dashboard')}}">Peer-Observasion.</a></p>
            </td>
        </tr>
    </tbody>
</table>
<table class="order-detail" border="0" cellpadding="0" cellspacing="0" align="left"
    style="width: 100%; font-size:10pt;">
    <tbody>
        <tr class="pad-left-right-space">
            <td align="left">
                <p>Halaman Login</p>
            </td>
            <td align="right"><a href="{{url('/login')}}">lpm.jgu.ac.id/login</a></td>
        </tr>
        <tr class="pad-left-right-space">
            <td align="left">
                <p>Username</p>
            </td>
            <td align="right">{{ $data['username'] }}</td>
        </tr>
        <tr class="pad-left-right-space">
            <td align="left">
                <p>Email</p>
            </td>
            <td align="right">{{ $data['email'] }}</td>
        </tr>
    </tbody>
</table>
<table align="left" border="0" cellpadding="0" cellspacing="0" style="text-align: left; margin-bottom:50px;"
    width="100%">
    <tbody>
        <tr>
            <td style="font-size: 10pt;">
                <p style="text-align: justify;">Anda dapat masuk menggunakan <i>Single Sign-On</i> (SSO JGU) dengan memasukkan <i>username</i> dan <i>password</i> yang sama dengan yang digunakan dalam sistem Klas2 atau masuk menggunakan email Akun Google yang terdaftar. Jika terdapat kendala atau ingin melakukan <b>perubahan jadwal</b> harap menghubungi tim LPM JGU.</p>
                <br>
                <p style="text-align: justify;"><b>Catatan:</b> Email ini akan Anda terima setiap hari sampai statusnya berubah.</p><br>
                <p>Terima Kasih,</p>
                <p><i>Wassalamu'alaikum Warahmatullaahi Wabarakaatuh.</i></p>
                <br>
                <strong>Tim LPM</strong>
            </td>
        </tr>
    </tbody>
</table>
@endsection
