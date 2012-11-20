<?php
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SISTEM PAKAR DIAGNOSA PENYAKIT PADA ANAK</title>
</head>
<body>
<table border="0" width="600" height="200" align="center" cellpadding=0 cellspacing=0>
	<tr>
		<td colspan="3" bgcolor="#FFFFFF" headers="120"><img src="img/hed.png" align="top" width="600" height="150" /></td></tr>
		<tr><td height="5"></td></tr>
			<tr>
							<td width="500" height="10" colspan="3" bgcolor="#000000" ></td></tr>
			<tr>
				<td bgcolor="#000000" width="10"></td>
				<td align="center" width="600" height="300" bgcolor="#0099FF">
<?php
$my['host']	= "localhost";
$my['user']	= "root";
$my['pass']	= "";
$my['dbs']	= "certainty";

$koneksi	= mysql_connect($my['host'], 
							$my['user'], 
							$my['pass']);
if (! $koneksi) {
  echo "Gagal koneksi!";
  mysql_error();
}
mysql_select_db($my['dbs'])
	 or die ("Database tidak ada".mysql_error()); 

?>
<table>
	<tr><td align="center"><u>HASIL ANALISA PADA KESEHATAN ANAK</td></tr>
	<tr><td align="center"><hr /></td></tr>

<form>
<tr>
<td>DATA PASIEN</td>
<tr><td align="center"><hr /></td></tr>
</tr>
<?php
$query3="SELECT * from pasien ORDER BY id DESC LIMIT 1";
$result=mysql_query($query3);
$r=mysql_fetch_array($result);

?>
	<tr><td></td></tr>
	<tr><td>Nama :<font color="#FF0000"> <?php echo $r['nama'];?>
	<tr><td></td></tr>
		<tr><td>Umur :<font color="#FF0000"> <?php echo $r['umur'];?>
	<tr><td></td></tr>
		<tr><td>Kelamin :<font color="#FF0000"> <?php echo $r['kelamin'];?>
	<tr><td></td></tr>
		<tr><td>Alamat :<font color="#FF0000"> <?php echo $r['alamat'];?>
	<tr><td></td></tr>
	<tr><td align="center"><hr /></td></tr>
	<tr><td>Gejala yang diderita anak :<center><font color="#FF0000">
	
<?php

$query="Select temp.id_gejala,gejala.id_gejala,gejala.nama_gejala,gejala.CF from temp,gejala where temp.id_gejala=gejala.id_gejala and status='Iya'";
$result=mysql_query($query);
while ($r=mysql_fetch_array($result))
{
	echo $r['nama_gejala'] ." dengan nilai CF : ";
	echo $r['CF'];
	echo "<br>";
	
}
?>
</td></tr>
<tr><td>
Kesimpulan : <font color="#FF0000">

<?php
$query="SELECT * FROM temp ORDER by id_gejala ASC";
$result=mysql_query($query);
$i=1;
while ($r=mysql_fetch_array($result))
{
	//$gejala[$i]=$r['id_gejala'];
	//$status[$i]=$r['status'];	
	//$i++;
	$status[$r['id_gejala']]=$r['status'];
}


if($status[1]=='Iya' && $status[2]=="Iya" && $status[3]=="Iya")
{
	
	echo "Infeksi saluran nafas dengan nilai certainty factor sebesar 0.156";
}
else if($status[1]=='Iya' && $status[2]=="Iya" && $status[4]=="Iya")
{
	echo "Infeksi dada dengan nilai certainty factor sebesar 0.090";
}
else if($status[1]=='Iya' && $status[2]=="Iya" && $status[5]=="Iya")
{
	echo "influenza dengan nilai certainty factor sebesar 0.222";
}
else if($status[1]=='Iya' && $status[2]=="Iya" && $status[3]=="Iya" && $status[4]=="Iya")
{
	
	echo "Infeksi saluran nafas dengan nilai certainty factor sebesar 0.156";
}
else if($status[1]=='Iya' && $status[2]=="Iya" && $status[3]=="Iya" && $status[4]=="Iya" && $status[5]=="Iya")
{
	
	echo "influenza dengan nilai certainty factor sebesar 0.222";
}
else
{
	echo "Sistem tidak bisa menganalisa jawaban pasien";
}
?>
<tr><td align="center"><hr /></td></tr>
</form>
</td></tr></table>
<br />
<form method="post">
<input type="submit" name="selesai" value="Selesai Konsultasi" />
</form>
<?php
	if(isset($_POST['selesai']))
	{
		$query="DELETE from temp";
		mysql_query($query);
		header("Location: index.php");
	}
?>
</td>
					<td bgcolor="#000000" width="10"></td></tr>
						<tr>
							<td width="500" height="10" colspan="3" bgcolor="#000000" ></td></tr>

</table>
</body>
</html>
<?php
ob_flush();
?>