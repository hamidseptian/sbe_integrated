<?php
/**
	* Author     : Alfikri, M.Kom
	* Created By : Alfikri, M.Kom
	* E-Mail     : alfikri.name@gmail.com
	* No HP      : 081277337405
*/
?>



<!-- Modal progress Fisik dan Keuangan -->
<div class="modal fade" id="modal-progress-pekerjaan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Progress Pekerjaan <br>
                <span>Nama Paket</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="data-progress">
            	<input type="" id="id_paket">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table" id="table-progress">
                            <thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th>Progress</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="progress-pekerjaan">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info  pull-left" id="btn_copy_progress_awal" onclick="tambah_progress()">Tambah Progress</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal EXPORT EXCEL -->



<div class="modal fade" id="modal-tambah-progress-pekerjaan" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Progress Pekerjaan <br>
                <span>Nama Paket</span> 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="data-progress">
            	<form id="form_add_progress">
	            	<input type="" id="id_paket_pekerjaan" name="id_paket_pekerjaan">
	                <div class="form-group">
	                	<label for="">Tanggal Pengerjaan</label>
	                	<input type="date" class="form-control" id="tgl" name="tgl">
	                </div>
	                <div class="form-group">
	                	<label for="">Progress</label>
	                	<select name="persen" id="persen" class="form-control">
	                	<?php for ($i=0; $i <=100 ; $i++) { ?>
	                		<option value="<?php echo $i ?>%"><?php echo $i ?>%</option>
	                	<?php } ?>
	                	</select>
	                </div>
	                <div class="form-group">
	                	<label for="">Keterangan</label>
	                	<textarea class="form-control" rows="6" name="keterangan" id="keterangan"></textarea>
	                </div>
	                <div class="form-group">
	                	<label for="">Foto Progress Pengerjaan</label><br>
	                	<div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="upload-file" name="upload_file" aria-describedby="inputGroupFileAddon04" onchange="get_file_name(this)">
                                    <label class="custom-file-label" id="label-upload" for="upload-file">Choose File</label>
                                </div>
                               
                            </div>

	                </div>
	            </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info  pull-left" id="btn_copy_progress_awal" onclick="simpan_progress_pekerjaan()">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>