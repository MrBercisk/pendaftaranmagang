<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="http://localhost/diskominfosan/public/assets/logo.png">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/adminlte3/plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="/assets/adminlte3/plugins/daterangepicker/daterangepicker.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="/assets/adminlte3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="/assets/adminlte3/plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/assets/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/assets/adminlte3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="/assets/adminlte3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/assets/adminlte3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/adminlte3/dist/css/adminlte.min.css">
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.6/index.global.min.js'></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        initialDate: new Date(),
        editable: false,
        locale: 'id', // set bahasa ke bahasa Indonesia
        eventLimit: true,
        events: [
          <?php foreach ($events as $event) { ?> {
              title: '<?php echo substr($event->jam_bimbingan, 0, 5); ?> <?php echo $event->nama_peserta; ?> - <?php echo $event->judul; ?>',
              start: '<?php echo $event->tanggal_bimbingan; ?>',
              extendedProps: {
                id: '<?php echo $event->id; ?>',
                nama_peserta: '<?php echo $event->nama_peserta; ?>',
                judul: '<?php echo $event->judul; ?>',
                tanggal_mulai: '<?php echo $event->tanggal_mulai; ?>',
                tanggal_selesai: '<?php echo $event->tanggal_selesai; ?>',
                jam_bimbingan: '<?php echo $event->jam_bimbingan; ?>',
                tanggal_bimbingan: '<?php echo $event->tanggal_bimbingan; ?>',
              },
            },
          <?php } ?>
        ],

        // tambahkan kode styling berikut
        eventColor: 'linear-gradient(to bottom right, #008080, #42a895)', // set warna event
        eventTextColor: '#FFFFFF', // set warna teks event
        // tambahkan tindakan eventClick untuk menampilkan detail pada setiap event
        eventClick: function(info) {
          var event = info.event;
          var detail = "<div style='background-color: #FFFFFF; border-radius: 10px; padding: 10px;'>" +
            "<div style='font-weight: bold;'>" + event.extendedProps.jam_bimbingan + " - " + event.extendedProps.tanggal_bimbingan + " - " + event.extendedProps.nama_peserta + " - " + event.extendedProps.judul + "</div>" +
            "<div><p>Tanggal Mulai dan Tanggal Selesai</p>" + event.extendedProps.tanggal_mulai + " - " + event.extendedProps.tanggal_selesai + "</div>" +
            "</div>";
          // tampilkan detail pada dialog sweetalert
          Swal.fire({
            title: 'Detail Kegiatan',
            html: detail,
            icon: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok',
          });
        },
      });
      calendar.render();
    });
  </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?= $this->include('layouts_magang/navbar') ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->include('layouts_magang/sidebar') ?>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->renderSection('content') ?>
    <!-- /.content-wrapper -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
      <div class="container py-4">
        
      </div>
    </footer><!-- End Footer -->

  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="/assets/adminlte3/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="/assets/adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- InputMask -->
  <script src="/assets/adminlte3/plugins/moment/moment.min.js"></script>
  <script src="/assets/adminlte3/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <!-- date-range-picker -->
  <script src="/assets/adminlte3/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- SweetAlert2 -->
  <script src="/assets/adminlte3/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- chart js -->
  <script src="/assets/adminlte3/plugins/chart.js/Chart.min.js"></script>
  <!-- Toastr -->
  <script src="/assets/adminlte3/plugins/toastr/toastr.min.js"></script>
  <!-- DataTables -->
  <script src="/assets/adminlte3/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/assets/adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/assets/adminlte3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="/assets/adminlte3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="/assets/adminlte3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="/assets/adminlte3/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/assets/adminlte3/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="/assets/adminlte3/dist/js/demo.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.0/chart.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const chart = Highcharts.chart('container', {
        chart: {
          type: 'column'
        },
        title: {
          text: 'Kampus Pendaftar'
        },
        xAxis: {
          categories: ['UBSI', 'UGM', 'UNY']
        },
        yAxis: {
          title: {
            text: 'Nama Kampus'
          }
        },
        series: [{
          name: 'Lulus',
          data: [1, 2, 4]
        }, {
          name: 'Tidak Lulus',
          data: [5, 7, 3]
        }]
      });
    });
  </script>
  <!-- page script -->
  <?= $this->renderSection('script') ?>
</body>

</html>