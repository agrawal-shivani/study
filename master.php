<?php
  include "config.php";
  class master
 {
 	
 	function logIn($EmailId,$password)
 	{
 		global $dataBase;
 		$query="SELECT id FROM log_in WHERE emailId='$EmailId' and password='$password' ";
 		$data=mysqli_query($dataBase,$query);
 		$status=false;
 		if (mysqli_num_rows($data)>0)
 		 {
 		 	
 			$result=mysqli_fetch_assoc($data);
 			$status=true;

 		}
 			return $status;

 	}
 	
 	function vendorAdd($id,$VendorName,$company,$gstNo,$mobile,$city,$pincode,$address)
 	{
 	   global $dataBase;
 	   $returnArray=array();
 	   $returnArray=array('status'=>false,'message'=>'failed');
 	   if(!empty($id))
 	   { 
 	   	 $query2="UPDATE vendor SET vendorName='$VendorName',company='$company',address='$address',pincode='$pincode',GstNo='$gstNo',city='$city',mobileNo='$mobile' where vendorId='$id'";
 	   	 echo $query2;
 	   	 $data2=mysqli_query($dataBase,$query2);
 	   	 if ($data2) {
 	   	 	$returnArray=array('status'=>true,'message'=>'updated successfully');
 	         return $returnArray;

 	   	 }

 	   }
 	   else
 	   {
       $query1="SELECT vendorId FROM vendor where company='$company' and GstNo='$gstNo'";
 	   $data1=mysqli_query($dataBase,$query1);
 		if (mysqli_num_rows($data1)>0)
 		{
 			$returnArray=array('status'=>true,'message'=>'Vendor is already Exist');
 			return $returnArray;
 		}
 	   $query="INSERT INTO vendor(vendorName,company,address,pincode,GstNo,city,mobileNo) VALUES ('$VendorName','$company','$address','$pincode','$gstNo','$city','$mobile')";
 	  $data=mysqli_query($dataBase,$query);
 	  if($data)
 	  {
 			$returnArray=array('status'=>true,'message'=>'Vendor sucessfully Added');

 	  }
 	}
 	   return $returnArray;
 	}


 	function showVendor()
 	{
 		global $dataBase;
 		$returnArray=array();
 		$query="select * from vendor";
 		$data=mysqli_query($dataBase,$query);
 		 
 		if(mysqli_num_rows($data)>0)
 		{
 		   while ($result=mysqli_fetch_assoc($data)) {
 		   	  $returnArray[]=array('id'=>$result['vendorId'],'vendorName'=>$result['vendorName'],'company'=>$result['company'],'address'=>$result['address'],'pincode'=>$result['pincode'],'GstNo'=>$result['GstNo'],'city'=>$result['city'],'mobileNo'=>$result['mobileNo'],'created'=>$result['created']);
 		   	  
 		   }
 		   	  return $returnArray;

 		}
 		
 	}

function deleteVendor($vendorGstNo)
{
	global $dataBase;
 	$returnArray=array('status'=>false,'message'=>'failed');
	$query="DELETE FROM vendor WHERE GstNo='$vendorGstNo'"; 
	$data=mysqli_query($dataBase,$query);
	if ($data) 
	{
 	   $returnArray=array('status'=>true,'message'=>'Delete Sucessfully');

	}
	return $returnArray;
}
 		
  



  function getVendorName()
  {
 	 global $dataBase;
  	 $returnArray=array();
     $query="SELECT vendorId,vendorName FROM vendor";
 	 $data=mysqli_query($dataBase,$query);
 	 if(mysqli_num_rows($data)>0)
 	 {
 		   while ($result=mysqli_fetch_assoc($data)) 
 		   {
 		   	 $returnArray[]=array('vendorId'=>$result['vendorId'],'vendorName'=>$result['vendorName']);
 		   }
    }
 		    return $returnArray;

  }
   




 function deleteProduct($productNo)
{

	global $dataBase;
 	$returnArray=array('status'=>false,'message'=>'failed');
	$query="DELETE FROM purchasing WHERE productNo='$productNo'"; 
	$data=mysqli_query($dataBase,$query);
	if ($data) 
	{
 	   $returnArray=array('status'=>true,'message'=>'Delete Sucessfully');

	}
	return $returnArray;
}


	function addSales($customerId,$productNo,$noOfSoldProduct,$soldPrice)
  {
  	   global $dataBase;
  	   
  	   $returnArray=array();
  	   
 	   $returnArray=array('status'=>false,'message'=>'failed');
 	   if(!empty($salesId))
 	   { 
 	       
 	   	 $query2="UPDATE sales SET productNo='$productNo',noOfSoldProduct='$noOfSoldProduct',soldPrice='$soldPrice',totalAmount='$totalAmount'";
 	   	 
 	   	 
 	   	 $data2=mysqli_query($dataBase,$query2);
 	   	 if ($data2) { 
 	   	 	$returnArray=array('status'=>true,'message'=>'updated successfully');
 	         return $returnArray;
 	     }
 	 }
 	 else
 	 {

      $query="INSERT INTO sales(customerId,productNo,noOfSoldProduct,soldPrice,totalAmount) VALUES ('$customerId','$productNo','$noOfSoldProduct','$soldPrice','$totalAmount')";
 	  $data=mysqli_query($dataBase,$query);

 	   if($data)
 	  {
 			$returnArray=array('status'=>true,'message'=>'sales added successfully');

 	  }
 	
 	   return $returnArray;
 	}
 	}
  


  function getProductName()
  {
 	 global $dataBase;
  	 $returnArray=array();
     $query="SELECT productId,productName,sellingPrice FROM productStock";
 	 $data=mysqli_query($dataBase,$query);
 	 if(mysqli_num_rows($data)>0)
 	 {
 		   while ($result=mysqli_fetch_assoc($data)) 
 		   {
 		   	 $returnArray[]=array('productId'=>$result['productId'],'productName'=>$result['productName'],'sellingPrice'=>$result['sellingPrice']);
 		   }
 		    // print_r($returnArray);
 		    // print_r($returnArray);
    }
 		    return $returnArray;
 		    // print_r($returnArray);

  }



  function getcustomerId($mobileNo)
  { 
  	global $dataBase;
     $status=0;
     $returnArray=array();
     $query="SELECT * FROM customer ";
     $data=mysqli_query($dataBase,$query);
 	 if(mysqli_num_rows($data)>0)
 	   {
 		   while ($result=mysqli_fetch_assoc($data)) 
 		   {
 		   	  if($mobileNo==$result['mobileNo'])
 		   	  {
 		   	  	$status=1;
 		   	  	$customerId=$result['customerId'];
 		   	  	return $customerId;
 		   	  }
 		   }
 		   if($status==0)
 		   {
 		   	 $query1="INSERT INTO customer(mobileNo) VALUES ('$mobileNo') ";
             $data1=mysqli_query($dataBase,$query1);
             if($data)
             {
             	$query2="SELECT customerId FROM customer where mobileNo='$mobileNo'";
                $data2=mysqli_query($dataBase,$query2);
                 if(mysqli_num_rows($data)>0)
                 {
 		   	     	$customerId=$result['customerId'];
 		   	     	return $customerId;

                 }

             }
 		   }
 		   
        }
    }
 		 

  

   function addProduct($productId,$productName,$quantity,$sellingPrice)
  {
  	   global $dataBase;
  	   
  	   $returnArray=array();
 	   $returnArray=array('status'=>false,'message'=>'failed');
 	   if(!empty($productId))
 	   {
 	   	$query1="SELECT productId FROM productStock where productName='$productName' and productId!='$productId'";
 	   $data1=mysqli_query($dataBase,$query1);
 		if (mysqli_num_rows($data1)>0)
 		{
 			$returnArray=array('status'=>true,'message'=>'product already Existed');
 			return $returnArray;
 		}



 	      
 	   	 $query2="UPDATE productStock SET productName='$productName',quantity='$quantity',sellingPrice='$sellingPrice' WHERE productId='$productId'";
 	   	 
 	   	 $data2=mysqli_query($dataBase,$query2);
 	   	  echo $query2;
 	   	 if ($data2) { 
 	   	 	$returnArray=array('status'=>true,'message'=>'updated successfully');
 	     }
 	         return $returnArray;
 	 }
 	 else
 	 {
 	 	 $query1="SELECT productId FROM productStock where productName='$productName'";
 	   $data1=mysqli_query($dataBase,$query1);
 		if (mysqli_num_rows($data1)>0)
 		{
 			$returnArray=array('status'=>true,'message'=>'product already Existed');
 			return $returnArray;
 		}


      $query="INSERT INTO productStock(productName,quantity,sellingPrice) VALUES ('$productName','$quantity','$sellingPrice')";
 	  $data=mysqli_query($dataBase,$query);
 	   if($data)
 	  {
 			$returnArray=array('status'=>true,'message'=>'product added successfully');

 	  }
 	
 	   return $returnArray;
 	}
 	}


function showProduct()
 	{
 		global $dataBase;
 		$returnArray=array();
 		$query="select * from productStock";
 		$data=mysqli_query($dataBase,$query);
 		if(mysqli_num_rows($data)>0)
 		{
 		   while ($result=mysqli_fetch_assoc($data))
 		    {
 		   	  $returnArray[]=array('productId'=>$result['productId'],'productName'=>$result['productName'],'quantity'=>$result['quantity'],'sellingPrice'=>$result['sellingPrice'],'created'=>$result['created']);
 		   	  
 		   }
 		   	  return $returnArray;
        }
    }
    function addPurchase($purchaseId,$vendorId,$productId,$costPrice,$quantity,$totalAmount)
  {
  	   global $dataBase;
  	   $returnArray=array();
  	   // echo $purchaseId;
 	   $returnArray=array('status'=>false,'message'=>'failed');
 	   if ($purchaseId) {
 	 	 $query6="SELECT created FROM purchaseOrder where purchaseId='$purchaseId'";
 	 	 $data6=mysqli_query($dataBase,$query6);
 	 	 if (mysqli_num_rows($data6)>0)
 		{
 		   while ($result=mysqli_fetch_assoc($data6))
 		   {
 		   	 $created=$result['created'];
 		   	 $query7="DELETE FROM purchaseOrder WHERE purchaseId='$purchaseId'"; 
	         $data7=mysqli_query($dataBase,$query7);
	         $query8="DELETE FROM purchaseProduct WHERE purchaseId='$purchaseId'";
	         $data8=mysqli_query($dataBase,$query8);
	         if($vendorId)
 	   {
 	   	 $query3="INSERT INTO purchaseOrder(vendorId,totalAmount,created) VALUES ($vendorId,$totalAmount,'$created')";
 	   	 $data3=mysqli_query($dataBase,$query3);
 	   	 if($data3)
 		{   
 			$query4="SELECT MAX(purchaseId) as pId FROM purchaseOrder";
 			$data4=mysqli_query($dataBase,$query4);
 			
 			if (mysqli_num_rows($data4)>0)
 		{
 		   while ($result=mysqli_fetch_assoc($data4))
 		   {
 		    $purchaseId=$result['pId'];
           } 
 			
 		}
      }
 	}
 	$i=0;
      $str="INSERT INTO purchaseProduct(purchaseId,productId,costPrice,quantity) VALUES";

      while ($i<count($costPrice))
      {
	  		$str=$str."('".$purchaseId."','".$productId[$i]."','".$costPrice[$i]."','".$quantity[$i]."'),";
	  		$i=$i+1;
                    
      }
      $str=rtrim($str,',');
 	  $data=mysqli_query($dataBase,$str);
 	   if($data)
 	  {     

 			$returnArray=array('status'=>true,'message'=>'purchase updated successfully');

 	  }
 	
 	   return $returnArray;

 		   }
          
 		}
 	   	 
 	   }
 	   else
 	   {
 	   if($vendorId)
 	   {
 	   	 $query3="INSERT INTO purchaseOrder(vendorId,totalAmount) VALUES ($vendorId,$totalAmount)";
 	   	 $data3=mysqli_query($dataBase,$query3);
 	   	 if($data3)
 		{   
 			$query4="SELECT MAX(purchaseId) as pId FROM purchaseOrder";
 			$data4=mysqli_query($dataBase,$query4);
 			
 			if (mysqli_num_rows($data4)>0)
 		{
 		   while ($result=mysqli_fetch_assoc($data4))
 		   {
 		    $purchaseId=$result['pId'];
           } 
 			
 		}
      }
 	}
 	 //   if(!empty($productId))
 	 //   {
 	 //   	$query1="SELECT productId FROM productStock where productName='$productName' and productId!='$productId'";
 	 //   $data1=mysqli_query($dataBase,$query1);
 		// if (mysqli_num_rows($data1)>0)
 		// {
 		// 	$returnArray=array('status'=>true,'message'=>'product already Existed');
 		// 	return $returnArray;
 		// }



 	      
 	 //   	 $query2="UPDATE productStock SET productName='$productName',quantity='$quantity',sellingPrice='$sellingPrice' WHERE productId='$productId'";
 	   	 
 	 //   	 $data2=mysqli_query($dataBase,$query2);
 	 //   	  echo $query2;
 	 //   	 if ($data2) { 
 	 //   	 	$returnArray=array('status'=>true,'message'=>'updated successfully');
 	 //     }
 	 //         return $returnArray;
 	 // }
 	 // else
 	 // {
 	 // 	 $query1="SELECT productId FROM productStock where productName='$productName'";
 	 //   $data1=mysqli_query($dataBase,$query1);
 		// if (mysqli_num_rows($data1)>0)
 		// {
 		// 	$returnArray=array('status'=>true,'message'=>'product already Existed');
 		// 	return $returnArray;
 		// }




      // print_r($costPrice);

      $i=0;
      $str="INSERT INTO purchaseProduct(purchaseId,productId,costPrice,quantity) VALUES";

      while ($i<count($costPrice))
      {
	  		$str=$str."('".$purchaseId."','".$productId[$i]."','".$costPrice[$i]."','".$quantity[$i]."'),";
	  		$i=$i+1;
                    
      }
      $str=rtrim($str,',');
 	  $data=mysqli_query($dataBase,$str);
 	   if($data)
 	  {     

 			$returnArray=array('status'=>true,'message'=>'purchase added successfully');

 	  }
 	
 	   return $returnArray;
 	}
 	}


 	function showPurchase()
 	{
 		global $dataBase;
 		$returnArray=array();
 		$query="SELECT purchaseOrder.purchaseId,vendor.vendorName,purchaseOrder.totalAmount,purchaseOrder.created FROM vendor,purchaseOrder WHERE vendor.vendorId=purchaseOrder.vendorId  ";
 		$data=mysqli_query($dataBase,$query);
 		
 		if(mysqli_num_rows($data)>0)
 		 {
 		 	
 		   while ($result=mysqli_fetch_assoc($data)) {
 		   	// echo $result['totalAmount'];

 		   	  $returnArray[]=array('purchaseId'=>$result['purchaseId'],'vendorName'=>$result['vendorName'],'totalAmount'=>$result['totalAmount'],'created'=>$result['created']);
 		   	  
 		   	  // print_r($returnArray);
 		   }
 		    return $returnArray;
 		   	  

 		}
 		
 	}
 	function viewPurchase($purchaseId)
 	{
 		global $dataBase;
 		$returnArray=array();
 		$query="SELECT productStock.productName,purchaseProduct.costPrice,purchaseProduct.quantity FROM purchaseProduct,productStock WHERE purchaseProduct.purchaseId='$purchaseId' and purchaseProduct.productId=productStock.productId ";
 	
 		$data=mysqli_query($dataBase,$query);
 		
 		if(mysqli_num_rows($data)>0)
 		 {
 		   while ($result=mysqli_fetch_assoc($data)) {
 		   	 $returnArray[]=array('productName'=>$result['productName'],'costPrice'=>$result['costPrice'],'quantity'=>$result['quantity']);
 		   	  
 		   }
 		    return $returnArray;



 	}
 }


 function deletePurchase($purchaseId)
{

	global $dataBase;
 	$returnArray=array('status'=>false,'message'=>'failed');
	$query="DELETE FROM purchaseOrder WHERE purchaseId='$purchaseId'"; 
	$data=mysqli_query($dataBase,$query);
	$query2="DELETE FROM purchaseProduct WHERE purchaseId='$purchaseId'"; 
	$data2=mysqli_query($dataBase,$query2);
    if ($data2) 
	{
 	   $returnArray=array('status'=>true,'message'=>'Delete Sucessfully');

	}
	return $returnArray;
}

 
}
?>


