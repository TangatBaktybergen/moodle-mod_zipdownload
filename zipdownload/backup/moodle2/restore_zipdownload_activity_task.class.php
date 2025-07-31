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
 * Restore task for ZIP Download activity module.
 *
 * @package    mod_zipdownload
 * @category   backup
 * @copyright  2025 Ivan Volosyak and Tangat Baktybergen
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/zipdownload/backup/moodle2/restore_zipdownload_stepslib.php');

/**
 * Restore task for the ZIP Download activity module.
 *
 * This class defines all the settings, steps, and decoding rules
 * required to restore a ZIP Download activity from a Moodle backup.
 *
 * @package    mod_zipdownload
 * @category   backup
 * @copyright  2025 Ivan Volosyak and Tangat Baktybergen
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_zipdownload_activity_task extends restore_activity_task {
    /**
     * Define (add) particular settings this activity can have.
     *
     * @return void
     */
    protected function define_my_settings() {
        // No particular settings.
    }

    /**
     * Define (add) particular steps this activity can have.
     *
     * @return void
     */
    protected function define_my_steps() {
        $this->add_step(new restore_zipdownload_activity_structure_step('zipdownload_structure', 'zipdownload.xml'));
    }

    /**
     * Define the contents in the activity that must be processed by the link decoder.
     *
     * @return restore_decode_content[]
     */
    public static function define_decode_contents() {
        return [
            new restore_decode_content(
                'zipdownload',
                ['intro'],
                'zipdownload'
            ),
        ];
    }

    /**
     * Define the decoding rules for links belonging to the activity.
     *
     * @return restore_decode_rule[]
     */
    public static function define_decode_rules() {
        return [
            new restore_decode_rule('ZIPDOWNLOADVIEWBYID', '/mod/zipdownload/view.php?id=$1', 'course_module'),
            new restore_decode_rule('ZIPDOWNLOADINDEX', '/mod/zipdownload/index.php?id=$1', 'course'),
        ];
    }

    /**
     * Define restore log rules that will be applied when restoring activity logs.
     *
     * @return restore_log_rule[]
     */
    public static function define_restore_log_rules() {
        return [
            new restore_log_rule('zipdownload', 'add', 'view.php?id={course_module}', '{zipdownload}'),
            new restore_log_rule('zipdownload', 'update', 'view.php?id={course_module}', '{zipdownload}'),
            new restore_log_rule('zipdownload', 'view', 'view.php?id={course_module}', '{zipdownload}'),
        ];
    }

    /**
     * Define restore log rules that apply to course logs (cmid = 0).
     *
     * @return restore_log_rule[]
     */
    public static function define_restore_log_rules_for_course() {
        return [
            new restore_log_rule('zipdownload', 'view all', 'index.php?id={course}', null),
        ];
    }
}
