
<?php include ("DBConnection.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
   
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


</head>
<body>
<form method="POST">
      <h1>PLACE ORDER</h1>
      <div class="formcontainer">
      <hr/>
      <br>
      <div class="container">
        <label for="name"><strong>Customer Name</strong></label>
        <br>
        <select name="cusName" id="source3" onchange="copyTextValue3()">

        <?php
        //Get Customer

        $query ="SELECT Customer_Name,Customer_Code FROM customers";
        $result = $con->query($query);
        if($result->num_rows> 0){
          $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        ?>
        <option>Select customer</option>
        <?php 

        $value=1;
        foreach ($options as $option) {   
          $sum=$value++;
        ?>
        <option value="<?php echo $option['Customer_Code'];?>"><?php echo $option['Customer_Name']; ?> </option>
        <?php 
        
        }    
        ?>
        </select>
        <br><br>

    <label for="orderNumber"><strong>Order Number</strong></label>
    <br>
    <input type="text" placeholder="Order Number" name="on" id="orderNum" required>
    
    </form>
    <br><br>
    <table>
  <tr>
    <th>Product Name</th>
    <th>Product Code</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Free</th>
    <th>Amount</th>
  </tr>
  <tr>

 <td><select name="product">

<?php

//GET PRODUCTS INTO DROPDOWN

$query ="SELECT product_Name FROM product";
$result = $con->query($query);
if($result->num_rows> 0){
  $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<option>Select Product</option>
<?php 
foreach ($options as $option) {
  
?>
<option ><?php echo $option['product_Name']; ?> </option>

<?php 
}

?>
</select></td>
<td><select name="product" id="source1" onchange="copyTextValues()" >

<?php

//GET PRODUCT CODE AND PRICE

$query ="SELECT product_code,price FROM product";
$result = $con->query($query);
if($result->num_rows> 0){
  $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<option>Select Code</option>
<?php 
foreach ($options as $option) {
  
?>
<option value="<?php echo $option['price'];?> "><?php echo $option['product_code']; ?> </option>

<?php 
}

?>
</select></td>

    <td><input type="text" id="price" name="price"></td>
    <td><input type="text" id="qty" name="qty"></td>
    <td><input type="text" name="free"  id="free"></td>
    <td><input type="text" id="totals"  onkeyup="sum();" /></td>
  </tr>
  <tr>
  
  <td><select name="product" >

<?php


//GET PRODUCTS INTO DROPDOWN

$query ="SELECT product_Name FROM product";
$result = $con->query($query);
if($result->num_rows> 0){
  $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<option>Select Product</option>
<?php 
foreach ($options as $option) {
?>
<option ><?php echo $option['product_Name']; ?> </option>

<?php 
}

?>
</select></td>
<td><select name="product" id="source2" onchange="copyTextValues2()" >

<?php
//GET PRODUCT CODE AND PRICE

$query ="SELECT product_Name,product_code,price FROM product";
$result = $con->query($query);
if($result->num_rows> 0){
  $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<option>Select Code</option>
<?php 
foreach ($options as $option) {
?>
<option value="<?php echo $option['price'];?>"><?php echo $option['product_code']; ?> </option>

<?php 
}

?>
</select></td>

    <td><input type="text" id="price2" name="price2"></td>
    <td><input type="text" id="qty2"></td>
    <td><input type="text" name="free2" id="free2" ></td>
    <td><input type="text" id="totals2"  onkeyup="sum();" /></td>
</tr>
</table>
<br><br>
<label style="color:red;"><strong>Net Amount</strong></label>
<input type="text" id="txt3" readonly/>

</body>



<!----------------------------------------JAVASCRIPT PART------------------------------>

<script src="jquery-3.5.0.min.js"></script>
	<script>
		$(document).ready(function(){

    	// Get value on keyup funtion
    	$("#price, #qty").keyup(function(){

    	var total=0;    	
    	var x = Number($("#price").val());
    	var y = Number($("#qty").val());
    	var total=x * y;  

    	$('#totals').val(total);

      //GET AMOUNT
    });
    
});
$(document).ready(function(){
    	// Get value on keyup funtion
    	$("#price2, #qty2").keyup(function(){
      
    	var total2=0;    	
    	var x = Number($("#price2").val());
    	var y = Number($("#qty2").val());
    	var total2=x * y;  

    	$('#totals2').val(total2);

     //GET AMOUNT

    });
    
});

//COPY VALUES
function copyTextValues() {  
    const text1 = document.getElementById("source1").value;
    document.getElementById("price").value = text1;
  
}
function copyTextValues2() {  
    const text2 = document.getElementById("source2").value;
    document.getElementById("price2").value = text2;
}
function copyTextValue3() {  
    const text2 = document.getElementById("source3").value;
    document.getElementById("orderNum").value = text2;
}

//GET THE NET AMOUNTS

function sum() {
      var txtFirstNumberValue = document.getElementById('totals').value;
      var txtSecondNumberValue = document.getElementById('totals2').value;
      var result2 = parseInt(txtFirstNumberValue);
      var result = parseInt(txtFirstNumberValue) + parseInt(txtSecondNumberValue);
      if (!isNaN(result)) {
         document.getElementById('txt3').value = result;
         
      }else{
        document.getElementById('txt3').value = result2;
      }
}
</script>

</html>