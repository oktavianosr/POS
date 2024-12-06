<?php
include 'auth.php';

try {
    // Query untuk mendapatkan tanggal order terbaru
    $sql = "SELECT orderId,orderDateTime FROM point_of_sales.orders ORDER BY orderDateTime DESC LIMIT 1";
    $result = $pdo->query($sql);

    if ($result->rowCount() > 0) {
        $row = $result->fetch();
        $latestOrderId=$row['orderId'];
        $latestOrderDate = $row['orderDateTime'];
        echo json_encode([
            'success' => true,
            'orderId'=> $latestOrderId,
            'orderDateTime' => date("Y-m-d H:i:s", strtotime($latestOrderDate))
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'No orders found.'
        ]);
    }
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => "Database error: " . $e->getMessage()
    ]);
}
?>
