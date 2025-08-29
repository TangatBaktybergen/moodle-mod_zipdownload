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
 * Provides support for the conversion of moodle1 backup to the moodle2 format.
 *
 * @package    mod_zipdownload
 * @category   backup
 * @copyright  2025 Ivan Volosyak and Tangat Baktybergen
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Moodle 1.9 to 2.0 conversion handler for ZIP Download activity.
 */
class moodle1_mod_zipdownload_handler extends moodle1_mod_handler {
    /** @var moodle1_file_manager|null */
    protected $fileman = null;

    /**
     * Declare the paths in moodle.xml that we are able to convert.
     *
     * @return convert_path[]
     */
    public function get_paths() {
        return [
            new convert_path(
                'zipdownload',
                '/MOODLE_BACKUP/COURSE/MODULES/MOD/ZIPDOWNLOAD',
                [
                    'renamefields' => [
                        'summary' => 'intro',
                    ],
                    'newfields' => [
                        'introformat' => 1,
                    ],
                ]
            ),
        ];
    }

    /**
     * Process one ZIP Download instance from the Moodle 1.9 backup.
     *
     * @param array $data Parsed activity data from moodle.xml
     * @param array $raw  Raw backup data (unused)
     * @return void
     */
    public function process_zipdownload(array $data, array $raw) {
        global $DB;

        $data = (object)$data;
        $oldid = $data->id;

        // Attach course ID.
        $data->course = $this->get_courseid();

        // Ensure required fields.
        if (!isset($data->timemodified)) {
            $data->timemodified = time();
        }

        if (!isset($data->introformat)) {
            $data->introformat = FORMAT_HTML;
        }

        // Get context ID for this activity.
        $currentcminfo = $this->get_cminfo($oldid);
        $moduleid = $currentcminfo['id'];
        $contextid = $this->converter->get_contextid(CONTEXT_MODULE, $moduleid);

        // Prepare file manager for this context.
        $this->fileman = $this->converter->get_file_manager($contextid, 'mod_zipdownload');

        // Convert embedded files in intro field.
        $this->fileman->filearea = 'intro';
        $this->fileman->itemid = 0;
        $data->intro = moodle1_converter::migrate_referenced_files($data->intro, $this->fileman);

        // Insert record into new DB table.
        $newitemid = $DB->insert_record('zipdownload', $data);

        // Store ID mapping for this module instance.
        $this->apply_activity_instance($newitemid);
    }

    /**
     * Finalization callback for ZIP Download conversion (optional).
     *
     * @return void
     */
    public function on_zipdownload_end() {
        // Nothing to finalize for now.
    }
}
