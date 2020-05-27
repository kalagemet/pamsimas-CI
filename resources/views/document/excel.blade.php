<!DOCTYPE html>
<table>
    <thead>
        <tr>
            <th>Laporan Keuangan Pamsimas</th>
        </tr>
        <tr>
            <th>Cabang {{ucfirst(strtolower($user['nama_cabang']))}} Desa {{$user->lokasi}}, {{$user->kec}}, <th>{{$user->kab}}</th>
        </tr>
        <tr>
            <th>Tgl Cetak : {{$tgl}}</th>
        </tr>
        <tr>
            <th>No.</th>
            <th>Tanggal Transaksi</th>
            <th>Debet</th>
            <th>Kredit</th>
            <th>Saldo</th>
            <th>Keterangan</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @php $semua = 1 @endphp
        @foreach ($data as $item)
            <tr>
                <td>{{$semua++}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->debet}}</td>
                <td>{{$item->kredit}}</td>
                <td>{{$item->saldo}}</td>
                <td>{{$item->keterangan}}</td>
                <td>
                @if($item->akses==1) Transaksi non Pelanggan
                @else Transaksi Pelanggan @endif
                </td>
            </tr>
        @endforeach
        <tr>
            <td>Total Pengeluaran</td>
        </tr>
        <tr>
            <td>Total Pemasukan</td>
        </tr>
        <tr>
            <td>Total Saldo</td>
        </tr>
    </tbody>
</table>