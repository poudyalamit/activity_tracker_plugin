<?php

require_once('../../config.php');
require_login();

global $DB, $USER;

$payload = file_get_contents('php://input');
$data = json_decode($payload, true);

if ($data) {
    $record = new stdClass();
    $record->userid = $data['userid'];
    $record->courseid = $data['courseid'];
    $record->moduleid = $data['moduleid'];
    $record->ideal = $data['ideal'];

    $DB->insert_record('block_ideality_tracker_log', $record);

    error_log("IDEALITY LOGGED IN DATABASE");
} else {
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
    error_log("FAILED TO LOGG DATA IN DATABASE");
}
