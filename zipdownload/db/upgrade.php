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
 * Upgrade code for ZIP Download activity module.
 *
 * @package    mod_zipdownload
 * @copyright  2025 Ivan Volosyak and Tangat Baktybergen <Ivan.Volosyak@@@hochschule-rhein-waal.de>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// (Boilerplate must be followed by a blank line.)

/**
 * Performs upgrades for ZIP Download module.
 *
 * @param int $oldversion the version we are upgrading from
 * @return bool success
 */
function xmldb_zipdownload_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2025070401) {

        // Add new field "defaultplatform" to table zipdownload.
        $table = new xmldb_table('zipdownload');
        $field = new xmldb_field('defaultplatform', XMLDB_TYPE_CHAR, '10', null, XMLDB_NOTNULL, null, 'lab', 'introformat');

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Set the plugin version to the new version.
        upgrade_mod_savepoint(true, 2025070401, 'zipdownload');
    }

    return true;
}
