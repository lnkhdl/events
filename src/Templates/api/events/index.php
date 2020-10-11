<?php
    if (empty($data)) {
        http_response_code(404);
        echo json_encode(
            array("message" => "No events found.")
        );
    } else {
        $result = [];
        $result['events'] = $data;

        http_response_code(200);
        echo json_encode($result);
    }