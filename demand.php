<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileInput'])) {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "foreproduce";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle the uploaded file
    $file = $_FILES['fileInput']['tmp_name'];
    if (($handle = fopen($file, "r")) !== false) {
        // Skip the header row
        fgetcsv($handle);

        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO dataset 
            (date, productID, category, productName, quantitySold, discountPrice, originalPrice, totalSaleValue, 
            currentStockLevel, reorderLevel, expirationDate, restockDate, batchID, pricingPromotion, priceChangeDate) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        while (($data = fgetcsv($handle, 1000, ",")) !== false) {
            // Bind parameters
            $stmt->bind_param(
                "ssssiddidiissss", // Types: s = string, i = integer, d = double
                $data[0],  // date
                $data[1],  // productID
                $data[2],  // category
                $data[3],  // productName
                $data[4],  // quantitySold
                $data[5],  // discountPrice
                $data[6],  // originalPrice
                $data[7],  // totalSaleValue
                $data[8],  // currentStockLevel
                $data[9],  // reorderLevel
                $data[10], // expirationDate
                $data[11], // restockDate
                $data[12], // batchID
                $data[13], // pricingPromotion
                $data[14]  // priceChangeDate
            );

            // Execute the statement
            $stmt->execute();
        }

        fclose($handle);
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ForeProduce - Demand Forecasting</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/wm-logo.svg" rel="icon">
  <link href="assets/img/wm-logo.svg" rel="icon">

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .col-12.col-md-6 .card {
      border: 1px solid #ddd;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
      border-radius: 5px;
      padding: 10px;
      background-color: #fff;
    }

    .card-title {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 8px;
      color: #333;
    }

    #forecastedDemandChart2 {
      height: 300px;
      width: 100%;
    }

    .chart-tooltip {
      font-size: 16px;
      color: #333;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
      padding: 8px;
    }

    .chart-tooltip table {
      width: 100%;
      border-collapse: collapse;
    }

    .chart-tooltip th {
      background-color: #f7f7f7;
      padding: 8px;
      text-align: center;
      font-weight: bold;
    }

    .chart-tooltip td {
      padding: 8px;
      font-weight: 600;
    }
  </style>


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

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
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
      <h1>Demand Forecasting</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Demand Forecasting</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

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
                <button class="btn btn-primary" id="uploadButton" style="font-size: 13px; margin-top: 2px;">
                  Upload Data
                </button>
                <form id="uploadForm" action="demand.php" method="POST" enctype="multipart/form-data">
                  <input type="file" name="fileInput" id="fileInput" class="d-none" accept=".csv" />
                </form>
              </div>
              <!-- Month Filter -->
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
          </div>

          <div class="col-12">
            <div class="row">
              <!-- Actual Demand Chart -->
              <div class="col-12 col-md-6">
                <div class="card">
                  <div class="card-body" style="position: relative;">
                    <h5 class="card-title">Actual Demand</h5>
                    <!-- "No data available yet" message (visible initially) -->
                    <div id="actualNoDataMessage"
                      style="position: absolute; top: 80%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: #888; display: block;">
                      No data available yet
                    </div>
                    <!-- Placeholder for the Actual Demand Chart (hidden initially) -->
                    <canvas id="actualChart" height="200" style="display: none;"></canvas>
                  </div>
                </div>
              </div>

              <!-- Forecasted Demand Chart  -->
              <div class="col-12 col-md-6">
                <div class="card">
                  <div class="card-body" style="position: relative;">
                    <h5 class="card-title">Forecasted Demand</h5>
                    <!-- "No data available yet" message (visible initially) -->
                    <div id="forecastedNoDataMessage"
                      style="position: absolute; top: 80%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: #888; display: block;">
                      No data available yet
                    </div>
                    <!-- Placeholder for the Forecasted Demand Chart (hidden initially) -->
                    <canvas id="forecastedChart" height="200" style="display: none;"></canvas>
                  </div>
                </div>
              </div>
              
          <section class="section">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <!-- Title and Description with Filters in the Same Row -->
                    <div
                      class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-3">
                      <div>
                        <h5 class="card-title mb-0">Forecast Detail Table</h5>
                        <p class="mb-0">Display forecast data for each product in a simple, easy-to-read format.</p>
                      </div>
                      <!-- Filters Section with Search and Download Icon -->
                      <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center mt-3 mt-sm-0">
                        <!-- Filter by Date -->
                        <div class="me-2 mb-2 mb-sm-0">
                          <select id="monthFilter" class="form-select form-select-sm">
                            <option value="">Filter by Date</option>
                            <option value="Today">Today</option>
                            <option value="Last Week">Last Week</option>
                            <option value="Last Month">Last Month</option>
                          </select>
                        </div>
                        <!-- Filter by Category -->
                        <div class="me-2 mb-2 mb-sm-0">
                          <select id="produceTypeFilter" class="form-select form-select-sm">
                            <option value="">Category</option>
                            <option value="Fruits">Fruits</option>
                            <option value="Vegetables">Vegetables</option>
                          </select>
                        </div>
                        <!-- Search Bar with Icon -->
                        <div class="input-group input-group-sm me-2 mb-2 mb-sm-0" style="width: 180px;">
                          <input type="text" class="form-control" id="searchInput" placeholder="Search...">
                          <button class="btn btn-outline-secondary" type="button">
                            <i class="bi bi-search"></i>
                          </button>
                        </div>
                        <!-- Download Button (aligned to the right) -->
                        <button class="btn btn-primary btn-sm ms-2" id="downloadBtn">
                          <i class="bi bi-download"></i>
                        </button>
                      </div>
                    </div>

                    <!-- Forecast Detail Table -->
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th colspan="5" class="text-center">Detailed Forecast</th>
                            <th colspan="3" class="text-center">Recommendation</th>
                          </tr>
                          <tr>
                            <th scope="col">Date</th>
                            <th scope="col">ID</th>
                            <th scope="col">Produce</th>
                            <th scope="col">Actual Demand</th>
                            <th scope="col">Forecasted Demand</th>
                            <th scope="col" class="text-center">Inventory</th>
                            <th scope="col" class="text-center">Pricing</th>
                            <th scope="col" class="text-center">Promotion</th>
                          </tr>
                        </thead>
                        <tbody id="forecastTableBody">
                          <!-- Table rows will be dynamically inserted here -->
                        </tbody>
                      </table>
                    </div>

  </main><!-- End #main -->

  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>PUP Sto.Tomas</span></strong>. All Rights Reserved
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

                   <!--kay nicole upload (fix this please, double upload)-->
           <script>
            const uploadButton = document.getElementById("uploadButton");
            const fileInput = document.getElementById("fileInput");
          
            uploadButton.addEventListener("click", () => fileInput.click());
            fileInput.addEventListener("change", () => {
              if (fileInput.files.length > 0) {
                document.getElementById("uploadForm").submit();
              }
            });
          </script>
          <script>
            document.getElementById('uploadButton').addEventListener('click', function () {
              document.getElementById('fileInput').click();
            });
            document.getElementById('fileInput').addEventListener('change', handleFileSelect, false);

  function handleFileSelect(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function (e) {
      const csvData = e.target.result;
      const parsedData = parseCSV(csvData);

      if (parsedData.dates.length > 0) {
        generateActualChart(parsedData);
        generateForecastedChart(parsedData);
        populateTable(parsedData);
      } else {
        alert("No valid data found in the file.");
      }
    };
    reader.readAsText(file);
  }

  function parseCSV(csv) {
    const rows = csv.trim().split("\n");
    const headers = rows[0].split(",");

    const data = {
      dates: [],
      ids: [],
      produce: [],
      actualDemand: [],
      forecastedDemand: [],
      inventory: [],
      pricing: [],
      promotion: [],
      quantitySold: [],
      totalSaleValue: [],
    };

    rows.slice(1).forEach((row) => {
      const columns = row.split(",");
      if (columns.length === headers.length) {
        data.dates.push(columns[0]);
        data.ids.push(columns[1]);
        data.produce.push(columns[2]);
        data.actualDemand.push(Number(columns[3]));
        data.forecastedDemand.push(Number(columns[4]));
        data.inventory.push(Number(columns[5]));
        data.pricing.push(parseFloat(columns[6].replace(",", "")));
        data.promotion.push(columns[7]);
        data.quantitySold.push(Number(columns[4])); // This looks like it should be columns[5] (inventory) or another relevant column.
        data.totalSaleValue.push(Number(columns[8]));
      }
    });

    return data;
  }

  function generateActualChart(parsedData) {
    const actualChartCtx = document.getElementById("actualChart").getContext("2d");
    const actualChart = Chart.getChart("actualChart");

    if (actualChart) {
      actualChart.data.labels = parsedData.dates;
      actualChart.data.datasets[0].data = parsedData.quantitySold;
      actualChart.data.datasets[1].data = parsedData.totalSaleValue;
      actualChart.update();
    } else {
      new Chart(actualChartCtx, {
        type: "line",
        data: {
          labels: parsedData.dates,
          datasets: [
            {
              label: "Quantity Sold",
              data: parsedData.quantitySold,
              borderColor: "rgba(75, 192, 192, 1)",
              backgroundColor: "rgba(75, 192, 192, 0.2)",
              fill: true,
            },
            {
              label: "Total Sale Value",
              data: parsedData.totalSaleValue,
              borderColor: "rgba(153, 102, 255, 1)",
              backgroundColor: "rgba(153, 102, 255, 0.2)",
              fill: true,
            },
          ],
        },
        options: {
          responsive: true,
        },
      });
    }

    document.getElementById("actualNoDataMessage").style.display = "none";
    document.getElementById("actualChart").style.display = "block";
  }

  function generateForecastedChart(parsedData) {
    const forecastedChartCtx = document.getElementById("forecastedChart").getContext("2d");
    const forecastedChart = Chart.getChart("forecastedChart");

    if (forecastedChart) {
      forecastedChart.data.labels = parsedData.dates;
      forecastedChart.data.datasets[0].data = parsedData.inventory;
      forecastedChart.data.datasets[1].data = parsedData.pricing;
      forecastedChart.update();
    } else {
      new Chart(forecastedChartCtx, {
        type: "line",
        data: {
          labels: parsedData.dates,
          datasets: [
            {
              label: "Inventory",
              data: parsedData.inventory,
              borderColor: "rgba(75, 192, 192, 1)",
              backgroundColor: "rgba(75, 192, 192, 0.2)",
              fill: true,
            },
            {
              label: "Pricing",
              data: parsedData.pricing,
              borderColor: "rgba(153, 102, 255, 1)",
              backgroundColor: "rgba(153, 102, 255, 0.2)",
              fill: true,
            },
          ],
        },
        options: {
          responsive: true,
        },
      });
    }

    document.getElementById("forecastedNoDataMessage").style.display = "none";
    document.getElementById("forecastedChart").style.display = "block";
  }

  function populateTable(data) {
    const tableBody = document.getElementById("forecastTableBody");
    tableBody.innerHTML = "";

    for (let i = 0; i < data.dates.length; i++) {
      const tr = document.createElement("tr");
      tr.innerHTML = `
        <td>${data.dates[i]}</td>
        <td>${data.ids[i]}</td>
        <td>${data.produce[i]}</td>
        <td>${data.actualDemand[i]}</td>
        <td>${data.forecastedDemand[i]}</td>
        <td>${data.inventory[i]}</td>
        <td>${data.pricing[i]}</td>
        <td>${data.promotion[i]}</td>
      `;
      tableBody.appendChild(tr);
    }
  }
</script>

  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
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