// get the product information from the server
  function getProductData(row_id,input_code) {
    var product_code ="";
    
    product_code= $("#product_code_" + row_id).val();
    console.log("product code="+product_code);

    if (product_code == "") {
      $("#rate_" + row_id).val("");
      $("#rate_value_" + row_id).val("");
    
      $("#qty_" + row_id).val("");

      $("#amount_" + row_id).val("");
      $("#amount_value_" + row_id).val("");
   
      return false;
    } 



      console.log("get product by="+product_code);
      $.ajax({
        url: base_url + 'orders/getProductValueByCode/'+product_code,
        type: 'post',
        data: {
         
        },
        dataType: 'json',
        success: function(response) {
          // setting the rate value into the rate input field
					console.log(response);
          $("#product_id_" + row_id).val(response.id);
          $("#product_name_" + row_id).val(response.name);
          $("#rate_" + row_id).val(response.sale_price);
          $("#rate_value_" + row_id).val(response.sale_price);
					$("#sale_unit_" + row_id).val(response.sale_unit);
					$("#stock_unit_" + row_id).val(response.stock_unit);
          $("#on_stock_" + row_id).val(response.on_stock);
          $("#qty_" + row_id).val(1);
          $("#qty_value_" + row_id).val(1);

          var total = Number(response.sale_price) * 1;
          total = total;
          
          $("#amount_" + row_id).val(total);
          $("#amount_value_" + row_id).val(total);
       
					//คำนวณ
          subAmount();
        } // /success
      }); // /ajax function to fetch the product data 
    
  }



 function getTotal(row = null) {
    if (row) {
      var total = Number($("#rate_" + row).val()) * Number($("#qty_" + row).val());
      total = total-Number($("#item_discount_" + row).val());


      $("#amount_" + row).val(total);
      $("#amount_value_" + row).val(total);

  
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }
  function getCustData() {
    console.log("set cust data");
      var id= $("#cust_id").val();
      $.ajax({
        url: base_url + 'Customers/fetchDataById/'+id,
        type: 'GET',
        data: {
         
        },
        dataType: 'json',
        success: function(response) {
          // setting the rate value into the rate input field
					console.log(response);
          $("#cust_code").val(response.cust_code);
          $("#cust_name").val(response.cust_name_th);
        
         
        } // /success
      }); // /ajax function to fetch the product data 
    
  }
  

  
  // calculate the total amount of the order
  function subAmount() {
    //ค่าบริการ
		var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value'] : 0; ?>;
		var vat_type=$("#vat_type").val();

		//0:นอก 1: ใน
		//vat
    var vat_charge = <?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value'] : 0; ?>;

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    
    for (x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_" + count).val());
     
    } // /for


  
    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);
 

    // vat
   
    // service
    var service = (Number($("#gross_amount").val()) / 100) * service_charge;
    service = service;
    $("#service_charge").val(service);
    $("#service_charge_value").val(service);


    // total amount
    var totalAmount = (Number(totalSubAmount) +  Number(service));
   // totalAmount = totalAmount;

    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    var discount = Number($("#discount").val());
		var grandTotal=totalAmount;
    if (discount) {
       grandTotal = Number(totalAmount) - Number(discount);
 
      $("#net_amount").val(parseFloat(grandTotal).toFixed(2));
      $("#net_amount_value").val(grandTotal);
    } else {
      $("#net_amount").val(parseFloat(totalAmount).toFixed(2));
      $("#net_amount_value").val(totalAmount);

    } // /else discount 
    
		var vat =0;
		
		if (vat_type==0){
			vat=(grandTotal / 100) * vat_charge;
    	vat =parseFloat(vat).toFixed(2);
		}else{

			vat=(Number(grandTotal)*7)/107;
		}


		var sum_total_amount=0;
		if (vat_type==0){
			sum_total_amount= Number(grandTotal)+ Number(vat);
		}else{
			sum_total_amount= Number(grandTotal);
      exclude_vat=Number(sum_total_amount)- Number(vat);
			$("#net_amount").val(parseFloat(exclude_vat).toFixed(2));
      $("#net_amount_value").val(exclude_vat);
		}

		$("#vat_charge").val(parseFloat(vat).toFixed(2));
    $("#vat_charge_value").val(vat);
		$("#total_amount").val(parseFloat(sum_total_amount).toFixed(2));
    $("#total_amount_value").val(sum_total_amount);


  } // /sub total amount

  function removeRow(tr_id) {
    $("#product_info_table tbody tr#row_" + tr_id).remove();
    subAmount();
  }