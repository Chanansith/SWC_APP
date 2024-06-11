<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Permission
        </h1>
    </section>
    <section class="content">
    <div class="row">
      <div class="col-xs-12 text-right">
        <div class="form-group">
          <a class="btn btn-primary" href="<?php echo base_url(); ?>addPermission"><i class="fa fa-plus"></i> Add New</a>
        </div>
      </div>
    </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Permission List</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>permission/" method="POST" id="searchList">
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
                                <th>ชื่อผู้ใช้</th>
                                <th>รหัสผ่าน</th>
                                <th>สิทธิการเข้าถึง</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            <?php
                            if (!empty($adminRecords)) {

                                $i = $segment;
                                foreach ($adminRecords as $record) {
                                    $i++
                            ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $record->username ?></td>
                                        <td><?php echo $record->pass ?></td>
                                        <td><?php
                                            if ($record->role === "1") {
                                                echo "พนักงานขาย";
                                            }
                                            if ($record->role === "2") {
                                                echo "บัญชี";
                                            }
                                            if ($record->role === "3") {
                                                echo "CEO";
                                            }
                                            if ($record->role === "4") {
                                                echo "ผู้จัดการ";
                                            }
                                            ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-info" href="<?php echo base_url('editPermission/') . $record->username; ?>"><i class="fa fa-pencil"></i></a>
                                            <!-- <a class="btn btn-sm btn-danger deleteProduct_subtype" href="#" data-id=""><i class="fa fa-trash"></i></a> -->
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>

                    </div>
                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('ul.pagination li a').click(function(e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "permission/" + value);
            jQuery("#searchList").submit();
        });
        jQuery(document).on("click", ".deleteWarehouse", function() {
            var id = $(this).data("id"),
                hitURL = baseURL + "deleteWarehouse",
                currentRow = $(this);
            var confirmation = confirm("Are you sure to delete this warehouse ?");

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
                        alert("warehouse successfully deleted");
                    } else if (data.status = false) {
                        alert("warehouse deletion failed");
                    } else {
                        alert("Access denied..!");
                    }
                });
            }
        });
    });
</script>