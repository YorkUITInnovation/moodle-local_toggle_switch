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
 * Main page for the toggle switch local plugin.
 *
 * @package    local_toggle_switch
 * @copyright  2025 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');

// Ensure user is logged in.
require_login();

$context = context_system::instance();
require_capability('moodle/site:config', $context);

$PAGE->set_url('/local/toggle_switch/index.php');
$PAGE->set_context($context);
$PAGE->set_title(get_string('pluginname', 'local_toggle_switch'));
$PAGE->set_heading(get_string('pluginname', 'local_toggle_switch'));

echo $OUTPUT->header();

echo html_writer::tag('h2', get_string('pluginname', 'local_toggle_switch'));

echo html_writer::tag('h3', 'Toggle Switch Examples');

// Example 1: Unchecked toggle (value = 0)
echo html_writer::tag('h4', 'Unchecked Toggle (value = 0)');
$templatecontext1 = [
    'elementid' => 'toggle_off',
    'required' => false,
    'disabled' => false,
    'value' => 0
];
echo $OUTPUT->render_from_template('local_toggle_switch/toggle_switch', $templatecontext1);

echo html_writer::tag('br', '');
echo html_writer::tag('br', '');

// Example 2: Checked toggle (value = 1)
echo html_writer::tag('h4', 'Checked Toggle (value = 1)');
$templatecontext2 = [
    'elementid' => 'toggle_on',
    'required' => true,
    'disabled' => false,
        'value' => 1
];
echo $OUTPUT->render_from_template('local_toggle_switch/toggle_switch', $templatecontext2);

echo html_writer::tag('br', '');
echo html_writer::tag('br', '');

// Example 3: Disabled toggle
echo html_writer::tag('h4', 'Disabled Toggle');
$templatecontext3 = [
    'elementid' => 'toggle_disabled',
    'required' => false,
    'disabled' => true,
    'value' => 1
];
echo $OUTPUT->render_from_template('local_toggle_switch/toggle_switch', $templatecontext3);

echo $OUTPUT->footer();
