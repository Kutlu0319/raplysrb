Link Kullanımı	: http://SUNUCU ADRESİNİZ/HDFilmCehennemi.php?ID=https://www.hdfilmcehennemi.la/limonov-the-ballad/


<?php
$Live = $_GET['ID'];
$ch = curl_init($Live);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Accept: */*',
'Connection: keep-alive',
'Mofycore-Router-Prefetch: false',
'Referer: ' . $Live,
'User-Agent: iPlayTV',
'X-Requested-With: fetch',
));
$site = curl_exec($ch);
curl_close($ch);
$site = str_replace('\\','',$site);
preg_match('#a itemprop="item" href="(.*?)"#',$site,$icerik);
$Url = $icerik[1];
preg_match('#data-video="(.*?)"#',$site,$icerik);
$Data = $icerik[1];

$ch1 = curl_init($Url . 'video/' . urlencode($Data) . '/');
curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch1, CURLOPT_HTTPHEADER, array(
'Accept: */*',
'Connection: keep-alive',
'Content-Type: application/json',
'Referer: ' . $Live,
'User-Agent: iPlayTV',
'X-Requested-With: fetch',
));
$site1 = curl_exec($ch1);
curl_close($ch1);
$site1 = str_replace(['\\/','\\\\','/'],'"',$site1);
$site1 = str_replace('\\','',$site1);
preg_match('#"rplayer"(.*?)"#',$site1,$icerik);
$Embed = $icerik[1];
preg_match('#rapidrame_id=(.*?)"#',$site1,$icerik);
$Embed2 = $icerik[1];

$Ticket = '{
------WebKitFormBoundaryifAk1Acz7VYxiGUh
Content-Disposition: form-data; name="video_id"

'.$Embed.''.$Embed2.'
------WebKitFormBoundaryifAk1Acz7VYxiGUh
Content-Disposition: form-data; name="selected_quality"

high
------WebKitFormBoundaryifAk1Acz7VYxiGUh--
}';
$ch2 = curl_init('https://cehennempass.pw/process_quality_selection.php');
curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch2, CURLOPT_POST, true);
curl_setopt($ch2, CURLOPT_POSTFIELDS, $Ticket);
curl_setopt($ch2, CURLOPT_HTTPHEADER, array(
'Accept: */*',
'Connection: keep-alive',
'Content-Type: multipart/form-data; boundary=----WebKitFormBoundaryifAk1Acz7VYxiGUh',
'Host: cehennempass.pw',
'Origin: https://cehennempass.pw',
"Referer: https://cehennempass.pw/download/$Embed",
'User-Agent: iPlayTV',
));
$site2 = curl_exec($ch2);
curl_close($ch2);
$site2 = str_replace('\\','',$site2);
preg_match('#"download_link":"(.*?)"#',$site2,$icerik);
$Link = $icerik[1];
header ("Location: $Link");
?>