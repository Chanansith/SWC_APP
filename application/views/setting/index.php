<?php

if ($language == "en") {

}
if ($language == "th") {

}
if ($language == "lao") {

}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Company Setting
    </h1>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Warehouse List</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>ลำดับ</th>
                <th>รูป</th>
                <th>ชื่อสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th class="text-center">Actions</th>
              </tr>
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
      jQuery("#searchList").attr("action", baseURL + "warehouse/" + value);
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