

<div class="mb-3 card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                  <?php   if ($id_kedudukan=='') { ?>
                  <button class="btn btn-info" onclick="tambah_instansi_teknis()" data-toggle="tooltip" title="Tambah SKPD">Tambah Instansi Teknis</button>
                    <?php }else{ ?>
                        <button type="button" class="btn btn-outline-danger" id="" onclick="Swal.fire('Terkunci','Penambahan Instansi Teknis hanya dapat dilakukan Operator Utama','warning')">Tambah Instansi Teknis</button>

                    <?php } ?>


              <hr>

                <div class="table-responsive">
                    <table id="table-instansi-teknis" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th style="text-align: center;" width="1%">No</th>
                                <th style="text-align: center;">Kode Instansi Teknis</th>
                                <th style="text-align: center;">Nama Instansi Teknis</th>
                                <th style="text-align: center;">Jenis</th>
                                <th style="text-align: center;">Domisili</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;"  width="10%">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>