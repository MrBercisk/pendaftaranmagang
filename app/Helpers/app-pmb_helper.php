<?php 

// Fungsi untuk mengubah format tanggal mejadi format tanggal Indonesia
function tgl_indonesia($tgl){ 
    $tanggal = substr($tgl,8,2);
    $nama_bulan = array("Januari", "Februari", "Maret", "April", "Mei", 
            "Juni", "Juli", "Agustus", "September", 
            "Oktober", "November", "Desember");
    $bulan = $nama_bulan[substr($tgl,5,2) - 1];
    $tahun = substr($tgl,0,4);
    return $tanggal.' '.$bulan.' '.$tahun;       
}

// Fungsi untuk mengubah susunan format tanggal dari form ke database 
function ubah_tgl1($tanggal) { 
   $pisah   = explode('/',$tanggal);
   $larik   = array($pisah[2],$pisah[0],$pisah[1]);
   $satukan = implode('-',$larik);
   return $satukan;
}

// Fungsi untuk mengubah susunan format tanggal dari database ke form
function ubah_tgl2($tanggal) { 
   $pisah   = explode('-',$tanggal);
   $larik   = array($pisah[1],$pisah[2],$pisah[0]);
   $satukan = implode('/',$larik);
   return $satukan;
}

// fungsi untuk menghitung jumlah 
function hitungData($table){
   $db = \config\Database::connect();
   return $db->table($table)->countAllResults();
}

// fungsi untuk menghitung jumlah pendaftar dengan status_verifikasi "Diterima"
function hitungDataDiterima($table){
   $db = \config\Database::connect();
   return $db->table($table)->where('status_verifikasi', 'Diterima')->countAllResults();
}

function hitungDataKampus($table, $nama_kampus = null){
   $db = \config\Database::connect();
   
   if($nama_kampus && $nama_kampus == 'UBSI'){
      $db->table($table)->where('nama_kampus', $nama_kampus);
   }
   
   return $db->table($table)->countAllResults();
}


