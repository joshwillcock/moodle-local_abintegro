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
 * Abintegro Intergration Settings.
 *
 * @package    local_abintegro
 * @copyright  2016 onwards Josh Willcock {@link http://joshwillcock.co.uk}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;
if ($hassiteconfig) {
    $settings = new admin_settingpage(
        get_string('pluginname', 'local_abintegro'),
        get_string('pluginname', 'local_abintegro')
);

// Heading.
$setting = new admin_setting_heading(
    'local_abintegro/heading',
    '', get_string('setting_heading_desc', 'local_abintegro')
);
$setting->plugin = 'local_abintegro';
$settings->add($setting);
// Base URL.
$setting = new admin_setting_configtext(
    'local_abintegro/baseurl',
    get_string('baseurl', 'local_abintegro'),
    get_string('baseurldesc', 'local_abintegro'),
    'https://www.abintegro.com/SSO/AuthUser.aspx', PARAM_URL
);
$setting->plugin = 'local_abintegro';
$settings->add($setting);
// secret_key.
$setting = new admin_setting_configtext(
    'local_abintegro/authtoken',
    get_string('secretkey', 'local_abintegro'),
    get_string('secretkeydesc', 'local_abintegro'),
    '', PARAM_TEXT
);
$setting->plugin = 'local_abintegro';
$settings->add($setting);

// Auth Salt.
$setting = new admin_setting_configtext(
    'local_abintegro/themeid',
    get_string('themeid', 'local_abintegro'),
    get_string('themeiddesc', 'local_abintegro'),
    '', PARAM_TEXT
);
$setting->plugin = 'local_abintegro';
$settings->add($setting);
$ADMIN->add('localplugins', $settings);
}
