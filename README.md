# moodle-auth_vulnerablepassword [![Build Status](https://travis-ci.org/joshwillcock/moodle-auth_vulnerablepassword.svg?branch=master)](https://travis-ci.org/joshwillcock/moodle-auth_vulnerablepassword)
This Moodle plugin attempts to check HIBP's list of exposed passwords. Enabling your learners to be informed if their password has ever been involved in a data breach.

## Quick Description
Over the last few years Data Breaches have been in the news a lot. It is not suprising with such large platforms being targetted that many of our account details have made their way onto the dark web or end up pasted all over the internet.
In an attempt to ensure our users accounts are safe, this plugin grabs the users password and without sending it to a third party checks if the password has been compromised. If the password has been compromised it will refer the user to a warning page on login, which they can then either change their password or continue to their original destination. This will occur every time the user logs in with the compromised password until they change it. 

## Installation
You can download the auth plugin from:
https://github.com/joshwillcock/moodle-auth_vulnerablepassword
This plugin should be located and named as: [yourmoodledir]/auth/auth_vulnerablepassword
Once this has been installed you will need to enable the auth which you can do in Site Admin -> Plugins -> Manage Authentication. [yourmoodleurl]/admin/settings.php?section=manageauths

## Issues & Contributions
Any issues or contributions are welcome. You can create a new issue here: https://github.com/joshwillcock/moodle-auth_vulnerablepassword/issues
Please create a Pull Request for contributions.

## How do we know this?
We have integrated this platform with “Have I Been Pwned" a public service created by Troy Hunt ( https://www.troyhunt.com/). Troy created Have I Been Pwned ( https://haveibeenpwned.com/) which allows you to check if your details appear on these leaked lists. If your username or password appear on a list of over 5 billion accounts from over 300 leaked sources the platform will be able to tell you.

## How does this work?
It is critical that we do not send your password to be validated to a third party. So when you provide us with your password we encrypt it using a method called SHA-1( https://en.wikipedia.org/wiki/SHA-1). As an example the password “Password123” will be encrypted as “b2e98ad6f6eb8508dd6a14cfa704bad7f05f6fb1”. We then ask the API for all the passwords which start “B2e98”, this way your password is never sent outside of the LMS. We are then given a list of every password which begins with that. We then check to see if the remaining 35 characters of your encrypted password appears in the list we are given. If it does, we let you know immediately.

## Acknowlegements
This plugin uses Have I Been Pwned API.
Created by Troy Hunt.
This idea was based from a similar Wordpress project by Wordfence(https://www.wordfence.com/blog/2018/03/password-leak-attacks-wordpress/).
This plugin has been created by Josh Willcock for the members of The Charity Learning Consortium.
