<?php
session_start();
if (isset($_SESSION["admin"]) ){
    ?>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Pharmacy Web Application</title>
            <style>
                .mainImage{
                    height: 300px;
                    background-image: url(Images/baseMedicineImage.png);
                    background-repeat: no-repeat;
                    background-size: contain;
                    background-position: center center;
                }

                .smallImage1{
                    height: 100px;
                    background-image: url(Images/baseMedicineImage.png);
                    background-repeat: no-repeat;
                    background-size: contain;
                    background-position: center center;
                }
                .smallImage2{
                    height: 100px;
                    background-image: url(Images/baseMedicineImage.png);
                    background-repeat: no-repeat;
                    background-size: contain;
                    background-position: center center;
                }
                .smallImage3{
                    height: 100px;
                    background-image: url(Images/baseMedicineImage.png);
                    background-repeat: no-repeat;
                    background-size: contain;
                    background-position: center center;
                }
                .smallImage4{
                    height: 100px;
                    background-image: url(Images/baseMedicineImage.png);
                    background-repeat: no-repeat;
                    background-size: contain;
                    background-position: center center;
                }
            </style>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body onload="getImages('<?php echo $_GET['id']; ?>');">
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

                <div class="container mt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="border p-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                         <div class="col-10 offset-1 border mb-2 mainImage" id="image1"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3 smallImage1" id="image2"></div>
                                            <div class="col-3 smallImage2" id="image3"></div>
                                            <div class="col-3 smallImage3" id="image4"></div>
                                            <div class="col-3 smallImage4" id="image5"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border p-3">
                                <div class="row">
                                <div class="error-message text-danger" id="error"></div>
                                <table id="drugTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Drug</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                                </div>

                                <div class="row">
                                <div class="col-6 offset-6 mb-2">
                                    <input type="text" class="form-control" placeholder="Drug Name" id="drug">
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-6 offset-6  mb-2">
                                    <input type="text" class="form-control" placeholder="Quantity" id="qty">
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-6 offset-6  mb-2">
                                    <input type="text" class="form-control" placeholder="price" id="price">
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-6 offset-6  mb-2">
                                    <button class="btn btn-primary col-12" onclick="addDrug()">Add</button>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-12 mb-2">
                                    <button class="btn btn-success col-12" onclick="sendQuotationData('<?php echo $_GET['id']; ?>')">Send Quotation</button>
                                </div>
                                </div>
                            </div>
                        </div>
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