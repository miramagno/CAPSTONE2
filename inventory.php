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
$sqlDataset = "SELECT productID, productName, currentStockLevel, expirationDate, restockDate 
               FROM dataset";
$resultDataset = $conn->query($sqlDataset);

$inventoryData = [];

if ($resultDataset->num_rows > 0) {
    // Fetch dataset rows
    while ($row = $resultDataset->fetch_assoc()) {
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
  <title>ForeProduce - Inventory Management</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link rel="icon" href="assets/img/wm-logo.svg">
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
<style>
  .chart-container {
    height: 100%;
  }

  #stockLevelChart {
    max-height: 400px;
  }

  .card {
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  }

  .list-group-item {
    font-size: 14px;
  }
</style>

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
            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle" href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>

            <!-- User Dropdown -->
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                    <?php echo $username; ?>                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6 style="color: #015c92;">
                        <?php echo $username; ?>                        </h6>
                        <span>Admin</span>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="profile.php">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="settings.php">
                            <i class="bi bi-gear"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="pages-register.php">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
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
        <a class="nav-link" href="index.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link" href="demand.php">
          <i class="bi bi-bar-chart"></i>
          <span>Demand Forecasting</span>
        </a>
      </li>
      <!-- End Demand Forecasting -->
      <li class="nav-item">
        <a class="nav-link" href="inventory.php">
          <i class="bi bi-journal-album"></i>
          <span>Inventory Management</span>
        </a>
      </li>
      <!-- End Inventory Nav -->
      <li class="nav-item">
        <a class="nav-link" href="pricing.php">
          <i class="bi bi-grid"></i>
          <span>Pricing and Promotion</span>
        </a>
      </li>
      <!-- End Pricing Nav -->
      <li class="nav-heading">Pages</li>
      <li class="nav-item">
        <a class="nav-link" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>
      <!-- End Profile Page Nav -->
      <li class="nav-item">
        <a class="nav-link" href="pages-register.php">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li>
      <!-- End Register Page Nav -->
      <li class="nav-item">
        <a class="nav-link" href="pages-login.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li>
      <!-- End Login Page Nav -->
    </ul>
  </aside>
  <!-- End Sidebar -->
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Inventory Management</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.php">Home</a>
          </li>
          <li class="breadcrumb-item active">Inventory Management</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row">
        <div class="card-body">
          <!-- Title and Filters -->
          <div class="row align-items-end mt-4 mb-4">
            <div class="col-lg-6">
            </div>
            <div class="col-lg-6 d-flex justify-content-end gap-3">
              <!-- Upload Data Button -->
              <div>
        <button class="btn btn-primary" id="uploadStockDataButton" style="font-size: 14px;">Upload Stock
          Data</button>
        <input type="file" id="stockFileInput" class="d-none" accept=".csv" />
      </div>
      <div>
                <select id="monthFilter" class="form-select form-select-sm mt-1 ">
                  <option value="">Filter by Date</option>
                  <option value="Today">Today</option>
                  <option value="Last Week">Last Week</option>
                  <option value="Last Month">Last Month</option>
                </select>
              </div>
              <!-- Produce Type Filter -->
              <div>
                <select id="produceTypeFilter" class="form-select form-select-sm mt-1">
                  <option value="">Category</option>
                  <option value="Fruits">Fruits</option>
                  <option value="Vegetables">Vegetables</option>
                </select>
              </div>
      </div>
      <!-- loraine style-->
      <div class="container mt-4">
        <div class="row">
          <!-- Left Column: Stock Level Chart -->
          <div class="col-12 col-md-6">
            <div class="chart-container" style="width: 100%; margin: 0 auto;">
              <h5 class="text-center">Stock Level Monitoring</h5>
              <canvas id="stockLevelChart" style="max-width: 100%;"></canvas>
            </div>
          </div>

          <!-- Right Column: Low Stock Alerts and Inventory Snapshot -->
          <div class="col-12 col-md-6">
            <div class="card mb-4">
              <div class="chart-container" style="width: 100%; margin: 0 auto;">
                <h5 class="text-center">Inventory Snapshot</h5>
                <canvas id="inventorySnapshotChart" style="width: 50px; height: 50px;"></canvas>
                <!-- Adjust height as needed -->
              </div>
              <div class="card-body">
                <h5 class="card-title text-center">Low Stock Alerts</h5>
                <ul class="list-group" id="lowStockAlerts">
                  <li class="list-group-item">No low stock items</li>
                </ul>
              </div>
            </div>
          </div>
        </div>

<script>
document.getElementById('uploadStockDataButton').addEventListener('click', function () {
  document.getElementById('stockFileInput').click();
});

document.getElementById('stockFileInput').addEventListener('change', handleStockFileSelect, false);

function handleStockFileSelect(event) {
  const file = event.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = function (e) {
    const csvData = e.target.result;
    const parsedData = parseStockCSV(csvData);
    generateStockLevelChart(parsedData);
    updateLowStockAlerts(parsedData);
    generateInventorySnapshotChart(parsedData);
  };
  reader.readAsText(file);
}

function parseStockCSV(csv) {
  const rows = csv.split('\n');
  const headers = rows[0].split(',');

  const data = {
    dates: [],
    stockLevels: [],
    reorderPoints: [],
    lowStockItems: [],
    low: 0,
    optimal: 0,
    high: 0
  };

  rows.slice(1).forEach(row => {
    const columns = row.split(',');
    if (columns.length === headers.length) {
      const date = columns[0];
      const stockLevel = Number(columns[4]); // Replace with the correct column index for stock levels
      const reorderPoint = Number(columns[5]); // Replace with the correct column index for reorder points

      data.dates.push(date);
      data.stockLevels.push(stockLevel);

      if (!isNaN(reorderPoint)) {
        data.reorderPoints.push(reorderPoint);
        if (stockLevel < reorderPoint) {
          data.lowStockItems.push(`${columns[1]} (Stock: ${stockLevel}, Reorder Point: ${reorderPoint})`);
          data.low++;
        } else if (stockLevel <= reorderPoint * 2) {
          data.optimal++;
        } else {
          data.high++;
        }
      }
    }
  });

  return data;
}

function generateStockLevelChart(parsedData) {
  const ctx = document.getElementById('stockLevelChart').getContext('2d');
  const stockLevelNoDataMessage = document.getElementById('stockLevelNoDataMessage');
  const stockLevelChartContainer = document.getElementById('stockLevelChartContainer');

  const datasets = [
    {
      label: 'Stock Levels',
      data: parsedData.stockLevels,
      borderColor: 'rgba(54, 162, 235, 1)',
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      fill: true
    }
  ];

  if (parsedData.reorderPoints.length > 0) {
    datasets.push({
      label: 'Reorder Point',
      data: parsedData.reorderPoints,
      borderColor: 'rgba(255, 99, 132, 1)',
      backgroundColor: 'rgba(255, 99, 132, 0.2)',
      fill: false,
      borderDash: [5, 5]
    });
  }

  if (parsedData.dates.length > 0) {
    stockLevelNoDataMessage.style.display = 'none';  // Hide "No data" message
    stockLevelChartContainer.style.display = 'block'; // Show chart container
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: parsedData.dates,
        datasets: datasets
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Stock Level Monitoring'
          },
          legend: {
            display: true,
            position: 'top'
          }
        },
        scales: {
          x: {
            type: 'category',
            title: {
              display: true,
              text: 'Date'
            }
          },
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Stock Level'
            }
          }
        }
      }
    });
  } else {
    stockLevelNoDataMessage.style.display = 'block';  // Show "No data" message
    stockLevelChartContainer.style.display = 'none';   // Hide chart container
  }
}
function updateLowStockAlerts(parsedData) {
  const lowStockList = document.getElementById('lowStockAlerts');
  const lowStockAlertsSection = document.getElementById('lowStockAlertsSection');
  lowStockList.innerHTML = '';  // Clear previous low stock items

  if (parsedData.lowStockItems.length > 0) {
    lowStockAlertsSection.style.display = 'block';  // Show the low stock section
    parsedData.lowStockItems.forEach(item => {
      const li = document.createElement('li');
      li.className = 'list-group-item';
      li.textContent = item;
      lowStockList.appendChild(li);
    });
    lowStockList.style.display = 'block';  // Show the list of low stock items
  } else {
    lowStockAlertsSection.style.display = 'block';  // Show the low stock section even if there are no items
    const li = document.createElement('li');
    li.className = 'list-group-item text-center';
    li.textContent = 'No low stock items';
    lowStockList.innerHTML = '';  // Clear any previous data before adding the "No low stock items" message
    lowStockList.appendChild(li);
    lowStockList.style.display = 'block';  // Show the "No low stock items" message
  }
}


function generateInventorySnapshotChart(parsedData) {
  const inventorySnapshotChartContainer = document.getElementById('inventorySnapshotChartContainer');
  const inventorySnapshotNoDataMessage = document.getElementById('inventorySnapshotNoDataMessage');
  const inventorySnapshotChart = document.getElementById('inventorySnapshotChart').getContext('2d');

  if (parsedData.low + parsedData.optimal + parsedData.high > 0) {
    inventorySnapshotChartContainer.style.display = 'block'; // Show chart container

    new Chart(inventorySnapshotChart, {
      type: 'pie',
      data: {
        labels: ['Low', 'Optimal', 'High'],
        datasets: [
          {
            label: 'Inventory Snapshot',
            data: [parsedData.low, parsedData.optimal, parsedData.high],
            backgroundColor: [
              'rgba(255, 99, 132, 0.7)',
              'rgba(54, 162, 235, 0.7)',
              'rgba(75, 192, 192, 0.7)'
            ],
            hoverOffset: 4
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            position: 'top'
          }
        }
      }
    });

    inventorySnapshotNoDataMessage.style.display = 'none'; // Hide "No data available" message
  } else {
    inventorySnapshotChartContainer.style.display = 'none'; // Hide chart container
    inventorySnapshotNoDataMessage.style.display = 'block'; // Show "No data available" message
  }
}
</script>
<div class="col-12">
  <div class="card pricing-adjustment-promotion overflow-auto">
    <div class="card-body">
      <h5 class="card-title">Inventory Detail</h5>
      <!-- Filters Section with Search and Download Icon -->
      <div class="d-flex justify-content-end align-items-center mt-3">
        <!-- Filter by Date -->
        <div class="me-2">
          <select id="monthFilter" class="form-select form-select-sm">
            <option value="">Filter by Date</option>
            <option value="Today">Today</option>
            <option value="Last Week">Last Week</option>
            <option value="Last Month">Last Month</option>
          </select>
        </div>
        <!-- Filter by Category -->
        <div class="me-2">
          <select id="produceTypeFilter" class="form-select form-select-sm">
            <option value="">Category</option>
            <option value="Fruits">Fruits</option>
            <option value="Vegetables">Vegetables</option>
          </select>
        </div>
        <!-- Search Bar with Icon -->
        <div class="input-group input-group-sm" style="width: 180px;">
          <input type="text" class="form-control" id="searchInput" placeholder="Search...">
          <button class="btn btn-outline-secondary" type="button">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </div>
      <!-- Inventory Table -->
      <div class="table-responsive mt-3">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col" colspan="4" class="text-center">Detailed Inventory</th>
              <th scope="col" colspan="4" class="text-center">Recommendations</th>
            </tr>
            <tr>
              <th scope="col"># ID</th>
              <th scope="col">Produce</th>
              <th scope="col">Stock Level</th>
              <th scope="col">Expiration Date</th>
              <th scope="col">Stock</th>
              <th scope="col">Promotion Duration</th>
            </tr>
          </thead>
          <tbody>
          <?php
// Loop through inventory data and display it
foreach ($inventoryData as $item) {
    $stockStatus = $item['currentStockLevel'] > 0 ? "In Stock" : "Out of Stock";
    $stockInfo = $item['currentStockLevel'] . " units";
    $expiration = "Expires in " . (strtotime($item['expirationDate']) - time()) / (60 * 60 * 24) . " days";
    $promotionDuration = "Start: " . date("M d, Y", strtotime($item['restockDate'])) . " - End: " . date("M d, Y", strtotime($item['restockDate'] . ' +7 days'));

    echo "<tr>
            <th scope='row'><a href='#'>{$item['productID']}</a></th>
            <td>{$item['productName']}</td>
            <td>{$stockStatus} ({$stockInfo})</td>
            <td>{$expiration}</td>
            <td>{$stockInfo}</td>
            <td>{$promotionDuration}</td>
          </tr>";
}
?>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

    </section>
  </main>
  <!-- End #main -->
  <footer id="footer" class="footer">
    <div class="copyright"> &copy; Copyright <strong>
        <span>PUP Sto.Tomas</span>
      </strong>. All Rights Reserved </div>
  </footer>
  <!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    <i class="bi bi-arrow-up-short"></i>
  </a>
  <!-- Forecasted Demand Chart -->
  
  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/5.4.2/echarts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>