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
 * Abintegro Auth Token SSO integration.
 *
 * @package    local_abintegro
 * @copyright  2016 Josh Willcock
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_abintegro\integration;
require_once('../../config.php');
global $CFG, $USER;
require_once('locallib.php');
$PAGE->set_url('/local/abintegro/index.php');
$PAGE->set_context(\context_system::instance());
$PAGE->set_pagelayout('admin');
$strheading = get_string('abintegro', 'local_abintegro');
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);
$system = \context_system::instance();
$permission = \has_capability('local/abintegro:access', $system, $USER->id);
if($permission){
$mform = new agreeterms_form();
    if ($fromform = $mform->get_data()) {
        $recordtoinsert = new \stdClass;
        $recordtoinsert->userid = $USER->id;
        $recordtoinsert->agreed = '1';
        if($DB->count_records('local_abintegro', array('userid' => $USER->id, 'agreed' => '1')) == 0){
            $DB->insert_record('local_abintegro', $recordtoinsert);
        }
        $connection = new connection;
        $connection->send();
    } else {
        $termsagreed = $DB->get_record('local_abintegro', array('userid' => $USER->id, 'agreed' => '1'));
        if($termsagreed){
            $connection = new connection;
            $connection->send();
        }else{
            echo $OUTPUT->header();
            $fallback = \html_writer::link('https://www.abintegro.com/Terms-And-Conditions', get_string('fallback', 'local_abintegro'));
            echo \html_writer::tag('iframe', $fallback, array('width' => '100%', 'height' => '500px', 'src' => 'https://www.abintegro.com/Terms-And-Conditions'));
            echo  \html_writer::tag('a',get_string('termsdesc','local_abintegro'));
            $mform->display();
            echo $OUTPUT->footer();
        }
    }
}else{
    echo $OUTPUT->header();
    echo get_string('nopermissions', 'local_abintegro');
    echo $OUTPUT->footer();
}
?>
