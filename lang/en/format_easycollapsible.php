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
$string['pluginname'] = 'Easy collapsible';

/* Privacy */
$string['privacy:metadata'] = 'The Easy collapsible plugin only display existing topics course format into a nice and clean collapsible mode.';

/* Lib options */
$string['showfromothers'] = 'Show topic';
$string['collapsefirst'] = 'Collapse first section';
$string['collapsesecond'] = 'Collapse second section';
$string['collapselast'] = 'Collapse last section';
$string['collapseiconbackground'] = 'Icon background color';
$string['collapseiconcolor'] = 'Icon color';
$string['collapsetitlebackground'] = 'Topic title background';
$string['collapsetitlecolor'] = 'Topic title color';
$string['collapsetitlebordercolor'] = 'Bottom border color';
$string['collapsetopicsspacing'] = 'Topics spacing (px)';
$string['hidefromothers'] = 'Hide topic';
$string['no'] = 'No';
$string['yes'] = 'Yes';

/* Helpers */
$string['collapsefirst_help'] = 'Choose "yes" if you want to collapse also the first topic. Take in mind<br>
that before the first topic there could be another one called "Welcome" that is showed by default ';
$string['collapsesecond_help'] = 'Choose "yes" if you want to collapse also the second topic';
$string['collapselast_help'] = 'Choose "yes" if you want to collapse also the last topic';
$string['collapseiconcolor_help'] = 'Insert the esadecimal value (#000000) of the background color you<br>
desire for the icon';
$string['collapseiconbackground_help'] = 'Insert the esadecimal value (#000000) of the icon background color';
$string['collapseiconcolor_help'] = 'Insert the esadecimal value (#000000) of the icon color';
$string['collapsetitlebackground_help'] = 'Insert the esadecimal value (#000000) of the topic title background color';
$string['collapsetitlecolor_help'] = 'Insert the esadecimal value (#000000) of the topic title color';
$string['collapsetitlebordercolor_help'] = 'Insert the esadecimal value (#000000) of the bottom border color';
$string['collapsetopicsspacing_help'] = 'Insert the value (in pixels) of the space between topics';

/* Course section */
$string['showhideall'] = 'Show/hide all topics';