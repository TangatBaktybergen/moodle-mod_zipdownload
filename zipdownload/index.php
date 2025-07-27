<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * List all instances of zipdownload in a course.
 *
 * @package    mod_zipdownload
 * @copyright  2025 Ivan Volosyak and Tangat Baktybergen
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');
require_once($CFG->dirroot . '/mod/zipdownload/lib.php');
require_once($CFG->libdir . '/tablelib.php');

$id = required_param('id', PARAM_INT); // Course ID.

$course = $DB->get_record('course', ['id' => $id], '*', MUST_EXIST);
require_course_login($course);

$PAGE->set_url('/mod/zipdownload/index.php', ['id' => $id]);
$PAGE->set_title(get_string('modulenameplural', 'mod_zipdownload'));
$PAGE->set_heading($course->fullname);

// Trigger event.
$params = [
    'context' => context_course::instance($course->id),
];
$event = \mod_zipdownload\event\course_module_instance_list_viewed::create($params);
$event->add_record_snapshot('course', $course);
$event->trigger();

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('modulenameplural', 'mod_zipdownload'));

if (!$instances = get_all_instances_in_course('zipdownload', $course)) {
    notice(get_string('nozipdownloads', 'mod_zipdownload'), new moodle_url('/course/view.php', ['id' => $id]));
    echo $OUTPUT->footer();
    exit;
}

$table = new html_table();
$table->head  = [
    get_string('name'),
    get_string('intro', 'mod_zipdownload'),
];
$table->align = ['left', 'left'];

foreach ($instances as $instance) {
    $cm = get_coursemodule_from_instance('zipdownload', $instance->id);
    $context = context_module::instance($cm->id);

    if (!has_capability('mod/zipdownload:view', $context)) {
        continue;
    }

    $link = html_writer::link(
        new moodle_url('/mod/zipdownload/view.php', ['id' => $cm->id]),
        format_string($instance->name)
    );
    $intro = format_module_intro('zipdownload', $instance, $cm->id);
    $table->data[] = [$link, $intro];
}

echo html_writer::table($table);
echo $OUTPUT->footer();
