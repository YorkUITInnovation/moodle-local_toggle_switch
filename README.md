# Toggle Switch Plugin for Moodle

A local Moodle plugin that provides a toggle switch template for use in forms as an alternative to traditional checkboxes.

## Description

The Toggle Switch plugin provides a visually appealing toggle switch component that can be used in Moodle forms. Instead of displaying a standard checkbox, this plugin renders a smooth, animated toggle switch with a slider that moves from left (off) to right (on).

## Installation

1. Download or clone this plugin to your Moodle installation
2. Place the plugin files in `/local/toggle_switch/`
3. Log in as an administrator and go to **Site administration → Notifications**
4. Follow the installation prompts to complete the installation

## Usage

The toggle switch is designed to be used with static or HTML elements within Moodle forms. **Important: You must add a corresponding hidden form element for the toggle switch to work properly.**

### Basic Usage in Forms

In your form class, you need to add both a hidden field and a static element:

```php
<?php
// In your form's definition() method

// Step 1: Add the hidden field that Moodle will process
$currentvalue = $this->_customdata['toggle_value'] ?? 0;
$mform->addElement('hidden', 'my_toggle_field', $currentvalue);
$mform->setType('my_toggle_field', PARAM_INT);

// Step 2: Prepare template context
$templatecontext = [
    'elementid' => 'my_toggle_field',  // Must match the hidden field name
    'disabled' => false,
    'value' => $currentvalue,
    'tooltip' => 'Toggle this option'  // Optional
];

// Step 3: Render the toggle switch
$togglehtml = $OUTPUT->render_from_template('local_toggle_switch/toggle_switch', $templatecontext);

// Step 4: Add as a static element to your form
$mform->addElement('static', 'toggle_display', 'Enable Feature', $togglehtml);
```

### Required Steps Summary

**You must include BOTH elements for the toggle to work:**

1. **Hidden Field**: `$mform->addElement('hidden', 'fieldname', $value);` - This is what gets submitted
2. **Static Element**: Contains the toggle switch template for visual display
3. **Matching elementid**: The template's `elementid` parameter must match the hidden field name

### Example Implementation

```php
<?php
// Complete example for an "accept terms" toggle

class my_form extends moodleform {
    public function definition() {
        global $OUTPUT;
        $mform = $this->_form;

        // Get current value
        $acceptterms = $this->_customdata['accept'] ?? 0;

        // REQUIRED: Add hidden field for form submission
        $mform->addElement('hidden', 'accept', $acceptterms);
        $mform->setType('accept', PARAM_INT);

        // Add toggle switch display
        $templatecontext = [
            'elementid' => 'accept',    // Must match hidden field name
            'disabled' => false,
            'value' => $acceptterms,
            'tooltip' => 'You must accept the terms to proceed' // Optional
        ];

        $togglehtml = $OUTPUT->render_from_template('local_toggle_switch/toggle_switch', $templatecontext);
        $mform->addElement('static', 'accept_display', 'Accept Terms', $togglehtml);
    }
}
```
## Template Parameters

The toggle switch template accepts the following parameters:

| Parameter   | Type    | Required | Description                                                     |
|-------------|---------|----------|-----------------------------------------------------------------|
| `elementid` | string  | Yes | The ID and name for the checkbox element                        |
| `disabled`  | boolean | Yes | Whether the field is disabled                                   |
| `value`     | integer | Yes | The current value (0 = unchecked/off, 1 = checked/on)           |
| `tooltip`   | string  | No | A pop-up tooltip when user mouse-over. Perfect for accessibilty |

### Example Template Context

```php
$templatecontext = [
    'elementid' => 'accept_terms',     // Creates checkbox with id="accept_terms" name="accept_terms"               // Adds required attribute
    'disabled' => false,               // Normal clickable state
    'value' => 1                       // Toggle appears in "on" position
    'tooltip' => 'You must accept the terms to proceed' // Optional tooltip text
];
```

## Form Data Handling

When the form is submitted, the toggle switch will submit data using the `elementid` as the field name:

- **Checked**: `elementid=1`
- **Unchecked**: `elementid=0`

## Examples

### Basic Toggle

```php
$params = [
    'elementid' => 'simple_toggle',
    'disabled' => false,
    'value' => 0
];
$html = $OUTPUT->render_from_template('local_toggle_switch/toggle_switch', $params);
```

### Pre-checked Toggle

```php
$params = [
    'elementid' => 'prechecked_toggle',
    'disabled' => false,
    'value' => 1
];
$html = $OUTPUT->render_from_template('local_toggle_switch/toggle_switch', $params);
```

### Disabled Toggle

```php
$params = [
    'elementid' => 'disabled_toggle',
    'disabled' => true,
    'value' => 1
];
$html = $OUTPUT->render_from_template('local_toggle_switch/toggle_switch', $params);
```

## Demo

To see the toggle switch in action, visit `/local/toggle_switch/index.php` in your Moodle installation (requires site administrator privileges).

## Troubleshooting

### Toggle Not Responding to Clicks
Ensure the template is properly rendered and not inside elements that prevent click events from bubbling.

### Form Data Not Submitting
Remember to add the hidden field with the same name as `elementid` to your form.

## License

This plugin is licensed under the GNU GPL v3 or later, the same license as Moodle.

---

**Version**: 1.0  
**Moodle Version**: 4.0+  
**Plugin Type**: Local  
**Maturity**: Alpha
