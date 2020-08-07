<?php
/**
 * Created by Chamil Wijesooriya.
 * Date: 06/08/2020
 * Time: 17:26
 */

class CRM_Collapsecommsanddemographics_Ajax
{
    /**
     * Display icons for privacy options
     * @throws Exception
     */
    public static function getCommsAndPrefs()
    {
        // contact id is mandatory
        $requiredParams = [
            'cid' => 'Integer',
        ];

        $params = CRM_Core_Page_AJAX::validateParams($requiredParams);

        // load contact params
        $contactParams = ['id' => $params['cid']];
        $defaults = [];
        CRM_Contact_BAO_Contact::getValues($contactParams, $defaults);

        $html = CRM_Core_Smarty::singleton()->fetchWith('CRM/Collapsecommsanddemographics/PrivacyIcons.tpl', $defaults);

        CRM_Utils_JSON::output($html);
    }


    /**
     * Display icons for demographics options
     * @throws Exception
     */
    public static function getDemographics()
    {
        // contact id is mandatory
        $requiredParams = [
            'cid' => 'Integer',
        ];

        $params = CRM_Core_Page_AJAX::validateParams($requiredParams);

        // load contact params
        $contactParams = ['id' => $params['cid']];
        $defaults = [];
        CRM_Contact_BAO_Contact::getValues($contactParams, $defaults);

        $html = CRM_Core_Smarty::singleton()->fetchWith('CRM/Collapsecommsanddemographics/DemographicIcons.tpl', $defaults);

        CRM_Utils_JSON::output($html);

    }
}