<div class="container">
    <!-- Content Header (Page header) -->
   <lable class="alert alert-primary"> สมัครสมาชิก Disposal & logistic of IMW register</label>
  
      <h3>
         บริษัทจัดเก็บและขนส่ง Disposal & logistic of IMW register

      </h3>
 
    
    <section class="container">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                
                <div class="box box-primary">
                    <div class="box-header">
                        
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url_api ?>saveadduser" method="post" role="form">
                        <div class="box-body">
                           
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text">รหัสบริษัท</label>
                                      <input type="radio" value="1" name="hascode"/> มี
                                      <input type="radio" value="0" name="hascode"/> ไม่มี
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                       
                                        <input type="text" class="form-control" id="code" name="code" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">คำนำหน้า</label>
                                        <input type="text" class="form-control required" id="title" name="title" maxlength="50">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">ชื่อ-สกุล</label>
                                        <input type="text" class="form-control required" id="fullname" name="fullname" maxlength="150">
                                    </div>
                                    
                                </div>
                              
                            </div>
                        <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="fname">ชื่อสถานประกอบการ</label>
                                        <input type="text" class="form-control required" id="companyname" name="companyname" maxlength="150">
                                    </div>
                                    
                                </div>
                        </div>       
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text">ประเภทย่อย</label>
                                        <select name="sub_cate_id"  class="form-control">
                                        <option value="0">สถานพยาบาล</option>
                                                <option value="1">รพสต.</option>
                                           </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address_no">ที่ตั้งเลขที่</label>
                                        <input type="text" class="form-control required equalTo" id="address_no" name="address_no" maxlength="10">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">หมู่ที่</label>
                                        <input type="text" class="form-control required digits" id="moo" name="moo" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">รหัสไปรษณีย์</label>
                                        <input type="text" class="form-control required digits" id="zipcode" name="zipcode" maxlength="10">
                                    </div>
                                </div>
                            </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="role">จังหวัด</label>
                                            <select class="form-control required" id="province" name="province">
                                                <option value="0">เลือกจังหวัด</option>
                                                <?php
                                                if(!empty($provinces))
                                                {
                                                    foreach ($provinces as $pr)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $pr->id?>"><?php echo $pr->name_th ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                            
                                    <div class="col-md-6">
                                         <div class="form-group">
                                        <label for="role">อำเภอ</label>
                                        <select class="form-control required" id="amphure" name="amphure">
                                            <option value="0">เลือก</option>
                                       
                                        </select>
                                        </div>
                                        </div>
                                </div>   
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="role">ตำบล</label>
                                        <select class="form-control required" id="district" name="district">
                                         
                                                <option value="0">เลือก</option>
                                        </select>
                                        </div>
                                    </div>
                              
                             
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="text">จำนวนเตียง</label>
                                            <input type="number" class="form-control required" id="bed_count"  name="bed_count" maxlength="10">
                                        </div>
                                    </div>
                                </div>
                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ctext">ตำแหน่งแผนที่ :ละติจูด</label>
                                                <input type="text" class="form-control required equalTo" id="lat" name="lat" maxlength="10">
                                            </div>
                                        </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ctext">ลองติจูด:</label>
                                            <input type="text" class="form-control required equalTo" id="lng" name="lng" maxlength="10">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                <div id="map" style="width:800px;height:300px;"></div>


                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ctext">อปท.ที่เป็นที่ตั้ง
                                            </label>
                                           <select name="main_location"  class="form-control">
                                                <option value="0">--อปท.ที่เป็นที่ตั้ง--</option>
                                                <?php
                                                if(!empty($main_location))
                                                {
                                                    foreach ($main_location as $ml)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $ml->id?>"><?php echo $ml->location_name ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                           </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ctext">เบอร์โทรศัพท์:</label>
                                            <input type="text" class="form-control" id="tel_no" name="tel_no" maxlength="20">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ctext">อีเมล์
                                            </label>
                                            <input type="text" class="form-control required" id="email" name="email" maxlength="200">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ctext">เบอร์โทรศัพท์มือถือ:</label>
                                            <input type="text" class="form-control required" id="mobile_no" name="mobile_no" maxlength="20">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ctext">เลขที่ใบอนุญาตจัดเก็บ
                                            </label>
                                            <input type="text" class="form-control" id="registerno" name="registerno" maxlength="200">
                                        </div>
                                    </div>
                               
                                </div>
                        </div>


                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="บันทึก" />
                            <input type="reset" class="btn btn-default" value="ยกเลิก" />
                        </div>
                    </form>
                </div>
            </div>
          
             <div class="col-md-6">
                    <?php
                        $this->load->helper('form');
                        $error = $this->session->flashdata('error');
                        if($error)
                        {
                    ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>                    
                    </div>
                    <?php } ?>
                    <?php  
                        $success = $this->session->flashdata('success');
                        if($success)
                        {
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
        </div>    
    </section>
    
</div>

<script>
    var base_url="<?php echo base_url() ?>";
    var provinceid=0;
    var amphureid=0;
    var lat=0;
    var lng=0;

    $(document).ready(function(){
 
        $('#lat').on('focus', function (e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 9) {
            lat =parseFloat($(this).val());
            initMap(lat,lng)
        }
       
        });
        
        $('#lng').on('focus', function (e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        if (code == 9) {
            lng =parseFloat($(this).val());
            initMap(lat,lng)
        }
       
        });
      
        $('#province').change(async function(){ 
            provinceid = $(this).val();
              console.log("province"+provinceid);

              //load amphure


                try {
            // Fetch data from the RESTful API
        
                    const response =await  fetch(base_url+'provinces/amphures/'+provinceid);
                    console.log(response);
                    const data = await response.json();
                

                    // Get the select element
                    const selectElement = document.getElementById('amphure');

                    // Loop through the data and create option elements
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id; // or any other property of your data
                        option.text = item.name_th; // or any other property of your data
                        selectElement.appendChild(option);
                    });
                } catch (error) {
                    console.error('Error fetching data:', error);
                }

            });

            $('#amphure').change( async function(){ 
                amphureid = $(this).val();
              console.log("amphure"+amphureid);
              //load district

              
              try {
            // Fetch data from the RESTful API
        
                    const response =await  fetch(base_url+'provinces/districts/'+amphureid);
                    console.log(response);
                    const data = await response.json();
                

                    // Get the select element
                    const selectElement = document.getElementById('district');

                    // Loop through the data and create option elements
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id; // or any other property of your data
                        option.text = item.name_th; // or any other property of your data
                        selectElement.appendChild(option);
                    });
                } catch (error) {
                    console.error('Error fetching data:', error);
                }

            });


            async function initMap(mylat,mylng) {
  // Request needed libraries.
  const { Map } = await google.maps.importLibrary("maps");
  var myLatlng = { lat:mylat, lng:mylng };
  console.log(myLatlng);
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 10,
    center: myLatlng,
  });
  // Create the initial InfoWindow.
  let infoWindow = new google.maps.InfoWindow({
    content: "Click the map to get Lat/Lng!",
    position: myLatlng,
  });

  infoWindow.open(map);
  // Configure the click listener.
  map.addListener("click", (mapsMouseEvent) => {
    // Close the current InfoWindow.
    infoWindow.close();
    // Create a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
      position: mapsMouseEvent.latLng,
    });
    infoWindow.setContent(
      JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
    );
    infoWindow.open(map);
  });
}

initMap(19.7110803,99.907557);

    })

</script>    


