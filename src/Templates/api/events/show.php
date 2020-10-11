<?php
    if (empty($data)) {
        http_response_code(404);
        echo json_encode(
            array('message' => 'No event found.')
        );
    } else {
        $result = [];
        $result['event'] = $data[0];
        $result['members'] = [];
        
        if (empty($data[1]['id'])) {
            $result['members']['message'] = 'No members found.';
        } else {
            for ($member = 1; $member <= count($data)-1; $member++) {
                array_push($result['members'], $data[$member]);
            }
        }

        if (isset($_SESSION['success'])) {
            $result['message'] = $_SESSION['success'];
            unset($_SESSION['success']);
        }

        if (isset($_SESSION['error'])) {
            $result['error'] = $_SESSION['error'];
            unset($_SESSION['error']);
        }

        http_response_code(200);
        echo json_encode($result);
    }