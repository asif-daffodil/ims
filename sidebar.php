
<div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == "index.php" ? "active":null ?>" href="./">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == "allproducts.php" || basename($_SERVER['PHP_SELF']) == "addnewproduct.php" || basename($_SERVER['PHP_SELF']) == "brands.php" || basename($_SERVER['PHP_SELF']) == "types.php" ? "active":"collapsed" ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="<?= basename($_SERVER['PHP_SELF']) == "allproducts.php" || basename($_SERVER['PHP_SELF']) == "addnewproduct.php" || basename($_SERVER['PHP_SELF']) == "brands.php" || basename($_SERVER['PHP_SELF']) == "types.php" ? true:false ?>" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Products
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse <?= basename($_SERVER['PHP_SELF']) == "allproducts.php" || basename($_SERVER['PHP_SELF']) == "addnewproduct.php" || basename($_SERVER['PHP_SELF']) == "brands.php" || basename($_SERVER['PHP_SELF']) == "types.php" ? "show":null ?>" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == "allproducts.php" ? "active":null ?>" href="./allproducts.php">All Products</a>
                            <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == "addnewproduct.php" ? "active":null ?>" href="./addnewproduct.php">Add New Products</a>
                            <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == "brands.php" ? "active":null ?>" href="./brands.php">Brands</a>
                            <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == "types.php" ? "active":null ?>" href="./types.php">Types</a>
                        </nav>
                    </div>
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF']) == "allorders.php" || basename($_SERVER['PHP_SELF']) == "addneworders.php" ? "active":"collapsed" ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="<?= basename($_SERVER['PHP_SELF']) == "allorders.php" || basename($_SERVER['PHP_SELF']) == "addneworders.php" ? true:false ?>" aria-controls="collapsePages">
                        <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                        Orders
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse <?= basename($_SERVER['PHP_SELF']) == "allorders.php" || basename($_SERVER['PHP_SELF']) == "addneworders.php" ? "show":null ?>" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?= basename($_SERVER["PHP_SELF"]) == "allorders.php" ? "active":null ?>" href="./allorders.php">All Orders</a>
                            <a class="nav-link <?= basename($_SERVER["PHP_SELF"]) =="addneworders.php" ? "active":null ?>" href="./addneworders.php">Add New Orders</a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Addons</div>
                    <a class="nav-link" href="charts.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Charts
                    </a>
                    <a class="nav-link" href="tables.html">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Tables
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                <?= "Asif Abir" ?>
            </div>
        </nav>
    </div>