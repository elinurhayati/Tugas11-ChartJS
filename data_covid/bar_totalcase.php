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
		$query = mysqli_query($conn, "SELECT sum(total_case) as total_case FROM tb_covid WHERE id = '".$row['id']."'");
		$row = $query->fetch_array();
		// Mengambil nilai dari database dalam bentuk array
		$jumlah_kasus[] = $row['total_case'];
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
			margin-left: 15%;
			margin-top: 5%;
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
				}]
			},

			// Options untuk mengatur format tampilan chart
			options: {
				responsive : true,
				maintainAspectRation : true,
				legend : {
					position : 'top',
				},
				// Mengatur format judul bar chart
				title : { 
					display : true,
					text : "BAR CHART DATA COVID"
				},
				// Konfigurasi skala pada chart
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