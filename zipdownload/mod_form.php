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
 * Form for adding and editing ZIP Download module instances.
 *
 * @package    mod_zipdownload
 * @copyright  2025 Ivan Volosyak and Tangat Baktybergen <Ivan.Volosyak@@@hochschule-rhein-waal.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/moodleform_mod.php');

/**
 * Module form for ZIP Download.
 */
class mod_zipdownload_mod_form extends moodleform_mod {

    /**
     * Defines forms elements.
     */
    public function definition() {
        $mform = $this->_form;
        // General settings.
        $mform->addElement('header', 'general', get_string('general', 'form'));
        // Name.
        $mform->addElement('text', 'name', get_string('name'), ['size' => '64']);
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
        // Intro.
        $this->standard_intro_elements();
        // ZIP file upload.
        $mform->addElement(
            'filemanager',
            'templatezip_filemanager',
            get_string('templatezip', 'mod_zipdownload'),
            null,
            [
                'subdirs' => 0,
                'maxbytes' => 0,
                'areamaxbytes' => 10485760, // 10MB.
                'maxfiles' => 1,
                'accepted_types' => ['.zip'],
            ]
        );
        // Default platform selection.
        $mform->addElement(
            'select',
            'defaultplatform',
            get_string('defaultplatform', 'mod_zipdownload'),
            [
                'lab' => get_string('platform_lab', 'mod_zipdownload'),
                'win' => get_string('platform_win', 'mod_zipdownload'),
                'mac' => get_string('platform_mac', 'mod_zipdownload'),
            ]
        );
        $mform->setDefault('defaultplatform', 'lab');
        $this->standard_coursemodule_elements();
        $this->add_action_buttons();
    }

    /**
     * Data preprocessing for the form.
     *
     * @param array $defaultvalues Reference to default values array.
     */
    public function data_preprocessing(&$defaultvalues) {
        parent::data_preprocessing($defaultvalues);
    }
}
