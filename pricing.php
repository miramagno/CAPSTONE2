<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foreproduce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to get data from the dataset table
$sqlDataset = "SELECT productID, productName, currentStockLevel, expirationDate, restockDate, originalPrice, discountPrice, pricingPromotion 
               FROM dataset";
$resultDataset = $conn->query($sqlDataset);

$inventoryData = [];

if ($resultDataset->num_rows > 0) {
    // Fetch dataset rows
    while ($row = $resultDataset->fetch_assoc()) {
        // Storing the row data in the array
        $inventoryData[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ForeProduce - Pricing and Promotion</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/wm-logo.svg" rel="icon">
    <link href="assets/img/wm-logo.svg" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/wm-logo.svg" alt="">
                <span class="d-none d-lg-block" style="color: #015c92;">ForeProduce</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>


        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">


                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2" style="color: #015c92;">John Doe</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6 style="color: #015c92;">John Doe</h6>
                            <span>Admin</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.php">
                                <i class="bi bi-question-circle"></i>
                                <span>Need Help?</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>

    </header>
    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="index.php">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link" href="demand.php">
                    <i class="bi bi-bar-chart"></i>
                    <span>Demand Forecasting</span>
                </a>
            </li><!-- End Demand Forecasting -->

            <!-- ======= Inventory ======= -->
            <li class="nav-item">
                <a class="nav-link " href="inventory.php">
                    <i class="bi bi-journal-album"></i>
                    <span>Inventory Management</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <!-- ======= Pricing ======= -->
            <li class="nav-item">
                <a class="nav-link " href="pricing.php">
                    <i class="bi bi-grid"></i>
                    <span>Pricing and Promotion</span>
                </a>
            </li><!-- Pricing -->


            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="users-profile.php">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li><!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-register.php">
                    <i class="bi bi-card-list"></i>
                    <span>Register</span>
                </a>
            </li><!-- End Register Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="pages-login.php">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Login</span>
                </a>
            </li><!-- End Login Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Pricing and Promotion</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Pricing and Promotion</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="pricePromotion py-4">
            <!-- Filter Container -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <!-- Pricing and Promotion Toggle Buttons (Left side) -->
                <div class="btn-group me-3" role="group" aria-label="Toggle Buttons">
                    <button id="pricing-btn" class="btn btn-secondary">Pricing</button>
                    <button id="promotion-btn" class="btn btn-secondary">Promotion</button>
                </div>

                <!-- Filter Dropdown and Search Bar (Right side) -->
                <div class="d-flex align-items-center">
                    <select id="filter-select" class="form-select me-2" style="width: 150px;">
                        <option value="all">Filter by</option>
                        <option value="vegetables">Vegetables</option>
                        <option value="fruits">Fruits</option>
                    </select>
                    <div class="input-group input-group-sm" style="width: 200px;">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                        <button class="btn btn-outline-secondary" type="button" style="padding: 7px;">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4" id="pricing-table">
    <div class="card-body">
        <h2 class="card-title">Pricing</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ID</th> <!-- New ID column -->
                        <th>Produce</th>
                        <th>Current Price</th>
                        <th>Suggested Price</th>
                        <th>Expected Revenue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inventoryData as $item): ?>
                    <tr>
                        <td><?php echo $item['productID']; ?></td> <!-- ID for this row -->
                        <td><?php echo $item['productName']; ?></td>
                        <td>₱<?php echo number_format($item['originalPrice'], 2); ?></td>
                        <td>₱<?php echo number_format($item['discountPrice'], 2); ?></td>
                        <td><?php echo $item['pricingPromotion']; ?></td> <!-- Example expected revenue, you can adjust this if needed -->
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card" id="promotion-table" style="display:none;">
    <div class="card-body">
        <h2 class="card-title">Promotion Strategy</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Produce</th>
                        <th>Expiration Date</th>
                        <th>Discount</th>
                        <th>Recommendation</th>
                        <th>Status</th> <!-- Status Column -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inventoryData as $item): ?>
                    <tr>
                        <td><?php echo $item['productID']; ?></td>
                        <td><?php echo $item['productName']; ?></td>
                        <td><?php echo date("m/d/Y", strtotime($item['expirationDate'])); ?></td>
                        <td><?php echo $item['pricingPromotion']; ?></td>
                        <td><?php echo $item['promotionRecommendation']; ?></td>
                        <td>
                            <span class="badge <?php echo ($item['promotionStatus'] === 'Active') ? 'bg-success' : 'bg-warning'; ?>">
                                <?php echo $item['promotionStatus']; ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

                    </main>
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>PUP Sto.Tomas</span></strong>. All Rights Reserved
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const sidebar = document.getElementById("sidebar");
            const toggleSidebarBtn = document.querySelector(".toggle-sidebar-btn");
            const main = document.getElementById("main");

            // Toggle sidebar visibility
            toggleSidebarBtn.addEventListener("click", () => {
                sidebar.classList.toggle("collapsed");
                main.classList.toggle("expanded");
            });
        });

        const pricingBtn = document.getElementById("pricing-btn");
        const promotionBtn = document.getElementById("promotion-btn");
        const pricingTable = document.getElementById("pricing-table");
        const promotionTable = document.getElementById("promotion-table");
        const filterSelect = document.getElementById("filter-select");

        // Utility function to toggle active state
        function setActiveButton(activeBtn, inactiveBtn) {
            activeBtn.classList.add("active", "btn-primary"); // Add active and highlight style
            activeBtn.classList.remove("btn-secondary"); // Ensure inactive style is removed
            inactiveBtn.classList.remove("active", "btn-primary"); // Remove active and highlight style
            inactiveBtn.classList.add("btn-secondary"); // Apply inactive style
        }

        // Show/Hide Tables
        pricingBtn.addEventListener("click", () => {
            setActiveButton(pricingBtn, promotionBtn);
            pricingTable.style.display = "block";
            promotionTable.style.display = "none";
        });

        promotionBtn.addEventListener("click", () => {
            setActiveButton(promotionBtn, pricingBtn);
            pricingTable.style.display = "none";
            promotionTable.style.display = "block";
        });

        // Filter Tables
        function filterTable(category) {
            const rows = document.querySelectorAll("#pricing-table tbody tr, #promotion-table tbody tr");
            rows.forEach(row => {
                if (category === "all") {
                    row.style.display = ""; // Show all rows
                } else {
                    row.style.display = row.dataset.category === category ? "" : "none";
                }
            });
        }

        filterSelect.addEventListener("change", () => {
            filterTable(filterSelect.value);
        });

        // Default state
        pricingTable.style.display = "block";
        promotionTable.style.display = "none";
        setActiveButton(pricingBtn, promotionBtn); // Set initial active button
    </script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>