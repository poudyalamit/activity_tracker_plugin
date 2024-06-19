<?php
defined('MOODLE_INTERNAL') || die();

$observers = array(
    array(
        'eventname' => '\core\event\course_viewed',
        'callback' => '\block_activity_tracker\observer::course_viewed',
    ),
    array(
        'eventname' => '\core\event\course_module_viewed',
        'callback' => '\block_activity_tracker\observer::course_module_viewed',
    )
);
