<?php
include_once("header.php");
// table name: clients; columns: `id`, `name`, `mobile`, `address`, `created_at` 
// all clients
$sql = "SELECT * FROM `clients`";
$result = mysqli_query($conn, $sql);
?>
<div id="layoutSidenav">
    <?php
    include_once("sidebar.php");
    ?>
    <div id="layoutSidenav_content">
        <div class="container-fluid px-4">
            <div class="row">
                <?php if(!isset($_GET["eid"]) && !isset($_GET["did"])){ ?>
                <div class="col-md-12">
                    <h2>All Clients</h2>
                    <div class="table-responsive">
                        <!-- show all clients in datatable -->
                        <table class="table table-striped table-sm" id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Client Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = mysqli_fetch_object($result)) {
                                ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $row->name ?></td>
                                        <td><?= $row->mobile ?></td>
                                        <td><?= $row->address ?></td>
                                        <td>
                                            <a href="./allclients.php?eid=<?= $row->id ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <a href="./allclients.php?did=<?= $row->id ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $('#datatablesSimple').DataTable();
                        });
                    </script>
                </div>
                <?php } ?>
                <?php
                // edit client
                if (isset($_GET['eid'])) {
                    # code...
                    $eid = $_GET['eid'];
                    $sql = "SELECT * FROM `clients` WHERE `id`='$eid'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_object($result);
                ?>
                    <div class="col-md-6">
                        <h2>Edit Client</h2>
                        <form action="" method="post">
                            <div class="mb-3 form-floating ">
                                <input type="text" placeholder="Client Name" name="cname" class="form-control" value="<?= $row->name ?>">
                                <label for="">Client Name</label>
                            </div>
                            <div class="mb-3 form-floating ">
                                <input type="text" placeholder="Mobile Number" name="mobile" class="form-control" value="<?= $row->mobile ?>">
                                <label for="">Mobile Number</label>
                            </div>
                            <div class="mb-3 form-floating ">
                                <input type="text" placeholder="Address" name="address" class="form-control" value="<?= $row->address ?>">
                                <label for="">Address</label>
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Update Client" name="updateclient" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                <?php
                }
                ?>
                <?php
                // delete client
                if (isset($_GET['did'])) {
                    # code...
                    $did = $_GET['did'];
                    $sql = "DELETE FROM `clients` WHERE `id`='$did'";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        # code...
                        echo "<script>toastr.success('Client Deleted Successfully')</script>";
                    } else {
                        # code...
                        echo "<script>toastr.error('Client Not Deleted')</script>";
                    }
                }
                ?>
            </div>
        </div>
        <?php
        include_once("footer.php");
        ?>
    </div>
</div>
</body>

</html>