<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Edit Permission
            <small>Edit</small>
        </h1>
        <ol class="breadcrumb">
      <li><a href="<?= base_url('permission') ?>"><i class="fa fa-dashboard"></i> permission</a></li>
      <li><a > Edit permission</a></li>
    </ol>
    </section>

    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if ($error) {
                ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <?php
                $success = $this->session->flashdata('success');
                if ($success) {
                ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Old Permission</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="editOldPermission" action="<?php echo base_url() ?>editOldPermission" method="post" role="form" >
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">username</label>
                                <input type="text" class="form-control required" readonly id="username" name="username" value="<?= $adminRecords[0]->username ?>">
                            </div>
                            <div class="form-group">
                                <label for="title">password</label>
                                <input type="password" class="form-control required" id="password" name="password" value="<?= $adminRecords[0]->pass ?>">
                            </div>
                            <div class="form-group">
                                <label for="role">role</label>
                                <select class="form-control " id="role" name="role">
                                    <option value="1" <?php if($adminRecords[0]->role === "1"){echo "selected";}?>>พนักงานขาย</option>
                                    <option value="2" <?php if($adminRecords[0]->role === "2"){echo "selected";}?>>บัญชี</option>
                                    <option value="3" <?php if($adminRecords[0]->role === "3"){echo "selected";}?>>CEO</option>
                                    <option value="4" <?php if($adminRecords[0]->role === "4"){echo "selected";}?>>ผู้จัดการ</option>
                                </select>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
<script>
    // $(document).ready(function() {
    //     $('#summernote_eng').summernote();
    //     $('#summernote_lao').summernote();
    // });
    $(document).ready(function(){
	
	var editOldPermissionForm = $("#editOldPermission");
	
	var validator = editOldPermissionForm.validate({
		
		rules:{
            username :{ required : true },
            password :{ required : true },
		},
		messages:{
            username :{ required : "This field is required" },
            password :{ required : "This field is required" },
		}
	});
});
</script>