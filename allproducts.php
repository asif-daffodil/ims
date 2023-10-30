<?php
include_once("header.php");
// update product
if (isset($_POST['esub'])) {
    $eid = safuda($_GET['eid']);
    $ename = safuda($_POST['ename']);
    $typeid = safuda($_POST['typeid']);
    $newtype = safuda($_POST['newtype']);
    $brandid = safuda($_POST['brandid']);
    $newbrand = safuda($_POST['newbrand']);
    $description = safuda($_POST['description']);
    $price = safuda($_POST['price']);
    $stock = safuda($_POST['stock']);
    $shelfno = safuda($_POST['shelfno']);
    // check if type is selected
    if ($typeid == "") {
        # code...
        $typeid = null;
    } else if ($typeid == "addnewtype") {
        # code...
        $sql = "INSERT INTO `types` (`name`) VALUES ('$newtype')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            # code...
            $typeid = mysqli_insert_id($conn);
        } else {
            # code...
            $typeid = null;
        }
    }
    // check if brand is selected
    if ($brandid == "") {
        # code...
        $brandid = null;
    } else if ($brandid == "addnewbrand") {
        # code...
        $sql = "INSERT INTO `brands` (`name`) VALUES ('$newbrand')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            # code...
            $brandid = mysqli_insert_id($conn);
        } else {
            # code...
            $brandid = null;
        }
    }
    // type name is mendetory
    if ($ename == "") {
        # code...
        echo "<script>toastr.error('Product Name is Required')</script>";
    }

    // price is mendetory
    if ($price == "") {
        # code...
        echo "<script>toastr.error('Price is Required')</script>";
    }

    // update product
    if ($ename != "" && $price != "") {
        # code...
        $sql = "UPDATE `products` SET `name` = '$ename', `type_id` = '$typeid', `brand_id` = '$brandid', `description` = '$description', `price` = '$price', `stock` = '$stock', `shelf_no` = '$shelfno' WHERE `id` = '$eid'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            # code...
            echo "<script>toastr.success('Product Updated Successfully');setTimeout(()=> location.href='allproducts.php',2000)</script>";
        } else {
            # code...
            echo "<script>toastr.error('Product Updated Failed')</script>";
        }
    }
}

// delete product
if (isset($_POST['dsub'])) {
    $did = safuda($_GET['did']);
    $sql = "DELETE FROM `products` WHERE `id` = '$did'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        # code...
        echo "<script>toastr.success('Product Deleted Successfully');setTimeout(()=> location.href='allproducts.php',2000)</script>";
    } else {
        # code...
        echo "<script>toastr.error('Product Deleted Failed')</script>";
    }
}
?>
<div id="layoutSidenav">
    <?php
    include_once("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <div class="container-fluid px-4">
            <div class="row">
                <?php
                if (!isset($_GET['eid']) && !isset($_GET['did']) && !isset($_GET['addproduct'])) {
                ?>
                    <div class="col-md-12">
                        <h2>All Products</h2>
                        <!-- show all products in datatable -->
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Shelf No</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // get all products
                                $sql = "SELECT * FROM `products`";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // get brand name
                                        $brandid = $row['brand_id'];
                                        $sql1 = "SELECT * FROM `brands` WHERE `id` = '$brandid'";
                                        $result1 = mysqli_query($conn, $sql1);
                                        $row1 = mysqli_fetch_assoc($result1);
                                        $brandname = $row1['name'];
                                        // get type name
                                        $typeid = $row['type_id'];
                                        $sql2 = "SELECT * FROM `types` WHERE `id` = '$typeid'";
                                        $result2 = mysqli_query($conn, $sql2);
                                        $row2 = mysqli_fetch_assoc($result2);
                                        $typename = $row2['name'];
                                        echo "<tr>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $brandname . "</td>
                                            <td>" . $row['price'] . "</td>
                                            <td>" . $row['stock'] . "</td>
                                            <td>" . $row['shelf_no'] . "</td>
                                            <td style='width: max-content'>
                                                <a href='allproducts.php?addproduct=" . $row['id'] . "' class='btn btn-primary btn-sm'><i class='fas fa-plus'></i></a>
                                                <a href='allproducts.php?eid=" . $row['id'] . "' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i></a>
                                                <a href='allproducts.php?did=" . $row['id'] . "' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></a>
                                            </td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr>
                                        <td colspan='8' class='text-center'>No Products Found</td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
                <?php
                if (isset($_GET['eid'])) {
                ?>
                    <div class="col-md-6">
                        <h2>Edit Product</h2>
                        <?php
                        // get product data
                        $eid = $_GET['eid'];
                        $sql = "SELECT * FROM `products` WHERE `id` = '$eid'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_object($result);
                        ?>
                        <form action="" method="post">
                            <div class="mb-3">
                                <input type="text" placeholder="Product Name" name="ename" value="<?= $row->name ?>" class="form-control ">
                            </div>
                            <div class="mb-3">
                                <select name="typeid" id="typeid" class="form-select">
                                    <option value="">--SELECT TYPE--</option>
                                    <?php
                                    $sql = "SELECT * FROM `types`";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row1 = mysqli_fetch_object($result)) {
                                    ?>
                                        <option value="<?= $row1->id ?>" <?php if ($row1->id == $row->type_id) {
                                                                                echo "selected";
                                                                            } ?>><?= $row1->name ?></option>
                                    <?php
                                    }
                                    ?>
                                    <!-- add new types -->
                                    <option value="addnewtype">Add New Type</option>
                                </select>
                            </div>
                            <div class="mb-3 d-none" id="newTypeInput">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="newtype" name="newtype" placeholder="New Type">
                                    <label for="newtype">New Type</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <select name="brandid" id="brandid" class="form-select">
                                    <option value="">--SELECT BRAND--</option>
                                    <?php
                                    $sql = "SELECT * FROM `brands`";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row1 = mysqli_fetch_object($result)) {
                                    ?>
                                        <option value="<?= $row1->id ?>" <?php if ($row1->id == $row->brand_id) {
                                                                                echo "selected";
                                                                            } ?>><?= $row1->name ?></option>
                                    <?php
                                    }
                                    ?>
                                    <!-- add new brand -->
                                    <option value="addnewbrand">Add New Brand</option>
                                </select>
                            </div>
                            <div class="mb-3 d-none" id="newBrandInput">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="newbrand" name="newbrand" placeholder="New Brand">
                                    <label for="newbrand">New Brand</label>
                                </div>
                            </div>
                            <!-- wysiwyg editor -->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Description" id="description" name="description" style="height: 100px"><?= htmlspecialchars_decode(htmlspecialchars_decode($row->description)) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <input type="number" placeholder="Price" name="price" value="<?= $row->price ?>" class="form-control ">
                            </div>
                            <div class="mb-3">
                                <input type="number" placeholder="Stock" name="stock" value="<?= $row->stock ?>" class="form-control ">
                            </div>
                            <div class="mb-3">
                                <input type="text" placeholder="Shelf No" name="shelfno" value="<?= $row->shelf_no ?>" class="form-control ">
                            </div>
                            <input type="submit" class="btn btn-primary btn-sm" value="Update" name="esub">
                            <a href="javascript:void()" class="btn btn-danger btn-sm" onclick="javascript:history.back()">Cancel</a>
                        </form>
                    </div>
                <?php } ?>
                <?php
                if (isset($_GET['did'])) {
                ?>
                    <div class="col-md-6 fst-1">
                        Do you really want to delete this product?
                        <form action="" method="post">
                            <input type="submit" class="btn btn-danger btn-sm" value="Yes" name="dsub">
                            <a href="javascript:void()" class="btn btn-primary btn-sm" onclick="javascript:history.back()">No</a>
                        </form>
                    </div>
                <?php
                }
                ?>
            </div>
            <?php  
                if(isset($_POST["addsub"])){
                    $pid = $conn->real_escape_string(safuda($_POST["pid"]));
                    $quantity = $conn->real_escape_string(safuda($_POST["quantity"]));
                    if(!empty($pid) && !empty($quantity)){
                        $sql = "UPDATE `products` SET `stock` = `stock` + '$quantity' WHERE `id` = '$pid'";
                        $result = mysqli_query($conn, $sql);
                        if($result){
                            echo "<script>toastr.success('Product Added Successfully');setTimeout(()=> location.href='allproducts.php',2000)</script>";
                        }else{
                            echo "<script>toastr.error('Product Added Failed')</script>";
                        }
                    }else{
                        echo "<script>toastr.error('Something went wrong')</script>";
                    }
                }
            ?>
            <?php  
                if (isset($_GET["addproduct"])) {
                    $pid = $_GET["addproduct"];
                    $sql = "SELECT * FROM `products` WHERE `id` = '$pid'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_object($result);
                    $pstock = $row->stock;
                    $pname = $row->name;
            ?>
            <div class="col-md-6">
                <h2 class="mb-3 mt-2">Add Product</h2>
                <h5><?= $pname ?></h5>
                <form action="" method="post">
                    <input type="hidden" value="<?= $pid ?>" name="pid">
                    <div class="mb-3">
                        <label for="">Previous Quantity :</label>
                        <input type="number" placeholder="Quantity" value="<?= $pstock ?>" class="form-control disabled" disabled>
                    </div>
                    <div class="mb-3">
                        <input type="number" placeholder="Add New Quantity" name="quantity" class="form-control ">
                    </div>
                    <input type="submit" class="btn btn-primary btn-sm" value="Add" name="addsub">
                    <a href="javascript:void()" class="btn btn-danger btn-sm" onclick="javascript:history.back()">Cancel</a>
                </form>
            </div>
            <?php } ?>
        </div>
        <?php
        include_once("footer.php");
        ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#datatablesSimple').DataTable();
    });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error(error);
        });
</script>
</body>

</html>