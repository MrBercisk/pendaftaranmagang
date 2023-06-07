<!DOCTYPE html>
<html>

<head>
	<title>Print Data Pendaftaran</title>
	<style type="text/css">
		body {
			font-family: Arial, sans-serif;
			font-size: 14px;
		}

		table {
			border-collapse: collapse;
			width: 100%;
			margin-bottom: 20px;
		}

		table td,
		table th {
			border: 1px solid #ddd;
			padding: 8px;
		}

		table th {
			background-color: #f2f2f2;
			text-align: center;
		}

		h2 {
			margin-top: 0;
		}
	</style>
</head>

<body>
	<h1><?= $title ?></h1>

	<table border="1">
		<thead>
			<tr>
				<th>ID</th>
				<th>Foto</th>
				<th>Nama Lengkap</th>
				<th>Nomor Induk Mahasiswa</th>
				<th>Tanggal Pendaftaran</th>
				<th>Status Verifikasi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($tbl_pendaftaran as $row) : ?>
				<tr>
					<td><?= $row['id'] ?></td>
					<td><img src="<?= base_url('/file_peserta/' . $row['foto']); ?>" style="width: 80px; height: 80px; border-radius: 50%;"></td>
					<td><?= $row['nama_peserta'] ?></td>
					<td><?= $row['nim'] ?></td>
					<td><?= $row['tanggal_pendaftaran'] ?></td>
					<td><?= $row['status_verifikasi'] ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</body>

</html>
