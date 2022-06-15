<?php
	// Include file koneksi utk menghubungkan antara file php dengan database
	include ('koneksi.php');
	// Query utk select data dari tb_barang
	$produk = mysqli_query($conn, "SELECT * FROM tb_barang");
	// Melakukan perulangan ketika dilakukan pengambilan / SELECT data dari tb_barang
	while($row = mysqli_fetch_array($produk)){
		$nama_produk[] = $row['barang'];
		// Query untuk mengambil nilai total dari database
		$query = mysqli_query($conn, "SELECT sum(jumlah) as jumlah from tb_penjualan WHERE id_barang = '".$row['id_barang']."'");
			$row = $query->fetch_array();
			// Mengambil nilai dari database dalam array
			$jumlah_produk[] = $row['jumlah'];
	}

?>

<DOCTYPE HTML>
<html>
<head>
	<title> Menmbuat Grafik Menggunakan Chart JS</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>

<body>
	<div style ="width : 800px; height:800px">
		<canvas id="myChart"></canvas>
	</div>

	<script>
		// Variabel utk membuat grafik 2d di myChart
		var ctx = document.getElementById("myChart").getContext('2d');
		// Chart akan ditampilkan dalam tipe bar 
		var myChart = new Chart(ctx, {
			type: 'bar',
			// Data dari chart yang akan ditampilkan
			data: {
				// Menampilkan data nama produk
				labels: <?php echo json_encode($nama_produk); ?>,
				datasets: [{
					label: 'Jumlah Produk Terjual',
					 // Memanggil variabel yang akan dijadikan isi chart
					data: <?php echo json_encode($jumlah_produk); ?>,
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					borderColor: 'rgba(255, 99, 132, 1)',
					borderWidth: 1
				}]
			},
			// Options untuk mengatur format tampilan chart
			options: {
				// Mengatur format judul bar chart
				title : { 
					display : true,
					text : "GRAFIK PENJUALAN"
				},
				// Konfigurasi skala chart
				scales: {
					// Konfigurasi sumbu-x
					yAxes: [{
						ticks: {
							// Skala sumbu-x dimulai dari 0
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>