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
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function collapsecommsanddemographics_civicrm_xmlMenu(&$files)
{
    _collapsecommsanddemographics_civix_civicrm_xmlMenu($files);
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
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function collapsecommsanddemographics_civicrm_postInstall()
{
    _collapsecommsanddemographics_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function collapsecommsanddemographics_civicrm_uninstall()
{
    _collapsecommsanddemographics_civix_civicrm_uninstall();
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
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function collapsecommsanddemographics_civicrm_disable()
{
    _collapsecommsanddemographics_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function collapsecommsanddemographics_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL)
{
    return _collapsecommsanddemographics_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function collapsecommsanddemographics_civicrm_managed(&$entities)
{
    _collapsecommsanddemographics_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function collapsecommsanddemographics_civicrm_caseTypes(&$caseTypes)
{
    _collapsecommsanddemographics_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function collapsecommsanddemographics_civicrm_angularModules(&$angularModules)
{
    _collapsecommsanddemographics_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function collapsecommsanddemographics_civicrm_alterSettingsFolders(&$metaDataFolders = NULL)
{
    _collapsecommsanddemographics_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function collapsecommsanddemographics_civicrm_entityTypes(&$entityTypes)
{
    _collapsecommsanddemographics_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function collapsecommsanddemographics_civicrm_themes(&$themes)
{
    _collapsecommsanddemographics_civix_civicrm_themes($themes);
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