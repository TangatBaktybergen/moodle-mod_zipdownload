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
 * @copyright  2025 Ivan Volosyak and Tangat Baktybergen <Ivan.Volosyak@@@hochschule-rhein-waal.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// No MOODLE_INTERNAL check here; this is a script entry point.

require_once('../../config.php');
require_once($CFG->dirroot.'/mod/zipdownload/lib.php');

$id = required_param('id', PARAM_INT); // Course id.

$course = $DB->get_record('course', array('id' => $id), '*', MUST_EXIST);

require_course_login($course);

$PAGE->set_url('/mod/zipdownload/index.php', array('id' => $id));
$PAGE->set_title(get_string('modulenameplural', 'mod_zipdownload'));
$PAGE->set_heading($course->fullname);

echo $OUTPUT->header();

echo $OUTPUT->heading(get_string('modulenameplural', 'mod_zipdownload'));

// TODO: List all instances or provide additional functionality as needed.

echo $OUTPUT->footer();
