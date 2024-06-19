<?php

namespace block_activity_tracker;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/blocks/activity_tracker/save_activity.php');
require_once($CFG->dirroot . '/blocks/activity_tracker/lib.php');

class observer {
    public static function course_viewed(\core\event\course_viewed $event) {
        global $PAGE;
        // $PAGE->requires->js_call_amd('block_activity_tracker/start_activity', 'init', array($event->courseid, 0));
        block_activity_tracker_extend_navigation_course();
    }

    public static function course_module_viewed(\core\event\course_module_viewed $event) {
        global $PAGE, $USER;
        // $PAGE->requires->js_call_amd('block_activity_tracker/start_activity', 'init', array($event->courseid, $event->contextinstanceid));
        save_data_in_localstorage($event->courseid, $event->contextinstanceid);
    }
}
