<h1 style="background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase;">
    Laporan Keuangan Pamsimas {{ucfirst(strtolower($user->nama_cabang))}}</h1>
<div style="float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0;">
    <p style="margin: 0 0 0.25em;">{{ucfirst(strtolower($user->alamat))}}</p>
    <p style="margin: 0 0 0.25em;">Desa {{$user->lokasi}}, {{$user->kec}} - {{$user->kab}}</p>
    <p style="margin: 0 0 0.25em;"> Tanggal Cetak : {{$tgl}}</p>
</div>
<table style="padding-top: 1.7cm" class="table1">
    <thead>
        <tr>
            <th><span>Nomor</span></th>
            <th><span>Tanggal Transaksi</span></th>
            <th><span>Debet</span></th>
            <th><span>Kredit</span></th>
            <th><span>Saldo</span></th>
            <th><span>Keterangan</span></th>
            <th><span>Detail</span></th>
        </tr>
    </thead>
    <tbody>
        @php $semua = 1; $tot=0 @endphp
        @foreach ($data as $item)
            <tr>
                <td><a> #</a><span >( {{$semua}} )</span></td>
                <td><span >{{$item->created_at}}</span></td>
                <td><span >Rp. {{$item->debet}},-</span></td>
                <td><span >Rp. {{$item->kredit}},-</span></td>
                <td><span >Rp. {{$item->saldo}},-</span></td>
                <td><span >{{$item->keterangan}},-</span></td>
                <td><span >
                @if($item->akses==1) Transaksi non Pelanggan
                @else Transaksi Pelanggan @endif
                </span></td>
            </tr>
            @php $semua++; $tot=$item->saldo; @endphp
        @endforeach
    </tbody>
</table><br/>
<table>
    <tr>
        <th><span>Saldo</span></th>
        <td><span data-prefix><b>Rp. </span>{{$tot}}<span>,-</b></span></td>
    </tr>
</table>
<style>

table { font-size: 75%; table-layout: fixed; width: 100%; }
table { border-collapse: separate; border-spacing: 0px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0em; border-style: solid; }
th { background: #EEE; border-color: #BBB; }
td { border-color: #DDD; }
tr:hover {
        background-color: #f5f5f5;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
@page{ 
background: white;
display: block;
margin: 0 auto;
margin-bottom: 0.5cm;
box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
width: 21cm;
height: 29.7cm; 
}
body { margin: 20px;
padding-top: 0.5cm;  }

</style>