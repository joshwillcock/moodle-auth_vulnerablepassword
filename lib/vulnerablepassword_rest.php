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
 * @copyright 2018 onwards Josh Willcock  {@link http://joshwillcock.co.uk}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace auth_vulnerablepassword;
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.'); // It must be included from a Moodle page.
}
require_once("$CFG->libdir/filelib.php");
class checkapi
{
    private $results;

    public function __construct($sha) {
        $curl = new \curl();
        $endpoint = new \moodle_url("https://api.pwnedpasswords.com/range/$sha");
        $this->results = $curl->get($endpoint);

    }
    public function lookup ($sha) {
        $response = new \stdClass();
        if (strpos(strtolower($this->results), strtolower($sha)) !== false) {
            $position = strpos(strtolower($this->results), strtolower($sha));
            $count = substr($this->results, $position, 50);
            $count = explode(':', $count)[1];
            $count = preg_split('/\r\n|\r|\n/', $count)[0];
            $response->status = true;
            $response->count = $count;
        } else {
            $response->status = false;
        }
        return $response;
    }
}
