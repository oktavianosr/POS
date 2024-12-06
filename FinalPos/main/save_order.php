<?php
date_default_timezone_set("Asia/Jakarta");
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

// 
//$pdo = new PDO('mysql:host=localhost;dbname=point_of_sales', 'root', '');
//echo"Anjay"; pas awal errornya ada disini

// Koneksi ke database (Buat jaga jaga takut ada error)
try {
    $pdo = new PDO('mysql:host=localhost;dbname=point_of_sales', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database connection error: ' . $e->getMessage()]);
    exit;
}

// Validasi data input
if (!$data || !isset($data['orderAmount'], $data['orderItems'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid data format']);
    exit;
}

try {
    $pdo->beginTransaction();

    // Masukkan data ke tabel `orders`
    $orderAmount = $data['orderAmount'];
    $orderCustomerPaid = $data['orderCustomerPaid'];
    $orderChange = $data['orderChange'];
    // $orderCustomerName=$data['orderCustomerName']; // nama column orderCustomerName tidak sama dengan database
    $orderCustomerName = $data['orderCustomer'];
    $orderDateTime = date('Y-m-d H:i:s');
    $orderCashierId = 1;

    $sqlOrder = "INSERT INTO orders (orderAmount, orderCustomerPaid, orderChange, orderCustomer, orderDateTime, orderCashierId) 
    VALUES (?,?,?,?,?,?)";
    $stmtOrder = $pdo->prepare($sqlOrder);
    $stmtOrder->execute([$orderAmount, $orderCustomerPaid, $orderChange, $orderCustomerName, $orderDateTime, $orderCashierId]);

    // Dapatkan `orderId` terakhir
    $orderId = $pdo->lastInsertId();

    // mgausah masukin menuItemId karena dia Id udah otomatis insert
    // foreach($data['menuitems']as$item){
    //     $sqlItems="INSERT INTO menuitems (menuItemId,menuItemName,menuItemPrice,menuItemImage,menuItemCategory) VALUES (?,?,?,?,?)";
    //     $stmtItems=$pdo->prepare($sqlItems);
    //     $stmtItems->execute([$orderId,$item['itemId'],$item['itemName'],$item['itemPrice'],$item['itemCategory']]);
    // }

    // Masukkan data ke tabel `menuitems` data baru
    foreach ($data['orderItems'] as $item) {
        if (!isset($item['itemId'], $item['itemName'], $item['itemPrice'], $item['itemQuantity'])) {
            throw new Exception('Invalid item data');
        }
        // $sqlItems = "INSERT INTO menuitems (orderId, menuItemName, menuItemPrice, menuItemCategory) 
        //      VALUES (?, ?, ?, ?)";
        // $stmtItems = $pdo->prepare($sqlItems);
        // $stmtItems->execute([$orderId, $item['itemName'], $item['itemPrice'], $item['itemQuantity']]);

    }

    $pdo->commit();
    echo json_encode(['success' => true, 'message' => 'Order berhasil disimpan']);
} catch (Exception $e) {
    $pdo->rollBack();
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}