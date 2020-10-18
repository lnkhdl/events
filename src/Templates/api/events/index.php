<?php
    $result = [];
    http_response_code(200);

    if (isset($_SESSION['success'])) {
        $result['message'] = $_SESSION['success'];
        unset($_SESSION['success']);
    }

    if (empty($data)) {
        array_push($result['message'], 'No events found.');
        echo json_encode($result);
    } else {
        $result['events'] = $data;
        echo json_encode($result);
    }