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
 * Scheduled task to clear field 'email' for suspend users.
 *
 * @package   local_extend_clear
 * @copyright 2020, Yuriy Yurinskiy <moodle@krsk.dev>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_extend_clear\task;

defined('MOODLE_INTERNAL') || die();

/**
 * Scheduled task to clear field 'email' for suspend users.
 *
 * @package   local_extend_clear
 * @copyright 2020, Yuriy Yurinskiy <moodle@krsk.dev>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class clear_mail_for_suspend_users extends \core\task\scheduled_task
{
    /**
     * Get the name of the task.
     *
     * @return string the name of the task
     */
    public function get_name()
    {
        return get_string('task_clear_mail_for_suspend_users', 'local_extend_clear');
    }

    /**
     * Execute the task.
     */
    public function execute()
    {
        global $DB;

        $sql = <<<SQL
select id,username,email from {user} u where u.suspended = :suspended and COALESCE(u.email, '') <> ''
SQL;

        $users = $DB->get_records_sql($sql, ['suspended' => 1]);

        $mask = "|%15.15s | %-30.30s | %-15.15s |\n";
        printf(
            $mask,
            get_string('username', 'local_extend_clear'),
            get_string('last_email', 'local_extend_clear'),
            get_string('new_email', 'local_extend_clear')
        );

        foreach ($users as $user) {
            $oldEmail = $user->email;
            $user->email = '';

            $DB->update_record('user', $user, false);

            printf($mask, $user->username, $oldEmail, $user->email);
        }
    }
}