<!DOCTYPE html>
<html>
<head>
    <title>tjsl-core.borneos.co</title>
</head>
<body>
    @if($sender == false)
    <p>Halo MitraKami,</p>
    <p>Anda memiliki pesan dengan detail berikut :</p>
    <p>
        Nama&nbsp;&nbsp;: {{ $name }}<br>
        Email&nbsp;&nbsp;: {{ $resEmail }}<br>
        Pesan&nbsp;: {{ $resMessage }}<br>
    </p>
    <p>Terimakasih atas perhatiannya.</p>
    @else
    <p>Halo {{ $name }},</p>
    <p>Terimakasih telah menghubungi kami, ini adalah pesan otomatis, mohon bersabar, tim kami akan segera merespon pesan anda.</p>
    <p>Terimakasih atas perhatiannya.</p>
    @endif
</body>
</html>