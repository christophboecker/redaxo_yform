<?php

$value = $value ?? $this->getValue() ?? '';
$options = $options ?? [];

if (is_array($value)) {
    if (0 == count($value)) {
        $value = '-';
    } elseif (1 == count($value)) {
        $value = (isset($options[current($value)]) ? rex_escape($options[current($value)]) : 'error - no option found for '. rex_escape(current($value)));
    } elseif (1 < count($value)) {
        foreach ($value as $k => $v) {
            $v = (isset($options[$v]) ? rex_escape($options[$v]) : 'error - no option found for '. rex_escape($v));
            $value[$k] = '<li>'.rex_escape($v).'</li>';
        }
        $value = '<ul>'.implode('', $value).'</ul>';
    }

} else {
    $length = strlen($value);
    $title = $value;
    $maxsize = 400;
    if ($length > $maxsize) {
        $value = mb_substr($value, 0, $maxsize / 2).' ... '.mb_substr($value, -($maxsize / 2));
    }
    $value = rex_escape($value);
}

$class_group = [];
$class_group['form-group'] = 'form-group';
if (!empty($this->getWarningClass())) {
    $class_group[$this->getWarningClass()] = $this->getWarningClass();
}

$class_label[] = 'control-label';

echo '
    <div class="'.implode(' ', $class_group).'" id="'.$this->getHTMLId().'">
        <label class="'.implode(' ', $class_label).'" for="'.$this->getFieldId().'">'.$this->getLabel().'</label>
        <div>' . $value . '</div>
    </div>';

?>
