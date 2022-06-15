<?php
	// Include file koneksi utk menghubungkan antara file php dengan database
	include ('koneksi.php');
	// Query utk select data dari tb_covid
	$country = mysqli_query($conn, "SELECT * FROM tb_covid");
	// Melakukan perulangan ketika dilakukan pengambilan / SELECT data dari tb_covid
	while($row = mysqli_fetch_array($country)){
		$nama_negara[] = $row['country'];
		// Query untuk mengambil nilai total dari database
		$query = mysqli_query($conn, "SELECT sum(total_case) as total_case, sum(new_case) as new_case, sum(total_death) as total_death, sum(new_death) as new_death, sum(total_recovered) as total_recovered, sum(new_recovered) as new_recovered from tb_covid WHERE id = '".$row['id']."'");
			$row = $query->fetch_array();
			// Mengambil nilai dari database dalam array
			$total_kasus[] = $row['total_case'];
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
</head>
<style>
	/* Mengatur format tampilan dari canvas */
	canvas{
		margin-left: 50%;
		margin-top: 6%;
		background-color: #f7f4f8;
		padding-bottom: 12px;
		border-radius: 20px;
	}
	/* Mengatur format tampilan keseluruhan halaman */
	*{
		background-color: #91ba83;
	}
</style>

<body>
	<!-- Mendefinisikan beberapa canvas -->
	<div id="canvas-holder" style="width:50%">
		<canvas id="myChart"></canvas>
		<canvas id="myChart2"></canvas>
		<canvas id="myChart3"></canvas>
		<canvas id="myChart4"></canvas>
		<canvas id="myChart5"></canvas>
		<canvas id="myChart6"></canvas>
	</div>
	
	<!--Script untuk menampilkan total case -->
	<script>
		// Variabel utk membuat grafik 2d di myChart
		var ctx = document.getElementById("myChart").getContext('2d');		var myChart = new Chart(ctx, {
			// Chart akan ditampilkan dalam tipe pie 
			type: 'pie',
			// Data dari chart yang akan ditampilkan
			data: {
				datasets: [{
					data: <?php echo json_encode($total_kasus); ?>,
					label: 'Total Case',
					backgroundColor: [ //Mengatur warna background bar chart
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.6)',
					'rgb(204, 153, 255, 0.5)',
					'rgb(255, 179, 255, 0.5)',
					'rgb(255, 170, 128, 0.5)',
					'rgb(179, 255, 179, 0.5)',
					'rgb(163, 163, 194, 0.5)',
					'rgb(217, 179, 140, 0.5)'
					],
					borderColor: [ //Mengatur warna border bar chart
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 179, 26, 1)',
					'rgba(75, 192, 192, 1)',
					'rgb(204, 102, 255, 1)',
					'rgb(255, 77, 255, 1)',
					'rgb(255, 153, 102, 1)',
					'rgb(0, 179, 0, 1)',
					'rgb(117, 117, 163, 1)',
					'rgb(204, 153, 102, 1)'
					],
				}], 
				// Menampilkan data nama negara
				labels : <?php echo json_encode($nama_negara); ?>},

			// Options untuk mengatur format tampilan chart
			options: {
				responsive: true,
				// Mengatur format judul pie chart
				title : {
					display : true,
					text : "TOTAL CASE"
				},
				// Konfigurasi skala chart
				scales :{

				}
			}

		});

	</script>

	<!--Script untuk menampilkan new case -->
	<script>
		// Variabel utk membuat grafik 2d di myChart
		var ctx2 = document.getElementById("myChart2").getContext('2d');		
		var myChart2 = new Chart(ctx2, {
			// Chart akan ditampilkan dalam tipe pie 
			type: 'pie',
			// Data dari chart yang akan ditampilkan
			data: {
				datasets: [{
					data: <?php echo json_encode($kasus_baru); ?>,
					label: 'Total Case',
					backgroundColor: [ //Mengatur warna background bar chart
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.6)',
					'rgb(204, 153, 255, 0.5)',
					'rgb(255, 179, 255, 0.5)',
					'rgb(255, 170, 128, 0.5)',
					'rgb(179, 255, 179, 0.5)',
					'rgb(163, 163, 194, 0.5)',
					'rgb(217, 179, 140, 0.5)'
					],
					borderColor: [ //Mengatur warna border bar chart
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 179, 26, 1)',
					'rgba(75, 192, 192, 1)',
					'rgb(204, 102, 255, 1)',
					'rgb(255, 77, 255, 1)',
					'rgb(255, 153, 102, 1)',
					'rgb(0, 179, 0, 1)',
					'rgb(117, 117, 163, 1)',
					'rgb(204, 153, 102, 1)'
					],
				}], 
				// Menampilkan data nama negara
				labels : <?php echo json_encode($nama_negara); ?>},

			// Options untuk mengatur format tampilan chart
			options: {
				responsive: true,
				// Mengatur format judul pie chart
				title : {
					display : true,
					text : "NEW CASE"
				},
				// Konfigurasi skala chart
				scales :{

				}
			}

		});
	</script>

	<!--Script untuk menampilkan total death -->
	<script>
		// Variabel utk membuat grafik 2d di myChart
		var ctx3 = document.getElementById("myChart3").getContext('2d');		
		var myChart3 = new Chart(ctx3, {
			// Chart akan ditampilkan dalam tipe pie 
			type: 'pie',
			// Data dari chart yang akan ditampilkan
			data: {
				datasets: [{
					data: <?php echo json_encode($total_kematian); ?>,
					label: 'Total Case',
					backgroundColor: [ //Mengatur warna background bar chart
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.6)',
					'rgb(204, 153, 255, 0.5)',
					'rgb(255, 179, 255, 0.5)',
					'rgb(255, 170, 128, 0.5)',
					'rgb(179, 255, 179, 0.5)',
					'rgb(163, 163, 194, 0.5)',
					'rgb(217, 179, 140, 0.5)'
					],
					borderColor: [ //Mengatur warna border bar chart
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 179, 26, 1)',
					'rgba(75, 192, 192, 1)',
					'rgb(204, 102, 255, 1)',
					'rgb(255, 77, 255, 1)',
					'rgb(255, 153, 102, 1)',
					'rgb(0, 179, 0, 1)',
					'rgb(117, 117, 163, 1)',
					'rgb(204, 153, 102, 1)'
					],
				}], 
				// Menampilkan data nama negara
				labels : <?php echo json_encode($nama_negara); ?>},

			// Options untuk mengatur format tampilan chart
			options: {
				responsive: true,
				// Mengatur format judul pie chart
				title : {
					display : true,
					text : "TOTAL DEATH"
				},
				// Konfigurasi skala chart
				scales :{

				}
			}

		});
	</script>

	<!--Script untuk menampilkan new death -->
	<script>
		// Variabel utk membuat grafik 2d di myChart
		var ctx4 = document.getElementById("myChart4").getContext('2d');		
		var myChart4 = new Chart(ctx4, {
			// Chart akan ditampilkan dalam tipe pie 
			type: 'pie',
			// Data dari chart yang akan ditampilkan
			data: {
				datasets: [{
					data: <?php echo json_encode($kematian_baru); ?>,
					label: 'Total Case',
					backgroundColor: [ //Mengatur warna background bar chart
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.6)',
					'rgb(204, 153, 255, 0.5)',
					'rgb(255, 179, 255, 0.5)',
					'rgb(255, 170, 128, 0.5)',
					'rgb(179, 255, 179, 0.5)',
					'rgb(163, 163, 194, 0.5)',
					'rgb(217, 179, 140, 0.5)'
					],
					borderColor: [ //Mengatur warna border bar chart
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 179, 26, 1)',
					'rgba(75, 192, 192, 1)',
					'rgb(204, 102, 255, 1)',
					'rgb(255, 77, 255, 1)',
					'rgb(255, 153, 102, 1)',
					'rgb(0, 179, 0, 1)',
					'rgb(117, 117, 163, 1)',
					'rgb(204, 153, 102, 1)'
					],
				}], 
				// Menampilkan data nama negara
				labels : <?php echo json_encode($nama_negara); ?>},

			// Options untuk mengatur format tampilan chart
			options: {
				responsive: true,
				// Mengatur format judul pie chart
				title : {
					display : true,
					text : "NEW DEATH"
				},
				// Konfigurasi skala chart
				scales :{

				}
			}

		});
	</script>

	<!--Script untuk menampilkan total recovered -->
	<script>
		// Variabel utk membuat grafik 2d di myChart
		var ctx5 = document.getElementById("myChart5").getContext('2d');		
		var myChart5 = new Chart(ctx5, {
			// Chart akan ditampilkan dalam tipe pie 
			type: 'pie',
			// Data dari chart yang akan ditampilkan
			data: {
				datasets: [{
					data: <?php echo json_encode($total_sembuh); ?>,
					label: 'Total Case',
					backgroundColor: [ //Mengatur warna background bar chart
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.6)',
					'rgb(204, 153, 255, 0.5)',
					'rgb(255, 179, 255, 0.5)',
					'rgb(255, 170, 128, 0.5)',
					'rgb(179, 255, 179, 0.5)',
					'rgb(163, 163, 194, 0.5)',
					'rgb(217, 179, 140, 0.5)'
					],
					borderColor: [ //Mengatur warna border bar chart
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 179, 26, 1)',
					'rgba(75, 192, 192, 1)',
					'rgb(204, 102, 255, 1)',
					'rgb(255, 77, 255, 1)',
					'rgb(255, 153, 102, 1)',
					'rgb(0, 179, 0, 1)',
					'rgb(117, 117, 163, 1)',
					'rgb(204, 153, 102, 1)'
					],
				}], 
				// Menampilkan data nama negara
				labels : <?php echo json_encode($nama_negara); ?>},

			// Options untuk mengatur format tampilan chart
			options: {
				responsive: true,
				// Mengatur format judul pie chart
				title : {
					display : true,
					text : "TOTAL RECOVERED"
				},
				// Konfigurasi skala chart
				scales :{

				}
			}

		});
	</script>

	<!--Script untuk menampilkan new recovered -->
	<script>
		// Variabel utk membuat grafik 2d di myChart
		var ctx6 = document.getElementById("myChart6").getContext('2d');		
		var myChart6 = new Chart(ctx6, {
			// Chart akan ditampilkan dalam tipe pie 
			type: 'pie',
			// Data dari chart yang akan ditampilkan
			data: {
				datasets: [{
					data: <?php echo json_encode($sembuh_baru); ?>,
					label: 'Total Case',
					backgroundColor: [ //Mengatur warna background bar chart
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.6)',
					'rgb(204, 153, 255, 0.5)',
					'rgb(255, 179, 255, 0.5)',
					'rgb(255, 170, 128, 0.5)',
					'rgb(179, 255, 179, 0.5)',
					'rgb(163, 163, 194, 0.5)',
					'rgb(217, 179, 140, 0.5)'
					],
					borderColor: [ //Mengatur warna border bar chart
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 179, 26, 1)',
					'rgba(75, 192, 192, 1)',
					'rgb(204, 102, 255, 1)',
					'rgb(255, 77, 255, 1)',
					'rgb(255, 153, 102, 1)',
					'rgb(0, 179, 0, 1)',
					'rgb(117, 117, 163, 1)',
					'rgb(204, 153, 102, 1)'
					],
				}], 
				// Menampilkan data nama negara
				labels : <?php echo json_encode($nama_negara); ?>},

			// Options untuk mengatur format tampilan chart
			options: {
				responsive: true,
				// Mengatur format judul pie chart
				title : {
					display : true,
					text : "NEW RECOVERED"
				},
				// Konfigurasi skala chart
				scales :{

				}
			}

		});
	</script>
</body>
</html>