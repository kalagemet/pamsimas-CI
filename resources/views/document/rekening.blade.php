			 <h1 style="background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase;">Rekening Air Pamsimas</h1>
			<div style="float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0;">
				<p style="margin: 0 0 0.25em;">Pamsimas {{ucfirst(strtolower($user->nama_cabang))}}</p>
                <p style="margin: 0 0 0.25em;">{{ucfirst(strtolower($user->alamat))}}</p>
                <p style="margin: 0 0 0.25em;">Desa {{$user->lokasi}}, {{$user->kec}} - {{$user->kab}}</p>
                <p style="margin: 0 0 0.25em;"><b> Nama Pelanggan : {{ucfirst(strtolower($nama->nama))}} - {{$nama->id}}</b></p>
                <p style="margin: 0 0 0.25em;"> Tanggal / Cetak : {{$tgl}} / {{$asli}}</p>
            </div>
			<table style="padding-top: 3cm">
				<thead>
					<tr>
						<th><span>ID Tagihan</span></th>
						<th><span>Jumlah Meter</span></th>
						<th><span>Tarif</span></th>
						<th><span>Denda</span></th>
						<th><span>Total</span></th>
					</tr>
				</thead>
				<tbody>
                    @php $semua = 0; @endphp
                    @foreach ($data as $item)
                        <tr>
                            <td><a> #</a><span >( {{$item->id}} ) || @php
                                    switch($item->bulan){
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
                                    @endphp</span></td>
                            <td><span >{{$item->jml_meter}} m || Rp. {{$item->total}},-</span></td>
                            <td><span >Rp. {{$item->tarif}},-/m || denda:Rp. {{$item->tarif_denda}},-/bulan</span></td>
                            <td><span >( {{$item->terlambat}} bulan ) Rp. {{$item->totaldenda}},-</span></td>
                            <td><span >Rp. {{$item->subtotal}},-</span></td>
                        </tr>
                        @php $semua = $semua+$item->subtotal @endphp
                    @endforeach
				</tbody>
			</table>
			<table>
				<tr>
					<th><span>Total</span></th>
                    <td><span data-prefix>Rp. </span>{{$semua}}<span>,-</span></td>
				</tr>
			</table>
			<div align="center">
				<p><i>Dokumen ini sebagai alat bukti pembayaran yang sah</i></p>
			</div>
<style>

    table { font-size: 75%; table-layout: fixed; width: 100%; }
    table { border-collapse: separate; border-spacing: 2px; }
    th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
    th, td { border-radius: 0.25em; border-style: solid; }
    th { background: #EEE; border-color: #BBB; }
    td { border-color: #DDD; }

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