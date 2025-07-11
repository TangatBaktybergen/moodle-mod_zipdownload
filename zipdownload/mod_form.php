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
 * Main library for Auto PDF Form plugin
 *
 * @package    mod_autopdfform
 * @copyright  2025 Ivan Volosyak and Tangat Baktybergen <Ivan.Volosyak@hochschule-rhein-waal.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
require_once($CFG->dirroot . '/course/moodleform_mod.php');

class mod_zipdownload_mod_form extends moodleform_mod {
    public function definition() {
        $mform = $this->_form;
        // General settings
        $mform->addElement('header', 'general', get_string('general', 'form'));
        // Name
        $mform->addElement('text', 'name', get_string('name'), ['size' => '64']);
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
        // Intro
        $this->standard_intro_elements();
        // ZIP file upload
        $mform->addElement('filemanager', 'templatezip_filemanager', get_string('templatezip', 'mod_zipdownload'), null, [
            'subdirs' => 0,
            'maxbytes' => 0,
            'areamaxbytes' => 10485760, // 10MB
            'maxfiles' => 1,
            'accepted_types' => ['.zip']
        ]);
        // Default platform selection
        $mform->addElement('select', 'defaultplatform', get_string('defaultplatform', 'mod_zipdownload'), [
            'lab' => get_string('platform_lab', 'mod_zipdownload'),
            'win' => get_string('platform_win', 'mod_zipdownload'),
            'mac' => get_string('platform_mac', 'mod_zipdownload'),
        ]);
        $mform->setDefault('defaultplatform', 'lab');
        $this->standard_coursemodule_elements();
        $this->add_action_buttons();
    }
    public function data_preprocessing(&$default_values) {
        parent::data_preprocessing($default_values);
    }
}