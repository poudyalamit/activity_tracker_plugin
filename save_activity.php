    <?php
defined('MOODLE_INTERNAL') || die();


function save_data_in_localstorage($courseid, $contextinstanceid) {
    global $PAGE, $USER;
    $PAGE->requires->js(new moodle_url('/blocks/activity_tracker/js/tracktime.js'));
    $userId = json_encode($USER->id);
    $courseId = json_encode($courseid);
    $moduleId = json_encode($contextinstanceid);
    $startTime = time();

    $PAGE->requires->js_init_code(<<<JS
document.addEventListener('DOMContentLoaded', function() {
    startModuleActivity($userId, $courseId, $moduleId, $startTime);
});
JS
    );
}
function save_ideal_data_in_localstorage($courseid, $contextinstanceid) {
    global $PAGE, $USER;
    $PAGE->requires->js(new moodle_url('/blocks/activity_tracker/js/focus_tracking.js'));
    $userId = json_encode($USER->id);
    $courseId = json_encode($courseid);
    $moduleId = json_encode($contextinstanceid);
    $ideal = json_encode($ideal);

    $PAGE->requires->js_init_code(<<<JS
document.addEventListener('DOMContentLoaded', function() {
    startIdealActivity($userId, $courseId, $moduleId, $ideal);
});
JS
    );
}

// function track_page_focus() {
//     global $PAGE, $USER;
//     $PAGE->requires->js(new moodle_url('/blocks/activity_tracker/js/focus_tracking.js'));
//     $PAGE->requires->js_init_call('track_idle_time');
//     $PAGE->requires->js_init_call('check_page_focus');
// }