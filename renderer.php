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
require_once($CFG->dirroot . '/course/format/topics/renderer.php');
$PAGE->requires->js('/course/format/easycollapsible/js/easycollapse.js');
$PAGE->requires->jquery();
class format_easycollapsible_renderer extends format_topics_renderer
{
    /**
     * Generate the starting container html for a list of sections
     * @return string HTML to output.
     */
    protected function start_section_list() {
        /* Include files general js and css that make Easycollapsible plugin works */
        echo '<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">';
        echo '<button id="showhideallbtn" type="button" class="btn btn-primary">' . get_string('showhideall', 'format_easycollapsible') . '</button>';
        echo '<div id="easycollapsetopics">';
        return html_writer::start_tag('ul', array(
            'class' => 'topics'
        ));
    }
    protected function section_header($section, $course, $onsectionpage, $sectionreturn = null)
    {
        $o            = '';
        $currenttext  = '';
        $sectionstyle = '';
        if ($section->section != 0) {
            // Only in the non-general sections.
            if (!$section->visible) {
                $sectionstyle = ' hidden';
            }
            if (course_get_format($course)->is_section_current($section)) {
                $sectionstyle = ' current';
            }
        }
        $o .= html_writer::start_tag('li', [
        'id' => 'section-'.$section->section,
        'class' => 'format-easycollapsible_section format-easycollapsible_main clearfix'.$sectionstyle,
        'role' => 'region',
        'aria-labelledby' => "sectionid-{$section->id}-title",
        'data-sectionid' => $section->section
        ]);
        $leftcontent = $this->section_left_content($section, $course, $onsectionpage);
        $o .= html_writer::tag('div', $leftcontent, array(
            'class' => 'format-easycollapsible_left format-easycollapsible_side'
        ));
        $rightcontent = $this->section_right_content($section, $course, $onsectionpage);
        $o .= html_writer::tag('div', $rightcontent, array(
            'class' => 'format-easycollapsible_right format-easycollapsible_side'
        ));
        $o .= html_writer::start_tag('div', array(
            'class' => 'content'
        ));
        // When not on a section page, we display the section titles except the general section if null
        $hasnamenotsecpg = (!$onsectionpage && ($section->section != 0 || !is_null($section->name)));
        // When on a section page, we only display the general section title, if title is not the default one
        $hasnamesecpg    = ($onsectionpage && ($section->section == 0 && !is_null($section->name)));
        $classes         = ' accesshide';
        if ($hasnamenotsecpg || $hasnamesecpg) {
            $classes = '';
        }
        /* Choose how to show the topic title, if linked or not */
        if (($section->section == 0) || ($course->collapsefirst == 1 && $section->section == 1 || $course->collapsesecond == 1 && $section->section == 2 || $course->collapselast == 1 && $section->section == $course->numsections)) {
            $sectionname = $section->name;
            $o .= $this->output->heading($sectionname, 3, 'sectionname' . $classes, "sectionid-{$section->id}-title");
        } else {
            $sectionname = '<a href="#collapsible-' . $section->id . '" class="format-easycollapsible_fheader" >' . $section->name . '</a>';
            $o .= '<div class="format-easycollapsible_topictitle">' . $sectionname . '</div>';
        }
        if ($course->collapseiconbackground && $course->collapseiconbackground != 0) {
            echo '
			<style>
			a.format-easycollapsible_fheader.closed:before {
			background:' . $course->collapseiconbackground . '!important;

			}
			a.format-easycollapsible_fheader:before {
			background:' . $course->collapseiconbackground . '!important;

			}
			
			</style>
			';
        } elseif ($course->collapseiconcolor && $course->collapseiconcolor != 0) {
            echo '
			<style>
			a.format-easycollapsible_fheader.closed:before {

			color: ' . $course->collapseiconcolor . '!important;
			}
			a.format-easycollapsible_fheader:before {

			color: ' . $course->collapseiconcolor . '!important;
			}
			</style>
			';
        } elseif ($course->collapseiconbackground && $course->collapseiconbackground != 0) {
            echo '
			<style>
			.format-easycollapsible_section .format-easycollapsible_topictitle {
			background-color: ' . $course->collapsetitlebackground . '!important;		
			}
			</style>
			';
        } elseif ($course->collapsetitlecolor && $course->collapsetitlecolor != 0) {
            echo '
			<style>
			.format-easycollapsible_section .format-easycollapsible_topictitle {
			color: ' . $course->collapsetitlecolor . '!important;	
			}
			</style>
			';
        } elseif ($course->collapsetitlebackground && $course->collapsetitlebackground != 0) {
            echo '
			<style>
			.format-easycollapsible_section .format-easycollapsible_topictitle {
			background-color: ' . $course->collapsetitlebackground . '!important;
			}
			</style>
			';
        } elseif ($course->collapsetitlebordercolor && $course->collapsetitlebordercolor != 0) {
            echo '
			<style>
			.format-easycollapsible_section .format-easycollapsible_topictitle {
			border-bottom: ' . $course->collapsetitlebordercolor . '!important;
			}
			</style>
			';
        } elseif ($course->collapsetopicsspacing) {
            echo '
			<style>
			.course-content ul li.format-easycollapsible_section.format-easycollapsible_main {
					margin-bottom:' . $course->collapsetopicsspacing . 'px!important;
			}
			</style>
			';
        }
        $o .= html_writer::start_tag('div', array(
            'class' => 'summary'
        ));
        if ($section->uservisible || $section->visible) {
            // Show summary if section is available or has availability restriction information.
            // Do not show summary if section is hidden but we still display it because of course setting
            // "Hidden sections are shown in collapsed form".
            $o .= $this->format_summary_text($section);
        }
        $o .= html_writer::end_tag('div');
        return $o;
    }
    /**
     * Output the html for a multiple section page
     *
     * @param stdClass $course The course entry from DB
     * @param array $sections (argument not used)
     * @param array $mods (argument not used)
     * @param array $modnames (argument not used)
     * @param array $modnamesused (argument not used)
     */
    public function print_multiple_section_page($course, $sections, $mods, $modnames, $modnamesusedn)
    {
        $modinfo        = get_fast_modinfo($course);
        $course         = course_get_format($course)->get_course();
        $context        = context_course::instance($course->id);
        // Title with completion help icon.
        $completioninfo = new completion_info($course);
        echo $completioninfo->display_help_icon();
        echo $this->output->heading($this->page_title(), 2, 'accesshide');
        // Copy activity clipboard..
        echo $this->course_activity_clipboard($course, 0);
        // Now the list of sections..
        echo $this->start_section_list();
        $numsections = course_get_format($course)->get_last_section_number();
        foreach ($modinfo->get_section_info_all() as $section => $thissection) {
            if ($section == 0) {
                // 0-section is displayed a little different then the others
                if ($thissection->summary or !empty($modinfo->sections[0]) or $this->page->user_is_editing()) {
                    echo $this->section_header($thissection, $course, false, 0);
                    echo $this->courserenderer->course_section_cm_list($course, $thissection, 0);
                    echo $this->courserenderer->course_section_add_cm_control($course, 0, 0);
                    echo $this->section_footer();
                }
                continue;
            }
            if ($section > $numsections) {
                // activities inside this section are 'orphaned', this section will be printed as 'stealth' below
                continue;
            }
            // Show the section if the user is permitted to access it, OR if it's not available
            // but there is some available info text which explains the reason & should display,
            // OR it is hidden but the course has a setting to display hidden sections as unavilable.
            $showsection = $thissection->uservisible || ($thissection->visible && !$thissection->available && !empty($thissection->availableinfo)) || (!$thissection->visible && !$course->hiddensections);
            if (!$showsection) {
                continue;
            }
            if (!$this->page->user_is_editing() && $course->coursedisplay == COURSE_DISPLAY_MULTIPAGE) {
                // Display section summary only.
                echo $this->section_summary($thissection, $course, null);
            } else {
                echo $this->section_header($thissection, $course, false, 0);
                if ($thissection->uservisible) {
                    /* Choose how to show the div if visible or not */
                    if ($course->collapsefirst == 1 && $thissection->section == 1 || $course->collapsesecond == 1 && $thissection->section == 2 || $course->collapselast == 1 && $thissection->section == $course->numsections) {
                        echo '<div class="format-easycollapsible format-easycollapsible_showed" id="collapsible-' . $thissection->id . '" >';
                    } else {
                        echo '<div class="format-easycollapsible format-easycollapsible_multi-collapse" id="collapsible-' . $thissection->id . '">';
                    }
                    echo $this->courserenderer->course_section_cm_list($course, $thissection, 0);
                    echo $this->courserenderer->course_section_add_cm_control($course, $section, 0);
                    echo '</div>';
                }
                echo $this->section_footer();
            }
        }
        if ($this->page->user_is_editing() and has_capability('moodle/course:update', $context)) {
            // Print stealth sections if present.
            foreach ($modinfo->get_section_info_all() as $section => $thissection) {
                if ($section <= $numsections or empty($modinfo->sections[$section])) {
                    // this is not stealth section or it is empty
                    continue;
                }
                echo $this->stealth_section_header($section);
                echo $this->courserenderer->course_section_cm_list($course, $thissection, 0);
                echo $this->stealth_section_footer();
            }
            echo $this->end_section_list();
            echo $this->change_number_sections($course, 0);
        } else {
            echo $this->end_section_list();
        }
    }
    /**
     * Generate the closing container html for a list of sections
     * @return string HTML to output.
     */
    protected function end_section_list()
    {
        return html_writer::end_tag('ul');
        echo '</div>';
    }
}
