<?php 
    $penginputan = ['Di Kunci','Sesuai Jadwal','Bebas'];
    $id_group = $this->session->userdata('id_group');
    $id_kedudukan = $this->session->userdata('id_kedudukan');
    $nama_kedudukan = $this->session->userdata('kedudukan');
   
    if ($id_group==5) {
        if ($id_kedudukan=='') {
            $group_name = $this->session->userdata('group_name'). ' - UTAMA';
        }else{
            $group_name = $this->session->userdata('group_name') .' - '.$nama_kedudukan;
        }
    }else{
        $group_name = $this->session->userdata('group_name');
    }
 ?>

<style type="text/css">
    th, td{
        text-align: center;
    }
</style>



        <div class="card-shadow-primary card-border mb-3 profile-responsive card">
                                    <div class="dropdown-menu-header">
                                        <div class="dropdown-menu-header-inner bg-alternate">
                                           
                                            <div class="menu-header-content btn-pane-right">
                                                <div class="avatar-icon-wrapper mr-3 avatar-icon-xl btn-hover-shine">
                                                    <div class="avatar-icon rounded"><img src="<?php echo base_url() ?>assets/sbe/image/user.jpg" alt="Image"></div>
                                                </div>
                                                <div>
                                                    <p>Selamat datang di aplikasi Simbangda Based Evidence V.4! </p>
                                                    <h6 class="menu-header-subtitle"><?php echo $this->session->userdata('full_name'); ?> | <?php  echo $group_name; ?></h6>
                                                    <h5 class="menu-header-title"><b><?php echo $this->session->userdata('nama_instansi'); ?></b></h5>

                                                </div>
                                                <div class="menu-header-btn-pane">
                                                    
                                                    <a href="<?php echo base_url() ?>tutorial" class="btn-wide btn-hover-shine  btn btn-info">Lihat Tutorial Penggunaan Aplikasi</a>  

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="p-0 list-group-item">
                                            <div class="widget-content">
                                                <div class="row">
                                                    <div class="col-md-6 col-xl-3">
                                                        <div class="card mb-3 widget-content bg-night-fade">
                                                            <div class="widget-content-wrapper text-white">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-subheading"><b>Tahapan APBD</b></div>
                                                                    <div class="widget-heading">
                                                                        <?php echo nama_tahapan(); ?>
                                                                    </div>
                                                                </div>

                                                                <div class="widget-content-right">
                                                                    <div class="widget-numbers text-white"><i class="pe-7s-cash"></i></div>
                                                                </div>

                                                               



                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-xl-3">
                                                        <div class="card mb-3 widget-content bg-arielle-smile">
                                                            <div class="widget-content-wrapper text-white">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-subheading"><b>Tahun Anggaran</b></div>
                                                                    <div class="widget-heading"><?php echo tahun_anggaran(); ?></div>
                                                                </div>
                                                                <div class="widget-content-right">
                                                                    <div class="widget-numbers text-white"><i class="pe-7s-cash"></i></div>
                                                                </div>
                                                           
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-xl-3">
                                                        <div class="card mb-3 widget-content bg-arielle-smile">
                                                            <div class="widget-content-wrapper text-white">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-subheading"><b>Bulan Pelaporan</b></div>
                                                                    <div class="widget-heading">
                                                                        <?php echo konversi_bulan(bulan_aktif()) . ' ' . tahun_anggaran(); ?>
                                                                    </div>
                                                                </div>
                                                                 <div class="widget-content-right">
                                                                    <div class="widget-numbers text-white"><i class="pe-7s-file"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-xl-3">
                                                        <div class="card mb-3 widget-content bg-happy-green">
                                                            <div class="widget-content-wrapper text-white">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-subheading"><b>Penginputan</b></div>
                                                                    <div class="widget-heading">
                                                                        <?php echo @$penginputan[$config['penginputan']] ?>
                                                                    </div>
                                                                </div>
                                                                <div class="widget-content-right">
                                                                    <div class="widget-numbers text-white"><i class="pe-7s-file"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-xl-none d-lg-block col-md-6 col-xl-4">
                                                        <div class="card mb-3 widget-content bg-premium-dark">
                                                            <div class="widget-content-wrapper text-white">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading">Products Sold</div>
                                                                    <div class="widget-subheading">Revenue streams</div>
                                                                </div>
                                                                <div class="widget-content-right">
                                                                    <div class="widget-numbers text-warning"><span>$14M</span></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>

                                        <li class="p-0 list-group-item">
                                            <div class="widget-content">
                                                    <?php if ($jumlah_pengumuman==0) { ?>
                                                         <div class="alert alert-info">Tidak ada pengumuman</div>
                                                    <?php }else{ ?>
                                                         <div class="alert alert-info"><u><b>Pengumuman Terbaru</b></u>
                                                        <h5><?php echo $data_pengumuman->judul ?></h5>
                                                        <?php echo substr($data_pengumuman->keterangan, 0,380) ?>.... <br>
                                                        <button class="btn btn-info btn-sm" onclick="detail_pengumuman('<?php echo sbe_crypt($data_pengumuman->id_pengumuman,"E") ?>')">Lihat Detail Pengumuman</button>
                                                        </div>
                                                        
                                                    <?php } ?>
                                                      
                                            </div>
                                        </li>
                                        
                                    </ul>
                                </div>





<?php if ($anggaran_apbd>0) { ?>

<div class="tabs-animation">
 <input type="hidden" class="form-control" id="id_instansi_grafik" value="<?php echo id_instansi() ?>">
    <div class="row">
        <div class="col-lg-12 col-xl-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div id="pagu" name="pagu"></div>
                   
                    
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-6">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div id="terealisasi" name="terealisasi"></div>
                   
                    
                </div>
            </div>
        </div>
       <!--  <div class="col-lg-12 col-xl-4">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div id="perbandingan_kelompok" name="perbandingan_kelompok"></div>
                   
                    
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-xl-8">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div id="perbandingan" name="perbandingan"></div>
                   
                    
                </div>
            </div>
        </div>
         -->
        
    </div>
</div>
<div class="tabs-animation">
 <input type="hidden" class="form-control" id="id_instansi_grafik" value="<?php echo id_instansi() ?>">
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                   <div id="grafik_realisasi_skpd"></div>
                <table class="table table-striped table-bordered">
                    <thead>
                        <th colspan="2"><center>Bulan / Keterangan</center></th>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>Mei</th>
                        <th>Jun</th>
                        <th>Jul</th>
                        <th>Agu</th>
                        <th>Sep</th>
                        <th>Okt</th>
                        <th>Nov</th>
                        <th>Des</th>
                    </thead>
                    <tbody>
                      
                       
                        <tr id="tfisik">
                            <td rowspan="3" align="center">Fisik</td>
                        </tr>
                        <tr id="rfisik">
                        </tr>
                        <tr id="dfisik">
                        </tr>
                          <tr id="tkeu">
                            <td rowspan="3" align="center">Keuangan</td>
                        </tr>
                        <tr id="rkeu">
                        </tr>
                        <tr id="dkeu">
                        </tr>
                    </tbody>
                </table>
                <div class="btn-group btn-block">
                       <button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary" onclick="grafik('Akumulasi')"><i class="fa fa-plus"> </i> Grafik Akumulasi</button>
                       <button type="button" class="btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"  onclick="grafik('Bulanan')"><i class="fa fa-calendar"> </i> Grafik Bulanan</button>
                <?php if ($this->session->userdata('group_name') == 'OPERATOR') : ?>
                        
                        <button class="btn-icon btn-shadow btn-outline-2x btn btn-outline-secondary"  onclick="sync(<?php echo $this->session->userdata('id_instansi'); ?>)" id="tombol_sync"><i class="fa fa-indent"> </i> Synchronize / Refresh Grafik</button>
                <?php endif; ?>
                </div>




<!-- 








                <div class="card-body"><h5 class="card-title">Outline 2x Shadow Linecons Icons</h5>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-primary"><i class="lnr-store btn-icon-wrapper"> </i>Primary</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-secondary"><i class="lnr-book btn-icon-wrapper"> </i>Secondary</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-success"><i class="lnr-user btn-icon-wrapper"> </i>Success</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-info"><i class="lnr-paperclip btn-icon-wrapper"> </i>Info</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-warning"><i class="lnr-screen btn-icon-wrapper"> </i>Warning</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-danger"><i class="lnr-smartphone btn-icon-wrapper"> </i>Danger</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-focus"><i class="lnr-phone btn-icon-wrapper"> </i>Focus</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-alternate"><i class="lnr-keyboard btn-icon-wrapper"> </i>Alt</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-light"><i class="lnr-dinner btn-icon-wrapper"> </i>Light</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-dark"><i class="lnr-earth btn-icon-wrapper"> </i>Dark</button>
                                            <button class="mb-2 mr-2 btn-icon btn-shadow btn-outline-2x btn btn-outline-link"><i class="lnr-car btn-icon-wrapper"> </i>link</button>
                                        </div>

 -->






                </div>
            </div>
        </div>
        
    </div>
</div>

<?php   } ?>

<?php echo $extra_js2 ?>