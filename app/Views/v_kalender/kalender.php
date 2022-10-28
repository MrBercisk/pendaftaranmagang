<!DOCTYPE html>
<html>
<head>
    <title>CodeIgniter 4 Fullcalender Tutorial - Online Web Tutor</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!--fullcalendar plugin files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    
    <!-- for plugin notification -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
  
<div class="container">
    <h3 style="text-align: center">CodeIgniter 4 Fullcalendar Tutorial - Online Web Tutor</h3>
    <div id="calendar"></div>
</div>
   
<script>
  var site_url = "<?= site_url() ?>";
</script>

<?= script_tag('script.js') ?>
  
</body>
</html>