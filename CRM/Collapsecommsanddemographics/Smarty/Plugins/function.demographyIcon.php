<?php
/**
 * Created by Chamil Wijesooriya.
 * Date: 06/08/2020
 * Time: 18:14
 */

/**
 * Display gender icon and age
 *
 * @param $params
 *   - field: the applicable demography field
 *          gender or age
 *   - value: depends on gender: gender id or age
 *
 * @param $smarty
 *
 * @return string
 */
function smarty_function_demographyIcon($params, &$smarty)
{

    $field = $params['field'];
    $value = $params['value'];

    if (empty($value)) {
        return '';
    }

    if ($field == 'age') {
        $years = $value['y'] ?? 0;
        $months = $value['m'] ?? 0;
        $ageText = ts('%count year', ['count' => $years, 'plural' => '%count years']);
        if ($months) {
            $ageText .= ts(' and %count month', ['count' => $months, 'plural' => 'and %count months']);
        }

        return <<<HEREDOC
<span class="demography-icon privacy-flag age" title="$ageText">$years</span><span class="sr-only">$ageText</span>
HEREDOC;
    } else {
        $icon = '';
        if (isset($value)) {
            // get icon
            try {
                $genderOption = civicrm_api3('OptionValue', 'getsingle', [
                    'return' => ["icon", "label"],
                    'option_group_id' => "gender",
                    'value' => $value,
                ]);
                $icon = $genderOption['icon'] ?? '';
            } catch (Exception $e) {

            }
        }
        if (empty($icon)) {
            return '';
        }

        return <<<HEREDOC
<span class="demography-icon privacy-flag gender" title="{$genderOption['label']}"><i class="crm-i {$icon} fa-lg" aria-hidden="true"></i></span><span class="sr-only">{$genderOption['label']}</span>
HEREDOC;
    }

}