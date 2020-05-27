function indonesian_date ($timestamp = '', $date_format = 'd F Y', $suffix = '') { 
  if($timestamp == null){
      return '-';
    }
    if($timestamp == '1970-01-01' || $timestamp == '0000-00-00' || $timestamp == '-25200'){
      return '-';
    }
    if ($.trim($timestamp) == '')
    {
            $timestamp = time ();
    }
    else if (isNaN($timestamp))
    {
        $timestamp = Date.parse($timestamp);
    }
    $hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    $bulan = [ 'Januari','Februari','Maret','April','Juni','Juli','Agustus','September',
        'Oktober','November','Desember',
    ];
    $date = new Date ($timestamp);
    $date = $hari[$date.getDay()]+", "+$date.getDate()+" "+$bulan[$date.getMonth()]+" "+$date.getFullYear()+" "+$date.getHours()+":"+$date.getMinutes()+":"+$date.getSeconds();
    return $date;
}