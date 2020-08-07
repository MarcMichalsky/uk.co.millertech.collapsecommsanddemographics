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

    if ($field == 'age') {
        $text = $value;
        return <<<HEREDOC
<span class="demography-icon privacy-flag age">$text</span>
HEREDOC;
    } else {
        $icon = '';
        if (isset($value)) {
            // get icon
            try {
                $icon = civicrm_api3('OptionValue', 'getvalue', [
                    'return' => "icon",
                    'option_group_id' => "gender",
                    'value' => $value,
                ]);
            } catch (Exception $e) {

            }
        }

        return <<<HEREDOC
<span class="demography-icon privacy-flag gender"><i class="crm-i {$icon} fa-lg" aria-hidden="true"></i></span><span class="sr-only"></span>
HEREDOC;
    }

}