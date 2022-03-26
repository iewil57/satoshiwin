<?php
error_reporting(0);
system('rm cookie.txt');
const host = "https://satoshiwin.io",
b = "\033[1;34m",
c = "\033[1;36m",
d = "\033[0m",
h = "\033[1;32m",
k = "\033[1;33m",
m = "\033[1;31m",
n = "\n",
p = "\033[1;37m",
u = "\033[1;35m";

$n = "\n";$n2 = "\n\n";$t = "\t";$r="\r                              \r";

system("termux-open-url  https://www.youtube.com/c/iewil");
bn();
cookie:
$user_agent=Save('User_Agent');
$cookie=Save('Cookie');

bn();

$ua[]="cookie: ".$cookie;
$ua[]="user-agent: ".$user_agent;

$ua1=['Host:satoshiwin.io','User-agent:'.$user_agent,'Cookie:'.$cookie,'Referer:https://satoshiwin.io/surf'];
$ua2=['Host:satoshiwin.io','User-agent:'.$user_agent,'Cookie:'.$cookie,'Origin:https://satoshiwin.io','Referer:https://satoshiwin.io/surf/'.$id];
$ua3=['Host:satoshiwin.io','user-agent:'.$user_agent,'cookie:'.$cookie,'accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9','referer:https://satoshiwin.io/surf/'.$id,'accept-encoding:gzip, deflate','accept-language:id,id-ID;q=0.9,en-US;q=0.8,en;q=0.7'];
$ua4=['Host:satoshiwin.io','accept:*/*','x-requested-with:XMLHttpRequest','user-agent:'.$user_agent,'content-type:application/x-www-form-urlencoded; charset=UTF-8','origin:https://satoshiwin.io','sec-fetch-site:same-origin','referer:https://satoshiwin.io/surf/'.$id,'accept-encoding:gzip, deflate','accept-language:id,id-ID;q=0.9,en-US;q=0.8,en;q=0.7','cookie:'.$cookie];
		
info:
$r1=Run(host.'/account',$ua);
$user=explode('"',explode(host.'/ref/',$r1)[1])[0];
$bal=explode('</span>',explode('<span id="balance">',$r1)[1])[0];
Ket('Username',$user);
Ket('Balance',$bal);
echo line();

menu:
echo col(" 1","p").col(" ≽ ","m").col("Faucet Bypass","b").$n;
echo col(" 2","p").col(" ≽ ","m").col("Faucet Manual","b").$n;
echo col(" 3","p").col(" ≽ ","m").col("Ptc","b").$n;
echo col(" 4","p").col(" ≽ ","m").col("Update Cookie ","k").$n;
$pil=readline(col(" Input Number","h").col(" ≽ ","m"));
echo line();
if($pil==1){goto Faucet;
}elseif($pil==2){goto manual;
}elseif($pil==3){goto ptc;
}elseif($pil==4){unlink('Cookie');goto cookie;
}else{echo col("Bad number you selected!","m").$n;echo line();goto menu;}

Faucet:
$cap=readline(col(" Captcha Prediction","m").col(" ≽ ","p"));
echo line();
ngok:
while(true){
	$r2=Run(host.'/faucet',$ua);
	$csrf=explode('">',explode('<input type="hidden" name="csrfToken" value="',$r2)[1])[0];//c87fb98c9bc23ee2e8e08d24727aca87">
	$hkey=explode('">',explode('<div class="h-captcha" data-sitekey="',$r2)[1])[0];//ef7cabfd-741e-4643-855f-77308adedef5
	$tmr=explode(' * 1000)',explode('+ (',$r2)[1])[0];
	if($tmr){tmr($tmr);goto ngok;}else{
		echo col('Bypass','rp1');
		$data = "csrfToken=$csrf&captcha=$cap&claim=";
		$r4=Run(host.'/faucet',$ua,$data);
		$tmr=explode(' * 1000)',explode('+ (',$r4)[1])[0];
		$notif=explode("',",explode("sendNotify('",$r4)[1])[0];
		echo $r;
		if($notif=="success"){
			$suk=explode("');",explode("sendNotify('success', '",$r4)[1])[0];
			$sukses=str_replace("</b>","",str_replace("<b>","",$suk));
			Ket('Success',$sukses);
			$r5=Run(host.'/account',$ua);
			$bal=explode('</span>',explode('<span id="balance">',$r5)[1])[0];
			Ket("Balance",$bal);
			echo line();
			}elseif($notif=="danger"){
				$dang=explode("');",explode("sendNotify('danger', '",$r4)[1])[0];
				$danger=str_replace("</b>","",str_replace("<b>","",$dang));
				if($danger=="You reached the maximum daily claims, get back tomorrow for more earnings."){echo $danger."\n";exit;}
				echo col($danger,"rr");sleep(2);echo$r;
				}
		}
	}
manual:
while(true){
	$r2=Run(host.'/faucet',$ua);
	
	$csrf=explode('">',explode('<input type="hidden" name="csrfToken" value="',$r2)[1])[0];//c87fb98c9bc23ee2e8e08d24727aca87">
	$hkey=explode('">',explode('<div class="h-captcha" data-sitekey="',$r2)[1])[0];//ef7cabfd-741e-4643-855f-77308adedef5
	$tmr=explode(' * 1000)',explode('+ (',$r2)[1])[0];
	if($tmr){tmr($tmr);goto manual;}else{
		$id=explode('"',explode('/captcha/',$r2)[1])[0];
		
		$coba=Run(host.'/captcha/'.$id,$ua);
		$nyolong=file_put_contents('img.png',$coba);
		system('termux-open img.png');
		$cap=readline(col(" Input Captcha","m").col(" ≽ ","p"));
		$data = "csrfToken=$csrf&captcha=$cap&claim=";
		$r4=Run(host.'/faucet',$ua,$data);
		$notif=explode("',",explode("sendNotify('",$r4)[1])[0];
		if($notif=="success"){
			$suk=explode("');",explode("sendNotify('success', '",$r4)[1])[0];
			$sukses=strip_tags($suk);
			Ket('Success',$sukses);
			$r5=Run(host.'/account',$ua);
			$bal=explode('</span>',explode('<span id="balance">',$r5)[1])[0];
			Ket("Balance",$bal);
			echo line();
			}elseif($notif=="danger"){
				$dang=explode("');",explode("sendNotify('danger', '",$r4)[1])[0];
				$danger=str_replace("</b>","",str_replace("<b>","",$dang));
				if($danger=="You reached the maximum daily claims, get back tomorrow for more earnings."){echo $danger."\n";exit;}
				Ket('Error',$danger);echo n;
				}
		}
	}
ptc:
$r = Run(host.'/surf',$ua1);
$tot = explode('href="/surf/',$r);
for($i=1;$i<count($tot);$i++){
	$id = explode('"',$tot[$i])[0];
	$ul = explode('"',explode('<img src="https://www.google.com/s2/favicons?domain=',$tot[$i])[1])[0];
	$r = Run(host.'/surf/'.$id,$ua2);
	$tmr = explode(';',explode('var count = ',$r)[1])[0];
	//$uid = explode('"',explode('id="uid" value="',$r)[1])[0];
	$c = explode("'",explode("var id = '",$r)[1])[0];
	Run(host.'/surf?uid='.$id.'&c='.$c,$ua2);
	if($tmr){tmr($tmr);}else{
		Ket('Error',"ptc finished");echo n;
		goto menu;}
	Run($ul,$ua3);
	$data = "&uid=".$id."&c=".$c;
	$r2 = json_decode(Run('https://satoshiwin.io/ajax/surf',$ua4,$data),1);
	if($r2["success"]){
			Ket('Success',$r2["message"]);
			$r5=Run(host.'/account',$ua);
			$bal=explode('</span>',explode('<span id="balance">',$r5)[1])[0];
			Ket("Balance",$bal);
			echo line();
		}else{
			echo col($r2["message"],"m")."\n";
			echo line();
		}
}

//curl
function Run($url, $ua, $data = null){
while (True){$ch = curl_init();curl_setopt_array($ch, array(
CURLOPT_URL => $url,CURLOPT_FOLLOWLOCATION => 1,));
if ($data){curl_setopt_array($ch, array(CURLOPT_POST => 1,
CURLOPT_POSTFIELDS => $data,));}curl_setopt_array($ch, array(
CURLOPT_HTTPHEADER => $ua,CURLOPT_SSL_VERIFYPEER => 1,
CURLOPT_RETURNTRANSFER => 1,CURLOPT_ENCODING => 'gzip',
CURLOPT_COOKIEJAR => 'cookie.txt',CURLOPT_COOKIEFILE => 'cookie.txt',));$run = curl_exec($ch);curl_close($ch);if($run){return $run;}else{sleep(1);continue;}}}
/** Standard function **/
function col($str,$color){
	if($color==5){$color=['h','k','b','u','m'][array_rand(['h','k','b','u','m'])];}
	$war=array('rw'=>"\033[107m\033[1;31m",'rt'=>"\033[106m\033[1;31m",'ht'=>"\033[0;30m",'p'=>"\033[1;37m",'a'=>"\033[1;30m",'m'=>"\033[1;31m",'h'=>"\033[1;32m",'k'=>"\033[1;33m",'b'=>"\033[1;34m",'u'=>"\033[1;35m",'c'=>"\033[1;36m",'rr'=>"\033[101m\033[1;37m",'rg'=>"\033[102m\033[1;34m",'ry'=>"\033[103m\033[1;30m",'rp1'=>"\033[104m\033[1;37m",'rp2'=>"\033[105m\033[1;37m");return $war[$color].$str."\033[0m";}
function Save($namadata){
	if(file_exists($namadata)){$datauser=file_get_contents($namadata);}else{$datauser=readline(col("Input ".$namadata,"rp1").col(' ≽','m')."\n");file_put_contents($namadata,$datauser);}
	return $datauser;}
function ket($msg1,$msg2){
	$var=10;
	$a=strlen($msg1);
	$b=$var-$a;
	$c=str_repeat(' ',4);
	if($msg1=="Error"){
		echo $c.col($msg1,'m').str_repeat(' ',$b).col(" ~> ",'p').col($msg2,'m');
	}else{
		echo $c.col($msg1,'k').str_repeat(' ',$b).col(" ~> ",'h').col($msg2,'p')."\n";
	}
}
function Slow($msg){$slow = str_split($msg);
	foreach( $slow as $slowmo ){ echo $slowmo; usleep(70000);}}
function tmr($tmr){$timr=time()+$tmr;while(true):
	echo "\r                       \r";$res=$timr-time(); 
	if($res < 1){break;}
	echo "    ".col(date('i:s',$res),5);sleep(1);endwhile;}
function cetak($msg, $tipe){
	$u="\033[1;35m";$h="\033[1;32m";$p="\033[1;37m";$m="\033[1;31m";$k="\033[1;33m";$b="\033[1;34m";$c="\033[1;36m";$len = 56;$var = $u.'═';
	if(strpos($msg, "|") == ""){$title = ((($len-strlen($msg))/2)-1);
		if($tipe=="line"){echo str_repeat($var,$len)."\n";
			}elseif($tipe=="title"){echo $var.str_repeat(" ", $title).$h.strtoupper($msg).str_repeat(" ", $title).$var."\n".str_repeat($var,$len)."\n";
				}elseif($tipe=="warn"){echo str_repeat($var,$len)."\n".$var.str_repeat(" ", $title).$p.strtoupper($msg).str_repeat(" ", $title).$var."\n";}}
	if(strpos($msg, "|") != ""){$msg1 = explode("|",$msg)[0];$msg2 = explode("|",$msg)[1];$gar= 10-strlen($msg1);$isi1 = strlen($msg1.str_repeat(" ",$gar)." ~> ".$msg2);$isi2 =($len-$isi1)-3;
		if ($tipe=="isi"){echo $var." ".$k.$msg1,str_repeat(" ",$gar).$p." ~> ".$k.$msg2.str_repeat(" ",$isi2).$var."\n";
			}else if($tipe=="request"){echo $var." ".$c.$msg1.str_repeat(" ",$gar).$p." ~> ".$c.$msg2.str_repeat(" ",$isi2).$var."\n";
				}else if($tipe=="date"){echo $var." ".$b."Date"."      ".$c." ~> ".$p.date('d/m/Y').str_repeat(" ",4).$var." ".$b."Scipt"."\t".$c." ~> ".$h."Online".str_repeat(" ",5).$var."\n";echo $var." ".$b."Time"."      ".$c." ~> ".$p.date('H:i:s').str_repeat(" ",6).$var." ".$b."Versi"."\t".$c." ~> ".$p.$msg1.str_repeat(" ",8).$var."\n";}}}
/** Banner **/
function bn(){
	system('clear');
	print "\n\n";
	print h."Author  : ".k."iewil".n;
	print h."Script  : ".k.host.n;
	print h."Youtube : ".k."youtube.com/c/iewil".n;
	print line();
}
function Line(){$l = 50;return b.str_repeat('─',$l).n;}
