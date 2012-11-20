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
	<tr><td rowspan="6"><img src="img/1.jpg" width="200" height="200" /></td>
		<td colspan="3" bgcolor="#FFFFFF"><img src="img/hed.png" align="top" width="600" height="150" /></td></tr>
		<tr><td height="5"></td></tr>
			<tr>
				<td width="500" height="10" colspan="3" bgcolor="#000000" ></td></tr>
			<tr>
				<td bgcolor="#000000" width="10"></td>
				<td align="center" width="600" height="70" bgcolor="#0099FF">
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

$no=$_POST['no'];
$nama=$_POST['nama'];
$umur=$_POST['umur'];
$kelamin=$_POST['RbKelamin'];
$alamat=$_POST['alamat'];
$query="Insert into pasien values('$no','$nama','$umur','$kelamin','$alamat')";
if ($nama!='')
mysql_query($query);

if(isset($_GET['ket']) && isset($_GET['i']))
{
	if($_GET['ket']=='Tidak' && ($_GET['i']==1 || $_GET['i']==2)) 
	{
		header("Location: index.php");
		$query="DELETE from temp";
		mysql_query($query);
	}
	
	if($_GET['i']==5)
	{
		header("Location: hasil.php");
	}
}

if(empty($_GET['i']))
{
	$i=1;
}
else
{
	$i=$_GET['i']+1;
}
$query="SELECT nama_gejala from gejala where id_gejala=$i";
$result=mysql_query($query);
$r=mysql_fetch_array($result);
echo "Apakah Anak Anda mengalami ".$r['nama_gejala']."?";
?>

<form>
	<input type="submit" name="ket" value="Iya" /> <input type="submit" name="ket" value="Tidak" />
	<input type="hidden" name="i" value="<?php echo $i ?>" />
</form>
<?php
	if(isset($_GET['ket']))
	{
		if($_GET['ket']=='Iya')
		{
	$i=$_GET['i'];
	$ket=$_GET['ket'];
	$query="INSERT into temp Values('$i','$ket')";
	mysql_query($query);
	}
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