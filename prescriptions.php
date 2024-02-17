<?php
session_start();

require_once("MySQL.php");

if (isset($_SESSION["admin"]) ){
    ?>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Pharmacy Web Application</title>
            <style>
                
            </style>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
            <div class="container-fluid mt-2">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                            <a class="navbar-brand" href="#">Pharmacy</a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Services</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Contact</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1 class="mb-4">Prescriptions</h1>
                    </div>
                </div>

                <div class="container">
                <div class="row">
                <div class="error-message text-danger" id="error"></div>
                <table id="drugTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Note</th>
                            <th scope="col">Delivery Addess</th>
                            <th scope="col">Delivery time</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                     <tbody>
                    <?php
                        $query = "SELECT * FROM `prescription` ORDER BY `delivery_time` DESC";
                        $result = MySQL::search($query);
                        // Check if there are any rows in the result set
                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Output the data into table rows
                                echo "<tr>";
                                echo "<td>" . $row['Note'] . "</td>";
                                echo "<td>" . $row['delivery_address'] . "</td>";
                                echo "<td>" . $row['delivery_time'] . "</td>";
                                echo "<td>" . $row['qty'] . "</td>";
                                echo "<td>" ; if ($row['status_id'] == 1) {
                                 echo "Accepted";
                                } elseif ($row['status_id'] == 2) {
                                    echo "Rejected";
                                } else {
                                    echo "<button onclick='goToPharmacyHome(\"{$row['id']}\")'>Send Quotation</button>";
                                } ; "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No prescriptions found.</td></tr>";
                        }
                
                    ?>
                     </tbody>
                </table>
                </div>
            </div>
            </div>
            <script src="script.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>
    <?php
}else{
    ?>
    <script>
        window.location = 'pharmacyUserLogin.php';
    </script>
    <?php
}
?>