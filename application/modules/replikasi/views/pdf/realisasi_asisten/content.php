<style>
  .font_laporan{
    font-size:9px;
    font-family: 'arial';
  }
  .laporan_asisten{
   
    border-collapse: collapse;
    width:100%;
  }
 
table td, th {
    border: 0.01em solid ;
    padding:3px;

}

  .tabel_header{
    font-weight:bold;
    text-align : center;
    font-size:9px;

  }

  .rata_kanan{
    text-align : right;

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
</style>

<?php 
  $total_peringatan_dev_fisik_merah = 0;
   $total_peringatan_dev_fisik_kuning = 0;
   $total_peringatan_dev_fisik_hijau = 0;
   $total_peringatan_dev_keu_merah = 0;
   $total_peringatan_dev_keu_kuning = 0;
   $total_peringatan_dev_keu_hijau = 0;
    ?>

<div style="width:33.33%; float:left">
  <table class="font_laporan laporan_asisten">
    <thead class="tabel_header">      
      <tr class="tabel_header">
        <th rowspan="2">ASISTEN PEMERINTAHAN DAN KESRA</th>
        <th colspan="3">Fisik</th>
        <th colspan="3">Keuangan</th>
      </tr>
      <tr>
        <th style="width:33px">T</th>
        <th style="width:33px">R</th>
        <th style="width:33px">D</th>
        <th style="width:33px">T</th>
        <th style="width:33px">R</th>
        <th style="width:33px">D</th>
      </tr>
    </thead>
    <tbody >
      <?php
          $tertimbang_satu       = 0;
          $total_t_fisik_satu    = 0;
          $total_t_keu_satu      = 0;
          $total_r_fisik_satu    = 0;
          $total_r_keu_satu      = 0;
          $total_tertimbang_satu = 0;
          $jml_skpd_satu         = 0;
       foreach ($asisten_1 as $satu) { 



        $dev_fisik = round($satu->realisasi_fisik -$satu->target_fisik ,2);
          $dev_keu = round($satu->realisasi_keuangan - $satu->target_keuangan,2);


            if ($dev_fisik < -10) {
              $warna_peringatan_dev_fisik = 'background: #f8b2b2'; 
              $total_peringatan_dev_fisik_merah += 1; 
            }
            elseif ($dev_fisik <-5  && $dev_fisik >-10) {
              $warna_peringatan_dev_fisik = 'background: #fcf3cf';
              $total_peringatan_dev_fisik_kuning += 1; 
            }else{
              $warna_peringatan_dev_fisik = 'background: #d5f5e3';
              $total_peringatan_dev_fisik_hijau += 1; 
            }

            if ($dev_keu < -10) {
              $warna_peringatan_dev_keu = 'background: #f8b2b2'; 
              $total_peringatan_dev_keu_merah += 1; 
            }
            elseif ($dev_keu <-5  && $dev_keu >-10) {
              $warna_peringatan_dev_keu = 'background: #fcf3cf';
              $total_peringatan_dev_keu_kuning += 1; 
            }else{
              $warna_peringatan_dev_keu = 'background: #d5f5e3';
              $total_peringatan_dev_keu_hijau += 1; 
            }


            $total_t_fisik_satu    += $satu->target_fisik;
            $total_t_keu_satu      += $satu->target_keuangan;
            $total_r_fisik_satu    += $satu->realisasi_fisik;
            $total_r_keu_satu      += $satu->realisasi_keuangan;
            $jml_skpd_satu++;
        


            $show_tf = $satu->target_fisik;
            $show_tk = $satu->target_keuangan;
            $show_rf = $satu->realisasi_fisik == '' ? 0 : $satu->realisasi_fisik;
            $show_rk = $satu->realisasi_keuangan == '' ? 0 :  $satu->realisasi_keuangan;


            $pisah_decimal_show_tf = explode('.', $satu->target_fisik);
            $pisah_decimal_show_tk = explode('.', $satu->target_keuangan);
            $pisah_decimal_show_rf = explode('.', $show_rf);
            $pisah_decimal_show_rk = explode('.', $show_rk);
            $pisah_decimal_dev_fisik = explode('.', $dev_fisik);
            $pisah_decimal_dev_keu = explode('.', $dev_keu);

            $digit_show_tf = count($pisah_decimal_show_tk);
            $digit_show_tk = count($pisah_decimal_show_tf);
            $digit_show_rf = count($pisah_decimal_show_rf);
            $digit_show_rk = count($pisah_decimal_show_rk);
            $digit_dev_fisik = count($pisah_decimal_dev_fisik);
            $digit_dev_keu = count($pisah_decimal_dev_keu);

            // Fisik
            if ($digit_show_tf>1) {
              $didepan_koma_tf = $pisah_decimal_show_tf[0] ; 
              $dibelakang_koma_tf = strlen($pisah_decimal_show_tf[1]) >1 ? $pisah_decimal_show_tf[1] : $pisah_decimal_show_tf[1].'0';
              $hasil_tf = $didepan_koma_tf.'.'.$dibelakang_koma_tf;
            }else{
              $hasil_tf = $show_tf.'.00';
            }

            if ($digit_show_rf>1) {
              $didepan_koma_rf = $pisah_decimal_show_rf[0] ; 
              $dibelakang_koma_rf = strlen($pisah_decimal_show_rf[1]) >1 ? $pisah_decimal_show_rf[1] : $pisah_decimal_show_rf[1].'0';
              $hasil_rf = $didepan_koma_rf.'.'.$dibelakang_koma_rf;
            }else{
              $hasil_rf = $show_rf.'.00';
            }

            if ($digit_dev_fisik>1) {
              $didepan_koma_dev_fisik = $pisah_decimal_dev_fisik[0] ; 
              $dibelakang_koma_dev_fisik = strlen($pisah_decimal_dev_fisik[1]) >1 ? $pisah_decimal_dev_fisik[1] : $pisah_decimal_dev_fisik[1].'0';
              $hasil_dev_fisik = $didepan_koma_dev_fisik.'.'.$dibelakang_koma_dev_fisik;
            }else{
              $hasil_dev_fisik = $dev_fisik.'.00';
            }

            // keuangan
            if ($digit_show_tk>1) {
              $didepan_koma_tk = $pisah_decimal_show_tk[0] ; 
              $dibelakang_koma_tk = strlen($pisah_decimal_show_tk[1]) >1 ? $pisah_decimal_show_tk[1] : $pisah_decimal_show_tk[1].'0';
              $hasil_tk = $didepan_koma_tk.'.'.$dibelakang_koma_tk;
            }else{
              $hasil_tk = $show_tk.'.00';
            }

            if ($digit_show_rk>1) {
              $didepan_koma_rk = $pisah_decimal_show_rk[0] ; 
              $dibelakang_koma_rk = strlen($pisah_decimal_show_rk[1]) >1 ? $pisah_decimal_show_rk[1] : $pisah_decimal_show_rk[1].'0';
              $hasil_rk = $didepan_koma_rk.'.'.$dibelakang_koma_rk;
            }else{
              $hasil_rk = $show_rk.'.00';
            }

            if ($digit_dev_keu>1) {
              $didepan_koma_dev_keu = $pisah_decimal_dev_keu[0] ; 
              $dibelakang_koma_dev_keu = strlen($pisah_decimal_dev_keu[1]) >1 ? $pisah_decimal_dev_keu[1] : $pisah_decimal_dev_keu[1].'0';
              $hasil_dev_keu = $didepan_koma_dev_keu.'.'.$dibelakang_koma_dev_keu;
            }else{
              $hasil_dev_keu = $dev_keu.'.00';
            }


            if ($hasil_dev_fisik!='0.00') {
              $blok = 'style="background: #eeeefe "';
            }else{
              $blok = '';

            }
        ?>
         <tr <?php echo $blok ?>>
          <td><?php echo $satu->nama_instansi ?></td>
          <td class="rata_kanan"><?php echo $hasil_tf ?></td>
          <td class="rata_kanan"><?php echo $hasil_rf ?></td>
          <td class="rata_kanan" style="<?php echo $warna_peringatan_dev_fisik ?>"><?php echo $hasil_dev_fisik ?></td>
          <td class="rata_kanan"><?php echo $hasil_tk ?></td>
          <td class="rata_kanan"><?php echo $hasil_rk ?></td>
          <td class="rata_kanan" style="<?php echo $warna_peringatan_dev_keu ?>"><?php echo $hasil_dev_keu?></td>
        
        </tr>


       <?php } 
          @$ratarata_t_fisik_satu    =  round($total_t_fisik_satu / $jml_skpd_satu, 2); 
          @$ratarata_r_fisik_satu   =  round($total_r_fisik_satu / $jml_skpd_satu, 2); 
          @$total_dev_fisik_satu = $ratarata_r_fisik_satu - $ratarata_t_fisik_satu ;
          @$ratarata_t_keu_satu   =  round($total_t_keu_satu / $jml_skpd_satu, 2); 
          @$ratarata_r_keu_satu   =  round($total_r_keu_satu / $jml_skpd_satu, 2);
          @$total_dev_keu_satu = $ratarata_r_keu_satu - $ratarata_t_keu_satu ;



            if ($total_dev_fisik_satu < -10) {
              $warna_peringatan_total_dev_fisik = 'background: #f8b2b2'; 
            }
            elseif ($total_dev_fisik_satu <-5  && $total_dev_fisik_satu >-10) {
              $warna_peringatan_total_dev_fisik = 'background: #fcf3cf';
            }else{
              $warna_peringatan_total_dev_fisik = 'background: #d5f5e3';
            }

            if ($total_dev_keu_satu < -10) {
              $warna_peringatan_total_dev_keu = 'background: #f8b2b2'; 
            }
            elseif ($total_dev_keu_satu <-5  && $total_dev_keu_satu >-10) {
              $warna_peringatan_total_dev_keu = 'background: #fcf3cf';
            }else{
              $warna_peringatan_total_dev_keu = 'background: #d5f5e3';
            }



            $show_total_tf = $ratarata_t_fisik_satu;
            $show_total_rf = $ratarata_r_fisik_satu;
            $show_total_tk = $ratarata_t_keu_satu;
            $show_total_rk = $ratarata_r_keu_satu;


            $pisah_decimal_show_total_tf = explode('.', $show_total_tf);
            $pisah_decimal_show_total_tk = explode('.', $show_total_tk);
            $pisah_decimal_show_total_rf = explode('.', $show_total_rf);
            $pisah_decimal_show_total_rk = explode('.', $show_total_rk);

            $pisah_decimal_total_dev_fisik = explode('.', $total_dev_fisik_satu);
            $pisah_decimal_total_dev_keu = explode('.', $total_dev_keu_satu);

            $digit_show_total_tf = count($pisah_decimal_show_total_tf);
            $digit_show_total_tk = count($pisah_decimal_show_total_tk);
            $digit_show_total_rf = count($pisah_decimal_show_total_rf);
            $digit_show_total_rk = count($pisah_decimal_show_total_rk);

            $digit_total_dev_fisik = count($pisah_decimal_total_dev_fisik);
            $digit_total_dev_keu = count($pisah_decimal_total_dev_keu);



            if ($digit_show_total_tf>1) {
              $didepan_koma_total_tf = $pisah_decimal_show_total_tf[0] ; 
              $dibelakang_koma_total_tf = strlen($pisah_decimal_show_total_tf[1]) >1 ? $pisah_decimal_show_total_tf[1] : $pisah_decimal_show_total_tf[1].'0';
              $hasil_total_tf = $didepan_koma_total_tf.'.'.$dibelakang_koma_total_tf;
            }else{
              $hasil_total_tf = $show_total_tf.'.00';
            }

            if ($digit_show_total_rf>1) {
              $didepan_koma_total_rf = $pisah_decimal_show_total_rf[0] ; 
              $dibelakang_koma_total_rf = strlen($pisah_decimal_show_total_rf[1]) >1 ? $pisah_decimal_show_total_rf[1] : $pisah_decimal_show_total_rf[1].'0';
              $hasil_total_rf = $didepan_koma_total_rf.'.'.$dibelakang_koma_total_rf;
            }else{
              $hasil_total_rf = $show_total_rf.'.00';
            }

            if ($digit_total_dev_fisik>1) {
              $didepan_koma_total_dev_fisik = $pisah_decimal_total_dev_fisik[0] ; 
              $dibelakang_koma_total_dev_fisik = strlen($pisah_decimal_total_dev_fisik[1]) >1 ? $pisah_decimal_total_dev_fisik[1] : $pisah_decimal_total_dev_fisik[1].'0';
              $hasil_total_dev_fisik = $didepan_koma_total_dev_fisik.'.'.$dibelakang_koma_total_dev_fisik;
            }else{
              $hasil_total_dev_fisik = $total_dev_fisik_satu.'.00';
            }


            if ($digit_show_total_tk>1) {
              $didepan_koma_total_tk = $pisah_decimal_show_total_tk[0] ; 
              $dibelakang_koma_total_tk = strlen($pisah_decimal_show_total_tk[1]) >1 ? $pisah_decimal_show_total_tk[1] : $pisah_decimal_show_total_tk[1].'0';
              $hasil_total_tk = $didepan_koma_total_tk.'.'.$dibelakang_koma_total_tk;
            }else{
              $hasil_total_tk = $show_total_tk.'.00';
            }

            if ($digit_show_total_rk>1) {
              $didepan_koma_total_rk = $pisah_decimal_show_total_rk[0] ; 
              $dibelakang_koma_total_rk = strlen($pisah_decimal_show_total_rk[1]) >1 ? $pisah_decimal_show_total_rk[1] : $pisah_decimal_show_total_rk[1].'0';
              $hasil_total_rk = $didepan_koma_total_rk.'.'.$dibelakang_koma_total_rk;
            }else{
              $hasil_total_rk = $show_total_rk.'.00';
            }

            if ($digit_total_dev_keu>1) {
              $didepan_koma_total_dev_keu = $pisah_decimal_total_dev_keu[0] ; 
              $dibelakang_koma_total_dev_keu = strlen($pisah_decimal_total_dev_keu[1]) >1 ? $pisah_decimal_total_dev_keu[1] : $pisah_decimal_total_dev_keu[1].'0';
              $hasil_total_dev_keu = $didepan_koma_total_dev_keu.'.'.$dibelakang_koma_total_dev_keu;
            }else{
              $hasil_total_dev_keu = $total_dev_keu_satu.'.00';
            }





          ?>
    </tbody>
    <tfoot>
      <?php if (count($asisten_1)==0) { ?>
      <tr>
        <td colspan="7"><b>Belum Ada Data</b></td>
       
      </tr>
      <?php }else{ ?>
      <tr>
        <td><b>Rata -Rata</b></td>
        <td class="rata_kanan"><?php echo $hasil_total_tf; ?></td>
        <td class="rata_kanan"><?php echo $hasil_total_rf; ?></td>
        <td class="rata_kanan" style="<?php echo $warna_peringatan_total_dev_fisik ?>"><?php echo $hasil_total_dev_fisik ?></td>
        <td class="rata_kanan"><?php echo $hasil_total_tk ?></td>
        <td class="rata_kanan"><?php echo $hasil_total_rk ?></td>
       <td class="rata_kanan" style="<?php echo $warna_peringatan_total_dev_keu ?>"><?php echo $hasil_total_dev_keu ?></td>
      </tr>
    <?php } ?>
    </tfoot>
   
  </table>
</div>

<div style="width:33.33%; float:left">
  <table class="font_laporan laporan_asisten">
    <thead class="tabel_header">      
      <tr class="tabel_header">
        <th rowspan="2">ASISTEN PEREKONOMIAN DAN PEMBANGUNAN</th>
        <th colspan="3">Fisik</th>
        <th colspan="3">Keuangan</th>
      </tr>
      <tr>
        <th style="width:33px">T</th>
        <th style="width:33px">R</th>
        <th style="width:33px">D</th>
        <th style="width:33px">T</th>
        <th style="width:33px">R</th>
        <th style="width:33px">D</th>
      </tr>
    </thead>
    <tbody >
      <?php
          $tertimbang_dua       = 0;
          $total_t_fisik_dua    = 0;
          $total_t_keu_dua      = 0;
          $total_r_fisik_dua    = 0;
          $total_r_keu_dua      = 0;
          $total_tertimbang_dua = 0;
          $jml_skpd_dua         = 0;
       foreach ($asisten_2 as $dua) { 



        $dev_fisik = round($dua->realisasi_fisik -$dua->target_fisik ,2);
          $dev_keu = round($dua->realisasi_keuangan - $dua->target_keuangan,2);


            if ($dev_fisik < -10) {
              $warna_peringatan_dev_fisik = 'background: #f8b2b2'; 
              $total_peringatan_dev_fisik_merah += 1; 
            }
            elseif ($dev_fisik <-5  && $dev_fisik >-10) {
              $warna_peringatan_dev_fisik = 'background: #fcf3cf';
              $total_peringatan_dev_fisik_kuning += 1; 
            }else{
              $warna_peringatan_dev_fisik = 'background: #d5f5e3';
              $total_peringatan_dev_fisik_hijau += 1; 
            }

            if ($dev_keu < -10) {
              $warna_peringatan_dev_keu = 'background: #f8b2b2'; 
              $total_peringatan_dev_keu_merah += 1; 
            }
            elseif ($dev_keu <-5  && $dev_keu >-10) {
              $warna_peringatan_dev_keu = 'background: #fcf3cf';
              $total_peringatan_dev_keu_kuning += 1; 
            }else{
              $warna_peringatan_dev_keu = 'background: #d5f5e3';
              $total_peringatan_dev_keu_hijau += 1; 
            }


            $total_t_fisik_dua    += $dua->target_fisik;
            $total_t_keu_dua      += $dua->target_keuangan;
            $total_r_fisik_dua    += $dua->realisasi_fisik;
            $total_r_keu_dua      += $dua->realisasi_keuangan;
            $jml_skpd_dua++;
        


            $show_tf = $dua->target_fisik;
            $show_tk = $dua->target_keuangan;
            $show_rf = $dua->realisasi_fisik == '' ? 0 : $dua->realisasi_fisik;
            $show_rk = $dua->realisasi_keuangan == '' ? 0 :  $dua->realisasi_keuangan;


            $pisah_decimal_show_tf = explode('.', $dua->target_fisik);
            $pisah_decimal_show_tk = explode('.', $dua->target_keuangan);
            $pisah_decimal_show_rf = explode('.', $show_rf);
            $pisah_decimal_show_rk = explode('.', $show_rk);
            $pisah_decimal_dev_fisik = explode('.', $dev_fisik);
            $pisah_decimal_dev_keu = explode('.', $dev_keu);

            $digit_show_tf = count($pisah_decimal_show_tk);
            $digit_show_tk = count($pisah_decimal_show_tf);
            $digit_show_rf = count($pisah_decimal_show_rf);
            $digit_show_rk = count($pisah_decimal_show_rk);
            $digit_dev_fisik = count($pisah_decimal_dev_fisik);
            $digit_dev_keu = count($pisah_decimal_dev_keu);

            // Fisik
            if ($digit_show_tf>1) {
              $didepan_koma_tf = $pisah_decimal_show_tf[0] ; 
              $dibelakang_koma_tf = strlen($pisah_decimal_show_tf[1]) >1 ? $pisah_decimal_show_tf[1] : $pisah_decimal_show_tf[1].'0';
              $hasil_tf = $didepan_koma_tf.'.'.$dibelakang_koma_tf;
            }else{
              $hasil_tf = $show_tf.'.00';
            }

            if ($digit_show_rf>1) {
              $didepan_koma_rf = $pisah_decimal_show_rf[0] ; 
              $dibelakang_koma_rf = strlen($pisah_decimal_show_rf[1]) >1 ? $pisah_decimal_show_rf[1] : $pisah_decimal_show_rf[1].'0';
              $hasil_rf = $didepan_koma_rf.'.'.$dibelakang_koma_rf;
            }else{
              $hasil_rf = $show_rf.'.00';
            }

            if ($digit_dev_fisik>1) {
              $didepan_koma_dev_fisik = $pisah_decimal_dev_fisik[0] ; 
              $dibelakang_koma_dev_fisik = strlen($pisah_decimal_dev_fisik[1]) >1 ? $pisah_decimal_dev_fisik[1] : $pisah_decimal_dev_fisik[1].'0';
              $hasil_dev_fisik = $didepan_koma_dev_fisik.'.'.$dibelakang_koma_dev_fisik;
            }else{
              $hasil_dev_fisik = $dev_fisik.'.00';
            }

            // keuangan
            if ($digit_show_tk>1) {
              $didepan_koma_tk = $pisah_decimal_show_tk[0] ; 
              $dibelakang_koma_tk = strlen($pisah_decimal_show_tk[1]) >1 ? $pisah_decimal_show_tk[1] : $pisah_decimal_show_tk[1].'0';
              $hasil_tk = $didepan_koma_tk.'.'.$dibelakang_koma_tk;
            }else{
              $hasil_tk = $show_tk.'.00';
            }

            if ($digit_show_rk>1) {
              $didepan_koma_rk = $pisah_decimal_show_rk[0] ; 
              $dibelakang_koma_rk = strlen($pisah_decimal_show_rk[1]) >1 ? $pisah_decimal_show_rk[1] : $pisah_decimal_show_rk[1].'0';
              $hasil_rk = $didepan_koma_rk.'.'.$dibelakang_koma_rk;
            }else{
              $hasil_rk = $show_rk.'.00';
            }

            if ($digit_dev_keu>1) {
              $didepan_koma_dev_keu = $pisah_decimal_dev_keu[0] ; 
              $dibelakang_koma_dev_keu = strlen($pisah_decimal_dev_keu[1]) >1 ? $pisah_decimal_dev_keu[1] : $pisah_decimal_dev_keu[1].'0';
              $hasil_dev_keu = $didepan_koma_dev_keu.'.'.$dibelakang_koma_dev_keu;
            }else{
              $hasil_dev_keu = $dev_keu.'.00';
            }

          if ($hasil_dev_fisik!='0.00') {
              $blok = 'style="background: #eeeefe "';
            }else{
              $blok = '';

            }
        ?>
         <tr <?php echo $blok ?>>
          <td><?php echo $dua->nama_instansi ?></td>
          <td class="rata_kanan"><?php echo $hasil_tf ?></td>
          <td class="rata_kanan"><?php echo $hasil_rf ?></td>
          <td class="rata_kanan" style="<?php echo $warna_peringatan_dev_fisik ?>"><?php echo $hasil_dev_fisik ?></td>
          <td class="rata_kanan"><?php echo $hasil_tk ?></td>
          <td class="rata_kanan"><?php echo $hasil_rk ?></td>
          <td class="rata_kanan" style="<?php echo $warna_peringatan_dev_keu ?>"><?php echo $hasil_dev_keu?></td>
        
        </tr>


       <?php } 
          @$ratarata_t_fisik_dua    =  round($total_t_fisik_dua / $jml_skpd_dua, 2); 
          @$ratarata_r_fisik_dua   =  round($total_r_fisik_dua / $jml_skpd_dua, 2); 
          @$total_dev_fisik_dua = $ratarata_r_fisik_dua - $ratarata_t_fisik_dua ;
          @$ratarata_t_keu_dua   =  round($total_t_keu_dua / $jml_skpd_dua, 2); 
          @$ratarata_r_keu_dua   =  round($total_r_keu_dua / $jml_skpd_dua, 2);
          @$total_dev_keu_dua = $ratarata_r_keu_dua - $ratarata_t_keu_dua ;



            if ($total_dev_fisik_dua < -10) {
              $warna_peringatan_total_dev_fisik = 'background: #f8b2b2'; 
            }
            elseif ($total_dev_fisik_dua <-5  && $total_dev_fisik_dua >-10) {
              $warna_peringatan_total_dev_fisik = 'background: #fcf3cf';
            }else{
              $warna_peringatan_total_dev_fisik = 'background: #d5f5e3';
            }

            if ($total_dev_keu_dua < -10) {
              $warna_peringatan_total_dev_keu = 'background: #f8b2b2'; 
            }
            elseif ($total_dev_keu_dua <-5  && $total_dev_keu_dua >-10) {
              $warna_peringatan_total_dev_keu = 'background: #fcf3cf';
            }else{
              $warna_peringatan_total_dev_keu = 'background: #d5f5e3';
            }



            $show_total_tf = $ratarata_t_fisik_dua;
            $show_total_rf = $ratarata_r_fisik_dua;
            $show_total_tk = $ratarata_t_keu_dua;
            $show_total_rk = $ratarata_r_keu_dua;


            $pisah_decimal_show_total_tf = explode('.', $show_total_tf);
            $pisah_decimal_show_total_tk = explode('.', $show_total_tk);
            $pisah_decimal_show_total_rf = explode('.', $show_total_rf);
            $pisah_decimal_show_total_rk = explode('.', $show_total_rk);

            $pisah_decimal_total_dev_fisik = explode('.', $total_dev_fisik_dua);
            $pisah_decimal_total_dev_keu = explode('.', $total_dev_keu_dua);

            $digit_show_total_tf = count($pisah_decimal_show_total_tf);
            $digit_show_total_tk = count($pisah_decimal_show_total_tk);
            $digit_show_total_rf = count($pisah_decimal_show_total_rf);
            $digit_show_total_rk = count($pisah_decimal_show_total_rk);

            $digit_total_dev_fisik = count($pisah_decimal_total_dev_fisik);
            $digit_total_dev_keu = count($pisah_decimal_total_dev_keu);



            if ($digit_show_total_tf>1) {
              $didepan_koma_total_tf = $pisah_decimal_show_total_tf[0] ; 
              $dibelakang_koma_total_tf = strlen($pisah_decimal_show_total_tf[1]) >1 ? $pisah_decimal_show_total_tf[1] : $pisah_decimal_show_total_tf[1].'0';
              $hasil_total_tf = $didepan_koma_total_tf.'.'.$dibelakang_koma_total_tf;
            }else{
              $hasil_total_tf = $show_total_tf.'.00';
            }

            if ($digit_show_total_rf>1) {
              $didepan_koma_total_rf = $pisah_decimal_show_total_rf[0] ; 
              $dibelakang_koma_total_rf = strlen($pisah_decimal_show_total_rf[1]) >1 ? $pisah_decimal_show_total_rf[1] : $pisah_decimal_show_total_rf[1].'0';
              $hasil_total_rf = $didepan_koma_total_rf.'.'.$dibelakang_koma_total_rf;
            }else{
              $hasil_total_rf = $show_total_rf.'.00';
            }

            if ($digit_total_dev_fisik>1) {
              $didepan_koma_total_dev_fisik = $pisah_decimal_total_dev_fisik[0] ; 
              $dibelakang_koma_total_dev_fisik = strlen($pisah_decimal_total_dev_fisik[1]) >1 ? $pisah_decimal_total_dev_fisik[1] : $pisah_decimal_total_dev_fisik[1].'0';
              $hasil_total_dev_fisik = $didepan_koma_total_dev_fisik.'.'.$dibelakang_koma_total_dev_fisik;
            }else{
              $hasil_total_dev_fisik = $total_dev_fisik_dua.'.00';
            }


            if ($digit_show_total_tk>1) {
              $didepan_koma_total_tk = $pisah_decimal_show_total_tk[0] ; 
              $dibelakang_koma_total_tk = strlen($pisah_decimal_show_total_tk[1]) >1 ? $pisah_decimal_show_total_tk[1] : $pisah_decimal_show_total_tk[1].'0';
              $hasil_total_tk = $didepan_koma_total_tk.'.'.$dibelakang_koma_total_tk;
            }else{
              $hasil_total_tk = $show_total_tk.'.00';
            }

            if ($digit_show_total_rk>1) {
              $didepan_koma_total_rk = $pisah_decimal_show_total_rk[0] ; 
              $dibelakang_koma_total_rk = strlen($pisah_decimal_show_total_rk[1]) >1 ? $pisah_decimal_show_total_rk[1] : $pisah_decimal_show_total_rk[1].'0';
              $hasil_total_rk = $didepan_koma_total_rk.'.'.$dibelakang_koma_total_rk;
            }else{
              $hasil_total_rk = $show_total_rk.'.00';
            }

            if ($digit_total_dev_keu>1) {
              $didepan_koma_total_dev_keu = $pisah_decimal_total_dev_keu[0] ; 
              $dibelakang_koma_total_dev_keu = strlen($pisah_decimal_total_dev_keu[1]) >1 ? $pisah_decimal_total_dev_keu[1] : $pisah_decimal_total_dev_keu[1].'0';
              $hasil_total_dev_keu = $didepan_koma_total_dev_keu.'.'.$dibelakang_koma_total_dev_keu;
            }else{
              $hasil_total_dev_keu = $total_dev_keu_dua.'.00';
            }





          ?>
    </tbody>
      <tfoot>
      <?php if (count($asisten_2)==0) { ?>
      <tr>
        <td colspan="7"><b>Belum Ada Data</b></td>
       
      </tr>
      <?php }else{ ?>
       <tr>
        <td><b>Rata -Rata</b></td>
        <td class="rata_kanan"><?php echo $hasil_total_tf; ?></td>
        <td class="rata_kanan"><?php echo $hasil_total_rf; ?></td>
        <td class="rata_kanan" style="<?php echo $warna_peringatan_total_dev_fisik ?>"><?php echo $hasil_total_dev_fisik ?></td>
        <td class="rata_kanan"><?php echo $hasil_total_tk ?></td>
        <td class="rata_kanan"><?php echo $hasil_total_rk ?></td>
       <td class="rata_kanan" style="<?php echo $warna_peringatan_total_dev_keu ?>"><?php echo $hasil_total_dev_keu ?></td>
      </tr>
    <?php } ?>
    </tfoot>
   
    
   
  </table>
</div>

<div style="width:33.33%; float:left">
  <table class="font_laporan laporan_asisten">
    <thead class="tabel_header">      
      <tr class="tabel_header">
        <th rowspan="2">ASISTEN ADMINISTRASI UMUM</th>
        <th colspan="3">Fisik</th>
        <th colspan="3">Keuangan</th>
      </tr>
      <tr>
        <th style="width:33px">T</th>
        <th style="width:33px">R</th>
        <th style="width:33px">D</th>
        <th style="width:33px">T</th>
        <th style="width:33px">R</th>
        <th style="width:33px">D</th>
      </tr>
    </thead>
    <tbody >
      <?php
          $tertimbang_tiga       = 0;
          $total_t_fisik_tiga    = 0;
          $total_t_keu_tiga      = 0;
          $total_r_fisik_tiga    = 0;
          $total_r_keu_tiga      = 0;
          $total_tertimbang_tiga = 0;
          $jml_skpd_tiga         = 0;
       foreach ($asisten_3 as $tiga) { 



        $dev_fisik = round($tiga->realisasi_fisik -$tiga->target_fisik ,2);
          $dev_keu = round($tiga->realisasi_keuangan - $tiga->target_keuangan,2);


            if ($dev_fisik < -10) {
              $warna_peringatan_dev_fisik = 'background: #f8b2b2'; 
              $total_peringatan_dev_fisik_merah += 1; 
            }
            elseif ($dev_fisik <-5  && $dev_fisik >-10) {
              $warna_peringatan_dev_fisik = 'background: #fcf3cf';
              $total_peringatan_dev_fisik_kuning += 1; 
            }else{
              $warna_peringatan_dev_fisik = 'background: #d5f5e3';
              $total_peringatan_dev_fisik_hijau += 1; 
            }

            if ($dev_keu < -10) {
              $warna_peringatan_dev_keu = 'background: #f8b2b2'; 
              $total_peringatan_dev_keu_merah += 1; 
            }
            elseif ($dev_keu <-5  && $dev_keu >-10) {
              $warna_peringatan_dev_keu = 'background: #fcf3cf';
              $total_peringatan_dev_keu_kuning += 1; 
            }else{
              $warna_peringatan_dev_keu = 'background: #d5f5e3';
              $total_peringatan_dev_keu_hijau += 1; 
            }


            $total_t_fisik_tiga    += $tiga->target_fisik;
            $total_t_keu_tiga      += $tiga->target_keuangan;
            $total_r_fisik_tiga    += $tiga->realisasi_fisik;
            $total_r_keu_tiga      += $tiga->realisasi_keuangan;
           $jml_skpd_tiga++;
        


            $show_tf = $tiga->target_fisik;
            $show_tk = $tiga->target_keuangan;
            $show_rf = $tiga->realisasi_fisik == '' ? 0 : $tiga->realisasi_fisik;
            $show_rk = $tiga->realisasi_keuangan == '' ? 0 :  $tiga->realisasi_keuangan;


            $pisah_decimal_show_tf = explode('.', $tiga->target_fisik);
            $pisah_decimal_show_tk = explode('.', $tiga->target_keuangan);
            $pisah_decimal_show_rf = explode('.', $show_rf);
            $pisah_decimal_show_rk = explode('.', $show_rk);
            $pisah_decimal_dev_fisik = explode('.', $dev_fisik);
            $pisah_decimal_dev_keu = explode('.', $dev_keu);

            $digit_show_tf = count($pisah_decimal_show_tk);
            $digit_show_tk = count($pisah_decimal_show_tf);
            $digit_show_rf = count($pisah_decimal_show_rf);
            $digit_show_rk = count($pisah_decimal_show_rk);
            $digit_dev_fisik = count($pisah_decimal_dev_fisik);
            $digit_dev_keu = count($pisah_decimal_dev_keu);

            // Fisik
            if ($digit_show_tf>1) {
              $didepan_koma_tf = $pisah_decimal_show_tf[0] ; 
              $dibelakang_koma_tf = strlen($pisah_decimal_show_tf[1]) >1 ? $pisah_decimal_show_tf[1] : $pisah_decimal_show_tf[1].'0';
              $hasil_tf = $didepan_koma_tf.'.'.$dibelakang_koma_tf;
            }else{
              $hasil_tf = $show_tf.'.00';
            }

            if ($digit_show_rf>1) {
              $didepan_koma_rf = $pisah_decimal_show_rf[0] ; 
              $dibelakang_koma_rf = strlen($pisah_decimal_show_rf[1]) >1 ? $pisah_decimal_show_rf[1] : $pisah_decimal_show_rf[1].'0';
              $hasil_rf = $didepan_koma_rf.'.'.$dibelakang_koma_rf;
            }else{
              $hasil_rf = $show_rf.'.00';
            }

            if ($digit_dev_fisik>1) {
              $didepan_koma_dev_fisik = $pisah_decimal_dev_fisik[0] ; 
              $dibelakang_koma_dev_fisik = strlen($pisah_decimal_dev_fisik[1]) >1 ? $pisah_decimal_dev_fisik[1] : $pisah_decimal_dev_fisik[1].'0';
              $hasil_dev_fisik = $didepan_koma_dev_fisik.'.'.$dibelakang_koma_dev_fisik;
            }else{
              $hasil_dev_fisik = $dev_fisik.'.00';
            }

            // keuangan
            if ($digit_show_tk>1) {
              $didepan_koma_tk = $pisah_decimal_show_tk[0] ; 
              $dibelakang_koma_tk = strlen($pisah_decimal_show_tk[1]) >1 ? $pisah_decimal_show_tk[1] : $pisah_decimal_show_tk[1].'0';
              $hasil_tk = $didepan_koma_tk.'.'.$dibelakang_koma_tk;
            }else{
              $hasil_tk = $show_tk.'.00';
            }

            if ($digit_show_rk>1) {
              $didepan_koma_rk = $pisah_decimal_show_rk[0] ; 
              $dibelakang_koma_rk = strlen($pisah_decimal_show_rk[1]) >1 ? $pisah_decimal_show_rk[1] : $pisah_decimal_show_rk[1].'0';
              $hasil_rk = $didepan_koma_rk.'.'.$dibelakang_koma_rk;
            }else{
              $hasil_rk = $show_rk.'.00';
            }

            if ($digit_dev_keu>1) {
              $didepan_koma_dev_keu = $pisah_decimal_dev_keu[0] ; 
              $dibelakang_koma_dev_keu = strlen($pisah_decimal_dev_keu[1]) >1 ? $pisah_decimal_dev_keu[1] : $pisah_decimal_dev_keu[1].'0';
              $hasil_dev_keu = $didepan_koma_dev_keu.'.'.$dibelakang_koma_dev_keu;
            }else{
              $hasil_dev_keu = $dev_keu.'.00';
            }

if ($hasil_dev_fisik!='0.00') {
              $blok = 'style="background: #eeeefe "';
            }else{
              $blok = '';

            }
        ?>
         <tr <?php echo $blok ?>>
          <td><?php echo $tiga->nama_instansi ?></td>
          <td class="rata_kanan"><?php echo $hasil_tf ?></td>
          <td class="rata_kanan"><?php echo $hasil_rf ?></td>
          <td class="rata_kanan" style="<?php echo $warna_peringatan_dev_fisik ?>"><?php echo $hasil_dev_fisik ?></td>
          <td class="rata_kanan"><?php echo $hasil_tk ?></td>
          <td class="rata_kanan"><?php echo $hasil_rk ?></td>
          <td class="rata_kanan" style="<?php echo $warna_peringatan_dev_keu ?>"><?php echo $hasil_dev_keu?></td>
        
        </tr>


       <?php } 
          @$ratarata_t_fisik_tiga    =  round($total_t_fisik_tiga / $jml_skpd_tiga, 2); 
          @$ratarata_r_fisik_tiga   =  round($total_r_fisik_tiga / $jml_skpd_tiga, 2); 
          @$total_dev_fisik_tiga = $ratarata_r_fisik_tiga - $ratarata_t_fisik_tiga ;
          @$ratarata_t_keu_tiga   =  round($total_t_keu_tiga / $jml_skpd_tiga, 2); 
          @$ratarata_r_keu_tiga   =  round($total_r_keu_tiga / $jml_skpd_tiga, 2);
          @$total_dev_keu_tiga = $ratarata_r_keu_tiga - $ratarata_t_keu_tiga ;



            if ($total_dev_fisik_tiga < -10) {
              $warna_peringatan_total_dev_fisik = 'background: #f8b2b2'; 
            }
            elseif ($total_dev_fisik_tiga <-5  && $total_dev_fisik_tiga >-10) {
              $warna_peringatan_total_dev_fisik = 'background: #fcf3cf';
            }else{
              $warna_peringatan_total_dev_fisik = 'background: #d5f5e3';
            }

            if ($total_dev_keu_tiga < -10) {
              $warna_peringatan_total_dev_keu = 'background: #f8b2b2'; 
            }
            elseif ($total_dev_keu_tiga <-5  && $total_dev_keu_tiga >-10) {
              $warna_peringatan_total_dev_keu = 'background: #fcf3cf';
            }else{
              $warna_peringatan_total_dev_keu = 'background: #d5f5e3';
            }



            $show_total_tf = $ratarata_t_fisik_tiga;
            $show_total_rf = $ratarata_r_fisik_tiga;
            $show_total_tk = $ratarata_t_keu_tiga;
            $show_total_rk = $ratarata_r_keu_tiga;


            $pisah_decimal_show_total_tf = explode('.', $show_total_tf);
            $pisah_decimal_show_total_tk = explode('.', $show_total_tk);
            $pisah_decimal_show_total_rf = explode('.', $show_total_rf);
            $pisah_decimal_show_total_rk = explode('.', $show_total_rk);

            $pisah_decimal_total_dev_fisik = explode('.', $total_dev_fisik_tiga);
            $pisah_decimal_total_dev_keu = explode('.', $total_dev_keu_tiga);

            $digit_show_total_tf = count($pisah_decimal_show_total_tf);
            $digit_show_total_tk = count($pisah_decimal_show_total_tk);
            $digit_show_total_rf = count($pisah_decimal_show_total_rf);
            $digit_show_total_rk = count($pisah_decimal_show_total_rk);

            $digit_total_dev_fisik = count($pisah_decimal_total_dev_fisik);
            $digit_total_dev_keu = count($pisah_decimal_total_dev_keu);



            if ($digit_show_total_tf>1) {
              $didepan_koma_total_tf = $pisah_decimal_show_total_tf[0] ; 
              $dibelakang_koma_total_tf = strlen($pisah_decimal_show_total_tf[1]) >1 ? $pisah_decimal_show_total_tf[1] : $pisah_decimal_show_total_tf[1].'0';
              $hasil_total_tf = $didepan_koma_total_tf.'.'.$dibelakang_koma_total_tf;
            }else{
              $hasil_total_tf = $show_total_tf.'.00';
            }

            if ($digit_show_total_rf>1) {
              $didepan_koma_total_rf = $pisah_decimal_show_total_rf[0] ; 
              $dibelakang_koma_total_rf = strlen($pisah_decimal_show_total_rf[1]) >1 ? $pisah_decimal_show_total_rf[1] : $pisah_decimal_show_total_rf[1].'0';
              $hasil_total_rf = $didepan_koma_total_rf.'.'.$dibelakang_koma_total_rf;
            }else{
              $hasil_total_rf = $show_total_rf.'.00';
            }

            if ($digit_total_dev_fisik>1) {
              $didepan_koma_total_dev_fisik = $pisah_decimal_total_dev_fisik[0] ; 
              $dibelakang_koma_total_dev_fisik = strlen($pisah_decimal_total_dev_fisik[1]) >1 ? $pisah_decimal_total_dev_fisik[1] : $pisah_decimal_total_dev_fisik[1].'0';
              $hasil_total_dev_fisik = $didepan_koma_total_dev_fisik.'.'.$dibelakang_koma_total_dev_fisik;
            }else{
              $hasil_total_dev_fisik = $total_dev_fisik_tiga.'.00';
            }


            if ($digit_show_total_tk>1) {
              $didepan_koma_total_tk = $pisah_decimal_show_total_tk[0] ; 
              $dibelakang_koma_total_tk = strlen($pisah_decimal_show_total_tk[1]) >1 ? $pisah_decimal_show_total_tk[1] : $pisah_decimal_show_total_tk[1].'0';
              $hasil_total_tk = $didepan_koma_total_tk.'.'.$dibelakang_koma_total_tk;
            }else{
              $hasil_total_tk = $show_total_tk.'.00';
            }

            if ($digit_show_total_rk>1) {
              $didepan_koma_total_rk = $pisah_decimal_show_total_rk[0] ; 
              $dibelakang_koma_total_rk = strlen($pisah_decimal_show_total_rk[1]) >1 ? $pisah_decimal_show_total_rk[1] : $pisah_decimal_show_total_rk[1].'0';
              $hasil_total_rk = $didepan_koma_total_rk.'.'.$dibelakang_koma_total_rk;
            }else{
              $hasil_total_rk = $show_total_rk.'.00';
            }

            if ($digit_total_dev_keu>1) {
              $didepan_koma_total_dev_keu = $pisah_decimal_total_dev_keu[0] ; 
              $dibelakang_koma_total_dev_keu = strlen($pisah_decimal_total_dev_keu[1]) >1 ? $pisah_decimal_total_dev_keu[1] : $pisah_decimal_total_dev_keu[1].'0';
              $hasil_total_dev_keu = $didepan_koma_total_dev_keu.'.'.$dibelakang_koma_total_dev_keu;
            }else{
              $hasil_total_dev_keu = $total_dev_keu_tiga.'.00';
            }





          ?>
    </tbody>
      <tfoot>
      <?php if (count($asisten_3)==0) { ?>
      <tr>
        <td colspan="7"><b>Belum Ada Data</b></td>
       
      </tr>
      <?php }else{ ?>
        <tr>
        <td><b>Rata -Rata</b></td>
        <td class="rata_kanan"><?php echo $hasil_total_tf; ?></td>
        <td class="rata_kanan"><?php echo $hasil_total_rf; ?></td>
        <td class="rata_kanan" style="<?php echo $warna_peringatan_total_dev_fisik ?>"><?php echo $hasil_total_dev_fisik ?></td>
        <td class="rata_kanan"><?php echo $hasil_total_tk ?></td>
        <td class="rata_kanan"><?php echo $hasil_total_rk ?></td>
       <td class="rata_kanan" style="<?php echo $warna_peringatan_total_dev_keu ?>"><?php echo $hasil_total_dev_keu ?></td>
      </tr>
    <?php } ?>
    </tfoot>
   
  
  </table>
</div>

<div style="clear:both"></div>
<hr>
<div style="width:33.33%; float:left;">
	<div class="font_laporan">
		
		<u>Keterangan</u> <br>
		  T : Target <br>
		  R : Realisasi <br>
		  D : Deviasi <br>
      <span style="padding-right:10px; width:50px; height:40px; background: #f8b2b2 ;color:#f8b2b2"> ---- </span> : Deviasi diatas -10%<br>
      <span style="padding-right:10px; width:50px; height:40px; background: #fcf3cf ;color:#fcf3cf"> ---- </span> : Deviasi antara -5% sampai -10%<br>
      <span style="padding-right:10px; width:50px; height:40px; background: #d5f5e3;color:#d5f5e3"> ---- </span> : Deviasi dibawah -5%
		</div> 
</div>
<div style="width:33.33%; float:left;">
	<table class="font_laporan laporan_asisten">
		<tr>
			<th rowspan="3">Rata Rata <?php echo $identitas['caption_ratarata_rekap_asisten'] ?></th>
			<th colspan="3">Fisik</th>
			<th colspan="3">Keuangan</th>
		</tr>
		<tr>
			<th style="width:33px">T</th>
			<th style="width:33px">R</th>
			<th style="width:33px">D</th>
			<th style="width:33px">T</th>
			<th style="width:33px">R</th>
			<th style="width:33px">D</th>
		</tr>
		<tr>
	<?php 
    $semua_skpd = $jml_skpd_satu + $jml_skpd_dua + $jml_skpd_tiga;
		$semua_total_t_fisik = ($total_t_fisik_satu +$total_t_fisik_dua +$total_t_fisik_tiga) / $semua_skpd;
		$semua_total_r_fisik = ($total_r_fisik_satu +$total_r_fisik_dua +$total_r_fisik_tiga)  / $semua_skpd ;
		$semua_total_dev_fisik = $semua_total_r_fisik - $semua_total_t_fisik  ;
		$semua_total_t_keu = ($total_t_keu_satu +$total_t_keu_dua +$total_t_keu_tiga) / $semua_skpd;
		$semua_total_r_keu = ($total_r_keu_satu +$total_r_keu_dua +$total_r_keu_tiga) / $semua_skpd;
		$semua_total_dev_keu = $semua_total_r_keu - $semua_total_t_keu ;


    $show_total_tf = round($semua_total_t_fisik,2);
    $show_total_rf = round($semua_total_r_fisik,2);
    $show_total_tk = round($semua_total_t_keu,2);
    $show_total_rk = round($semua_total_r_keu,2);
    $show_semua_total_dev_fisik = $show_total_rf - $show_total_tf;
    $show_semua_total_dev_keu =  $show_total_rk - $show_total_tk;


    $pisah_decimal_show_total_tf = explode('.', $show_total_tf);
    $pisah_decimal_show_total_tk = explode('.', $show_total_tk);
    $pisah_decimal_show_total_rf = explode('.', $show_total_rf);
    $pisah_decimal_show_total_rk = explode('.', $show_total_rk);

    $pisah_decimal_total_dev_fisik = explode('.', $show_semua_total_dev_fisik);
    $pisah_decimal_total_dev_keu = explode('.', $show_semua_total_dev_keu);

    $digit_show_total_tf = count($pisah_decimal_show_total_tf);
    $digit_show_total_tk = count($pisah_decimal_show_total_tk);
    $digit_show_total_rf = count($pisah_decimal_show_total_rf);
    $digit_show_total_rk = count($pisah_decimal_show_total_rk);

    $digit_total_dev_fisik = count($pisah_decimal_total_dev_fisik);
    $digit_total_dev_keu = count($pisah_decimal_total_dev_keu);



            if ($digit_show_total_tf>1) {
              $didepan_koma_total_tf = $pisah_decimal_show_total_tf[0] ; 
              $dibelakang_koma_total_tf = strlen($pisah_decimal_show_total_tf[1]) >1 ? $pisah_decimal_show_total_tf[1] : $pisah_decimal_show_total_tf[1].'0';
              $hasil_total_tf = $didepan_koma_total_tf.'.'.$dibelakang_koma_total_tf;
            }else{
              $hasil_total_tf = $show_total_tf.'.00';
            }

            if ($digit_show_total_rf>1) {
              $didepan_koma_total_rf = $pisah_decimal_show_total_rf[0] ; 
              $dibelakang_koma_total_rf = strlen($pisah_decimal_show_total_rf[1]) >1 ? $pisah_decimal_show_total_rf[1] : $pisah_decimal_show_total_rf[1].'0';
              $hasil_total_rf = $didepan_koma_total_rf.'.'.$dibelakang_koma_total_rf;
            }else{
              $hasil_total_rf = $show_total_rf.'.00';
            }

            if ($digit_total_dev_fisik>1) {
              $didepan_koma_total_dev_fisik = $pisah_decimal_total_dev_fisik[0] ; 
              $dibelakang_koma_total_dev_fisik = strlen($pisah_decimal_total_dev_fisik[1]) >1 ? $pisah_decimal_total_dev_fisik[1] : $pisah_decimal_total_dev_fisik[1].'0';
              $hasil_total_dev_fisik = $didepan_koma_total_dev_fisik.'.'.$dibelakang_koma_total_dev_fisik;
            }else{
              $hasil_total_dev_fisik = $show_semua_total_dev_fisik.'.00';
            }


            if ($digit_show_total_tk>1) {
              $didepan_koma_total_tk = $pisah_decimal_show_total_tk[0] ; 
              $dibelakang_koma_total_tk = strlen($pisah_decimal_show_total_tk[1]) >1 ? $pisah_decimal_show_total_tk[1] : $pisah_decimal_show_total_tk[1].'0';
              $hasil_total_tk = $didepan_koma_total_tk.'.'.$dibelakang_koma_total_tk;
            }else{
              $hasil_total_tk = $show_total_tk.'.00';
            }

            if ($digit_show_total_rk>1) {
              $didepan_koma_total_rk = $pisah_decimal_show_total_rk[0] ; 
              $dibelakang_koma_total_rk = strlen($pisah_decimal_show_total_rk[1]) >1 ? $pisah_decimal_show_total_rk[1] : $pisah_decimal_show_total_rk[1].'0';
              $hasil_total_rk = $didepan_koma_total_rk.'.'.$dibelakang_koma_total_rk;
            }else{
              $hasil_total_rk = $show_total_rk.'.00';
            }

            if ($digit_total_dev_keu>1) {
              $didepan_koma_total_dev_keu = $pisah_decimal_total_dev_keu[0] ; 
              $dibelakang_koma_total_dev_keu = strlen($pisah_decimal_total_dev_keu[1]) >1 ? $pisah_decimal_total_dev_keu[1] : $pisah_decimal_total_dev_keu[1].'0';
              $hasil_total_dev_keu =  $didepan_koma_total_dev_keu.'.'.$dibelakang_koma_total_dev_keu;
            }else{
              $hasil_total_dev_keu = $show_semua_total_dev_keu.'.00';
            }



	 ?>
			  <td class="rata_kanan"><?php echo $hasil_total_tf; ?></td>
        <td class="rata_kanan"><?php echo $hasil_total_rf; ?></td>
        <td class="rata_kanan"><?php echo $hasil_total_dev_fisik ?></td>
        <td class="rata_kanan"><?php echo $hasil_total_tk ?></td>
        <td class="rata_kanan"><?php echo $hasil_total_rk ?></td>
       <td class="rata_kanan"><?php echo $hasil_total_dev_keu ?></td>
		</tr>
	</table>
</div>
<div style="clear:both"></div>