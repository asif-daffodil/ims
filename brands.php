<?php
include_once("header.php");
if (isset($_POST['brand123'])) {
    $brand_name = safuda($_POST['brand_name']);
    if (empty($brand_name)) {
        echo "<script>toastr.error('Brand Name is Required')</script>";
    } else {
        // Check if brand name already exists
        $sql = "SELECT * FROM brands WHERE `name` = '$brand_name'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo "<script>toastr.error('Brand Name already exists')</script>";
        } else {
            $sql = "INSERT INTO brands (`name`) VALUES ('$brand_name')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>toastr.success('Brand Added Successfully')</script>";
                $brand_name = null;
            } else {
                echo "<script>toastr.error('Brand Added Failed')</script>";
            }
        }
    }
}

isset($_GET['eid']) ? $eid = safuda($_GET['eid']) : $eid = null;
$checkGetId = $conn->query("SELECT * FROM `brands` WHERE `id` = '$eid'");
isset($_GET['eid']) && $checkGetId->num_rows === 1 ? $eidData = $checkGetId->fetch_object() : null;
isset($_GET['eid']) && $checkGetId->num_rows === 0 ? header("location: brands.php") : null;
if(isset($_POST['esub'])){
    $ename = safuda($_POST['ename']);
    if(empty($ename)){
        echo "<script>toastr.error('Brand Name is Required')</script>";
    }else{
        $sql = "UPDATE `brands` SET `name` = '$ename' WHERE `id` = '$eid'";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo "<script>toastr.success('Brand Updated Successfully');setTimeout(()=> location.href='brands.php',2000)</script>";
        }else{
            echo "<script>toastr.error('Brand Updated Failed')</script>";
        }
    }
}

isset($_GET['did']) ? $did = safuda($_GET['did']) : $did = null;
$checkGetId = $conn->query("SELECT * FROM `brands` WHERE `id` = '$did'");
isset($_GET['did']) && $checkGetId->num_rows === 1 ? $didData = $checkGetId->fetch_object() : null;
isset($_GET['did']) && $checkGetId->num_rows === 0 ? header("location: brands.php") : null;
if(isset($_POST['dsub'])){
    $sql = "DELETE FROM `brands` WHERE `id` = '$did'";
    $result = mysqli_query($conn, $sql);
    if($result){
        echo "<script>toastr.success('Brand Deleted Successfully');setTimeout(()=> location.href='brands.php',2000)</script>";
    }else{
        echo "<script>toastr.error('Brand Deleted Failed')</script>";
    }
}

?>
<div id="layoutSidenav">
    <?php
    include_once("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <div class="container-fluid px-4">
            <h2>Brands</h2>
            <div class="row">
                <div class="col-md-6">
                    <form method="post" action="" class="mb-5">
                        <div class="form-group">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Brand Name" value="<?= $brand_name ?? null ?>">
                                <label for="brand_name">Brand Name</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="brand123">Add Brand</button>
                    </form>
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Brand Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S.N</th>
                                <th>Brand Name</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM brands ORDER BY id DESC";
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                $i = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $i++ . "</td>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td><a href='brands.php?eid=" . $row['id'] . "' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i></a> <a href='brands.php?did=" . $row['id'] . "' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i></a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3' class='text-center'>No Brands Found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <?php  
                        if (isset($eidData)) {
                    ?>
                        <h2>Edit Brand Name</h2>
                        <form action="" method="post">
                            <div class="mb-3">
                                <input type="text" placeholder="Your Name" name="ename" value="<?= $eidData->name ?>" class="form-control ">
                            </div>
                            <input type="submit" class="btn btn-primary btn-sm" value="Update" name="esub">
                            <a href="./brands.php" class="btn btn-danger btn-sm">
                            Cancel
                        </a>
                        </form>
                    <?php
                        }
                    ?>
                    <?php  
                        if (isset($didData)) {
                    ?>
                        <h2>Delete Brand Name</h2>
                        <form action="" method="post">
                            <div class="mb-3">
                                <input type="text" placeholder="Your Name" name="dname" value="<?= $didData->name ?>" class="form-control " disabled>
                            </div>
                            <input type="submit" class="btn btn-danger btn-sm" value="Delete" name="dsub">
                            <a href="./brands.php" class="btn btn-primary btn-sm">
                            Cancel
                        </a>
                        </form>
                    <?php
                        }
                    ?>
                </div>
            </div>

        </div>
        <?php
        include_once("footer.php");
        ?>
    </div>
</div>
</body>

</html>