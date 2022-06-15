<?php
	// Include file koneksi utk menghubungkan antara file php dengan database
	include ('koneksi.php');
	// Query utk select data dari tb_covid
	$case = mysqli_query($conn, "SELECT * FROM tb_covid");
	// Melakukan perulangan ketika dilakukan pengambilan / SELECT data dari tb_covid
	while($row = mysqli_fetch_array($case))
	{
		$nama_negara[] = $row['country'];
		// Query untuk mengambil nilai total dari database
		$query = mysqli_query($conn, "SELECT sum(total_case) as total_case, sum(new_case) as new_case, sum(total_death) as total_death, sum(new_death) as new_death, sum(total_recovered) as total_recovered, sum(new_recovered) as new_recovered FROM tb_covid WHERE id = '".$row['id']."'");
		$row = $query->fetch_array();
		// Mengambil nilai dari database dalam array
		$jumlah_kasus[] = $row['total_case'];
		$kasus_baru[] = $row['new_case'];
		$total_kematian[] = $row['total_death'];
		$kematian_baru[] = $row['new_death'];
		$total_sembuh[] = $row['total_recovered'];
		$sembuh_baru[] = $row['new_recovered'];
	}
	
	
?>

<DOCTYPE HTML>
<html>
<head>
	<title> Membuat Grafik Menggunakan Chart JS</title>
	<script type="text/javascript" src="Chart.js"></script>
	<style >
		/* Mengatur format tampilan dari canvas */
		canvas{
		margin-left: 16%;
		margin-top: 6%;
		background-color: #f7f4f8;
		padding-bottom: 12px;
		border-radius: 20px;
		}
		/* Mengatur format tampilan keseluruhan halaman */
		*{
			background-color: #a19dca;
		}
	</style>
</head>

<body>
	<div style ="width : 900px; height:900px">
		<canvas id="myChart"></canvas>
	</div>

	<script>
		// Variabel utk membuat grafik 2d di myChart
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			// Chart akan ditampilkan dalam tipe bar 
			type: 'bar',

			// Data dari chart yang akan ditampilkan
			data: {
				// Menampilkan data nama negara
				labels: <?php echo json_encode($nama_negara); ?>,
				// Data yang akan ditampilkan
				datasets: [ 
				{	// Data total case
					label: 'Total Case',
					data: <?php echo json_encode($jumlah_kasus); ?>, // Memanggil variabel yang akan dijadikan isi chart
					backgroundColor: 'rgba(52, 86, 139)', // Mengatur warna background bar chart
					borderColor: 'rgba(21, 34, 55)', //Mengatur warna border bar chart
					borderWidth: 1, //Mengatur lebar border bar chart
				}, 
				{	// Data new case
					label: 'New Case',
					data: <?php echo json_encode($kasus_baru); ?>, // Memanggil variabel yang akan dijadikan isi chart
					backgroundColor: 'rgba(249, 103, 20)', // Mengatur warna background bar chart
					borderColor: 'rgba(124, 48, 3)', //Mengatur warna border bar chart
					borderWidth: 1, //Mengatur lebar border bar chart
				}, 
				{	// Data total death
					label: 'Total Death',
					data: <?php echo json_encode($total_kematian); ?>, // Memanggil variabel yang akan dijadikan isi chart
					backgroundColor: 'rgba(250, 224, 60)', // Mengatur warna background bar chart
					borderColor: 'rgba(75, 65, 2)', //Mengatur warna border bar chart
					borderWidth: 1, //Mengatur lebar border bar chart
				},
				{	// Data new death
					label: 'New Death',
					data: <?php echo json_encode($kematian_baru); ?>, // Memanggil variabel yang akan dijadikan isi chart
					backgroundColor: 'rgba(0, 161, 112)', // Mengatur warna background bar chart
					borderColor: 'rgba(0, 77, 54)', //Mengatur warna border bar chart
					borderWidth: 1, //Mengatur lebar border bar chart
				},
				{	// Data total recovery
					label: 'Total Recovery',
					data: <?php echo json_encode($total_sembuh); ?>, // Memanggil variabel yang akan dijadikan isi chart
					backgroundColor: 'rgba(205, 33, 42)', // Mengatur warna background bar chart
					borderColor: 'rgba(132, 21, 26)', //Mengatur warna border bar chart
					borderWidth: 1, //Mengatur lebar border bar chart
				},
				{	// Data new recovery
					label: 'New Recovery',
					data: <?php echo json_encode($sembuh_baru); ?>, // Memanggil variabel yang akan dijadikan isi chart
					backgroundColor: 'rgba(181, 101, 167)', // Mengatur warna background bar chart
					borderColor: 'rgba(69, 33, 62)', //Mengatur warna border bar chart
					borderWidth: 1, //Mengatur lebar border bar chart
				}

				]
			},

			// Options untuk mengatur format tampilan chart
			options: {
				responsive : true, // Mengatur agar ukuran chart responsive terhadap ukuran layar perangkat
				maintainAspectRation : true, //Mempertahankan rasio aspek canvas asli saat ukuran berubah
				legend : {
					position : 'top',
				},
				// Mengatur format judul bar chart
				title : { 
					display : true,
					text : "BAR CHART DATA COVID"
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