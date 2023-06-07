<table align="center">
	<tr>
		<td width="100">
			<center>
				<img src="http://localhost/diskominfosan/public/assets/logo.png" alt="" width="100">
			</center>
		</td>
		<td width="400">
			<center>
				<font size="5"><b>DINAS KOMUNIKASI INFORMATIKA DAN PERSANDIAN KOTA YOGYAKARTA</b></font><br>
				<font size="2">Komplek Balaikota, Jl Kenari No 56 Yogyakarta 55165. Website: http://e-magang.diskominfosan.ac.id</font><br>
				<font size="1">Email: kominfosandi@jogjakota.go.id Telp. Office: (0274)551230, 515865, 562682</font>
			</center>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<hr>
		</td>
	</tr>
</table>

<br>

<center>
	<font size="4"><b>SURAT KETERANGAN MAGANG</b></font><br>
</center>

<br><br>

<table align="center">
	<tr>
		<td width="120">Nomor Pendaftaran</td>
		<td width="180">: <b><?= $buktiPendaftaran['nomor_pendaftaran']; ?></b></td>
		<td rowspan="9" width="200">
			<center>
				<!-- Lokasi foto peserta pada aplikasi app-pmb -->
				<img src="http://localhost/diskominfosan/public/file_peserta/<?= $buktiPendaftaran['foto']; ?>" alt="" width="200">
			</center>
		</td>
	</tr>
	<tr>
		<td>Bidang</td>
		<td>: <?= $nama_bidang; ?></td>
	</tr>
	<tr>
		<td>Kategori</td>
		<td>: <?= $nama_kategori; ?></td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>: <?= $buktiPendaftaran['nama_peserta']; ?></td>
	</tr>
	<tr>
		<td>Universitas Asal</td>
		<td>: <?= $buktiPendaftaran['nama_kampus']; ?></td>
	</tr>
	<tr>
		<td>Program Studi</td>
		<td>: <?= $buktiPendaftaran['prodi']; ?></td>
	</tr>
	<tr>
		<td>Keahlian</td>
		<td>: <?= $buktiPendaftaran['keahlian']; ?></td>
	</tr>
	<tr>
		<td>Status Permohonan</td>
		<td>:<?= $buktiPendaftaran['status_permohonan']; ?></td>
	</tr>
	<?php if ($buktiPendaftaran['status_permohonan'] == 'Kelompok') : ?>
		<?php if (!empty($buktiPendaftaran['nama_anggota_1'])) : ?>
			<tr>
				<td>Anggota Kelompok 1</td>
				<td>:<?= $buktiPendaftaran['nama_anggota_1']; ?></td>
			</tr>
		<?php endif; ?>
		<?php if (!empty($buktiPendaftaran['nama_anggota_2'])) : ?>
			<tr>
				<td>Anggota Kelompok 2</td>
				<td>:<?= $buktiPendaftaran['nama_anggota_2']; ?></td>
			</tr>
		<?php endif; ?>
	<?php endif; ?>
</table>

<br>

<table align="center">
	<tr>
		<td width="500">
			<hr>
		</td>
	</tr>
</table>

<center>
	<!-- Verifikasi Pendaftaran -->
	<?php if ($tgl_sekarang >= $tgl_pengumuman) : ?>
		<!-- Diterima -->
		<?php if ($buktiPendaftaran['status_verifikasi'] == "Diterima") : ?>
			<div class="alert alert-primary mt-4" role="alert">
				<h3 class="alert-heading">KETERANGAN</h3>
				<p>Anda Diterima Magang DISKOMINFOSAN pada kategori <b><?= $nama_kategori . " - " . $nama_bidang; ?></b></p>
				<?php foreach ($mentor as $m) : ?>
				<p>Dengan Nama Mentor Anda : <?= $m['nama'] ?> </p>
				<?php endforeach ?>
				<hr>
			</div>
		<?php endif ?>
	<?php endif ?>
</center>