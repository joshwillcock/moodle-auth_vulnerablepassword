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
 * Authentication Plugin: Vulnerable Password Authentication
 * Checks if password has been compromised in a leak.
 *
 * @package auth_vulnerablepassword
 * @copyright 2018 Josh Willcock {@link http://joshillcock.co.uk}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}

require_once($CFG->libdir.'/authlib.php');
require_once($CFG->dirroot.'/user/lib.php');
require_once($CFG->dirroot.'/auth/vulnerablepassword/lib/vulnerablepassword_rest.php');

/**
 * vulnerablepassword authentication plugin.
 */
class auth_plugin_vulnerablepassword extends auth_plugin_base {
    /**
     * Constructor.
     */
    public function __construct() {
        $this->authtype = 'vulnerablepassword';
    }

    /**
     * Returns true if the username and password work or don't exist and false
     * if the user exists and the password is wrong.
     *
     * @param string $username The username
     * @param string $password The password
     * @return bool Authentication success or failure.
     */

    /**
     * Post authentication hook.
     * This method is called from authenticate_user_login() for all enabled auth plugins.
     *
     * @param object $user user object, later used for $USER
     * @param string $username (with system magic quotes)
     * @param string $password plain text password (with system magic quotes)
     */
    public function user_authenticated_hook(&$user, $username, $password) {
        global $DB, $CFG, $SESSION;
        if (!empty($password)) {
            $first = substr(sha1($password), 0, 5);
            $final = substr(sha1($password), 5);
            $api = new \auth_vulnerablepassword\checkapi($first);
            $check = $api->lookup($final);
            if ($check->status) {
                $entry = new \stdClass();
                $entry->userid = $user->id;
                $entry->passwordwarning = $check->count;
                $entry->timemodified = \time();
                $DB->insert_record('auth_vulnerablepassword', $entry);
                $passwordwarning = new \moodle_url("$CFG->wwwroot/auth/vulnerablepassword/passwordwarning.php");
                $SESSION->oldwantsurl = $SESSION->wantsurl;
                $SESSION->wantsurl = $passwordwarning;
            }
        }
    }
}
