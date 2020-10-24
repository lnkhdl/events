<?php
    $result = [];
    $result['message'] = '';
    http_response_code(200);

    if (isset($_SESSION['success'])) {
        $result['message'] = $_SESSION['success'];
        unset($_SESSION['success']);
    }

    if (empty($data)) {
        $result['message'] .= $result['message'] === '' ? 'No events found.' : ' No events found.';
        echo json_encode($result);
    } else {
        $result['events'] = $data;
        echo json_encode($result);
    }