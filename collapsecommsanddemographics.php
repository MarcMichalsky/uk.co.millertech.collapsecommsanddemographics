<?php

require_once 'collapsecommsanddemographics.civix.php';

// phpcs:disable
use CRM_Collapsecommsanddemographics_ExtensionUtil as E;

// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function collapsecommsanddemographics_civicrm_config(&$config)
{
    _collapsecommsanddemographics_civix_civicrm_config($config);

    static $configured = FALSE;
    if ($configured) {
        return;
    }
    $configured = TRUE;


    $smarty = CRM_Core_Smarty::singleton();
    if (!file_exists(Civi::paths()->getPath('[civicrm.root]/CRM/Core/Smarty/plugins/function.privacyFlag.php'))) {
        // add Core smarty plugin if not there
        array_push($smarty->plugins_dir, E::path('CRM/Collapsecommsanddemographics/Core/Smarty/Plugins'));
    }
    array_push($smarty->plugins_dir, E::path('CRM/Collapsecommsanddemographics/Smarty/Plugins'));
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function collapsecommsanddemographics_civicrm_install()
{
    _collapsecommsanddemographics_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function collapsecommsanddemographics_civicrm_enable()
{
    _collapsecommsanddemographics_civix_civicrm_enable();
}

/**
 * Add icon field to Gender Option admin form
 * @param $formName
 * @param CRM_Admin_Form_Options $form
 */
function collapsecommsanddemographics_civicrm_buildForm($formName, &$form)
{
    // if gender option admin page, add icon field
    // as of 5.28.0 icon field wasn't added by core so add here
    // don't need to use postProcess as the icon is automatically saved by core
    if ($formName == 'CRM_Admin_Form_Options' && $form->_action !== CRM_Core_Action::DELETE &&
        $form->getVar('_gName') === 'gender') {
        if (!$form->elementExists('icon')) {
            $form->add('text', 'icon', ts('Icon'), ['class' => 'crm-icon-picker', 'title' => ts('Choose Icon'), 'allowClear' => TRUE]);
        }
    }
}

/**
 * Update templates for Communication Preferences and Demographics on contact summary screen
 * @param $page
 * @throws CRM_Core_Exception
 */
function collapsecommsanddemographics_civicrm_pageRun(&$page)
{
    $pageName = $page->getVar('_name');
    $pageAction = $page->getVar('_action');
    if ($pageName == 'CRM_Contact_Page_View_Summary' && ($pageAction == CRM_Core_Action::BROWSE || $pageAction == CRM_Core_Action::VIEW)) {
        CRM_Core_Region::instance('contact-comm-pref')->update('default', array(
            'disabled' => TRUE,
        ));
        CRM_Core_Region::instance('contact-comm-pref')->add(array(
            'template' => 'CRM/Collapsecommsanddemographics/Page/CollapseComms.tpl',
        ));

        CRM_Core_Region::instance('contact-demographic')->update('default', array(
            'disabled' => TRUE,
        ));
        CRM_Core_Region::instance('contact-demographic')->add(array(
            'template' => 'CRM/Collapsecommsanddemographics/Page/CollapseDemographics.tpl',
        ));

        CRM_Core_Resources::singleton()->addStyle('
            #crm-container .collapsedcommsanddemos { margin-bottom: 10px; overflow: auto; } 
            #crm-container .collapsedcommsanddemos.ccnd-demos .ccnd_demo_extra_content { display: inline; box-sizing: border-box; }'
        );

        // fix for versions below 5.27.0 which has background icon for privacy flag
        if (version_compare(CRM_Utils_System::version(), '5.27.0') === -1) {
            CRM_Core_Resources::singleton()->addStyle('#crm-container .collapsedcommsanddemos span.privacy-flag { background: none; font-size: 80%; }');
        }

    }
}

/**
 * Implements hook_civicrm_contactSummaryBlocks().
 *
 * @link https://github.com/civicrm/org.civicrm.contactlayout
 */
function collapsecommsanddemographics_civicrm_contactSummaryBlocks(&$blocks)
{
    // change tpl files
    foreach ($blocks['core']['blocks'] as $key => &$block) {
        if ($key == 'Demographics')
            $block['tpl_file'] = 'CRM/Collapsecommsanddemographics/Page/CollapseDemographics.tpl';
        else if ($key == 'CommunicationPreferences')
            $block['tpl_file'] = 'CRM/Collapsecommsanddemographics/Page/CollapseComms.tpl';

    }
}
