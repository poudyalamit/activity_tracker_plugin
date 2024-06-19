<?php
defined('MOODLE_INTERNAL') || die();

function block_activity_tracker_page_init(moodle_page $page) {
    // if ($page->pagelayout == 'course') {
    // }
    $page->requires->js(new moodle_url('/blocks/activity_tracker/js/tracktime.js'));
    // $PAGE->requires->js_init_call('startModuleActivity', array([
    //     'userid' => $USER->id,
    //     'courseid' => $COURSE->id,
    //     'moduleid' => $moduleId
    // ]));
}

function block_activity_tracker_extend_navigation_course() {
    global $PAGE;
    if ($PAGE->pagelayout == 'course' || $PAGE->pagelayout == 'mod') {
        $PAGE->requires->js(new moodle_url('/blocks/activity_tracker/js/focus_tracking.js'));
    }
}

// function random_function() {
//     global $PAGE;
//     $PAGE->requires->js(new moodle_url('/blocks/activity_tracker/js/tracktime.js'));
// }
