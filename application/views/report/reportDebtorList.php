<?php
$title = "";
if (!empty($day)) {
    $title = "วันที่ " . $day;
}
if (!empty($month)) {
    if ($month === "1") {
        $title = "มกราคม";
    }
    if ($month === "2") {
        $title = "กุมภาพันธ์";
    }
    if ($month === "3") {
        $title = "มีนาคม";
    }
    if ($month === "4") {
        $title = "เมษายน";
    }
    if ($month === "5") {
        $title = "พฤษภาคม";
    }
    if ($month === "6") {
        $title = "มิถุนายน";
    }
    if ($month === "7") {
        $title = "กรกฎาคม";
    }
    if ($month === "8") {
        $title = "สิงหาคม";
    }
    if ($month === "9") {
        $title = "กันยายน";
    }
    if ($month === "10") {
        $title = "ตุลาคม";
    }
    if ($month === "11") {
        $title = "พฤศจิกายน";
    }
    if ($month === "12") {
        $title = "ธันวาคม";
    }
}
if (!empty($year)) {
    $title = "ปี " . $year;
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> รายงานลูกหนี้ค่างวด <?= $title ?>
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('reportDebtor') ?>"><i class="fa fa-dashboard"></i> รายงานลูกหนี้</a></li>
        </ol>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">รายงานลูกหนี้</h3>
                        <div class="box-tools">
                            <!-- <form action="<?php echo base_url() ?>reportDebtorList/" method="POST" id="searchList">
                                <div class="input-group">
                                    <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" />
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form> -->
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>ลำดับ</th>
                                <th>รถ</th>
                                <th>ทะเบียน</th>
                                <th>เต็นท์จ่าย</th>
                                <th>เต็นท์รับ</th>
                                <th>รวม</th>
                            </tr>
                            <?php
                            $sumpayall=0;
                            $sumreceiveall=0;
                            if (!empty($debtorRecords)) {
                                $i = 0;
                                foreach ($debtorRecords as $record) {
                                    $sumtentpay = 0;
                                    $sumtentReceive = 0;
                                    $i++
                            ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $record->model ?></td>
                                        <td><?php echo $record->registerno ?></td>
                                        <td><?php if ($record->tentPay) {
                                                foreach ($record->tentPay as $tentpay) {
                                                    $sumtentpay += $tentpay->cost;
                                                }
                                                echo $sumtentpay;
                                                $sumpayall=$sumpayall+$sumtentpay;
                                            }  ?></td>
                                        <td><?php if ($record->tentReceive) {
                                                foreach ($record->tentReceive as $tentReceive) {
                                                    $sumtentReceive += $tentReceive->cost;
                                                }
                                                echo $sumtentReceive;
                                                $sumreceiveall=$sumreceiveall+$sumtentReceive;
                                            } ?></td>
                                        <td><?php
                                        if ($sumtentpay>$sumtentReceive){
                                            echo $sumtentpay - $sumtentReceive;
                                        }
                                            ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

<tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?php echo($sumpayall)?></th>
                                <th><?php echo($sumreceiveall)?></th>
                                <th>
                                <?php
                                        if ($sumpayall>$sumreceiveall){
                                            echo $sumpayall - $sumreceiveall;
                                        }
                                            ?>

                                </th>
                            </tr>
                        </table>


                    </div><!-- /.box-body -->

                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    // jQuery(document).ready(function() {
    //     jQuery('ul.pagination li a').click(function(e) {
    //         e.preventDefault();
    //         var link = jQuery(this).get(0).href;
    //         var value = link.substring(link.lastIndexOf('/') + 1);
    //         jQuery("#searchList").attr("action", baseURL + "debtor/" + value);
    //         jQuery("#searchList").submit();
    //     });
    // })
</script>