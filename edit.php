<?php  
	
	session_start();
	$koneksi = mysqli_connect('localhost','root','','data');

	$pk = $_SESSION['nim'];
	$tampil = mysqli_query($koneksi, "SELECT * FROM t_biodata WHERE NIM='$pk' ");
	$row = mysqli_fetch_array($tampil);

	$hobi = explode(" ",$row['Hobi']);


?>


<form method="post">
	NIM: <input type="text" name="nim" value="<?php echo $row['NIM'];  ?>"><br>
	Nama: <input type="text" name="nama" value="<?php echo $row['Nama'];  ?>"><br>
	Password: <input type="Password" name="password" ><br>
	Kelas: D3MI-41-01<input type="radio" name="kelas" value="D3MI-41-01"> D3MI-41-02<input type="radio" name="kelas" value="D3MI-41-02"> D3MI-41-03<input type="radio" name="kelas" value="D3MI-41-03"> D3MI-41-04<input type="radio" name="kelas" value="D3MI-41-04"><br>
	Jenis Kelamin: Laki-laki<input type="radio" name="jk" value="laki-laki"> Perempuan<input type="radio" name="jk" value="Perempuan"><br>
	Hobi:<br>
	Sepak bola<input type="checkbox" name="hobi[]" value="Sepak Bola"><br>
	Basket<input type="checkbox" name="hobi[]" value="Basket"><br>
	Bulutangkis<input type="checkbox" name="hobi[]" value="Bulutangkis"><br>
	Main Game<input type="checkbox" name="hobi[]" value="main Game"><br>
	Berenang<input type="checkbox" name="hobi[]" value="Berenang"><br>

	Fakultas: <select name="fakultas">

			<option value="pilih">====Pilih Fakultas======</option>

			<option value="Fakultas Ilmu Terapan">Fakultas Ilmu Terapan</option>

			<option value="Fakultas Industri Kreatif">Fakultas Komunikasi dan Bisnis</option>

			<option value="Fakultas Rekayasa Industri">Fakultas Rekayasa Industri</option>

		</select><br>

	Alamat: <textarea name="alamat" value="<?php echo $row['Alamat'];  ?>"></textarea><br>
	<input type="submit" name="submit">
</form>

<?php  
	
	if (isset($_POST['submit'])) {
		$nim = $_POST['nim'];
		$nama = $_POST['nama'];
		$password = $_POST['password'];
		$kelas;
		$jenis_kelamin;
		$arrhobi = $_POST['hobi'];
		$fakultas = $_POST['fakultas'];
		$alamat = $_POST['alamat'];
		$hobi = "";

		if (!empty($arrhobi)) {
			foreach ($arrhobi as $value) {
				$hobi .= $value.", ";
			}
		}
		

		$cek = true;

		if (isset($_POST['kelas'])) {
			$kelas = $_POST['kelas'];
		}

		if (isset($_POST['jk'])) {
			$jenis_kelamin = $_POST['jk'];
		}

		if (empty($nim)) {
			echo "NIM tidak boleh kosong<br>";
			$cek = false;
		}else{
			if (strlen($nim)!=10 || !is_numeric($nim)) {
				echo "NIM Harus 10 digit dan angka<br>";
				$cek = false;
			}

		}

		if (empty($nama)) {
			echo "Nama tidak boleh kosong<br>";
			$cek = false;
		}else{
			if (strlen($nama)>35) {
				echo "Maksimal panjang nama 35 huruf<br>";
				$cek = false;
			}
		}

		if (empty($password)) {
			echo "Password tidak boleh kosong<br>";
			$cek = false;
		}

		if (empty($kelas)) {
			echo "Harus memilih kelas<br>";
			$cek = false;
		}

		if (empty($jenis_kelamin)) {
			echo "Harus memilih jenis kelamin<br>";
			$cek = false;
		}


		if ($fakultas=="pilih") {
			echo "Harus memilih faultas<br>";
			$cek = false;
		}

		if (empty($alamat)) {
			echo "Alamat tidak boleh kosong<br>";
			$cek = false;
		}


		if ($cek) {
			$koneksi = mysqli_connect('localhost','root','','data');

			$sql = "UPDATE t_biodata SET NIM = '$nim', Nama = '$nama', Password = '$password', Kelas = '$kelas', Jenis_Kelamin = '$jenis_kelamin', Hobi = '$hobi', Fakultas = '$fakultas', Alamat = '$alamat'  WHERE NIM = '$pk' ";

			if (mysqli_query($koneksi, $sql)) {
				header("Location:index.php");
			}else {
				echo "Gagal input ".mysqli_error($koneksi);
			}
		}else {
			echo "Isi data dengan benar";
		}

	}	
?>