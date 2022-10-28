<table align="center">
	<tr>
		<td width="100">
			<center>
				<img src="http://localhost/app-pmb/public/assets/logo.png" alt="" width="100">
			</center>
		</td>
		<td width="400">
			<center>
				<font size="3">PENDAFTARAN MAGANG MAHASISWA</font><br>
				<font size="5"><b>DISKOMINFOSAN</b></font><br>
				<font size="2">Komplek Balaikota, Jl Kenari No 56 Yogyakarta 55165. Website: http://e-magang.diskominfosan.ac.id</font><br>
				<font size="1">Email: kominfosandi@jogjakota.go.id Telp. Office: (0274)551230, 515865, 562682</font>
			</center>
		</td>
	</tr>
	<tr>
		<td colspan="2"><hr></td>
	</tr>
</table>

<br>

<center>
	<font size="4"><b>BUKTI PENDAFTARAN ONLINE</b></font><br>
</center>

<br><br>

<table align="center">
	<tr>
		<td width="120">Nomor Pendafaratan</td>
		<td width="180">: <b><?=$buktiPendaftaran['nomor_pendaftaran']; ?></b></td>
		<td rowspan="9" width="200">
			<center>
				<!-- Lokasi foto peserta pada aplikasi app-pmb -->
				<img src="http://localhost/app-pmb/public/file_peserta/<?=$buktiPendaftaran['foto']; ?>" alt="" width="200">
			</center>
		</td>
	</tr>
	<tr>
		<td>Bidang</td>
		<td>: <?=$nama_bidang; ?></td>
	</tr>
	<tr>
		<td>Kategori</td>
		<td>: <?=$nama_kategori; ?></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>: <?=$buktiPendaftaran['nama_peserta']; ?></td>
	</tr>
	<tr>
		<td>Universitas Asal</td>
		<td>: <?=$buktiPendaftaran['nama_kampus']; ?></td>
	</tr>
	<tr>
		<td>Tanggal Pendaftaran</td>
		<td>: <?=tgl_indonesia($buktiPendaftaran['tanggal_pendaftaran']); ?></td>
	</tr>
</table>

<br>

<table align="center">
	<tr>
		<td width="500">
			<hr>
		</td>
	</tr>
</table>