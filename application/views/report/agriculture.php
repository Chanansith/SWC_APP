<?php
$number = "";
$image = "";
$id_card = "";
$issue = "";
$exp = "";
$name = "";
$birthday = "";
$id_card_farmer = "";
$address = "";
$phone = "";
$status = "";
if ($language == "en") {
    $number = $header[0]->en;
    $image = $header[1]->en;
    $phone = $header[2]->en;
    $address = $header[3]->en;
    $id_card = $header[4]->en;
    $issue = $header[5]->en;
    $exp = $header[6]->en;
    $name = $header[7]->en;
    $birthday = $header[8]->en;
    $id_card_farmer = $header[9]->en;
    $status = $header[10]->en;
}
if ($language == "th") {
    $number = $header[0]->th;
    $image = $header[1]->th;
    $phone = $header[2]->th;
    $address = $header[3]->th;
    $id_card = $header[4]->th;
    $issue = $header[5]->th;
    $exp = $header[6]->th;
    $name = $header[7]->th;
    $birthday = $header[8]->th;
    $id_card_farmer = $header[9]->th;
    $status = $header[10]->th;
}
if ($language == "lao") {
    $number = $header[0]->lao;
    $image = $header[1]->lao;
    $phone = $header[2]->lao;
    $address = $header[3]->lao;
    $id_card = $header[4]->lao;
    $issue = $header[5]->lao;
    $exp = $header[6]->lao;
    $name = $header[7]->lao;
    $birthday = $header[8]->lao;
    $id_card_farmer = $header[9]->lao;
    $status = $header[10]->lao;
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Farmer
            <small>Add, Edit, Delete</small>
        </h1>
    </section>
    <section class="content">
        <!-- <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addFarmer"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Farmer List</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>farmer" method="POST" id="searchList">
                                <div class="input-group">
                                    <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" />
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th><?= $number ?></th>
                                <th><?= $image ?></th>
                                <th><?= $id_card ?></th>
                                <th><?= $name ?></th>
                                <th><?= $image ?></th>
                                <th><?= $id_card_farmer ?></th>
                                <th><?= $address ?>/<?= $phone ?></th>
                                <th><?= $status ?></th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                            if (!empty($farmerRecords)) {
                                $i = 0;
                                foreach ($farmerRecords as $record) {
                                    $i++
                            ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><img src="<?php echo base_url($record->image_card_1) ?>" onclick="Cardmodal(<?= $record->farmer_id; ?>)" alt="Image" style="width:100%;height:150px;max-width:200px;"></td>
                                        <td><strong><?= $id_card ?>:</strong><?php echo $record->id_card ?><br /><strong><?= $issue ?>:</strong><?php echo $record->issue_date ?><br /><strong><?= $exp ?>:</strong><?php echo $record->exp_date ?></td>
                                        <td><?php echo $record->first_name ?> <?php echo $record->last_name ?><br /><strong><?= $birthday ?>:</strong><?php echo $record->birthdate ?></td>
                                        <td><img src="<?php echo base_url($record->image_book) ?>" onclick="Bookmodal(<?= $record->farmer_id; ?>)" alt="Image" style="width:100%;height:150px;max-width:200px;"></td>
                                        <td><?php echo $record->id_card_farmer ?></td>
                                        <td><strong><?= $address ?>:</strong><?php echo $record->address ?><br /><strong><?= $phone ?>:</strong><?php echo $record->phone ?></td>
                                        <td>
                                            <?php
                                            if ($record->status_register == 0) { ?>
                                                <span class="label label-default">Waiting</span>
                                            <?php }
                                            ?>
                                            <?php
                                            if ($record->status_register == 1) { ?>
                                                <span class="label label-success">Pass</span>
                                            <?php }
                                            ?>
                                            <?php
                                            if ($record->status_register == 2) { ?>
                                                <span class="label label-danger">Not Pass</span>
                                            <?php }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-default" href="<?php echo base_url() . 'farm/' . $record->farmer_id; ?>">Farm</a>
                                            <!-- <a class="btn btn-sm btn-info" href="<?php echo base_url() . 'editFarmer/' . $record->farmer_id; ?>"><i class="fa fa-pencil"></i></a>
                                            <a class="btn btn-sm btn-danger deleteFarmer" href="#" data-id="<?php echo $record->farmer_id; ?>"><i class="fa fa-trash"></i></a> -->
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>

                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<!-- cardModal -->

<div class="modal fade" id="cardModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">ID Card Image</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="image_card_1">ID Card Front</label>
                    <img class="form-control" src="" id="image_card_1" alt="ID Card Image Front" style="margin:auto;width:100%;height:300px;">
                </div>
                <div class="form-group">
                    <label for="image_card_1">ID Card Back</label>
                    <img class="form-control" src="" id="image_card_2" alt="ID Card Image Back" style="margin:auto;width:100%;height:300px;">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- bookModal -->
<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">ID Agricultural</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="image_book">ID Agricultural</label>
                    <img class="form-control" src="" id="image_book" alt="ID Agricultural" style="margin:auto;width:100%;height:300px;">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('ul.pagination li a').click(function(e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "farmer/" + value);
            jQuery("#searchList").submit();
        });
        jQuery(document).on("click", ".deleteFarmer", function() {
            var id = $(this).data("id"),
                hitURL = baseURL + "deleteFarmer",
                currentRow = $(this);
            var confirmation = confirm("Are you sure to delete this farmer ?");

            if (confirmation) {
                jQuery.ajax({
                    type: "POST",
                    dataType: "json",
                    url: hitURL,
                    data: {
                        id: id
                    }
                }).done(function(data) {
                    console.log(data);
                    currentRow.parents('tr').remove();
                    if (data.status = true) {
                        alert("farmer successfully deleted");
                    } else if (data.status = false) {
                        alert("farmer deletion failed");
                    } else {
                        alert("Access denied..!");
                    }
                });
            }
        });
    });

    function Cardmodal(id) {
        $.ajax({
            url: baseURL + "getCardFarmer",
            method: "POST",
            data: {
                id: id
            },
            datatype: "json",
            success: function(response) {
                var image = JSON.parse(response);
                $('#image_card_1').attr('src', baseURL + image.image_card_1);
                $('#image_card_2').attr('src', baseURL + image.image_card_2);
                $('#cardModal').modal('show');
            },
            error: function(xhr, status, error) {
                // การแสดงผลข้อผิดพลาด
                console.log(status);
                console.log(error);
            }
        })
    }

    function Bookmodal(id) {
        $.ajax({
            url: baseURL + "getBookFarmer",
            method: "POST",
            data: {
                id: id
            },
            datatype: "json",
            success: function(response) {
                var image = JSON.parse(response);
                $('#image_book').attr('src', baseURL + image.image_book);
                $('#bookModal').modal('show');
            },
            error: function(xhr, status, error) {
                // การแสดงผลข้อผิดพลาด
                console.log(status);
                console.log(error);
            }
        })
    }
</script>