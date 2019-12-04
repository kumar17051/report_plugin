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
 * Config changes report
 *
 * @package    report
 * @subpackage configlog
 * @copyright  2009 Petr Skoda
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/adminlib.php');


admin_externalpage_setup('reportconfiglog_2', '', null, '', array('pagelayout'=>'report'));
echo $OUTPUT->header();

echo $OUTPUT->heading(get_string("lastaddeduser", 'report_configlog_2'));


$table = new html_table();

$table->head  = array('Date', 'Firstname','Lastname', 'Username', 'Email');

$table->data  = array();


$sql = "SELECT * FROM mdl_user order by id desc";
          

$rs = $DB->get_recordset_sql($sql, array(), $limitfrom=0, $limitnum=1);



foreach ($rs as $log) {


    
    $row = array();
    $row[] = userdate($log->timemodified);
    $row[] = $log->firstname;
    $row[] = $log->lastname;
    $row[] = $log->username;
    $row[] = $log->email;
    

    $table->data[] = $row;
}
$rs->close();

echo html_writer::table($table);

echo $OUTPUT->footer();
