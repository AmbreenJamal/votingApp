<?php
require_once('config.php');

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'insert':
            Poll::insert();
            break;
        case 'select':
            Poll::select();
            break;
    }
};

?>
