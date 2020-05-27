
    <h1 align="center">Daftar Tagihan</h1>
    <h3 align="center">Pamsimas {{$user->nama_cabang}} ({{$user->id}}) - {{$user->lokasi}}</h3>
    <h5 align="center"><i>di cetak pada : {{$tgl}}</i></h5>
        <table class="table1" >
        <thead>
            <tr>
            <th style="width: 25px">No</th>
            <th style="width: 50px">ID Pelanggan</th>
            <th style="width: 80px">Nama Pelanggan</th>
            <th style="width: 80px">Alamat</th>
            <th style="width: 80px">Tagihan</th>
            <th style="width: 70px">Tarif</th>
            <th style="width: 70px">Tarif Denda</th>
            <th style="width: 30px">Keterlambatan</th>
            <th style="width: 80px">Denda</th>
            <th style="width: 30px">Jumlah meter</th>
            <th style="width: 100px">Total</th>
            </tr>
        </thead>
        <tbody>
            @php $n=0; @endphp
            @foreach ($data as $i)
                <tr>
                    <td>{{$n+1}}</td>
                    <td>{{$i->id}}</td>
                    <td>{{ucfirst(strtolower($i->nama))}}</td>
                    <td>{{$i->alamat}}</td>
                    <td>@php
                        switch($i->bulan){
                            case 1:
                                echo "Januari";
                                break;
                            case 2:
                            echo "Februari";
                                break;
                            case 3:
                            echo "Maret";
                                break;
                            case 4:
                            echo "April";
                                break;
                            case 5:
                            echo "Mei";
                                break;
                            case 6:
                            echo "Juni";
                                break;
                            case 7:
                            echo "Juli";
                                break;
                            case 8:
                            echo "Agustus";
                                break;
                            case 9:
                            echo "September";
                                break;
                            case 10:
                                return "Oktober";
                                break;
                            case 11:
                                return "November";
                                break;
                            case 12:
                                return "Desember";
                                break;
                            default:
                                return "-";
                                break;
                        }  
                        @endphp</td>
                    <td>Rp. {{$i->tarif}},-</td>
                    <td>Rp. {{$i->tarif_denda}},-</td>
                    <td>{{$i->terlambat}} bulan</td>
                    <td>Rp. {{$i->denda}},-</td>
                    <td>{{$i->jml_meter}} m</td>
                    <td>Rp. {{$i->total}},-</td>
                </tr>
                @php $n++ @endphp
            @endforeach
        </tbody>
        </table>
<style type="text/css" >
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
    .table1 {
        padding: 0.5cm;
        font-family: sans-serif;
        font-size: 9pt;
        margin: 0.5cm;
        color: #444;
        border-collapse: collapse;
        width: 50%;
        border: 1px solid #f2f5f7;
        align: center;
    }
    h1 {
        font-size: 12pt;
        margin-top: 10px;
        line-height: 2em;
    }h3 {
        font-size: 11pt;
        line-height: 0.5em;
    }h5 {
        font-size: 10pt;
        line-height: 0.2em;
    }
    
    .table1 tr th{
        background: black;
        color: white;
        padding: 0px 0px;
        margin: 0cm;
        font-weight: 1px;
    }

    tr.spaceUnder>td {
        padding-bottom: 5em;
    }
    
    .table1, th td {
        padding: 0px 0px;
        padding-bottom: 5em;
        margin: 0cm;
        text-align: center;
    }
    
    .table1 tr:hover {
        background-color: #f5f5f5;
    }
    
    .table1 tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>