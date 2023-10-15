<?php
include_once("header.php");
// column list
// name, type_id, brand_id, description, price, stock, shelf_no
// add product
if (isset($_POST['addproduct'])) {
    # code...
    $type_name = safuda($_POST['type_name']);
    $typeid = safuda($_POST['typeid']);
    $newtype = safuda($_POST['newtype']);
    $brandid = safuda($_POST['brandid']);
    $newbrand = safuda($_POST['newbrand']);
    $description = safuda($_POST['description']);
    $price = safuda($_POST['price']);
    $stock = safuda($_POST['stock']);
    $shelf_no = safuda($_POST['shelf_no']);
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
    if ($type_name == "") {
        # code...
        echo "<script>toastr.error('Product Name is Required')</script>";
    }

    // price is mendetory
    if ($price == "") {
        # code...
        echo "<script>toastr.error('Price is Required')</script>";
    }

    // stock limit is mendetory
    if ($stock == "") {
        # code...
        echo "<script>toastr.error('Stock Limit is Required')</script>";
    }

    // shelf no is mendetory
    if ($shelf_no == "") {
        # code...
        echo "<script>toastr.error('Shelf No is Required')</script>";
    }

    // description is mendetory
    if ($description == "") {
        # code...
        echo "<script>toastr.error('Description is Required')</script>";
    }

    // typeid is mendetory
    if ($typeid == "") {
        # code...
        echo "<script>toastr.error('Type is Required')</script>";
    }

    // brandid is mendetory
    if ($brandid == "") {
        # code...
        echo "<script>toastr.error('Brand is Required')</script>";
    }

    // insert product
    if (!empty($type_name) && !empty($price) && !empty($stock) && !empty($shelf_no) && !empty($description) && !empty($typeid) && !empty($brandid)) {
        # code...
        $sql = "INSERT INTO `products` (`name`, `type_id`, `brand_id`, `description`, `price`, `stock`, `shelf_no`) VALUES ('$type_name', '$typeid', '$brandid', '$description', '$price', '$stock', '$shelf_no')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            # code...
            echo "<script>toastr.success('Product Added Successfully')</script>";
            // emty all the fields
            $type_name = $typeid = $newtype = $brandid = $newbrand = $description = $price = $stock = $shelf_no = null;
        } else {
            # code...
            echo "<script>toastr.error('Error Adding Product')</script>";
        }
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
                <div class="col-md-6">
                    <h2>All Products</h2>
                    <form action="" method="post" class="mb-5">
                        <div class="form-group">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="type_name" name="type_name" placeholder="Product Name" value="<?= $type_name ?? null ?>">
                                <label for="type_name">Product Name</label>
                            </div>
                            <div class="mb-3">
                                <select name="typeid" id="typeid" class="form-select">
                                    <option value="">--SELECT TYPE--</option>
                                    <?php
                                    $sql = "SELECT * FROM `types`";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_object($result)) {
                                    ?>
                                        <option value="<?= $row->id ?>"><?= $row->name ?></option>
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
                                    while ($row = mysqli_fetch_object($result)) {
                                    ?>
                                        <option value="<?= $row->id ?>"><?= $row->name ?></option>
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
                                <textarea class="form-control" placeholder="Description" id="description" name="description" style="height: 100px"></textarea>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="<?= $price ?? null ?>">
                                <label for="price">Price</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" value="<?= $stock ?? null ?>">
                                <label for="stock">Stock</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="shelf_no" name="shelf_no" placeholder="Shelf No" value="<?= $shelf_no ?? null ?>">
                                <label for="shelf_no">Shelf No</label>
                            </div>
                            <!-- add product button -->
                            <div class="">
                                <button type="submit" class="btn btn-primary" name="addproduct">Add Product</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
        include_once("footer.php");
        ?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#typeid").change(function() {
            if ($(this).val() == "addnewtype") {
                $("#newTypeInput").removeClass("d-none");
            } else {
                $("#newTypeInput").addClass("d-none");
            }
        });
        $("#brandid").change(function() {
            if ($(this).val() == "addnewbrand") {
                $("#newBrandInput").removeClass("d-none");
            } else {
                $("#newBrandInput").addClass("d-none");
            }
        });
    });
</script>
<!-- ClassicEditor cdn -->
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