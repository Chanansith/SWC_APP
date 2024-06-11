<?php

$id = '';
$first_name = '';
$last_name = '';
$id_card_number = '';
$birth_date = '';
$gender = '';
$nationality = '';
$customer_type = '';
$address = '';
if (!empty($Customer)) {
    foreach ($Customer as $b) {
        $id = $b->customer_id;
        $first_name = $b->first_name;
        $last_name = $b->last_name;
        $id_card_number = $b->id_card_number;
        $birth_date = $b->birth_date;
        $gender = $b->gender;
        $nationality = $b->nationality;
        $customer_type = $b->customer_type;
        $address = $b->address;
    }
}

$id_card_t = "";
$first_name_t = "";
$last_name_t = "";
$birthday_t = "";
$gender_t = "";
$nationality_t = "";
$customer_type_t = "";
$address_t = "";
if ($language == "en") {

    $address_t =  $header[1]->en;
    $id_card_t =  $header[2]->en;
    $birthday_t =  $header[4]->en;
    $first_name_t = $header[5]->en;
    $last_name_t = $header[6]->en;
    $gender_t =  $header[7]->en;
    $nationality_t =  $header[8]->en;
    $customer_type_t =  $header[9]->en;
}
if ($language == "th") {

    $address_t =  $header[1]->th;
    $id_card_t =  $header[2]->th;
    $birthday_t =  $header[4]->th;
    $first_name_t = $header[5]->th;
    $last_name_t = $header[6]->th;
    $gender_t =  $header[7]->th;
    $nationality_t =  $header[8]->th;
    $customer_type_t =  $header[9]->th;
}
if ($language == "lao") {

    $address_t =  $header[1]->lao;
    $id_card_t =  $header[2]->lao;
    $birthday_t =  $header[4]->lao;
    $first_name_t = $header[5]->lao;
    $last_name_t = $header[6]->lao;
    $gender_t =  $header[7]->lao;
    $nationality_t =  $header[8]->lao;
    $customer_type_t =  $header[9]->lao;
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Customer
            <small>Edit</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Main</a></li>
            <li><a href="<?= base_url('customer') ?>"> Customer</a></li>
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
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Customer</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="editCustomer" action="<?php echo base_url() ?>editOldCustomer" method="post" role="form">
                        <div class="box-body">
                            <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?>" />
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name"><?= $first_name_t ?></label>
                                        <input type="text" class="form-control required" id="first_name" name="first_name" value="<?= $first_name ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="last_name"><?= $last_name_t ?></label>
                                        <input type="text" class="form-control required" id="last_name" name="last_name" value="<?= $last_name ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_card_number"><?= $id_card_t ?></label>
                                        <input type="text" class="form-control required" id="id_card_number" name="id_card_number" value="<?= $id_card_number ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="birth_date"><?= $birthday_t ?></label>
                                        <input type="text" class="form-control required" id="birth_date" name="birth_date" value="<?= $birth_date ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="gender"><?= $gender_t ?></label>
                                        <select class="form-control required" id="gender" name="gender">
                                            <option value="0" <?php if ($gender == "0") {
                                                                    echo "selected=selected";
                                                                } ?>>ชาย</option>
                                            <option value="1" <?php if ($gender == "1") {
                                                                    echo "selected=selected";
                                                                } ?>>หญิง</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nationality"><?= $nationality_t ?></label>
                                        <input type="text" class="form-control required" id="nationality" name="nationality" value="<?= $nationality ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="customer_type"><?= $customer_type_t ?></label>
                                        <input type="text" class="form-control required" id="customer_type" name="customer_type" value="<?= $customer_type ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address"><?= $address_t ?></label>
                                        <textarea class="form-control" id="address" name="address"><?= $address ?></textarea>
                                    </div>
                                </div>
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
    $(document).ready(function() {

        var editCategoryForm = $("#editCategory");

        var validator = editCategoryForm.validate({

            rules: {
                category_name_la: {
                    required: true
                },
                category_name_en: {
                    required: true
                },
            },
            messages: {
                category_name_la: {
                    required: "This field is required"
                },
                category_name_en: {
                    required: "This field is required"
                },
            }
        });
    });
</script>