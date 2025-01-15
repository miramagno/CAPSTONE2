<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ForeProduce - Admin Dashboard</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="icon" href="assets/img/wm-logo.svg">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

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

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foreproduce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT username FROM register";
$result = $conn->query($sql);

$tableRowsUsers = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $username = $row['username'];
    }
}
?>
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
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link" href="demand.php">
          <i class="bi bi-bar-chart"></i>
          <span>Demand Forecasting</span>
        </a>
      </li><!-- End Demand Forecasting -->

      <li class="nav-item">
        <a class="nav-link" href="inventory.php">
          <i class="bi bi-journal-album"></i>
          <span>Inventory Management</span>
        </a>
      </li><!-- End Inventory Nav -->

      <li class="nav-item">
        <a class="nav-link" href="pricing.php">
          <i class="bi bi-grid"></i>
          <span>Pricing and Promotion</span>
        </a>
      </li>

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link" href="pages-register.php">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link" href="pages-register.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Forecast Accuracy</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="ps-3">
                      <h6 class="text-dark">85%</h6>
                      <span class="small pt-1 fw-bold" style="color: #015c92;">Accurate</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Inventory Level</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-boxes"></i>
                    </div>
                    <div class="ps-3">
                      <h6 class="text-dark">10%</h6>
                      <span class="small pt-1 fw-bold" style="color: #015c92;">Overstocked</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Promotional Success</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-arrow-down-circle"></i>
                    </div>
                    <div class="ps-3">
                      <h6 class="text-dark">+21%</h6>
                      <span class="small pt-1 fw-bold" style="color: #015c92;">Sales Increase</span>
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Forecast Chart -->
            <div class="col-12">
              <div class="row">
                <!-- Forecasted Demand Chart -->
                <div class="col-12">
                  <div class="card">
                    <div class="filter">
                      <a class="icon" href="/demand.html"><i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Forecasted Demand Chart</h5>
                      <!-- Line Chart for Forecasted Demand -->
                      <div id="forecastedDemandChart"></div>
                    </div>
                  </div>
                </div>
              </div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  const produceLabels = ["Fruits", "Vegetables"];
                  const forecastedDemandData = [
                    [160, 190, 180, 200], // Fruits
                    [220, 240, 260, 250], // Vegetables
                  ];

                  const forecastAccuracyData = [
                    [90, 85, 88, 92], // Fruits (Accuracy in %)
                    [93, 87, 89, 91], // Vegetables (Accuracy in %)
                  ];

                  // Function to get the first four Fridays of a given month and year
                  const getFirstFourFridays = (month, year) => {
                    const fridays = [];
                    let date = new Date(year, month, 1);
                    // Find the first Friday of the month
                    while (date.getDay() !== 5) {
                      date.setDate(date.getDate() + 1);
                    }
                    // Add the first four Fridays
                    for (let i = 0; i < 4; i++) {
                      fridays.push(new Date(date).toLocaleDateString('en-GB', {
                        month: 'short',
                        day: '2-digit'
                      }));
                      date.setDate(date.getDate() + 7);
                    }
                    return fridays;
                  };

                  // Get the first four Fridays of November 2024
                  const novemberFridays = getFirstFourFridays(10, 2024);

                  // Forecasted Demand Chart
                  new ApexCharts(document.querySelector("#forecastedDemandChart"), {
                    series: produceLabels.map((label, index) => ({
                      name: label,
                      data: forecastedDemandData[index]
                    })),
                    chart: {
                      height: 300,
                      type: 'line',
                      toolbar: {
                        show: false
                      }
                    },
                    markers: {
                      size: 4
                    },
                    colors: ['#ff6361', '#ffa600', '#003f5c', '#bc5090', '#ffb347'],
                    fill: {
                      type: "gradient",
                      gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.3,
                        opacityTo: 0.4,
                        stops: [0, 90, 100]
                      }
                    },
                    dataLabels: {
                      enabled: false
                    },
                    stroke: {
                      curve: 'smooth',
                      width: 2
                    },
                    xaxis: {
                      categories: novemberFridays,
                    },
                    yaxis: {
                      title: {
                        text: 'Items',
                        style: {
                          fontSize: '12px',
                          fontWeight: 'normal',
                          fontFamily: 'Arial, sans-serif',
                          marginBottom: '10px',
                        }
                      },
                      tickAmount: 6,
                    },
                    tooltip: {
                      x: {
                        format: 'dd MMM'
                      },
                      custom: function({
                        seriesIndex,
                        dataPointIndex,
                        w
                      }) {
                        const category = produceLabels[seriesIndex];
                        const demandValue = w.config.series[seriesIndex].data[dataPointIndex];
                        const accuracyValue = forecastAccuracyData[seriesIndex][dataPointIndex];

                        return `
                          <div style="
                            font-size: 16px; 
                            color: #333; 
                            background-color: #fff; 
                            border: 1px solid #ddd; 
                            border-radius: 5px; 
                            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
                          ">
                            <table style="width: 100%; border-collapse: collapse;">
                              <tr>
                                <th colspan="2" style="padding: 8px; background-color: #f7f7f7; text-align: center;">${category}</th>
                              </tr>
                              <tr>
                                <td style="padding: 8px;">Units</td>
                                <td style="padding: 8px; font-weight: bold;">${demandValue}</td>
                              </tr>
                              <tr>
                                <td style="padding: 8px; ">Forecast Accuracy</td>
                                <td style="padding: 8px; font-weight: bold;">${accuracyValue}%</td>
                              </tr>
                            </table>
                          </div>
                        `;
                      }
                    }
                  }).render();
                });
              </script>
            </div>

            <!-- Pricing Adjustment & Promotion Overview -->
            <div class="col-12">
              <div class="card pricing-adjustment-promotion overflow-auto">

                <!-- Filter Dropdown -->
                <div class="filter mt-3">
                  <a class="icon" href="/pricing.html"><i class="fa-solid fa-arrow-right"></i></a>
                </div>

                <div class="card-body">
                  <h5 class="card-title mt-3">Pricing Adjustment & Promotions Overview</h5>

                  <!-- Pricing and Promotion Table -->
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">Id</th>
                          <th scope="col">Produce</th>
                          <th scope="col">Original Price</th>
                          <th scope="col">Discounted Price</th>
                          <th scope="col">Discount</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row"><a href="#">#2457</a></th>
                          <td>Organic Kale</td>
                          <td>$5</td>
                          <td>$4.50</td>
                          <td>20% Off</td>
                          <td><span class="badge" style="background-color: #174663;">Promotion Active</span></td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#">#2147</a></th>
                          <td>Sweet Potatoes</td>
                          <td>$2.50</td>
                          <td>$2.20</td>
                          <td>10% Off</td>
                          <td><span class="badge" style="background-color: #62879c;">Pending</span></td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#">#2049</a></th>
                          <td>Blueberries</td>
                          <td>$6</td>
                          <td>$7.50</td>
                          <td>5% Increase</td>
                          <td><span class="badge" style="background-color: #2c57a7;">Promotion Ended</span></td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#">#3001</a></th>
                          <td>Avocados</td>
                          <td>$3.50</td>
                          <td>$3.20</td>
                          <td>15% Off</td>
                          <td><span class="badge" style="background-color: #174663;">Promotion Active</span></td>
                        </tr>
                        <tr>
                          <th scope="row"><a href="#">#3321</a></th>
                          <td>Carrots</td>
                          <td>$1.80</td>
                          <td>$1.50</td>
                          <td>5% Off</td>
                          <td><span class="badge" style="background-color: #62879c;">Pending</span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!--High-Demand Produce Forecast -->
          <div class="card">

            <div class="card-body">
              <h5 class="card-title">High-Demand Produce Forecast </h5>
              <div class="activity">
                <div class="table">
                  <div class="row mb-3">
                    <div class="col-1"></div>
                    <div class="col">
                      <strong class="ms-2">Produce</strong>
                    </div>
                    <div class="col text-nowrap">
                      <strong>Predicted Demand</strong>
                    </div>
                  </div>

                  <!-- Activity Item 1: Top Produce - Example: Bananas -->
                  <div class="row mb-3">
                    <div class="col d-flex align-items-center">
                      <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                      <span class="ms-1">Bananas</span>
                    </div>
                    <div class="col text-nowrap text-center mt-2">15%</div>
                  </div>
                  <!-- End activity item-->

                  <!-- Activity Item 2: Another High-Demand Item - Example: Carrots -->
                  <div class="row mb-3">
                    <div class="col d-flex align-items-center">
                      <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                      <span class="ms-1">Carrots</span>
                    </div>
                    <div class="col text-nowrap text-center mt-2">21%</div>
                  </div>
                  <!-- End activity item-->

                  <!-- Activity Item 3: Example with another high-demand item - Oats -->
                  <div class="row mb-3">
                    <div class="col d-flex align-items-center">
                      <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                      <span class="ms-1">Rolled Oats</span>
                    </div>
                    <div class="col text-nowrap text-center mt-2">28%</div>
                  </div>
                  <!-- End activity item-->

                  <!-- Activity Item 4: Example with another high-demand item - Lettuce -->
                  <div class="row mb-3">
                    <div class="col d-flex align-items-center">
                      <i class='bi bi-circle-fill activity-badge text-info align-self-start'></i>
                      <span class="ms-1">Lettuce</span>
                    </div>
                    <div class="col text-nowrap text-center mt-2">23%</div>
                  </div>
                  <!-- End activity item-->

                  <!-- Activity Item 5: Example with another high-demand item - Basil -->
                  <div class="row mb-3">
                    <div class="col d-flex align-items-center">
                      <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                      <span class="ms-1">Basil</span>
                    </div>
                    <div class="col text-nowrap text-center mt-2">15%</div>
                  </div>
                  <!-- End activity item-->
                </div>
              </div>
            </div>
          </div> <!-- End Recent Activity -->

          <!-- Inventory Level -->
          <div class="card shadow-sm rounded">
            <div class="filter">
              <a class="icon" href="/inventory.html"><i class="fa-solid fa-arrow-right"></i></a>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title text-center mb-3">Inventory Level <span>| Today</span></h5>

              <!-- Pie chart for inventory status -->
              <div id="inventoryChart" style="min-height: 300px; border-radius: 10px;" class="echart mb-4"></div>

              <!-- Low Stock Alerts List -->
              <div class="low-stock-alerts mt-3">
                <h6 class="text-uppercase text-dark">Low Stock Alerts</h6>
                <ul id="lowStockList" class="list-unstyled mb-3">
                  <!-- Low stock items will be populated here -->
                </ul>
              </div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  // Example data structure for different categories
                  const inventoryData = {
                    vegetables: {
                      chartData: [{
                          value: 50,
                          name: 'Optimal',
                          itemStyle: {
                            color: '#4CAF50'
                          }
                        },
                        {
                          value: 30,
                          name: 'Low',
                          itemStyle: {
                            color: '#FFEB3B'
                          }
                        },
                        {
                          value: 20,
                          name: 'High',
                          itemStyle: {
                            color: '#F44336'
                          }
                        }
                      ],
                      lowStockItems: [{
                          name: 'Tomatoes',
                          quantity: 5,
                          reorder: 20
                        },
                        {
                          name: 'Carrots',
                          quantity: 3,
                          reorder: 15
                        }
                      ],
                      allItems: [{
                          name: 'Tomatoes',
                          quantity: 50
                        },
                        {
                          name: 'Carrots',
                          quantity: 30
                        },
                        {
                          name: 'Lettuce',
                          quantity: 45
                        },
                        {
                          name: 'Cucumbers',
                          quantity: 60
                        }
                      ]
                    },
                    fruits: {
                      chartData: [{
                          value: 60,
                          name: 'Optimal',
                          itemStyle: {
                            color: '#4CAF50'
                          }
                        },
                        {
                          value: 25,
                          name: 'Low',
                          itemStyle: {
                            color: '#FFEB3B'
                          }
                        },
                        {
                          value: 15,
                          name: 'High',
                          itemStyle: {
                            color: '#F44336'
                          }
                        }
                      ],
                      lowStockItems: [{
                          name: 'Bananas',
                          quantity: 10,
                          reorder: 30
                        },
                        {
                          name: 'Apples',
                          quantity: 12,
                          reorder: 20
                        }
                      ],
                      allItems: [{
                          name: 'Bananas',
                          quantity: 50
                        },
                        {
                          name: 'Apples',
                          quantity: 60
                        },
                        {
                          name: 'Oranges',
                          quantity: 70
                        },
                        {
                          name: 'Strawberries',
                          quantity: 80
                        }
                      ]
                    },
                    grains: {
                      chartData: [{
                          value: 70,
                          name: 'Optimal',
                          itemStyle: {
                            color: '#4CAF50'
                          }
                        },
                        {
                          value: 10,
                          name: 'Low',
                          itemStyle: {
                            color: '#FFEB3B'
                          }
                        },
                        {
                          value: 20,
                          name: 'High',
                          itemStyle: {
                            color: '#F44336'
                          }
                        }
                      ],
                      lowStockItems: [{
                        name: 'Rice',
                        quantity: 30,
                        reorder: 60
                      }],
                      allItems: [{
                          name: 'Rice',
                          quantity: 100
                        },
                        {
                          name: 'Wheat',
                          quantity: 120
                        },
                        {
                          name: 'Barley',
                          quantity: 80
                        }
                      ]
                    },
                    oats: {
                      chartData: [{
                          value: 80,
                          name: 'Optimal',
                          itemStyle: {
                            color: '#4CAF50'
                          }
                        },
                        {
                          value: 10,
                          name: 'Low',
                          itemStyle: {
                            color: '#FFEB3B'
                          }
                        },
                        {
                          value: 10,
                          name: 'High',
                          itemStyle: {
                            color: '#F44336'
                          }
                        }
                      ],
                      lowStockItems: [{
                        name: 'Rolled Oats',
                        quantity: 5,
                        reorder: 40
                      }],
                      allItems: [{
                          name: 'Rolled Oats',
                          quantity: 60
                        },
                        {
                          name: 'Instant Oats',
                          quantity: 40
                        }
                      ]
                    },
                    herbs: {
                      chartData: [{
                          value: 90,
                          name: 'Optimal',
                          itemStyle: {
                            color: '#4CAF50'
                          }
                        },
                        {
                          value: 5,
                          name: 'Low',
                          itemStyle: {
                            color: '#FFEB3B'
                          }
                        },
                        {
                          value: 5,
                          name: 'High',
                          itemStyle: {
                            color: '#F44336'
                          }
                        }
                      ],
                      lowStockItems: [{
                        name: 'Basil',
                        quantity: 5,
                        reorder: 20
                      }],
                      allItems: [{
                          name: 'Basil',
                          quantity: 40
                        },
                        {
                          name: 'Mint',
                          quantity: 50
                        },
                        {
                          name: 'Oregano',
                          quantity: 30
                        }
                      ]
                    }
                  };

                  // Set default category to "vegetables"
                  let currentCategory = 'vegetables';

                  // Function to update the pie chart, low stock list, and all items list based on category
                  function updateInventory(category) {
                    // Update pie chart
                    echarts.init(document.querySelector("#inventoryChart")).setOption({
                      tooltip: {
                        trigger: 'item'
                      },
                      legend: {
                        top: '5%',
                        left: 'center'
                      },
                      series: [{
                        name: 'Inventory Status',
                        type: 'pie',
                        radius: ['40%', '70%'],
                        avoidLabelOverlap: false,
                        label: {
                          show: false,
                          position: 'center'
                        },
                        emphasis: {
                          label: {
                            show: true,
                            fontSize: '18',
                            fontWeight: 'bold'
                          }
                        },
                        labelLine: {
                          show: false
                        },
                        data: inventoryData[category].chartData
                      }]
                    });

                    // Update low stock alerts list
                    const lowStockList = document.querySelector('#lowStockList');
                    lowStockList.innerHTML = ''; // Clear previous list

                    inventoryData[category].lowStockItems.forEach(item => {
                      const li = document.createElement('li');
                      li.classList.add('alert', 'alert-danger', 'd-flex', 'justify-content-between', 'align-items-center', 'mb-2');
                      li.innerHTML = `<strong>${item.name} </strong><span class="badge bg-danger" style="font-size: 0.7rem;">${item.quantity} units left <!-- | Reorder: ${item.reorder} --> </span>`;
                      lowStockList.appendChild(li);
                    });

                    // Update all items list
                    const allItemsList = document.querySelector('#allItemsList');
                    const categoryNameElement = document.querySelector('#selectedCategoryName');
                    categoryNameElement.textContent = category.charAt(0).toUpperCase() + category.slice(1); // Capitalize category name

                    allItemsList.innerHTML = ''; // Clear previous list

                    inventoryData[category].allItems.forEach(item => {
                      const li = document.createElement('li');
                      li.classList.add('list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
                      li.innerHTML = `<strong>${item.name}</strong><span class="badge" style="background-color: #015c92;">${item.quantity} units available</span>`;
                      allItemsList.appendChild(li);
                    });
                  }

                  // Initial call to set the default category (vegetables)
                  updateInventory(currentCategory);

                  // Event listener for category filter
                  document.querySelectorAll('.dropdown-item').forEach(item => {
                    item.addEventListener('click', (e) => {
                      e.preventDefault();
                      currentCategory = e.target.getAttribute('data-category');
                      updateInventory(currentCategory);
                    });
                  });
                });
              </script>
            </div>
          </div>



        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

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

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>