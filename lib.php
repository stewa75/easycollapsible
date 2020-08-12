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
 * @copyright  2020 Stefano Mura
 * @author     Stefano Mura
 * @link       https://www.linkedin.com/in/stefanomura75/
 * @license    http://www.gnu.org/copyleft/gpl.html GNU Public License
 *
 */
defined('MOODLE_INTERNAL') || die();
require_once($CFG->dirroot . '/course/format/topics/lib.php'); // For format_base.
require_once($CFG->dirroot . '/lib/classes/output/icon_system_fontawesome.php');
class format_easycollapsible extends format_topics {
    /**
     * course_format_options
     *
     * @param bool $foreditform
     * @return array
     */
    public function course_format_options($foreditform = false) {
        global $PAGE;
        static $courseformatoptions = false;
        /* How many sections the course has? */
        $modinfo       = get_fast_modinfo($PAGE->course);
        $sections      = $modinfo->get_section_info_all();
        $sectionscount = count($sections);
        /* Fine */
        if ($courseformatoptions === false) {
            $courseconfig                       = get_config('moodlecourse');
            $courseformatoptions['numsections'] = array(
                'default' => $sectionscount,
                'type' => PARAM_INT
            );
            /* Collapse first topic Op */
            if (!get_config('format_easycollapsible', 'collapsefirst')) {
                $courseformatoptions['collapsefirst'] = array(
                    'default' => 0,
                    'type' => PARAM_INT
                );
            } else {
                $courseformatoptions['collapsefirst'] = array(
                    'default' => get_config('format_easycollapsible', 'collapsefirst'),
                    'type' => PARAM_INT
                );
            }
            /* Collapse second topic Op */
            if (!get_config('format_easycollapsible', 'collapsesecond')) {
                $courseformatoptions['collapsesecond'] = array(
                    'default' => 0,
                    'type' => PARAM_INT
                );
            } else {
                $courseformatoptions['collapsesecond'] = array(
                    'default' => get_config('format_easycollapsible', 'collapsesecond'),
                    'type' => PARAM_INT
                );
            }
            /* Collapse last topic Op */
            if (!get_config('format_easycollapsible', 'collapselast')) {
                $courseformatoptions['collapselast'] = array(
                    'default' => 0,
                    'type' => PARAM_INT
                );
            } else {
                $courseformatoptions['collapselast'] = array(
                    'default' => get_config('format_easycollapsible', 'collapselast'),
                    'type' => PARAM_INT
                );
            }
            /* Icon background color Op */
            if (!get_config('format_easycollapsible', 'collapseiconbackground')) {
                $courseformatoptions['collapseiconbackground'] = array(
                    'default' => '#C11600',
                    'type' => PARAM_TEXT
                );
            } else {
                $courseformatoptions['collapseiconbackground'] = array(
                    'default' => get_config('format_easycollapsible', 'collapseiconbackground'),
                    'type' => PARAM_TEXT
                );
            }
            /* Icon color Op */
            if (!get_config('format_easycollapsible', 'collapseiconcolor')) {
                $courseformatoptions['collapseiconcolor'] = array(
                    'default' => '#ffffff',
                    'type' => PARAM_TEXT
                );
            } else {
                $courseformatoptions['collapseiconcolor'] = array(
                    'default' => get_config('format_easycollapsible', 'collapseiconcolor'),
                    'type' => PARAM_TEXT
                );
            }
            /* Title background color Op */
            if (!get_config('format_easycollapsible', 'collapsetitlebackground')) {
                $courseformatoptions['collapsetitlebackground'] = array(
                    'default' => '#f5f5f5',
                    'type' => PARAM_TEXT
                );
            } else {
                $courseformatoptions['collapsetitlebackground'] = array(
                    'default' => get_config('format_easycollapsible', 'collapsetitlebackground'),
                    'type' => PARAM_TEXT
                );
            }
            /* Title font color Op */
            if (!get_config('format_easycollapsible', 'collapsetitlecolor')) {
                $courseformatoptions['collapsetitlecolor'] = array(
                    'default' => '#333333',
                    'type' => PARAM_TEXT
                );
            } else {
                $courseformatoptions['collapsetitlecolor'] = array(
                    'default' => get_config('format_easycollapsible', 'collapsetitlecolor'),
                    'type' => PARAM_TEXT
                );
            }
            /* Title border color Op */
            if (!get_config('format_easycollapsible', 'collapsetitlebordercolor')) {
                $courseformatoptions['collapsetitlebordercolor'] = array(
                    'default' => '#dddddd',
                    'type' => PARAM_TEXT
                );
            } else {
                $courseformatoptions['collapsetitlebordercolor'] = array(
                    'default' => get_config('format_easycollapsible', 'collapsetitlebordercolor'),
                    'type' => PARAM_TEXT
                );
            }
            /* Topic Spacing Op */
            if (!get_config('format_easycollapsible', 'collapsetopicsspacing')) {
                $courseformatoptions['collapsetopicsspacing'] = array(
                    'default' => 10,
                    'type' => PARAM_INT
                );
            } else {
                $courseformatoptions['collapsetopicsspacing'] = array(
                    'default' => get_config('format_easycollapsible', 'collapsetopicsspacing'),
                    'type' => PARAM_INT
                );
            }
        }
        if ($foreditform && !isset($courseformatoptions['coursedisplay']['label'])) {
            $courseconfig = get_config('moodlecourse');
            $max          = $courseconfig->maxsections;
            if (!isset($max) || !is_numeric($max)) {
                $max = 52;
            }
            $sectionmenu = array();
            for ($i = 0; $i <= $max; $i++) {
                $sectionmenu[$i] = "$i";
            }
            $courseformatoptionsedit['numsections']              = array(
                'label' => new lang_string('numberweeks'),
                'element_type' => 'select',
                'element_attributes' => array(
                    $sectionmenu
                )
            );
            $courseformatoptionsedit['collapsefirst']            = array(
                'label' => get_string('collapsefirst', 'format_easycollapsible'),
                'help' => 'collapsefirst',
                'help_component' => 'format_easycollapsible',
                'element_type' => 'select',
                'element_attributes' => array(
                    array(
                        0 => get_string('yes', 'format_easycollapsible'),
                        1 => get_string('no', 'format_easycollapsible')
                    )
                )
            );
            $courseformatoptionsedit['collapsesecond']           = array(
                'label' => get_string('collapsesecond', 'format_easycollapsible'),
                'help' => 'collapsesecond',
                'help_component' => 'format_easycollapsible',
                'element_type' => 'select',
                'element_attributes' => array(
                    array(
                        0 => get_string('yes', 'format_easycollapsible'),
                        1 => get_string('no', 'format_easycollapsible')
                    )
                )
            );
            $courseformatoptionsedit['collapselast']             = array(
                'label' => get_string('collapselast', 'format_easycollapsible'),
                'help' => 'collapselast',
                'help_component' => 'format_easycollapsible',
                'element_type' => 'select',
                'element_attributes' => array(
                    array(
                        0 => get_string('yes', 'format_easycollapsible'),
                        1 => get_string('no', 'format_easycollapsible')
                    )
                )
            );
            $courseformatoptionsedit['collapseiconbackground']   = array(
                'label' => get_string('collapseiconbackground', 'format_easycollapsible'),
                'help' => 'collapseiconbackground',
                'help_component' => 'format_easycollapsible',
                'element_type' => 'text',
                'element_attributes' => array(
                    array(
                        'size' => '8',
                        'maxlength' => '7'
                    )
                )
            );
            $courseformatoptionsedit['collapseiconcolor']        = array(
                'label' => get_string('collapseiconcolor', 'format_easycollapsible'),
                'help' => 'collapseiconcolor',
                'help_component' => 'format_easycollapsible',
                'element_type' => 'text',
                'element_attributes' => array(
                    array(
                        'size' => '8',
                        'maxlength' => '7'
                    )
                )
            );
            $courseformatoptionsedit['collapsetitlebackground']  = array(
                'label' => get_string('collapsetitlebackground', 'format_easycollapsible'),
                'help' => 'collapsetitlebackground',
                'help_component' => 'format_easycollapsible',
                'element_type' => 'text',
                'element_attributes' => array(
                    array(
                        'size' => '8',
                        'maxlength' => '7'
                    )
                )
            );
            $courseformatoptionsedit['collapsetitlecolor']       = array(
                'label' => get_string('collapsetitlecolor', 'format_easycollapsible'),
                'help' => 'collapsetitlecolor',
                'help_component' => 'format_easycollapsible',
                'element_type' => 'text',
                'element_attributes' => array(
                    array(
                        'size' => '8',
                        'maxlength' => '7'
                    )
                )
            );
            $courseformatoptionsedit['collapsetitlebordercolor'] = array(
                'label' => get_string('collapsetitlebordercolor', 'format_easycollapsible'),
                'help' => 'collapsetitlebordercolor',
                'help_component' => 'format_easycollapsible',
                'element_type' => 'text',
                'element_attributes' => array(
                    array(
                        'size' => '8',
                        'maxlength' => '7'
                    )
                )
            );
            $courseformatoptionsedit['collapsetopicsspacing']    = array(
                'label' => get_string('collapsetopicsspacing', 'format_easycollapsible'),
                'help' => 'collapsetopicsspacing',
                'help_component' => 'format_easycollapsible',
                'element_type' => 'text',
                'element_attributes' => array(
                    array(
                        'size' => '3',
                        'maxlength' => '2'
                    )
                )
            );
            $courseformatoptions = array_merge_recursive($courseformatoptions, $courseformatoptionsedit);
        }
        return $courseformatoptions;
    }
    /**
     * update_course_format_options
     *
     * @param stdclass|array $data
     * @param stdClass $oldcourse
     * @return bool
     */
    public function update_course_format_options($data, $oldcourse = null) {
        global $DB;
        $data = (array) $data;
        if ($oldcourse !== null) {
            $oldcourse = (array) $oldcourse;
            $options   = $this->course_format_options();
            foreach ($options as $key => $unused) {
                if (!array_key_exists($key, $data)) {
                    if (array_key_exists($key, $oldcourse)) {
                        $data[$key] = $oldcourse[$key];
                    } else if ($key === 'numsections') {
                        $maxsection = $DB->get_field_sql('SELECT max(section) from
                        {course_sections} WHERE course = ?', array(
                            $this->courseid
                        ));
                        if ($maxsection) {
                            $data['numsections'] = $maxsection;
                        }
                    }
                }
            }
        }
        $changed = $this->update_format_options($data);
        if ($changed && array_key_exists('numsections', $data)) {
            $numsections = (int) $data['numsections'];
            $sql         = 'SELECT max(section) from {course_sections} WHERE course = ?';
            $maxsection  = $DB->get_field_sql($sql, array(
                $this->courseid
            ));
            for ($sectionnum = $maxsection; $sectionnum > $numsections; $sectionnum--) {
                if (!$this->delete_section($sectionnum, false)) {
                    break;
                }
            }
        }
        return $changed;
    }
    /**
     * get_view_url
     *
     * @param int|stdclass $section
     * @param array $options
     * @return null|moodle_url
     */
    public function get_view_url($section, $options = array()) {
        global $CFG;
        $course = $this->get_course();
        $url    = new moodle_url('/course/view.php', array(
            'id' => $course->id
        ));
        $sr     = null;
        if (array_key_exists('sr', $options)) {
            $sr = $options['sr'];
        }
        if (is_object($section)) {
            $sectionno = $section->section;
        } else {
            $sectionno = $section;
        }
        if ($sectionno !== null) {
            if ($sr !== null) {
                if ($sr) {
                    $usercoursedisplay = COURSE_DISPLAY_MULTIPAGE;
                    $sectionno         = $sr;
                } else {
                    $usercoursedisplay = COURSE_DISPLAY_SINGLEPAGE;
                }
            } else {
                $usercoursedisplay = 0;
            }
            if ($sectionno != 0 && $usercoursedisplay == COURSE_DISPLAY_MULTIPAGE) {
                $url->param('section', $sectionno);
            } else {
                if (empty($CFG->linkcoursesections) && !empty($options['navigation'])) {
                    return null;
                }
                $url->set_anchor('section-' . $sectionno);
            }
        }
        return $url;
    }
}
/**
 * Implements callback inplace_editable() allowing to edit values in-place
 *
 * @param string $itemtype
 * @param int $itemid
 * @param mixed $newvalue
 * @return \core\output\inplace_editable
 */
function format_easycollapsible_inplace_editable($itemtype, $itemid, $newvalue) {
    global $DB, $CFG;
    require_once($CFG->dirroot . '/course/lib.php');
    if ($itemtype === 'sectionname' || $itemtype === 'sectionnamenl') {
        $ecsql = 'SELECT s.* FROM {course_sections} s JOIN {course} c ON s.course = c.id WHERE s.id = ? AND c.format = ?';
        $section = $DB->get_record_sql($ecsql, array($itemid, 'topics'), MUST_EXIST);
        return course_get_format($section->course)->inplace_editable_update_section_name($section, $itemtype, $newvalue);
    }
}
