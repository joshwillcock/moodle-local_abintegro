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
 * Fuse Social LMS integration.
 *
 * @package    local_abintegro
 * @copyright  2016 Josh Willcock
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace local_abintegro\integration;
require_once("$CFG->libdir/formslib.php");
class agreeterms_form extends \moodleform {
    public function definition() {
        $this->add_action_buttons($cancel = false, $submitlabel=get_string('agree', 'local_abintegro'));
    }
}
class connection {
    public function send(){
        GLOBAL $USER, $CFG, $OUTPUT;
        // Terms Agreed So Send On
        $config = get_config('local_abintegro');
        $baseurl = $config->baseurl;
        $themeid = $config->themeid;
        $authtoken = $config->authtoken;
        $paramstrings  = 'StudentID='.$USER->id;
        $paramstrings .= '&EmailAddress='.$USER->email;
        $paramstrings .= '&AuthToken='.$authtoken;
        $paramstrings .= '&TermsAgree=true';
        $paramstrings .= '&FirstName='.str_replace(' ','&nbsp;', $USER->firstname);
        $paramstrings .= '&LastName='.str_replace(' ','&nbsp;', $USER->lastname);
        $paramstrings .= '&ThemeUniqueId='.$themeid;
        $paramstrings .= '&ReturnFormat=LinkOnly';
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($curl,CURLOPT_URL,$baseurl."?".$paramstrings);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        curl_close($curl);
        if(substr($response,0,8)=="https://"){
        $url = new \moodle_url($response);
        redirect($url);
        }else{
            echo $OUTPUT->header();
            echo \html_writer::link($CFG->wwwroot, get_string('error', 'local_abintegro'), array());
            echo $OUTPUT->footer();
        }
    }
}
