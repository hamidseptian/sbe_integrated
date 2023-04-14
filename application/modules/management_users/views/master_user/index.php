<?php
/**
	* Author     : Alfikri, M.Kom
	* Created By : Alfikri, M.Kom
	* E-Mail     : alfikri.name@gmail.com
	* No HP      : 081277337405
*/
?>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="notifikasi"></div>
                    <?php   if ($id_kedudukan=='') { ?>
                        <button type="button" class="btn btn-primary" id="addMasterUser" onclick="addMasterUser()">Tambah User</button>
                    <?php }else{ ?>
                        <button type="button" class="btn btn-outline-danger" id="" onclick="Swal.fire('Terkunci','Penambahan user Operator hanya dapat dilakukan Operator Utama','warning')">Tambah User</button>

                    <?php } ?>
                <hr>
                <table id="table-master-user" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
							<th>Instansi</th>

							<th>Group</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>E-Mail</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
