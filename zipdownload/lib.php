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
 * Library functions for ZIP Download activity module.
 *
 * @package    mod_zipdownload
 * @copyright  2025 Ivan Volosyak and Tangat Baktybergen <Ivan.Volosyak@@@hochschule-rhein-waal.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Returns list of features supported by the module.
 *
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed True if module supports feature, null if unknown
 */
function zipdownload_supports($feature) {
    switch ($feature) {
        case FEATURE_MOD_INTRO:
            return true;
        default:
            return null;
    }
}

/**
 * Add a new zipdownload instance.
 *
 * @param stdClass $data
 * @param mod_form $mform
 * @return int New instance ID
 */
function zipdownload_add_instance($data, $mform) {
    global $DB;
    $data->timecreated = time();
    $data->timemodified = $data->timecreated;
    $id = $DB->insert_record('zipdownload', $data);
    $context = context_module::instance($data->coursemodule);

    file_save_draft_area_files(
        $data->templatezip_filemanager,
        $context->id,
        'mod_zipdownload',
        'templatezip',
        0,
        ['subdirs' => 0, 'maxfiles' => 1, 'accepted_types' => ['.zip']]
    );

    return $id;
}

/**
 * Update an existing zipdownload instance.
 *
 * @param stdClass $data
 * @param mod_form $mform
 * @return bool True on success
 */
function zipdownload_update_instance($data, $mform) {
    global $DB;
    $data->timemodified = time();
    $data->id = $data->instance;
    $DB->update_record('zipdownload', $data);
    $context = context_module::instance($data->coursemodule);

    file_save_draft_area_files(
        $data->templatezip_filemanager,
        $context->id,
        'mod_zipdownload',
        'templatezip',
        0,
        ['subdirs' => 0, 'maxfiles' => 1, 'accepted_types' => ['.zip']]
    );

    return true;
}

/**
 * Delete a zipdownload instance.
 *
 * @param int $id
 * @return bool True on success, false on failure
 */
function zipdownload_delete_instance($id) {
    global $DB;

    if (!$record = $DB->get_record('zipdownload', ['id' => $id])) {
        return false;
    }

    $DB->delete_records('zipdownload', ['id' => $id]);
    $context = context_module::instance($record->coursemodule);
    $fs = get_file_storage();
    $fs->delete_area_files($context->id, 'mod_zipdownload');

    return true;
}

/**
 * Provides coursemodule info for the course page.
 *
 * @param stdClass $coursemodule
 * @return cached_cm_info
 */
function zipdownload_get_coursemodule_info($coursemodule) {
    global $DB;
    $info = new cached_cm_info();

    if ($record = $DB->get_record('zipdownload', ['id' => $coursemodule->instance], '*')) {
        $info->name = $record->name;

        if (!empty($record->intro)) {
            // This will properly display the description on the course page.
            $info->content = format_module_intro('zipdownload', $record, $coursemodule->id, false);
        }
    }
    return $info;
}
