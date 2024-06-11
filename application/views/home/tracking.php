<head>

    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>ບໍລິສັດ ພັນເພັດ ພັດທະນາກະສິກຳ ຈຳກັດ</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Favicons -->

</head>

<style>
    body {
        background: #ddd3;
        height: 100vh;
        vertical-align: middle;
        display: flex;
        font-family: Muli;
        font-size: 14px;
    }

    .card {
        margin: auto;
        width: 38%;
        max-width: 600px;
        padding: 4vh 0;
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-top: 3px solid rgb(252, 103, 49);
        border-bottom: 3px solid rgb(252, 103, 49);
        border-left: none;
        border-right: none;
    }

    @media(max-width:768px) {
        .card {
            width: 90%;
        }
    }

    .title {
        color: rgb(252, 103, 49);
        font-weight: 600;
        margin-bottom: 2vh;
        padding: 0 8%;
        font-size: initial;
    }

    .details {
        font-weight: 400;
    }

    .info {
        padding: 5% 8%;
    }

    .info .col-5 {
        padding: 0;
    }

    #heading {
        color: grey;
        line-height: 6vh;
    }

    .pricing {
        background-color: #ddd3;
        padding: 2vh 8%;
        font-weight: 400;
        line-height: 2.5;
    }

    .pricing .col-3 {
        padding: 0;
    }

    .total {
        padding: 2vh 8%;
        color: rgb(252, 103, 49);
        font-weight: bold;
    }

    .total .col-3 {
        padding: 0;
    }

    .footer {
        padding: 0 8%;
        font-size: x-small;
        color: black;
    }

    .footer img {
        height: 5vh;
        opacity: 0.2;
    }

    .footer a {
        color: rgb(252, 103, 49);
    }

    .footer .col-10,
    .col-2 {
        display: flex;
        padding: 3vh 0 0;
        align-items: center;
    }

    .footer .row {
        margin: 0;
    }

    #progressbar {
        margin-bottom: 3vh;
        overflow: hidden;
        color: rgb(252, 103, 49);
        padding-left: 0px;
        margin-top: 3vh
    }

    #progressbar li {
        list-style-type: none;
        font-size: x-small;
        width: 25%;
        float: left;
        position: relative;
        font-weight: 500;
        color: rgb(160, 159, 159);
        font-size: 15px;
    }

    #progressbar #step1:before {
        content: "";
        color: rgb(252, 103, 49);
        width: 5px;
        height: 5px;
        margin-left: 0px !important;
        /* padding-left: 11px !important */
    }

    #progressbar #step2:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-left: 32%;
    }

    #progressbar #step3:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-right: 32%;
        /* padding-right: 11px !important */
    }

    #progressbar #step4:before {
        content: "";
        color: #fff;
        width: 5px;
        height: 5px;
        margin-right: 0px !important;
        /* padding-right: 11px !important */
    }

    #progressbar li:before {
        line-height: 29px;
        display: block;
        font-size: 12px;
        background: #ddd;
        border-radius: 50%;
        margin: auto;
        z-index: -1;
        margin-bottom: 1vh;
    }

    #progressbar li:after {
        content: '';
        height: 2px;
        background: #ddd;
        position: absolute;
        left: 0%;
        right: 0%;
        margin-bottom: 2vh;
        top: 1px;
        z-index: 1;
    }

    .progress-track {
        padding: 0 8%;
    }

    #progressbar li:nth-child(2):after {
        margin-right: auto;
    }

    #progressbar li:nth-child(1):after {
        margin: auto;
    }

    #progressbar li:nth-child(3):after {
        float: left;
        width: 68%;
    }

    #progressbar li:nth-child(4):after {
        margin-left: auto;
        width: 132%;
    }

    #progressbar li.active {
        color: black;
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: rgb(252, 103, 49);
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    .tracking {
        margin-top: 20px;
    }
</style>
<?php
$product_name_en = "";
$product_name_la = "";
$first_name = "";
$last_name = "";
$farm_name_en = "";
$farm_name_la = "";
$planting_date = "";
$harvest_date_befor = "";
$harvest_date_affter = "";
$yield_affter = "";
$yield_befor = "";
$image = "";
if (!empty($production)) {
    foreach ($production as $b) {
        $product_name_en = $b->product_name_en;
        $product_name_la = $b->product_name_la;
        $first_name = $b->first_name;
        $last_name = $b->last_name;
        $image = $b->product_image;
        $farm_name_en = $b->farm_name_en;
        $farm_name_la = $b->farm_name_la;
        $planting_date = $b->planting_date;
        $harvest_date_befor = $b->harvest_date_befor;
        $harvest_date_affter = $b->harvest_date_affter;
        $yield_befor = $b->yield_befor;
        $yield_affter = $b->yield_affter;
    }
}
?>
<div class="card">
    <div style="text-align: right;margin-right:20px">
        <select id="selectBox" onchange="changeFunc();">
            <option value="1">Eng</option>
            <option value="2">Lao</option>
        </select>
    </div>
    <div style="text-align: center;">
        <img src="<?php echo base_url($image) ?>" alt="Image" style="width:100%;min-width:150px;max-height:350px;max-width:400px;margin-top:20px;margin-bottom:20px">
    </div>
    <div class="title" id="product_name_la" style="display: none;"><?= $product_name_la ?></div>
    <div class="title" id="product_name_en" style="display: block;"><?= $product_name_en ?></div>
    <div class="info">
        <div class="row">
            <div class="col-7">
                <span id="heading">Farm Name</span><br>
                <span class="details" id="farm_name_la" style="display: none;"><?= $farm_name_la ?></span>
                <span class="details" id="farm_name_en" style="display: block;"><?= $farm_name_en ?></span>
            </div>
            <div class="col-5 pull-right">
                <span id="heading">Farmer Name</span><br>
                <span class="details"><?= $first_name ?></span>
                <span class="details"><?= $last_name ?></span>
            </div>
        </div>
    </div>
    <div class="pricing">
        <div class="row">
            <div class="col-9">
                <span id="name">Planting Date</span>
            </div>
            <div class="col-3">
                <span id="price"><?= $planting_date ?></span>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <span id="name">Harvest Date</span>
            </div>
            <div class="col-3">
                <span id="price">Before:<?= $harvest_date_befor ?></span>
            </div>
            <div class="col-3">
                <span id="price">After:<?= $harvest_date_affter ?></span>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <span id="name">Yield(tan)</span>
            </div>
            <div class="col-3">
                <span id="price">Before:<?= $yield_befor ?></span>
            </div>
            <div class="col-3">
                <span id="price">After:<?= $yield_affter ?></span>
            </div>
        </div>
    </div>
    <!-- <div class="total">
                <div class="row">
                    <div class="col-9"></div>
                    <div class="col-3"><big>&pound;262.99</big></div>
                </div>
            </div> -->
    <div class="tracking">
        <div class="title">Tracking Order</div>
    </div>
    <div class="progress-track">
        <ul id="progressbar">
            <li class="step0 active " id="step1">start</li>
            <?php
            if (!empty($cultivation)) {
                foreach ($cultivation as $key => $c) {

            ?>
                    <li class="step0 active text-center" id="step2" onclick="cultivationmodal(<?= $key ?>)"><?= $c->method_name ?></li>
            <?php
                }
            }
            ?>
            <?php
            if ($yield_affter !== "0") { ?>
                <li class="step0 active text-right" id="step4">end</li>
            <?php } else { ?>
                <li class="step0 text-right" id="step4">end</li>
            <?php }
            ?>
            <!-- <li class="step0 active " id="step1">Ordered</li>
                    <li class="step0 active text-center" id="step2">Shipped</li>
                    <li class="step0 active text-right" id="step3">On the way</li>
                    <li class="step0 text-right" id="step4">Delivered</li>
                    <li class="step0 text-right" id="step4">Delivered</li> -->
        </ul>
    </div>

    <!-- <div class="footer">
        <div class="row">
            <div class="col-2"><img class="img-fluid" src="https://i.imgur.com/YBWc55P.png"></div>
            <div class="col-10">Want any help? Please &nbsp;<a> contact us</a></div>
        </div>


    </div> -->
</div>
<style>
    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    .modal-dialog {
        width: 600px;
        margin: 30px auto;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        /* Could be more or less, depending on screen size */
    }

    .modal-header {
        min-height: 16.43px;
        /* padding: 15px; */
        border-bottom: 1px solid #e5e5e5;
    }

    .form-group {
        margin-bottom: 15px;
    }

    /* The Close Button */
    .close {
        float: right;
        font-size: 21px;
        font-weight: 700;
        line-height: 1;
        color: #000;
        text-shadow: 0 1px 0 #fff;
        filter: alpha(opacity=20);
        opacity: .2;
    }
</style>
<div class="modal fade" id="Cultivationmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="method_name"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="method_description">Description</label>
                    <div id="method_description"></div>
                </div>
                <div class="form-group">
                    <label for="problem">Problem</label>
                    <div id="problem"></div>
                </div>
                <div class="form-group">
                    <img class="form-control" src="" id="image_1" alt="Image" style="margin:auto;width:100%;height:300px;display: block;">
                </div>
                <div class="form-group">
                    <img class="form-control" src="" id="image_2" alt="Image" style="margin:auto;width:100%;height:300px;display: block;">
                </div>
                <div class="form-group">
                    <img class="form-control" src="" id="image_3" alt="Image" style="margin:auto;width:100%;height:300px;display: block;">
                </div>
                <div class="form-group">
                    <img class="form-control" src="" id="image_4" alt="Image" style="margin:auto;width:100%;height:300px;display: block;">
                </div>
                <div class="form-group">
                    <img class="form-control" src="" id="image_5" alt="Image" style="margin:auto;width:100%;height:300px;display: block;">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="modal fade" id="cultivationmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Image Farm</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <img class="form-control" src="" id="image_1" alt="Image" style="margin:auto;width:100%;height:300px;">
        </div>
        <div class="form-group">
          <img class="form-control" src="" id="image_2" alt="Image" style="margin:auto;width:100%;height:300px;">
        </div>
        <div class="form-group">
          <img class="form-control" src="" id="image_3" alt="Image" style="margin:auto;width:100%;height:300px;">
        </div>
      </div>
    </div>
  </div>
</div> -->
<script>
    var modal = document.getElementById("Cultivationmodal");
    var span = document.getElementsByClassName("close")[0];
    var baseURL = "<?php echo base_url(); ?>";

    function cultivationmodal(key) {
        var data = <?= json_encode($cultivation) ?>;
        if (data[key].method_name) {
            $('#method_name').html(data[key].method_name);
        } else {
            const method_name = document.getElementById('method_name');
            method_name.style.display = "none";
        }
        if (data[key].method_description) {
            $('#method_description').html(data[key].method_description);
        } else {
            const method_description = document.getElementById('method_description');
            method_description.style.display = "none";
        }
        if (data[key].problem) {
            $('#problem').html(data[key].problem);
        } else {
            const problem = document.getElementById('problem');
            problem.style.display = "none";
        }
        if (data[key].image1) {
            $('#image_1').attr('src', baseURL + data[key].image1);
        } else {
            const image_1 = document.getElementById('image_1');
            image_1.style.display = "none";
        }
        if (data[key].image2) {
            $('#image_2').attr('src', baseURL + data[key].image2);
        } else {
            const image_2 = document.getElementById('image_2');
            image_2.style.display = "none";
        }
        if (data[key].image3) {
            $('#image_3').attr('src', baseURL + data[key].image3);
        } else {
            const image_3 = document.getElementById('image_3');
            image_3.style.display = "none";
        }
        if (data[key].image4) {
            $('#image_4').attr('src', baseURL + data[key].image4);
        } else {
            const image_4 = document.getElementById('image_4');
            image_4.style.display = "none";
        }
        if (data[key].image5) {
            $('#image_5').attr('src', baseURL + data[key].image5);
        } else {
            const image_5 = document.getElementById('image_5');
            image_5.style.display = "none";
        }
        modal.style.display = "block";
    }
    span.onclick = function() {
        modal.style.display = "none";
    }
</script>
<script type="text/javascript">

function changeFunc() {
 var selectBox = document.getElementById("selectBox");
 var selectedValue = selectBox.options[selectBox.selectedIndex].value;
//  alert(selectedValue);
if(selectedValue==1){
    document.getElementById('product_name_en').style.display = "block";
    document.getElementById('farm_name_en').style.display = "block";
    document.getElementById('product_name_la').style.display = "none";
    document.getElementById('farm_name_la').style.display = "none";
   } if(selectedValue==2){
    document.getElementById('product_name_en').style.display = "none";
    document.getElementById('farm_name_en').style.display = "none";
    document.getElementById('product_name_la').style.display = "block";
    document.getElementById('farm_name_la').style.display = "block";
   }
}

</script>