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
 * Backup structure step for the ZIP Download activity.
 *
 * @package    mod_zipdownload
 * @category   backup
 * @copyright  2025 Ivan Volosyak and Tangat Baktybergen
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_zipdownload_activity_structure_step extends backup_activity_structure_step {
    /**
     * Defines the structure of the ZIP Download activity for backup.
     *
     * @return backup_nested_element The root element of the backup structure.
     */
    protected function define_structure() {
        // Define the root element.
        $zipdownload = new backup_nested_element('zipdownload', ['id'], [
            'name', 'intro', 'introformat',
        ]);

        // Set the source table.
        $zipdownload->set_source_table('zipdownload', ['id' => backup::VAR_ACTIVITYID]);

        // Annotate files (e.g., intro attachments).
        $zipdownload->annotate_files('mod_zipdownload', 'intro', null);

        // Return the structure wrapped in the standard activity element.
        return $this->prepare_activity_structure($zipdownload);
    }
}
