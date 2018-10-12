<form method="post">
	NIM: <input type="text" name="nim"><br>
	Password: <input type="Password" name="pass"><br>
	<input type="submit" name="submit">

</form>



<a href="regis.php">Registrasi</a>
<?php  

	if (isset($_POST['submit'])) {
		$nim = $_POST['nim'];
		$pass = $_POST['pass'];

		$cek = true;

		if (empty($nim)) {
			echo "NIM tidak boleh kosong<br>";
			$cek = false;
		}else{
			if (strlen($nim)!=10 || !is_numeric($nim)) {
				echo "NIM Harus 10 digit dan angka<br>";
				$cek = false;
			}

		}

		if (empty($pass)) {
			echo "Password tidak boleh kosong";
			$cek = false;
		}



		if ($cek) {
			$koneksi = mysqli_connect('localhost','root','','data');

		$result = mysqli_query($koneksi, "SELECT * FROM t_biodata WHERE NIM = '$nim' AND Password = '$pass' ");

	    while ($row=mysqli_fetch_row($result)) {
	        session_start();
	        $_SESSION['nim'] = $row['0'];
	        header("Location: tampil.php");
	    }

	     echo "Username atau Password tidak sesuai";
		}
		
	}

?>