<?php

require_once 'cashentry.civix.php';
// phpcs:disable
use CRM_Cashentry_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_permission().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_permission/
 */
function cashentry_civicrm_permission(&$permissions) {
  // Create a permission to use Payment Processors of the type cash entry.
  $permissions += [
    'use Cash Entry Processors' => E::ts('Use Cash Entry Payment Processors'),
  ];
}

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 */
function cashentry_civicrm_preProcess($formName, &$form) {

  // If the logged in user does not have the permission use Cash Entry Processor
  if (!CRM_Core_Permission::check('use Cash Entry Processors')) {

    // If there are multiple payment processors and one of them is of the type cash entry, remove the cash entry processor.
    if (isset($form->_paymentProcessors)) {
      foreach ($form->_paymentProcessors as $key => $processorDetails) {
        if (!empty($processorDetails['api.payment_processor_type.getsingle']['class_name'])
        && $processorDetails['api.payment_processor_type.getsingle']['class_name'] == 'Payment_Cashentry') {
          unset($form->_paymentProcessors[$key]);
        }
      }

      // IF there is only one payment processor and it is of the type cash entry block access
      if (empty($form->_paymentProcessors)) {
        CRM_Core_Error::statusBounce(ts('Permission Denied, You must have the permission "Use Cash Entry Payment Processors" to access this page.'));
      }
    }
  }
}

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function cashentry_civicrm_config(&$config) {
  _cashentry_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function cashentry_civicrm_xmlMenu(&$files) {
  _cashentry_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function cashentry_civicrm_install() {
  _cashentry_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function cashentry_civicrm_postInstall() {
  _cashentry_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function cashentry_civicrm_uninstall() {
  _cashentry_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function cashentry_civicrm_enable() {
  _cashentry_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function cashentry_civicrm_disable() {
  _cashentry_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function cashentry_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _cashentry_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function cashentry_civicrm_managed(&$entities) {
  $entities[] = [
    'module' => 'com.aghstrategies.cashentry',
    'name' => 'Cash Entry',
    'entity' => 'PaymentProcessorType',
    'params' => [
      'version' => 3,
      'name' => 'Cashentry',
      'title' => 'Cash Entry',
      'description' => 'Cash Entry',
      'class_name' => 'Payment_Cashentry',
      'billing_mode' => 'form',
      'url_site_default' => 'https://notapplicable.com/',
      'url_site_test_default' => 'https://notapplicable.com/',
      'is_recur' => FALSE,
      'payment_type' => 3,
      'user_name_label' => 'Customer ID',
    ],
  ];
  _cashentry_civix_civicrm_managed($entities);
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
function cashentry_civicrm_caseTypes(&$caseTypes) {
  _cashentry_civix_civicrm_caseTypes($caseTypes);
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
function cashentry_civicrm_angularModules(&$angularModules) {
  _cashentry_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function cashentry_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _cashentry_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function cashentry_civicrm_entityTypes(&$entityTypes) {
  _cashentry_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function cashentry_civicrm_themes(&$themes) {
  _cashentry_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function cashentry_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
//function cashentry_civicrm_navigationMenu(&$menu) {
//  _cashentry_civix_insert_navigation_menu($menu, 'Mailings', array(
//    'label' => E::ts('New subliminal message'),
//    'name' => 'mailing_subliminal_message',
//    'url' => 'civicrm/mailing/subliminal',
//    'permission' => 'access CiviMail',
//    'operator' => 'OR',
//    'separator' => 0,
//  ));
//  _cashentry_civix_navigationMenu($menu);
//}
