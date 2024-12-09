<?php
date_default_timezone_set("Asia/Jakarta");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <script src="script.js" defer></script>
    <title>Point Of Sale</title>
</head>

<body>
    <div class="bg-primary">
        <div class="row mx-0 py-3 bg-light">
            <div class="col-sm-8">
                <div class="card rounded-3 mb-3">
                <a href="../login/logout.php" class="btn btn-primary">Keluar</a>
                    <div class="card-body" id="navbar">
                    <?php
                        include 'auth.php';

                        try {
                            // Query untuk mengambil semua data orderan dan mengurutkan berdasarkan tanggal terbaru
                            $sql = "SELECT orderId, orderDateTime FROM point_of_sales.orders ORDER BY orderDateTime DESC";
                            $result = $pdo->query($sql);

                            if ($result->rowCount() > 0) {
                                $row = $result->fetch() ;
                                    $orderId = $row['orderId'];
                                    $orderDate = $row['orderDateTime']; // Format dari database
                                    // Format tanggal menjadi lebih ramah pengguna
                                    $formattedDate = date("d F Y, h:i A", strtotime($orderDate));
                        ?>
                                    <?php
                                
                            } else {
                                echo '<p>No orders found.</p>';
                            }
                        } catch (PDOException $e) {
                            die("ERROR: Could not execute $sql. " . $e->getMessage());
                        }
                        ?>
                        <div class="row">
                            <div class="col">
                                <p>Order ID: <span id="latestOrderId"><?= $row['orderId'] ?></span></p>
                                <p>Tanggal Order Terakhir: <span id="latestOrderDate"><?= $row['orderDateTime'] ?></span></p>
                            </div>
                        </div>
                        
                        <ul class="nav nav-pills" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active rounded-pill" id="pills-food-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-food" type="button" role="tab" aria-controls="pills-food"
                                    aria-selected="true">Menu Utama</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-pill" id="pills-drink-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-drink" type="button" role="tab" aria-controls="pills-drink"
                                    aria-selected="false">Minuman Dingin</button>
                            </li>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-pill" id="pills-snack-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-snack" type="button" role="tab" aria-controls="pills-snack"
                                    aria-selected="false">Makanan Ringan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-pill" id="pills-hotdrink-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-hotdrink" type="button" role="tab" aria-controls="pills-hotdrink"
                                    aria-selected="false">Menu Unggulan</button>
                            </li>
                            <li class="nav-item d-none" role="presentation">
                                <button class="nav-link rounded-pill" id="pills-checkout-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-checkout" type="button" role="tab"
                                    aria-controls="pills-checkout" aria-selected="false">CHECK OUT </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-food" role="tabpanel"
                        aria-labelledby="pills-food-tab">


                        <div class="row row-cols-1 row-cols-md-4 g-3 mt-3 " style="height: 79vh;overflow-y: auto;">




                            <?php

              include 'auth.php';

              try {
                $sql = "SELECT * FROM point_of_sales.menuitems WHERE menuItemCategory= 1";
                $result = $pdo->query($sql);
                if ($result->rowCount() > 0) {
                  while ($row = $result->fetch()) { ?>

                            <div class=" col-sm-12 col-md-3  col mt-3">
                                <div class="card"
                                    onclick="orderbasket(<?= $row['menuItemId']; ?>,'<?= $row['menuItemName']; ?>','<?= $row['menuItemPrice']; ?>','<?= $row['menuItemImage']; ?>','<?= $row['menuItemCategory']; ?>');">
                                    <img draggable="false" src="<?= $row['menuItemImage']; ?>" class="card-img-top"
                                        alt="..." style="max-height: 200px; object-fit: contain; margin-bottom: 0;"/>
                                    <div class="card-body mb-2">
                                        <h5 class="card-title"><?= $row['menuItemName']; ?></h5>
                                        <p>   Rp   <span><?= number_format($row['menuItemPrice']); ?></span></p>

                                    </div>
                                </div>
                            </div>

                            <?php }
                  unset($result);
                } else {
                  // echo 'Please Add Your Menu Items Here';
                }
              } catch (PDOException $e) {
                die("ERROR::Could not able to execute $sql. " . $e->getMessage());
              }
              ?>




                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-drink" role="tabpanel" aria-labelledby="pills-drink-tab">
                        <div class="row row-cols-1 row-cols-md-4 g-3 mt-3" style="height: 79vh;overflow-y: auto;">

                            <?php

              try {
                $sql = "SELECT * FROM point_of_sales.menuitems WHERE menuItemCategory= 2";
                $result = $pdo->query($sql);
                if ($result->rowCount() > 0) {
                  while ($row = $result->fetch()) { ?>


                            <div class="col-sm-12 col-md-3 col mt-3">
                                <div class="card h-100"
                                    onclick="orderbasket(<?= $row['menuItemId']; ?>,'<?= $row['menuItemName']; ?>','<?= $row['menuItemPrice']; ?>','<?= $row['menuItemImage']; ?>','<?= $row['menuItemCategory']; ?>')">
                                    <img draggable="false" src="<?= $row['menuItemImage']; ?>" class="card-img-top"
                                        alt="..." style="max-height: 200px; object-fit: contain; margin-bottom: 0;"/>
                                    <div class="card-body">
                                        <h5 class="card-title mb-2"><?= $row['menuItemName']; ?></h5>
                                        <p>    Rp   <?= $row['menuItemPrice']; ?></p>
                                    </div>
                                </div>
                            </div>

                            <?php }
                  unset($result);
                } else {
                  // echo 'Please Add Your Menu Items Here';
                }
              } catch (PDOException $e) {
                die("ERROR::Could not able to execute $sql. " . $e->getMessage());
              }
              ?>





                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-snack" role="tabpanel" aria-labelledby="pills-snack-tab">
                        <div class="row row-cols-1 row-cols-md-4 g-3 mt-3" style="height: 79vh; overflow-y: auto;">

        <?php
        try {
            $sql = "SELECT * FROM point_of_sales.menuitems WHERE menuItemCategory = 3"; // Assuming 3 is the category ID for DESSERT
            $result = $pdo->query($sql);
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch()) { ?>
                    <div class="col mt-3">
                        <div class="card h-100"
                            onclick="orderbasket(<?= $row['menuItemId']; ?>,'<?= $row['menuItemName']; ?>','<?= $row['menuItemPrice']; ?>','<?= $row['menuItemImage']; ?>','<?= $row['menuItemCategory']; ?>')">
                            <img draggable="false" src="<?= $row['menuItemImage']; ?>" class="card-img-top"
                                alt="..." style="max-height: 200px; object-fit: contain; margin-bottom: 0;"/>
                            <div class="card-body ">
                                <h5 class="card-title mb-2"><?= $row['menuItemName']; ?></h5>
                                <p> Rp   <?= $row['menuItemPrice']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php }
                unset($result);
            } else {
                echo '<p class="text-center">No items available in this category.</p>';
            }
        } catch (PDOException $e) {
            die("ERROR::Could not execute $sql. " . $e->getMessage());
        }
        ?>

    </div>
</div>
                    <div class="tab-pane fade" id="pills-hotdrink" role="tabpanel" aria-labelledby="pills-hotdrink-tab">
                        <div class="row row-cols-1 row-cols-md-4 g-4 mt-4" style="height: 79vh; overflow-y: auto;">

        <?php
        try {
            $sql = "SELECT * FROM point_of_sales.menuitems WHERE menuItemCategory = 4";
            $result = $pdo->query($sql);
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch()) { ?>
                    <div class="col mt-3">
                        <div class="card h-100"
                            onclick="orderbasket(<?= $row['menuItemId']; ?>,'<?= $row['menuItemName']; ?>','<?= $row['menuItemPrice']; ?>','<?= $row['menuItemImage']; ?>','<?= $row['menuItemCategory']; ?>')">
                            <img draggable="false" src="<?= $row['menuItemImage']; ?>" class="card-img-top"
                                alt="..." style="max-height: 200px; object-fit: contain; margin-bottom: 0;" />
                            <div class="card-body">
                                <h5 class="card-title mb-2"><?= $row['menuItemName']; ?></h5>
                                <p> Rp   <?= $row['menuItemPrice']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php }
                unset($result);
            } else {
                echo '<p class="text-center">No items available in this category.</p>';
            }
        } catch (PDOException $e) {
            die("ERROR::Could not execute $sql. " . $e->getMessage());
        }
        ?>

    </div>
</div>

                    <div class="tab-pane fade" id="pills-checkout" role="tabpanel" aria-labelledby="pills-checkout-tab">
                        CHECK OUT

                        <div class="row mb-3">
                            <label for="customername"
                                class="rounded-pill col-sm-4 col-form-label col-form-label-lg">Nama Pelanggan</label>
                            <div class="col-sm-8">
                                <input type="text" class="text-center form-control form-control-lg" id="customername"
                                    placeholder="Atau #88">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="customername"
                                class="rounded-pill col-sm-4 col-form-label col-form-label-lg">Jumlah</label>
                            <div class="col-sm-8">
                                <input type="number" step="0.01" class="text-center form-control form-control-lg"
                                    id="amount" placeholder="amount" disabled>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="customername" class="col-sm-4 col-form-label col-form-label-lg">Pembayaran Pelanggan</label>
                            <div class="col-sm-8">
                                <button onclick="exactAmountCalculator()" id="calculatorModal"
                                    class="rounded-pill btn btn-success btn-lg w-100" data-bs-toggle="modal"
                                    data-bs-target="#amountcalculator">Masukan Jumlah Pembayaran</button>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="customername"
                                class="rounded-pill col-sm-4 col-form-label col-form-label-lg">Jumlah Nominal
                                Pelanggan</label>
                            <div class="col-sm-8">
                                <input type="number" step=""
                                    class="rounded-pill text-center form-control form-control-lg"
                                    id="customeramountpaid" placeholder="Jumlah" disabled>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="customername"
                                class="rounded-pill col-sm-4 col-form-label col-form-label-lg">Kembalian</label>
                            <div class="col-sm-8">
                                <input type="number" step="0.01"
                                    class="rounded-pill text-center form-control form-control-l text-danger fw-bold"
                                    id="customeramountchange" placeholder="Kembalian" disabled>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="printReceiptButton"
                                class="rounded-pill col-sm-4 col-form-label col-form-label-lg">Cetak Struk</label>
                            <div class="col-sm-8">
                                <button id="printReceiptButton" class="rounded-pill btn btn-success btn-lg w-100" onclick="printReceipt()"
                                    disabled>Cetak</button>
                            </div>
                            <div id="print-area" >
                            <!-- Konten cetak akan diisi secara dinamis -->
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="customerNextButton"
                                class="rounded-pill col-sm-4 col-form-label col-form-label-lg">Customer Selanjutnya</label>
                            <div class="col-sm-8">
                                <button id="customerNextButton" onclick="nextCustomerButton()" class="rounded-pill btn btn-primary btn-lg w-100"
                                    disabled>Customer Selanjutnya</button>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="d-flex justify-content-between align-items-center"><span>Order</span><button
                                class="btn btn-sm btn-danger rounded-pill" onclick="orderbasketClear()"
                                id="orderBasketClearButton" disabled>Bersihkan</button></h5>
                        <hr>
                        <ul class="list-unstyled" id="orderlist" style="height: 50vh;overflow-y: auto;">
                        </ul>
                        <hr>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between align-items-center">
                                <big>Total Items:</big>
                                <big id="totalitems" class="fw-bold card-text">0</big>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <big>Jumlah Total Pembayaran:</big>
                                <big class="fw-bold"><span id="totalcost" class="card-text">0.00</span></big>
                            </li>
                            <li>
                                <hr>
                                <button id="checkOutButton" onclick="goToCheckOutTab()"
                                    class="btn btn-primary btn-lg w-100 rounded-pill" disabled>CHECK OUT</button>
                            </li>
                        </ul>
                        <hr>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="amountcalculator" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
        
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Calculator</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input id="calculatorScreenAmount" type="text"
                            class="mb-3  w-100 text-end form-control form-control-lg" value="0" disabled>
                        <div class="row">
                            <div class="col-4 mb-3" onclick="calculatorInsert(9)"><button
                                    class="btn w-100 rounded-pill text-center btn-outline-dark">9</button></div>
                            <div class="col-4 mb-3" onclick="calculatorInsert(8)"><button
                                    class="btn w-100 rounded-pill text-center btn-outline-dark">8</button></div>
                            <div class="col-4 mb-3" onclick="calculatorInsert(7)"><button
                                    class="btn w-100 rounded-pill text-center btn-outline-dark">7</button></div>
                            <div class="col-4 mb-3" onclick="calculatorInsert(6)"><button
                                    class="btn w-100 rounded-pill text-center btn-outline-dark">6</button></div>
                            <div class="col-4 mb-3" onclick="calculatorInsert(5)"><button
                                    class="btn w-100 rounded-pill text-center btn-outline-dark">5</button></div>
                            <div class="col-4 mb-3" onclick="calculatorInsert(4)"><button
                                    class="btn w-100 rounded-pill text-center btn-outline-dark">4</button></div>
                            <div class="col-4 mb-3" onclick="calculatorInsert(3)"><button
                                    class="btn w-100 rounded-pill text-center btn-outline-dark">3</button></div>
                            <div class="col-4 mb-3" onclick="calculatorInsert(2)"><button
                                    class="btn w-100 rounded-pill text-center btn-outline-dark">2</button></div>
                            <div class="col-4 mb-3" onclick="calculatorInsert(1)"><button
                                    class="btn w-100 rounded-pill text-center btn-outline-dark">1</button></div>
                            <div class="col-4 mb-3" onclick="calculatorInsert(0)"><button
                                    class="btn w-100 rounded-pill text-center btn-outline-dark">0</button></div>
                            <div class="col-4 mb-3" onclick="calculatorInsert('00')"><button
                                    class="btn w-100 rounded-pill text-center btn-outline-dark">00</button></div>
                            <div class="col-4 mb-3" onclick="calculatorInsert('.')"><button
                                    class="btn w-100 rounded-pill text-center btn-outline-dark">.</button></div>
                            <div class="col-4 mb-3" onclick="calculatorCancel()"><button
                                    class="btn w-100 rounded-pill text-center btn-danger">C</button></div>
                            <div class="modal-body">
                                <div class="col-12 mb-3">
                                    <button class="btn w-100 rounded-pill text-center btn-warning"
                                        onclick="exactAmountButton()">Jumlah Pas (<span id="exactamountspan"></span>)</button>
                                </div>
                                <div class="row">
                                    <div class="col-2 mb-3"><button
                                            class="btn w-100 rounded-pill text-center btn-warning"
                                            onclick="denominationButton(1)">1</button></div>
                                    <div class="col-2 mb-3"><button
                                            class="btn w-100 rounded-pill text-center btn-warning"
                                            onclick="denominationButton(5)">5</button></div>
                                    <div class="col-2 mb-3"><button
                                            class="btn w-100 rounded-pill text-center btn-warning"
                                            onclick="denominationButton(10)">10</button></div>
                                    <div class="col-2 mb-3"><button
                                            class="btn w-100 rounded-pill text-center btn-warning"
                                            onclick="denominationButton(50)">50</button></div>
                                    <div class="col-2 mb-3"><button
                                            class="btn w-100 rounded-pill text-center btn-warning"
                                            onclick="denominationButton(100)">100</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            onclick="calculatorCancel()">Tutup</button>
                        <button type="submit" name="submit" class="btn btn-primary" id="confirmPaid"
                            onclick="confirmPaidButton()" data-bs-dismiss="modal" disabled>Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
        //   async function fetchData() {
        //   try {
        //     let response = await fetch("https://api.example.com/data");
        //     if (!response.ok) throw new Error("Request failed");
        //     let data = await response.json();
        //     console.log(data);
        //   } catch (error) {
        //     console.error("Error:", error);
        //   }
        // }
        // fetchData();
        </script>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>