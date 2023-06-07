<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Nilai Magang Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            font-size: 10px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            border: 1px solid #dddddd;
            text-align: left;
            word-wrap: break-word;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h2>Data Nilai Magang Mahasiswa</h2>
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Nama Kampus</th>
                    <th>Ketepatan Waktu</th>
                    <th>Kehadiran</th>
                    <th>Kemampuan Kerja</th>
                    <th>Kualitas Kerja</th>
                    <th>Kerjasama</th>
                    <th>Inisiatif</th>
                    <th>Rasa Percaya</th>
                    <th>Penampilan</th>
                    <th>Patuh Aturan PKL</th>
                    <th>Tanggung Jawab</th>
                    <th>Rata-rata</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <?php foreach ($row as $cell): ?>
                            <td><?php echo $cell; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
