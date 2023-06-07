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
    <font size="4"><b>SURAT KETERANGAN SELESAI MAGANG</b></font><br>
</center>
<br><br>
<p style="text-align: left;">Nomor : </p>
<p style="text-align: left;">Lampiran : 1 (Satu) berkas</p>
<p style="text-align: left;">Hal : Surat Keterangan Kerja Praktik</p>
<br><br>
<p style="text-align: justify;">Hormat kami,</p>
<p style="text-align: justify;">Dengan ini kami sampaikan bahwa mahasiswa dengan data sebagai berikut : </p>
<br>
<table class="table-bordered">
    <tr>
        <th>No</th>
        <th>Nama Peserta</th>
        <th>Nama Kategori</th>
        <th>Program Studi</th>
        <th>Nama Kampus</th>
    </tr>
    <tr>
        <td>1</td>
        <td><?= $surat_selesai['nama_peserta']; ?></td>
        <td><?= $nama_kategori; ?></td>
        <td><?= $surat_selesai['prodi']; ?></td>
        <td><?= $surat_selesai['nama_kampus']; ?></td>
    </tr>
    <?php if ($surat_selesai['status_permohonan'] == 'Kelompok') : ?>
        <?php if (!empty($surat_selesai['nama_anggota_1'])) : ?>
            <tr>
                <td>2</td>
                <td><?= $surat_selesai['nama_anggota_1']; ?></td>
                <td><?= $nama_kategori; ?></td>
                <td><?= $surat_selesai['prodi']; ?></td>
                <td><?= $surat_selesai['nama_kampus']; ?></td>
            </tr>
        <?php endif; ?>
        <?php if (!empty($surat_selesai['nama_anggota_2'])) : ?>
            <tr>
                <td>2</td>
                <td><?= $surat_selesai['nama_anggota_2']; ?></td>
                <td><?= $nama_kategori; ?></td>
                <td><?= $surat_selesai['prodi']; ?></td>
                <td><?= $surat_selesai['nama_kampus']; ?></td>
            </tr>
        <?php endif; ?>
    <?php endif; ?>
</table>

<style>
    table.table-bordered {
        border-collapse: collapse;
        width: 100%;
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

<br>
<p style="text-align: justify;">telah menyelesaikan Magang pada tanggal <?= $jadwal['tanggal_mulai'] ?? '' ?> sd tanggal <?= $jadwal['tanggal_selesai'] ?? '' ?> di Dinas Komunikasi Informatika dan Persandian Kota Yogyakarta.</p>
<p style="text-align: justify;">Demikian surat keterangan ini kami sampaikan, atas perhatiannya kami ucapkan terima kasih.</p>
<br>
<table align="center">
    <tr>
        <td width="350"></td>
        <td width="150">
            <center>
                <font size="3">Yogyakarta, <?= $ubah_tanggal; ?></font>
            </center>
        </td>
    </tr>
    <tr>
        <td width="350">
            &nbsp;
        </td>
        <td width="150">
            <center>
                <font size="3">Hormat Kami,</font>
            </center>
        </td>
    </tr>
    <tr>
        <td width="350">
            &nbsp;
        </td>
        <td width="100">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td width="350">
            &nbsp;
        </td>
        <td width="100">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td width="350">
            &nbsp;
        </td>
        <td width="100">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td width="350">
            &nbsp;
        </td>

        <td width="150">
            <center>
                <font size="3">(.....................................)</font>
            </center>
        </td>
    </tr>