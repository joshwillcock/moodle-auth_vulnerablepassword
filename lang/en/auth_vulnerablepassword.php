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
 * Strings for component 'auth_vulnerablepassword', language 'en'.
 *
 * @package   auth_vulnerablepassword
 * @copyright 2018 onwards Josh Willcock  {@link http://joshwillcock.co.uk}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['pluginname'] = 'Vulnerable Password';
$string['auth_pluginname'] = 'Vulnerable Password';
$string['auth_description'] = 'This plugin checks if the users password has been compromised and warns them if they need to change it.';
$string['auth_vulnerablepassworddescription'] = 'This plugin checks if the users password has been compromised and warns them if they need to change it.';
$string['whatshouldido'] = 'What should I do?';
$string['howdoweknowthis'] = 'How do we know this?';
$string['howdoesthiswork'] = 'How does this work?';
$string['continuetodashboard'] = 'Continue to your dashboard';
$string['resetyourpassword'] = 'Reset your password';
$string['acknowledgements'] = 'Acknowlegements';
$string['yourpasswordisvulnerableheader'] = 'Your Password is Vulnerable.';
$string['yourpasswordisvulnerabledesc'] = '
Over the past few years hackers have compromised a large number of organisations
and have obtained account details for them. This is usually usernames, email
addresses, passwords and sometimes bank details. This information is often for
sale on the dark web or publicly leaked';
$string['whatshouldidodesc'] = '
If you have seen this warning the password you entered appears once or more on
these lists. You should change your password on any account which uses that
password, not just this platform. Hackers understand many people use the same
password on multiple platforms, meaning that if they have obtained your password
 from Facebook they will be hoping it is the same password for your email. ';
$string['howdoweknowthisdesc'] = 'We have integrated this platform with
“Have I Been Pwned" a public service created by Troy Hunt (
    <a href="https://www.troyhunt.com/">https://www.troyhunt.com/</a>).
Troy created Have I Been Pwned (<a href="https://haveibeenpwned.com/">
https://haveibeenpwned.com/</a>) which allows you to
check if your details appear on these leaked lists. If your username or password
appear on a list of over 5 billion accounts from over 300 leaked sources the
platform will be able to tell you.';
$string['howdoesthisworkdesc'] = 'It is critical that we do not send your password
to be validated to a third party. So when you provide us with your password we
encrypt it using a method called SHA-1(<a href="https://en.wikipedia.org/wiki/SHA-1">
https://en.wikipedia.org/wiki/SHA-1</a>).
As an example the password “Password123” will be encrypted as
“b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1”.
We then ask the API for all the passwords which start “B2e98”, this way your password
is never sent outside of the LMS. We are then given a list of every password which
begins with that. We then check to see if the remaining 35 characters of your
encrypted password appears in the list we are given. If it does, we let you know
immediately.';
$string['acknowledgementsdesc'] = 'This plugin uses
<a href="https://haveibeenpwned.com/">Have I Been Pwned</a> API.<br>
Created by <a href="https://www.troyhunt.com/">Troy Hunt</a>.<br>
This idea was based from a similar Wordpress project by
<a href="https://www.wordfence.com/blog/2018/03/password-leak-attacks-wordpress/">
Wordfence</a>.<br>
This plugin has been created by <a href="https://joshwillcock.co.uk/">
Josh Willcock</a> for the members
of <a href="https://charitylearning.org/">
The Charity Learning Consortium</a>.';
