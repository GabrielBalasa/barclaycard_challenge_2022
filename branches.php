<?php
    $stmt = $pdo->prepare('SELECT * FROM branches ORDER BY branch_id ASC');
    $stmt->execute();

    foreach ($stmt as $row) {
        echo '<li><a class="dropdown-item" href="bookings.php?id=' . $row['branch_id'] . '">' . $row['branch_name'] .'</a></li>';
    }
?>