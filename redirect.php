<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $page = $_POST['page'];

    switch ($page) {
        case 'menu':
            header("Location: menu.html");
            break;
        case 'reservations':
            header("Location: reservation.html");
            break;
        case 'cancel-order':
            header("Location: cancel.html");
            break;
        case 'feedback':
            header("Location: cancel_res.html");
            break;
        default:
            header("Location: Navigation.html");
            break;
    }
    exit();
}
?>
