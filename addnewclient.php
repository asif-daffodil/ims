<?php
include_once("header.php");
// table name: clients; columns: `id`, `name`, `mobile`, `address`, `created_at` 
// add client
if (isset($_POST['addclient'])) {
    # code...
    $cname = safuda($_POST['cname']);
    $mobile = safuda($_POST['mobile']);
    $address = safuda($_POST['address']);
    // name is mendetory
    if (empty($cname)) {
        # code...
        echo "<script>toastr.error('Client Name is Required')</script>";
    }
    // mobile is mendetory
    if ($mobile == "") {
        # code...
        echo "<script>toastr.error('Mobile Number is Required')</script>";
    }
    // address is mendetory
    if ($address == "") {
        # code...
        echo "<script>toastr.error('Address is Required')</script>";
    }
    // check if client already exists
    $sql = "SELECT * FROM `clients` WHERE `mobile`='$mobile'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        # code...
        echo "<script>toastr.error('Client Already Exists')</script>";
    } else {
        # code...
        if(!empty($cname) && !empty($mobile) && !empty($address)){
            $sql = "INSERT INTO `clients` (`name`, `mobile`, `address`) VALUES ('$cname', '$mobile', '$address')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                # code...
                echo "<script>toastr.success('Client Added Successfully')</script>";
            } else {
                # code...
                echo "<script>toastr.error('Client Not Added')</script>";
            }
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
                    <h2>Add New Client</h2>
                    <!-- Form to add new client -->
                    <form action="" method="post">
                        <div class="mb-3 form-floating ">
                            <input type="text" placeholder="Client Name" name="cname" class="form-control">
                            <label for="">Client Name</label>
                        </div>
                        <div class="mb-3 form-floating ">
                            <input type="text" placeholder="Mobile Number" name="mobile" class="form-control">
                            <label for="">Mobile Number</label>
                        </div>
                        <div class="mb-3 form-floating ">
                            <input type="text" placeholder="Address" name="address" class="form-control">
                            <label for="">Address</label>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="Add Client" name="addclient" class="btn btn-primary">
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
</body>

</html>