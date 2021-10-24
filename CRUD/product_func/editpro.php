<?php
    require_once "pdo.php";
    session_start();


    
        if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['qty']) && isset($_POST['cp']) && isset($_POST['sp']) && isset($_POST['mfg_date']) && isset($_POST['supplier_id'])) {
            $stmt = $pdo->prepare("UPDATE `products` SET product_name =:product_name,qty = :qty,cp = :cp,sp=:sp,mfg_date=:mfg_date,supplier_id=:sid  WHERE product_id = :cid");
            $stmt->execute(array(':product_name' => $_POST['product_name'],':qty' => $_POST['qty'],':cp' => $_POST['cp'],':mfg_date' => $_POST['mfg_date'],':sid' => $_POST['supplier_id'],':cid' =>$_POST['product_id']));
            $_SESSION['success'] = 'Record Edited';
            header('Location: showpro.php');
            return;
        }

        $stmt = $pdo->prepare("SELECT products.product_name,products.qty,products.cp,products.sp,products.mfg_date,products.supplier_id,product_id FROM products  INNER JOIN `supplier` ON products.supplier_id=supplier.supplier_id WHERE product_id = :cip");
        $stmt->execute(array(':cip' => $_GET['product_id']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ( $row === false ) {
            $_SESSION['error'] = 'Bad value for product_id';
            header( 'Location: showpro.php' ) ;
            return;
        }


?>
<html>
    <head>
        <title>Products</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/util.css">
    </head>
    <body>
        <div class="contact1">
		<div class="container-contact1">
			<div class="contact1-pic js-tilt" data-tilt>
				<img src="images/sell-products.png" alt="IMG">
			</div>

            <form method = "post" action="editpro.php" class="contact1-form validate-form">
				<span class="contact1-form-title">
					EDIT
				</span>
                <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                
                <div class="wrap-input1">
					<input class="input1" type="text" name="product_name" value="<?= $row['product_name'] ?>">
                    <span class="shadow-input1"></span>
                </div>
                <div class="wrap-input1">
					<input class="input1" type="text" name="qty" value="<?= $row['qty'] ?>">
                    <span class="shadow-input1"></span>
                </div>
                <div class="wrap-input1">
					<input class="input1" type="text" name="price" value="<?= $row['cp'] ?>">
                    <span class="shadow-input1"></span>
                </div>
                 <div class="wrap-input1">
					<input class="input1" type="text" name="price" value="<?= $row['sp'] ?>">
                    <span class="shadow-input1"></span>
                </div>
                <div class="wrap-input1">
					<input class="input1" type="text" name="mfg_date" value="<?= $row['mfg_date'] ?>">
                    <span class="shadow-input1"></span>
                </div>
               <div class="wrap-input1">
					<input class="input1" type="text" name="mfg_date" value="<?= $row['supplier_id'] ?>">
                    <span class="shadow-input1"></span>
                </div>

                <div class="container-contact1-form-btn">
                <button class="contact1-form-btn">
                <span >
                <input style = "background-color : rgba(0,0,0,0)" type="submit" value="Edit" name="edit">
                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                </span>
                </button>
                </div>
			</form>
		</div>
	</div>
      <script src="main.js"></script>
    </body>
</html>