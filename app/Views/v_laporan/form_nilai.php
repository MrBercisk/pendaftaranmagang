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
				<font size="2">Komplek Balaikota, Jl Kenari No 56 Yogyakarta 55165. WEBSITE: http://e-magang.diskominfosan.ac.id</font><br>
				<font size="2">EMAIL: kominfosandi@jogjakota.go.id Telp. Office: (0274)551230, 515865, 562682</font>
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
	<font size="4"><b>FORM PENILAIAN PRAKTIK KERJA LAPANGAN</b></font><br>
</center>

<br>

<table class="table-bordered">
	<tr>
		<td>1</td>
		<td>Nama</td>
		<td><?= $form_nilai['nama_peserta']; ?></td>
	</tr>
	<tr>
		<td>2</td>
		<td>Kategori</td>
		<td><?= $nama_kategori; ?></td>
	</tr>
	<tr>
		<td>3</td>
		<td>Universitas Asal</td>
		<td><?= $form_nilai['nama_kampus']; ?></td>
	</tr>
	<tr>
		<td>4</td>
		<td>Program Studi</td>
		<td><?= $form_nilai['prodi']; ?></td>
	</tr>
	<tr>
		<td>5</td>
		<td>Bidang</td>
		<td><?= $nama_bidang; ?></td>
	</tr>
	<tr>
		<td>6</td>
		<td>No.Handphone</td>
		<td><?= $form_nilai['no_hp']; ?></td>
	</tr>
	<tr>
		<td>7</td>
		<td>Nama Pembimbing PKL di Instansi</td>
		<td><?php foreach ($mentor as $m) : ?>
				<?= $m['nama'] ?>
			<?php endforeach ?></td>
	</tr>
</table>
<br><br>
<table class="table-bordered">
	<tr>
		<th>No</th>
		<th>Unsur Penelitian</th>
		<th>Nilai</th>
	</tr>
	<tr>
		<td>1</td>
		<td>Ketepatan waktu dalam mengerjakan tugas</td>
		<td><?= $nilai['ketepatan_waktu'] ?? '' ?></td>
	</tr>
	<tr>
		<td>2</td>
		<td>Tanggung jawab dengan tugas</td>
		<td><?= isset($nilai['tanggung_jawab']) ? $nilai['tanggung_jawab'] : '' ?></td>
	</tr>
	<tr>
		<td>3</td>
		<td>Kehadiran</td>
		<td><?= isset($nilai['kehadiran']) ? $nilai['kehadiran'] : '' ?></td>
	</tr>
	<tr>
		<td>4</td>
		<td>Kemampuan kerja</td>
		<td><?= isset($nilai['kemampuan_kerja']) ? $nilai['kemampuan_kerja'] : '' ?></td>
	</tr>
	<tr>
		<td>5</td>
		<td>Kualitas kerja</td>
		<td><?= isset($nilai['kualitas_kerja']) ? $nilai['kualitas_kerja'] : '' ?></td>
	</tr>
	<tr>
		<td>6</td>
		<td>Kerjasama</td>
		<td><?= isset($nilai['kerjasama']) ? $nilai['kerjasama'] : '' ?></td>
	</tr>
	<tr>
		<td>7</td>
		<td>Inisiatif</td>
		<td><?= isset($nilai['inisiatif']) ? $nilai['inisiatif'] : '' ?></td>
	</tr>
	<tr>
		<td>8</td>
		<td>Memiliki rasa percaya</td>
		<td><?= isset($nilai['rasa_percaya']) ? $nilai['rasa_percaya'] : '' ?></td>
	</tr>
	<tr>
		<td>9</td>
		<td>Penampilan</td>
		<td><?= isset($nilai['penampilan']) ? $nilai['penampilan'] : '' ?></td>
	</tr>
	<tr>
		<td>10</td>
		<td>Mematuhi aturan PKL</td>
		<td><?= isset($nilai['patuh_aturan_pkl']) ? $nilai['patuh_aturan_pkl'] : '' ?></td>
	</tr>
	<tr>
		<td colspan="2">Nilai Rata-rata</td>
		<td><?= isset($nilai['rata_rata']) ? $nilai['rata_rata'] : '' ?></td>
	</tr>
</table>

<div class="page-break"></div> <!-- Tambahkan jarak halaman menggunakan class "page-break" -->

<table class="table-bordered">
	<tr>
		<th colspan="3" style="text-align: center;">Persetujuan Penilaian</th>
	</tr>
	<tr>
		<td colspan="3" style="text-align: center;">Judul Laporan : <?= $form_nilai['judul']; ?></td>
	</tr>
	<tr>
		<td>Nama Mentor</td>
		<td colspan="2">
			<?php foreach ($mentor as $m) : ?>
				<?= $m['nama'] ?>
			<?php endforeach ?>

		</td>
	</tr>
	<tr>
        <td rowspan="3">Tanda Tangan</td>
        <td rowspan="3" colspan="2">
            <!-- Tampilkan tanda tangan -->
            <img src="<?= $nilai['tanda_tangan'] ?? '' ?>" style="max-width: 200px;">
        </td>
    </tr>

	<tr>

	</tr>
	<tr>

	</tr>
</table>


<div class="page-break"></div> <!-- Tambahkan jarak halaman menggunakan class "page-break" -->

<?php if ($form_nilai['status_permohonan'] == 'Kelompok') : ?>
	<?php if (!empty($form_nilai['nama_anggota_1'])) : ?>
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
						<font size="2">Komplek Balaikota, Jl Kenari No 56 Yogyakarta 55165. WEBSITE: http://e-magang.diskominfosan.ac.id</font><br>
						<font size="2">EMAIL: kominfosandi@jogjakota.go.id Telp. Office: (0274)551230, 515865, 562682</font>
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
			<font size="4"><b>FORM PENILAIAN PRAKTIK KERJA LAPANGAN</b></font><br>
		</center>

		<br>

		<table class="table-bordered">
			<tr>
				<td>1</td>
				<td>Nama</td>
				<td><?= $form_nilai['nama_anggota_1']; ?></td>
			</tr>
			<tr>
				<td>2</td>
				<td>Kategori</td>
				<td><?= $nama_kategori; ?></td>
			</tr>
			<tr>
				<td>3</td>
				<td>Universitas Asal</td>
				<td><?= $form_nilai['nama_kampus']; ?></td>
			</tr>
			<tr>
				<td>4</td>
				<td>Program Studi</td>
				<td><?= $form_nilai['prodi']; ?></td>
			</tr>
			<tr>
				<td>5</td>
				<td>Bidang</td>
				<td><?= $nama_bidang; ?></td>
			</tr>
			<tr>
				<td>6</td>
				<td>Nama Pembimbing PKL di Instansi</td>
				<td><?php foreach ($mentor as $m) : ?>
						<?= $m['nama'] ?>
					<?php endforeach ?></td>
			</tr>
		</table>
		<br><br>
		<table class="table-bordered">
			<tr>
				<th>No</th>
				<th>Unsur Penelitian</th>
				<th>Nilai</th>
			</tr>
			<tr>
				<td>1</td>
				<td>Ketepatan waktu dalam mengerjakan tugas</td>
				<td><?= $nilai['ketepatan_waktu'] ?? '' ?></td>
			</tr>
			<tr>
				<td>2</td>
				<td>Tanggung jawab dengan tugas</td>
				<td><?= isset($nilai['tanggung_jawab']) ? $nilai['tanggung_jawab'] : '' ?></td>
			</tr>
			<tr>
				<td>3</td>
				<td>Kehadiran</td>
				<td><?= isset($nilai['kehadiran']) ? $nilai['kehadiran'] : '' ?></td>
			</tr>
			<tr>
				<td>4</td>
				<td>Kemampuan kerja</td>
				<td><?= isset($nilai['kemampuan_kerja']) ? $nilai['kemampuan_kerja'] : '' ?></td>
			</tr>
			<tr>
				<td>5</td>
				<td>Kualitas kerja</td>
				<td><?= isset($nilai['kualitas_kerja']) ? $nilai['kualitas_kerja'] : '' ?></td>
			</tr>
			<tr>
				<td>6</td>
				<td>Kerjasama</td>
				<td><?= isset($nilai['kerjasama']) ? $nilai['kerjasama'] : '' ?></td>
			</tr>
			<tr>
				<td>7</td>
				<td>Inisiatif</td>
				<td><?= isset($nilai['inisiatif']) ? $nilai['inisiatif'] : '' ?></td>
			</tr>
			<tr>
				<td>8</td>
				<td>Memiliki rasa percaya</td>
				<td><?= isset($nilai['rasa_percaya']) ? $nilai['rasa_percaya'] : '' ?></td>
			</tr>
			<tr>
				<td>9</td>
				<td>Penampilan</td>
				<td><?= isset($nilai['penampilan']) ? $nilai['penampilan'] : '' ?></td>
			</tr>
			<tr>
				<td>10</td>
				<td>Mematuhi aturan PKL</td>
				<td><?= isset($nilai['patuh_aturan_pkl']) ? $nilai['patuh_aturan_pkl'] : '' ?></td>
			</tr>
			<tr>
				<td colspan="2">Nilai Rata-rata</td>
				<td><?= isset($nilai['rata_rata']) ? $nilai['rata_rata'] : '' ?></td>
			</tr>
		</table>

		<div class="page-break"></div> <!-- Tambahkan jarak halaman menggunakan class "page-break" -->

		<table class="table-bordered">
			<tr>
				<th colspan="3" style="text-align: center;">Persetujuan Penilaian</th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;">Judul Laporan : <?= $form_nilai['judul']; ?></td>
			</tr>
			<tr>
				<td>Nama Mentor</td>
				<td colspan="2">
					<?php foreach ($mentor as $m) : ?>
						<?= $m['nama'] ?>
					<?php endforeach ?>

				</td>
			</tr>
			<tr>
				<td rowspan="3">Tanda Tangan</td>
				<td rowspan="3" colspan="2">
					<?php
					if (isset($nilai['tanda_tangan'])) {
						$base64 = $nilai['tanda_tangan'];
						$imageData = str_replace('data:image/png;base64,', '', $base64);
						$imageData = str_replace(' ', '+', $imageData);
						$image = base64_decode($imageData);
						file_put_contents('signature.png', $image);
						echo '<img src="signature.png" />';
					}
					?>
				</td>

			</tr>

			<tr>

			</tr>
			<tr>

			</tr>
		</table>
		<div class="page-break"></div> <!-- Tambahkan jarak halaman menggunakan class "page-break" -->
	<?php endif; ?>
	<?php if (!empty($form_nilai['nama_anggota_2'])) : ?>
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
						<font size="2">Komplek Balaikota, Jl Kenari No 56 Yogyakarta 55165. WEBSITE: http://e-magang.diskominfosan.ac.id</font><br>
						<font size="2">EMAIL: kominfosandi@jogjakota.go.id Telp. Office: (0274)551230, 515865, 562682</font>
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
			<font size="4"><b>FORM PENILAIAN PRAKTIK KERJA LAPANGAN</b></font><br>
		</center>

		<br>

		<table class="table-bordered">
			<tr>
				<td>1</td>
				<td>Nama</td>
				<td><?= $form_nilai['nama_anggota_2']; ?></td>
			</tr>
			<tr>
				<td>2</td>
				<td>Kategori</td>
				<td><?= $nama_kategori; ?></td>
			</tr>
			<tr>
				<td>3</td>
				<td>Universitas Asal</td>
				<td><?= $form_nilai['nama_kampus']; ?></td>
			</tr>
			<tr>
				<td>4</td>
				<td>Program Studi</td>
				<td><?= $form_nilai['prodi']; ?></td>
			</tr>
			<tr>
				<td>5</td>
				<td>Bidang</td>
				<td><?= $nama_bidang; ?></td>
			</tr>
			<tr>
				<td>6</td>
				<td>Nama Pembimbing PKL di Instansi</td>
				<td><?php foreach ($mentor as $m) : ?>
						<?= $m['nama'] ?>
					<?php endforeach ?></td>
			</tr>
		</table>
		<br><br>
		<table class="table-bordered">
			<tr>
				<th>No</th>
				<th>Unsur Penelitian</th>
				<th>Nilai</th>
			</tr>
			<tr>
				<td>1</td>
				<td>Ketepatan waktu dalam mengerjakan tugas</td>
				<td><?= $nilai['ketepatan_waktu'] ?? '' ?></td>
			</tr>
			<tr>
				<td>2</td>
				<td>Tanggung jawab dengan tugas</td>
				<td><?= isset($nilai['tanggung_jawab']) ? $nilai['tanggung_jawab'] : '' ?></td>
			</tr>
			<tr>
				<td>3</td>
				<td>Kehadiran</td>
				<td><?= isset($nilai['kehadiran']) ? $nilai['kehadiran'] : '' ?></td>
			</tr>
			<tr>
				<td>4</td>
				<td>Kemampuan kerja</td>
				<td><?= isset($nilai['kemampuan_kerja']) ? $nilai['kemampuan_kerja'] : '' ?></td>
			</tr>
			<tr>
				<td>5</td>
				<td>Kualitas kerja</td>
				<td><?= isset($nilai['kualitas_kerja']) ? $nilai['kualitas_kerja'] : '' ?></td>
			</tr>
			<tr>
				<td>6</td>
				<td>Kerjasama</td>
				<td><?= isset($nilai['kerjasama']) ? $nilai['kerjasama'] : '' ?></td>
			</tr>
			<tr>
				<td>7</td>
				<td>Inisiatif</td>
				<td><?= isset($nilai['inisiatif']) ? $nilai['inisiatif'] : '' ?></td>
			</tr>
			<tr>
				<td>8</td>
				<td>Memiliki rasa percaya</td>
				<td><?= isset($nilai['rasa_percaya']) ? $nilai['rasa_percaya'] : '' ?></td>
			</tr>
			<tr>
				<td>9</td>
				<td>Penampilan</td>
				<td><?= isset($nilai['penampilan']) ? $nilai['penampilan'] : '' ?></td>
			</tr>
			<tr>
				<td>10</td>
				<td>Mematuhi aturan PKL</td>
				<td><?= isset($nilai['patuh_aturan_pkl']) ? $nilai['patuh_aturan_pkl'] : '' ?></td>
			</tr>
			<tr>
				<td colspan="2">Nilai Rata-rata</td>
				<td><?= isset($nilai['rata_rata']) ? $nilai['rata_rata'] : '' ?></td>
			</tr>
		</table>

		<div class="page-break"></div> <!-- Tambahkan jarak halaman menggunakan class "page-break" -->
		<table class="table-bordered">
			<tr>
				<th colspan="3" style="text-align: center;">Persetujuan Penilaian</th>
			</tr>
			<tr>
				<td colspan="3" style="text-align: center;">Judul Laporan : <?= $form_nilai['judul']; ?></td>
			</tr>
			<tr>
				<td>Nama Mentor</td>
				<td colspan="2">
					<?php foreach ($mentor as $m) : ?>
						<?= $m['nama'] ?>
					<?php endforeach ?>

				</td>
			</tr>
			<tr>
				<td rowspan="3">Tanda Tangan</td>
				<td rowspan="3" colspan="2">
					<?php
					if (isset($nilai['tanda_tangan'])) {
						$base64 = $nilai['tanda_tangan'];
						$imageData = str_replace('data:image/png;base64,', '', $base64);
						$imageData = str_replace(' ', '+', $imageData);
						$image = base64_decode($imageData);
						file_put_contents('signature.png', $image);
						echo '<img src="signature.png" />';
					}
					?>
				</td>

			</tr>

			<tr>

			</tr>
			<tr>

			</tr>
		</table>
	<?php endif; ?>
<?php endif; ?>

<style>
	table.table-bordered {
		border-collapse: collapse;
		width: 100%;
	}

	.page-break {
		page-break-before: always;
	}

	table.table-bordered th,
	table.table-bordered td {
		border: 1px solid black;
		padding: 8px;
		text-align: center;
	}

	table.table-bordered th {
		background-color: lightgray;
	}
</style>