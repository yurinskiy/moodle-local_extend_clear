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
 * Adds module specific settings to the settings block.
 *
 * @package   local_extend_clear
 * @copyright 2020, Yuriy Yurinskiy <moodle@krsk.dev>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

function local_extend_clear_extend_settings_navigation($settingsnav, $context)
{
    if (is_siteadmin()) {
        $settingnode = $settingsnav->find('local_extend_clear', navigation_node::TYPE_CATEGORY);

//        if (!$settingnode) {
//            if ($servernode = $settingsnav->find('server', navigation_node::TYPE_SETTING)) {
//                $node = navigation_node::create(
//                    get_string('pluginname', 'local_extend_clear'),
//                    null,
//                    navigation_node::TYPE_CATEGORY,
//                    'local_extend_clear',
//                    'local_extend_clear',
//                    new pix_icon('i/settings', get_string('pluginname', 'local_extend_clear'))
//                );
//                $servernode->add_node($node);
//            }
//        }
    }
}