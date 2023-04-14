<style>
  .font_laporan{
    font-size:9px;
    font-family: 'arial';
  }
  table {
    
    border-collapse: collapse;
    width:100%;
}
table td, th {
    border: 0.01em solid ;
    padding:3px;
}

  .header{
    font-weight:bold;
    text-align : center;
  }


  .logo{
   float:left;
   width : 60px;
  }
  .skpd{
   float:right;
   
  }
  .clearfix{
   clear:both;
   
  }
  .kop{
   text-align:center;
   font-family: 'arial';
  }
  .penutup{
    font-size:6px;
  }
  .copyright{
    font-size:7px;
    float:left;
  }
  .page{
    float:right;
    font-size:7px;
  }
  .pemprov_sumbar{
    font-size:20px;
  }
  .garis_kop1{
    margin-top:5px;
    border-width: 1.6px;
      border-style: solid;
  }
  .garis_kop2{
    margin-top:1px;
    border-width: 1px;
      border-style: solid;
  }
  .judul_laporan{
    margin-top:15px;
    text-align : center;
    font-family: 'arial';
    font-size:10px;
  }
  .nama_kegiatan{
    white-space:pre;
    left: 30px;
  }
</style>

<head>
  <title><?php echo $title ?></title>
</head>


<body>

<table class="font_laporan border">
 <thead class="header">
    <tr>
    <th rowspan="3"  width="30px">No</th>
    <th rowspan="3" style="width:350px">Program, Kegiatan, Sub Kegiatan</th>
    <th rowspan="3" style="width:80px">Pagu</th>
    <th rowspan="2" colspan="5">Sumber Dana (Rp.)</th>
    <th rowspan="2" colspan="2">Target </th>
    <th colspan="3" >Realisasi</th>
    <th rowspan="2" colspan="2">Deviasi</th>

   
  </tr>
  <tr>
    <th colspan="2">Keuangan</th>
    <th rowspan="2" style="width:32px">Fisik <br>%</th>  
  </tr>
  <tr>
    <th style="width:80px">DAU</th>
    <th style="width:80px">DBK</th>
    <th style="width:80px">PAD</th>
    <th style="width:80px">DBH</th>
    <th style="width:80px">Lainnya</th>
    <th style="width:32px">Fisik</th>
    <th style="width:32px">Keu</th>
    <th style="width:80px">Rp</th>
    <th style="width:32px">%</th>
    <th style="width:35px">F</th>
    <th style="width:35px">K</th>
  
  </tr>
 </thead>
 <!-- <tbody> -->
   <?php 
  $no_program   = 0;
  $pagu_program   = 0;
  $total_pad    = 0;
  $total_dau    = 0;
  $total_dak    = 0;
  $total_dbh    = 0;
  $total_lainnya  = 0;
  $total_target_fisik = 0;


  $total_angka_target_keuangan = 0 ; //05012021
  $total_angka_realisasi_keuangan = 0; //06012021
  $total_target_keuangan = 0;
  $total_realisasi_keuangan = 0;
  $total_persen_realisasi_keuangan = 0;
  $total_persen_realisasi_fisik = 0;
  $total_realisasi_ft = 0;
  $total_persen_deviasi_f = 0;
  $total_persen_deviasi_k = 0;
  $hitungdata = 0;
  foreach ($program as $key => $value) { 
    $no_program++;
    $pagu_program += $value->pagu;
    $kegiatan = $this->realisasi_akumulasi_model->get_kegiatan($id_instansi, $value->kode_rekening_program, $value->kode_bidang_urusan)->result(); ?>
    <tr>
      <td><?php echo $no_program ?></td>
       <td colspan="14" style="font-size:10px"><div><b><?php echo $value->nama_program ?></b></div></td>
     </tr>
    <?php 
    $no_kegiatan=0;
    foreach ($kegiatan as $key => $value_kegiatan) {
      $no_kegiatan++;
      $no_sub_kegiatan = 0;
        $sub_kegiatan = $this->realisasi_akumulasi_model->get_sub_kegiatan($id_instansi, $value_kegiatan->kode_rekening_kegiatan, $value_kegiatan->kode_rekening_program, $value_kegiatan->kode_bidang_urusan)->result();
    ?>
    <tr>
      <td><?php echo $no_program.'.'.$no_kegiatan ?></td>
       <td colspan="14" style="padding-left:1.5em" ><div class="nama_kegiatan"><b><?php echo $value_kegiatan->nama_kegiatan ?></b></div></td>
     </tr>
     <?php 
     foreach ($sub_kegiatan as $key => $value_sk) {
      $no_sub_kegiatan++;
      $kategori_sub_kegiatan = $value_sk->kategori;
          if($kategori_sub_kegiatan =='Unit Pelaksana'){
            $nama_sub_kegiatan = $value_sk->nama_sub_kegiatan."<br>[".$value_sk->jenis_sub_kegiatan.' - '.$value_sk->keterangan."]";
           
          }else{
            $nama_sub_kegiatan = $value_sk->nama_sub_kegiatan;
          }

          $sumber_dana = $this->realisasi_akumulasi_model->get_sumber_dana($id_instansi, $value_sk->kode_rekening_sub_kegiatan, $value_sk->kode_rekening_kegiatan, $value_sk->kode_rekening_program, $value_sk->kode_bidang_urusan)->row_array();




          $target = $this->realisasi_akumulasi_model->get_target($id_instansi, $value_sk->kode_rekening_sub_kegiatan, $bulan)->row_array();
          $realisasi_keuangan = $this->realisasi_akumulasi_model->get_realisasi_keuangan($id_instansi, $value_sk->kode_rekening_sub_kegiatan, $bulan, $ope)->row_array();

          if ($value_sk->pagu == 0) {
            $persen_target_keuangan   = 0;
            $persen_realisasi_keuangan  = 0;
          } else {
            $persen_target_keuangan     = round(($target['target_keuangan'] / $value_sk->pagu) * 100, 2);
            $persen_realisasi_keuangan  = round(($realisasi_keuangan['total_realisasi'] / $value_sk->pagu) * 100, 2);
          }




          $total_paket = $this->realisasi_akumulasi_model->get_total_paket($id_instansi, $value_sk->kode_rekening_sub_kegiatan)->num_rows();
          $jenis_rutin = $this->realisasi_akumulasi_model->get_total_paket_perjenis($id_instansi, $value_sk->kode_rekening_sub_kegiatan, "RUTIN")->num_rows();
          $swa = $this->realisasi_akumulasi_model->get_realisasi_fisik($id_instansi, $value_sk->kode_rekening_sub_kegiatan, $bulan, 'SWAKELOLA', $ope)->row_array();
          $pen = $this->realisasi_akumulasi_model->get_realisasi_fisik($id_instansi, $value_sk->kode_rekening_sub_kegiatan, $bulan, 'PENYEDIA', $ope)->row_array();
          $rut = $jenis_rutin > 0 ? ($jenis_rutin * round($bulan / 12 * 100, 2)) : 0;
          $total_angka_target_keuangan += $target['target_keuangan'];

          $swa_tot  = !empty($swa['total']) ? $swa['total'] : 0;
          $pen_tot  = !empty($pen['total']) ? $pen['total'] : 0;
          $rut_tot  = !empty($rut) ? $rut : 0;
          $pagu_opd = $this->realisasi_akumulasi_model->get_pagu_opd($id_instansi)->row_array();
          $tot_pagu = !empty($pagu_opd['pagu']) ? $pagu_opd['pagu'] : 0;

          if ($total_paket != 0) {
            $total_fisik = ROUND(($swa_tot + $pen_tot + $rut_tot) / $total_paket,2);
          } else {
            $total_fisik = 0;
          }

          $total_fisik    = ROUND($total_fisik, 2) > 100 ? 100 : ROUND($total_fisik, 2);
          $uang_fisik     = ($total_fisik / 100) * $value_sk->pagu;
          @$persen_fisik  = ($uang_fisik / $tot_pagu) * 100;
          $dev_fisik = $total_fisik - $target['target_fisik'];
          $dev_keu = $persen_realisasi_keuangan - $persen_target_keuangan;


            if ($dev_fisik < -10) {
              $warna_peringatan_dev_fisik = 'background: #f8b2b2'; 
            }
            elseif ($dev_fisik <-5  && $dev_fisik >-10) {
              $warna_peringatan_dev_fisik = 'background: #fcf3cf';
            }else{
              $warna_peringatan_dev_fisik = 'background: #d5f5e3';
            }

            if ($dev_keu < -10) {
              $warna_peringatan_dev_keu = 'background: #f8b2b2'; 
            }
            elseif ($dev_keu <-5  && $dev_keu >-10) {
              $warna_peringatan_dev_keu = 'background: #fcf3cf';
            }else{
              $warna_peringatan_dev_keu = 'background: #d5f5e3';
            }

          $total_pad    += isset($sumber_dana['pad']) ? $sumber_dana['pad'] : 0;
          $total_dau    += isset($sumber_dana['dau']) ? $sumber_dana['dau'] : 0;
          $total_dak    += isset($sumber_dana['dak']) ? $sumber_dana['dak'] : 0;
          $total_dbh    += isset($sumber_dana['dbh']) ? $sumber_dana['dbh'] : 0;
          $total_lainnya  += isset($sumber_dana['lainnya']) ? $sumber_dana['lainnya'] : 0;
          $total_target_fisik   += isset($target['target_fisik']) ? $target['target_fisik'] : 0;
          // last update 09102020
          $total_target_keuangan += isset($persen_target_keuangan) ? $persen_target_keuangan : 0;
          $total_realisasi_keuangan += isset($realisasi_keuangan['total_realisasi']) ? $realisasi_keuangan['total_realisasi'] : 0;
          $total_persen_realisasi_keuangan += isset($persen_realisasi_keuangan) ? $persen_realisasi_keuangan : 0;
          $total_persen_realisasi_fisik += isset($total_fisik) ? $total_fisik : 0;
          $total_realisasi_ft += isset($persen_fisik) ? ROUND($persen_fisik, 2) : 0;
          $total_persen_deviasi_f += isset($dev_fisik) ? ROUND($dev_fisik, 2) : 0;
          $total_persen_deviasi_k += isset($dev_keu) ? ROUND($dev_keu, 2) : 0;








          $totaldata = $this->realisasi_akumulasi_model->jumlah_kegiatan($id_instansi);
          // dijadikan untuk rata rata pada target fisik, target keuangan, realisasi keuangan % , realisasi fisik, realisasi fisik tertimbang (FT), deviasi fisik, deviasi keuangan, 
          @$ratarata_target_fisik = $total_target_fisik / $totaldata;
          // $ratarata_target_keuangan = $total_target_keuangan / $totaldata;
          @$ratarata_target_keuangan = ($total_angka_target_keuangan / $pagu_program) * 100; // $totaldata;



          @$ratarata_persen_realisasi_keuangan = ($total_realisasi_keuangan / $pagu_program) * 100;
          // $ratarata_persen_realisasi_keuangan = $total_persen_realisasi_keuangan/$totaldata;

          @$ratarata_persen_realisasi_fisik = $total_persen_realisasi_fisik / $totaldata;
          @$ratarata_persen_realisasi_ft = $total_realisasi_ft / $totaldata;



          $total_persen_deviasi_f = $ratarata_persen_realisasi_fisik - $ratarata_target_fisik ;
          $total_persen_deviasi_k = $ratarata_persen_realisasi_keuangan- $ratarata_target_keuangan ;


      ?>
      <tr>
      <td><?php echo $no_program.'.'.$no_kegiatan.'.'.$no_sub_kegiatan ?></td>
       <td style="padding-left:3em"><div><?php echo $nama_sub_kegiatan ?></div></td>
       <td align="right"><?php echo number_format($value_sk->pagu) ?></td>
       <td align="right"><?php echo number_format(isset($sumber_dana['pad']) ? $sumber_dana['pad'] : 0) ?></td>
       <td align="right"><?php echo number_format(isset($sumber_dana['dau']) ? $sumber_dana['dau'] : 0) ?></td>
       <td align="right"><?php echo number_format(isset($sumber_dana['dak']) ? $sumber_dana['dak'] : 0) ?></td>
       <td align="right"><?php echo number_format(isset($sumber_dana['dbh']) ? $sumber_dana['dbh'] : 0) ?></td>
       <td align="right"><?php echo number_format(isset($sumber_dana['lainnya']) ? $sumber_dana['lainnya'] : 0) ?></td>
       <td align="center"><?php echo $target['target_fisik'] =='' ? 0: $target['target_fisik'] ?></td>
       <td align="center"><?php echo $persen_target_keuangan ?></td>
       <td align="right"><?php echo number_format($realisasi_keuangan['total_realisasi']) ?></td>
       <td align="center"><?php echo round($persen_realisasi_keuangan,2) ?></td>
       <td align="center"><?php echo $total_fisik ?></td>
       <td align="center" style="<?php echo $warna_peringatan_dev_fisik ?>"><?php echo ROUND($dev_fisik, 2) ?></td>
       <td align="center" style="<?php echo $warna_peringatan_dev_keu ?>"><?php echo ROUND($dev_keu, 2) ?></td>
     </tr>
  <?php 
        } //akhir foreach ($sub_kegiatan as $key => $value_sk)
      } //akhir foreach ($kegiatan as $key => $value_kegiatan) 
    } //akhir foreach ($program as $key => $value) { 
?>
 <!-- </tbody> -->


   <tr>
     <td colspan="2" align="right">Total</td>
     <td align="right"><?php echo number_format($pagu_program) ?></td>
     <td align="right"><?php echo number_format($total_pad) ?></td>
     <td align="right"><?php echo number_format($total_dau) ?></td>
     <td align="right"><?php echo number_format($total_dak) ?></td>
     <td align="right"><?php echo number_format($total_dbh) ?></td>
     <td align="right"><?php echo number_format($total_lainnya) ?></td>
     <td align="center"><?php echo number_format($ratarata_target_fisik, 2, '.', '') ?></td>
     <td align="center"><?php echo number_format($ratarata_target_keuangan, 2, '.', '') ?></td>
     <td align="right"><?php echo number_format($total_realisasi_keuangan) ?></td>
     <td align="center"><?php echo number_format($ratarata_persen_realisasi_keuangan, 2, '.', '') ?></td>
     <td align="center"><?php echo number_format($ratarata_persen_realisasi_fisik, 2, '.', '') ?></td>
     <td align="center"><?php echo number_format($total_persen_deviasi_f, 2, '.', '') ?></td>
     <td align="center"><?php echo number_format($total_persen_deviasi_k, 2, '.', '') ?></td>
   </tr>

</table>
</body>