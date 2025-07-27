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
 * Backup task for ZIP Download activity module.
 *
 * @package    mod_zipdownload
 * @category   backup
 * @copyright  2025 Ivan Volosyak and Tangat Baktybergen
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/zipdownload/backup/moodle2/backup_zipdownload_stepslib.php');

/**
 * Provides the steps to perform one complete backup of the ZIP Download instance.
 *
 * @package    mod_zipdownload
 * @category   backup
 */
class backup_zipdownload_activity_task extends backup_activity_task {
    /**
     * No specific settings for this activity.
     *
     * @return void
     */
    protected function define_my_settings() {
        // No settings.
    }

    /**
     * Defines a backup step to store the instance data in the zipdownload.xml file.
     *
     * @return void
     */
    protected function define_my_steps() {
        $this->add_step(new backup_zipdownload_activity_structure_step('zipdownload_structure', 'zipdownload.xml'));
    }

    /**
     * Encodes URLs to the ZIP Download index.php and view.php scripts during backup.
     *
     * This allows links in the intro field (or other HTML content) to be restored properly
     * when the course is restored on another site or with a different course ID.
     *
     * @param string $content HTML content potentially containing URLs.
     * @return string The content with encoded URLs.
     */
    public static function encode_content_links($content) {
        global $CFG;

        $base = preg_quote($CFG->wwwroot, "/");

        // Link to the list of activities.
        $search = "/(" . $base . "\/mod\/zipdownload\/index.php\?id\=)([0-9]+)/";
        $content = preg_replace($search, '$@ZIPDOWNLOADINDEX*$2@$', $content);

        // Link to activity view by moduleid.
        $search = "/(" . $base . "\/mod\/zipdownload\/view.php\?id\=)([0-9]+)/";
        $content = preg_replace($search, '$@ZIPDOWNLOADVIEWBYID*$2@$', $content);

        return $content;
    }
}
