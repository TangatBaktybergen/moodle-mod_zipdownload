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
 * Restore structure step for ZIP Download activity.
 *
 * @package    mod_zipdownload
 * @category   backup
 * @copyright  2025 Ivan Volosyak and Tangat Baktybergen
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_zipdownload_activity_structure_step extends restore_activity_structure_step {
    /**
     * Defines the structure of the restore process for the ZIP Download activity.
     *
     * @return array List of restore_path_element objects.
     */
    protected function define_structure() {
        $paths = [];
        $paths[] = new restore_path_element('zipdownload', '/activity/zipdownload');

        // Return the paths wrapped into standard activity structure.
        return $this->prepare_activity_structure($paths);
    }

    /**
     * Processes a restored ZIP Download activity record.
     *
     * @param array $data The data for the restored activity.
     * @return void
     */
    protected function process_zipdownload($data) {
        global $DB;

        $data = (object) $data;
        $oldid = $data->id;
        $data->course = $this->get_courseid();

        // Insert the zipdownload record.
        $newitemid = $DB->insert_record('zipdownload', $data);

        // Apply the new instance ID.
        $this->apply_activity_instance($newitemid);
    }

    /**
     * Called after all steps in the restore process have executed.
     *
     * Adds any related files (e.g., intro attachments).
     * @return void
     */
    protected function after_execute() {
        $this->add_related_files('mod_zipdownload', 'intro', null);
    }
}
