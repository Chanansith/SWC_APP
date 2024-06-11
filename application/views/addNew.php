<div class="container">
    <!-- Content Header (Page header) -->
   <lable class="alert alert-primary"> สมัครสมาชิก source of IMW register</label>
  
      <h3>
        แหล่งกำเนิดมูลฝอยติดเชื้อ source of IMW register

      </h3>
    
    <section class="container">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                
                <div class="row">
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
                <div class="box box-primary">
                    <div class="box-header">
                        
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    
                    <form role="form" id="addUser" action="<?php echo base_url() ?>saveadduser" method="post" role="form">
                        <div class="box-body">
                      
                           
                        <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text">รหัสสถานพบาบาล</label>
                                      <input type="radio" value="1" name="hascode" checked/> มี
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
                                        <label for="fname">ชื่อสถานประกอบการ</label>
                                        <input type="text" class="form-control required" id="companyname" name="companyname" maxlength="128" value="<?php echo set_value('companyname');?>" required>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">ประเภท</label>
                                        <select name="cate_id" class="form-control">
                                                <option value="0">โรงพยาบาล</option>
                                                <option value="1">สถานพยาบาล</option>
                                           </select>
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
                                        <input type="text" class="form-control required equalTo" id="address_no" name="address_no" maxlength="10" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">หมู่ที่</label>
                                        <input type="text" class="form-control required digits" id="moo" name="moo" maxlength="10" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">รหัสไปรษณีย์</label>
                                        <input type="text" class="form-control required digits" id="zipcode" name="zipcode" maxlength="10" required>
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
                                            <input type="number" class="form-control required" id="bed_count"  name="bed_count" maxlength="10" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ctext">ตำแหน่งแผนที่ :ละติจูด</label>
                                                <input type="text" class="form-control required equalTo" id="lat" name="lat" maxlength="20">
                                            </div>
                                        </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ctext">ลองติจูด:</label>
                                            <input type="text" class="form-control required equalTo" id="lng" name="lng" maxlength="20">
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
                                            
                                           <select id="main_location" name="main_location"  class="form-control">
                                                <option value="0">--อปท.ที่เป็นที่ตั้ง--</option>
                                              
                                           </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ctext">เบอร์โทรศัพท์:</label>
                                            <input type="text" class="form-control required" id="tel_no" name="tel_no" maxlength="20" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ctext">อีเมล์
                                            </label>
                                            <input type="text" class="form-control required equalTo" id="email" name="email" maxlength="200">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ctext">เบอร์โทรศัพท์มือถือ:</label>
                                            <input type="text" class="form-control required equalTo" id="mobile_no" name="mobile_no" maxlength="20" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                 
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ctext">รหัสผ่านเข้าระบบ:</label>
                                            <input type="password" class="form-control required" id="pass" name="pass" maxlength="50" required>
                                        </div>
                                    </div>
                                </div>

                        </div>


                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submt" id="btnsave" class="btn btn-primary" value="บันทึก" />
                            <input type="reset" class="btn btn-default" value="ยกเลิก" />
                        </div>
                    </form>
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

    function clearOption(elementid,default_start=0){
        var select = document.getElementById(elementid);
        var length = select.options.length;
        var start=length-1;
        if (default_start>0){
            start=default_start;
        }

        for (i = start; i >= 0; i--) {
        select.options[i] = null;
        }
    }

    $(document).ready(function(){
 

        $('#btnsave').on('click', function (e) {
       
            e.preventDefault();

          

            document.getElementById("addUser").submit();
            
       
        });

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
         
            provincename= $("#province option:selected").text();
              console.log("province"+provincename);

              //load amphure


                try {
            // Fetch data from the RESTful API
        
                    clearOption("amphure");
                    clearOption("district");
                    clearOption("main_location");
                    const response =await  fetch(base_url+'provinces/amphures/'+provinceid);
                   // console.log(response);
                    const data = await response.json();
                

                    // Get the select element
                    const selectElement = document.getElementById('amphure');
                    const option_default = document.createElement('option');
                    option_default.value ="0"; // or any other property of your data
                    option_default.text = "เลือกข้อมูล"; // or any other property of your data
                    selectElement.appendChild(option_default);
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

                try {
            // Fetch data from the RESTful API
                  
                    const response_location =await  fetch(base_url+'provinces/mainlocation/'+provincename);
                   
                    const data_location = await response_location.json();
                    console.log(data_location);

                    // Get the select element
                    const main_locaton_element = document.getElementById('main_location');

                    // Loop through the data and create option elements
                    data_location.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id; // or any other property of your data
                        option.text = item.location_name; // or any other property of your data
                        main_locaton_element.appendChild(option);
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
                    const option_default = document.createElement('option');
                    option_default.value ="0"; // or any other property of your data
                    option_default.text = "เลือกข้อมูล"; // or any other property of your data
                    selectElement.appendChild(option_default);
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


