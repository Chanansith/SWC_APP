<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> รายงานลูกหนี้ค้างดาวน์
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('down') ?>"><i class="fa fa-dashboard"></i> รายงานลูกหนี้ค้างดาวน์</a></li>
        </ol>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">รายงานลูกหนี้ค้างดาวน์</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>reportDown/" method="POST" id="searchList">
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
                                <th>ลำดับ</th>
                                <th>รถ</th>
                                <th>ทะเบียน</th>
                                <th>สาขา</th>
                                <th>ชื่อ</th>
                                <th>ยอดดาว</th>
                                <th>ยอดชำระ</th>
                                <th>ยอดค้าง</th>
                            </tr>
                            <?php
                            if (!empty($downRecords)) {
                                $i = 0;

                                foreach ($downRecords as $record) {
                                    $i++;
                                    $sum = 0;
                            ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $record->model ?></td>
                                        <td><?php echo $record->registerno ?></td>
                                        <td><?php echo $record->branchname ?></td>
                                        <td><?php echo $record->custname ?></td>
                                        <td><?php echo $record->down_balance ?></td>
                                        <td><?php foreach ($record->downPayRecords as $downPay) {
                                                $sum = $sum + $downPay->cost;
                                            }
                                            echo $sum; ?></td>
                                        <td><?php if ($sum >= $record->down_balance) {
                                                echo "<span class='label label-success'>ชำระเสร็จสิ้น</span>";
                                            } else {
                                                echo $record->down_balance - $sum;
                                            } ?></td>
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

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery(document).on("click", ".deleteDown", function() {
            var id = $(this).data("id"),
                hitURL = baseURL + "deleteDown",
                currentRow = $(this);
            var confirmation = confirm("Are you sure to delete this ?");

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
                        alert("Down successfully deleted");
                    } else if (data.status = false) {
                        alert("Down deletion failed");
                    } else {
                        alert("Access denied..!");
                    }
                });
            }
        });
    });
</script>