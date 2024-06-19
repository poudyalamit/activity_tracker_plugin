<?php
class block_activity_tracker extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_activity_tracker');
    }

    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->text = get_string('blockcontent', 'block_activity_tracker');
        $this->content->text = html_writer::link(new moodle_url('/blocks/activity_tracker/index.php'), 'View Data');
        $this->content->footer = '';

        // $this->page->requires->js(new moodle_url('/blocks/activity_tracker/js/tracktime.js'));

        return $this->content;
    }
}
