<?php
require_once('../../config.php');
require_once($CFG->libdir . '/formslib.php');

require_login();

class select_course_form extends moodleform {
    function definition() {
        $mform = $this->_form;

        $courses = enrol_get_my_courses();
        $courseoptions = [];
        foreach ($courses as $course) {
            $courseoptions[$course->id] = format_string($course->fullname);
        }

        $mform->addElement('select', 'courseid', 'Select a course to display', $courseoptions);
        $mform->addElement('submit', 'submitbutton', 'Display Data');
    }
}

global $DB, $PAGE, $OUTPUT;

$PAGE->set_url(new moodle_url('/blocks/activity_tracker/index.php'));
$PAGE->set_context(context_system::instance());
$PAGE->set_title(get_string('pluginname', 'block_activity_tracker'));

echo $OUTPUT->header();
echo html_writer::tag('h1', 'Time Tracker Logs');

$mform = new select_course_form();
$fromform = $mform->get_data();

// Always display the form
$mform->display();

if ($fromform && !empty($fromform->courseid)) {
    // Fetch records only for the selected course
    $datarecords = $DB->get_records('block_activity_tracker_log', ['courseid' => $fromform->courseid]);
    display_table($datarecords);
} else {
    echo html_writer::tag('p', "Select a course to display");
}

function display_table($datarecords) {
    global $DB;

    if ($datarecords) {
        $table = new html_table();
        $table->head = ['ID', 'User ID', 'Course ID', 'Module ID', 'Start Time', 'End Time'];
        foreach ($datarecords as $record) {
            $user_name = $DB->get_field('user', 'username', ['id' => $record->userid]);
            $course_name = $DB->get_field('course', 'fullname', ['id' => $record->courseid]);
            $module_type_id = $DB->get_field('course_modules', 'module', ['id' => $record->moduleid]);
            $module_type_name = $DB->get_field('modules', 'name', ['id' => $module_type_id]);
            
            $table->data[] = [
                $record->id,
                $user_name,
                $course_name,
                $module_type_name,
                userdate($record->starttime),
                userdate($record->endtime)
            ];
        }
        echo html_writer::table($table);
    } else {
        echo html_writer::tag('p', get_string('norecordsfound', 'block_activity_tracker'));
    }
}

echo $OUTPUT->footer();
