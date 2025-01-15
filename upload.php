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
        echo "File successfully uploaded and data inserted into the database.";
    } else {
        echo "Error opening the file.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No file uploaded.";
}
?>
