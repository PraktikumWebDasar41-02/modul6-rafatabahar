<?php  
	
	session_start();
	$koneksi = mysqli_connect('localhost','root','','data');

	$nim = $_SESSION['nim'];
	$tampil = mysqli_query($koneksi, "SELECT * FROM t_biodata WHERE NIM='$nim' ");
	$row = mysqli_fetch_row($tampil);

	echo "NIM : ".$row[0]."<br>";
	echo "Nama : ".$row[1]."<br>";
	echo "Kelas : ".$row[3]."<br>";
	echo "Jenis kelamin : ".$row[4]."<br>";
	echo "Hobi : ".$row[5]."<br>";
	echo "Fakultas : ".$row[6]."<br>";
	echo "Alamat : ".$row[7]."<br>";


	
?>

<a href="edit.php">edit</a>