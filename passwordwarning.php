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
 *
 * @copyright 2018 Josh Willcock (http://joshwillcock.co.uk)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package   auth_vulnerablepassword
 */
namespace auth_vulnerablepassword;
require_once('../../config.php');

require_login();
$context = \context_system::instance();
$strheading = \get_string('pluginname', 'auth_vulnerablepassword');

$PAGE->set_url('/auth/vulnerablepassword/passwordwarning.php');
$PAGE->set_context(\context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);
$PAGE->set_context($context);
if (isset($SESSION->oldwantsurl)) {
    $continue = $SESSION->oldwantsurl;
} else {
    $continue = $CFG->wwwroot;
}
$options = array('class' => 'btn btn-primary mx-auto');
$continue = \html_writer::link($continue, \get_string('continuetodashboard', 'auth_vulnerablepassword'), $options);
$information = \html_writer::tag('h1', \get_string('yourpasswordisvulnerableheader', 'auth_vulnerablepassword'));
$information .= \html_writer::tag('p', \get_string('yourpasswordisvulnerabledesc', 'auth_vulnerablepassword'));
$information .= \html_writer::empty_tag('hr');
$auth = "auth_$USER->auth";
$authplugin = "auth_plugin_$USER->auth";
require_once("../$USER->auth/auth.php");
if (class_exists($auth)) {
    $auth = new $auth();
} else if (class_exists($authplugin)) {
    $auth = new $authplugin();
} else {
    redirect(new \moodle_url($CFG->wwwroot));
}
if ($auth->can_reset_password() != false) {
    $options = array('class' => 'btn btn-primary mr-2');
    if (is_null($auth->change_password_url())) {
        $changeurl = new \moodle_url("$CFG->wwwroot/login/change_password.php", array());
        $information  .= \html_writer::link($changeurl, \get_string('resetyourpassword', 'auth_vulnerablepassword'), $options);

    } else {
        $changeurl = new \moodle_url($auth->config->changepasswordurl);
        $information  .= \html_writer::link($changeurl, \get_string('resetyourpassword', 'auth_vulnerablepassword'), $options);
    }
}
$information .= $continue;
$information .= \html_writer::empty_tag('hr');
$information .= \html_writer::tag('h1', \get_string('whatshouldido', 'auth_vulnerablepassword'));
$information .= \html_writer::tag('p', \get_string('whatshouldidodesc', 'auth_vulnerablepassword'));
$information .= \html_writer::tag('h1', \get_string('howdoweknowthis', 'auth_vulnerablepassword'));
$information .= \html_writer::tag('p', \get_string('howdoweknowthisdesc', 'auth_vulnerablepassword'));
$information .= \html_writer::tag('h1', \get_string('howdoesthiswork', 'auth_vulnerablepassword'));
$information .= \html_writer::tag('p', \get_string('howdoesthisworkdesc', 'auth_vulnerablepassword'));

$credits = \html_writer::tag('h3', \get_string('acknowledgements', 'auth_vulnerablepassword'));
$credits .= \html_writer::tag('p', \get_string('acknowledgementsdesc', 'auth_vulnerablepassword'));

echo $OUTPUT->header();
echo $information;
echo $credits;
echo $OUTPUT->footer();
