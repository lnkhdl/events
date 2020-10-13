<?php
    // Event already exists or other error when updating the record in DB
    if (isset($errors['error'])) {
        http_response_code(400);
        echo json_encode(
            array('error' => $errors['error'])
        );
    
    // Data validation errors
    } elseif (isset($errors)) {
        http_response_code(400);
        echo json_encode(
            array('error' => $errors)
        );
    }
    