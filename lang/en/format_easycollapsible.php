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

/*
 *
 * @package    format_easycollapsible
 * @version    See the value of '$plugin->version' in below.
 * @copyright  2020 Stefano Mura
 * @author     Stefano Mura
 * @link       https://www.linkedin.com/in/stefanomura75/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU Public License
 *
 */

defined('MOODLE_INTERNAL') || die();

/* Plugin name */
$string['pluginname'] = 'Collapsible Topics';

/* Lib options */
$string['yes'] = 'Yes';

$string['no'] = 'No';

$string['hidefromothers'] = 'Hide topic';

$string['showfromothers'] = 'Show topic';

$string['collapsefirst_op'] = 'Collapse first section';

$string['collapsesecond_op'] = 'Collapse second section';

$string['collapselast_op'] = 'Collapse last section';

$string['collapseiconbackground_op'] = 'Icon background color';

$string['collapseiconcolor_op'] = 'Icon color';

$string['collapsetitlebackground_op'] = 'Topic title background';

$string['collapsetitlecolor_op'] = 'Topic title color';

$string['collapsetitlebordercolor_op'] = 'Bottom border color';

$string['collapsetopicsspacing_op'] = 'Topics spacing (px)';



/* Helpers */
$string['collapsefirst_help'] = 'Choose "Yes" if you want to collapse also the first Topic. Take in mind<br>
that before the first Topic there could be another one called "Welcome" that is showed by default ';
$string['collapsesecond_help'] = 'Choose "Yes" if you want to collapse also the second Topic';
$string['collapslast_help'] = 'Choose "Yes" if you want to collapse also the last Topic';
$string['collapseiconcolor_help'] = 'Insert the esadecimal value (#000000) of the background color you<br>
desire for the Icon';

$string['collapseiconbackground_help'] = 'Insert the esadecimal value (#000000) of the Icon background color';
$string['collapseiconcolor_help'] = 'Insert the esadecimal value (#000000) of the Icon color';
$string['collapsetitlebackground_help'] = 'Insert the esadecimal value (#000000) of the Topic title background color';
$string['collapsetitlecolor_help'] = 'Insert the esadecimal value (#000000) of the Topic title color';
$string['collapsetitlebordercolor_help'] = 'Insert the esadecimal value (#000000) of the bottom Border color';

$string['collapsetopicsspacing_help'] = 'Insert the value (in pixels) of the space between Topics';