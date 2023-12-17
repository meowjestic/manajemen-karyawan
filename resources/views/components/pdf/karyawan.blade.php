<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data['nama_lengkap']}}</title>
</head>
<body>
    <p>Nama Lengkap        : {{$data['nama_lengkap']}}</p>
    <p>Email               : {{$data['email']}}</p>
    <p>Tempat Lahir        : {{$data['tempat_lahir']}}</p>
    <p>Tanggal Lahir       : {{date_format(date_create($data['tanggal_lahir']), "d/m/Y")}}</p>
    <p>Tempat Tinggal      : {{$data['tempat_tinggal']}}</p>
    <p>Domisili            : {{$data['domisili']}}</p>
    <p>Pekerjaan           : {{$data['pekerjaan']}}</p>
    <p>Jabatan             : {{$data['jabatan']}}</p>
    <p>Divisi              : {{$data['divisi_id']}}</p>
    <p>Gaji                : Rp.{{number_format($data->gaji,2,',','.')}}</p>
    <p>Pendidikan Terakhir : {{$data['pendidikan_terakhir']}}</p>
    <p>Tanggal Bergabung   : {{$data['tanggal_bergabung']}}</p>

    <div style="display: flex;width: 100%; justify-content: center;">
        <img src="" alt="">
    </div>
</body>
</html>