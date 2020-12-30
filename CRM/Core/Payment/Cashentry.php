<?php

use CRM_Tsys_ExtensionUtil as E;

/**
 * Payment Processor class for Tsys
 */
class CRM_Core_Payment_Cashentry extends CRM_Core_Payment {

  /**
   * We only need one instance of this object. So we use the singleton
   * pattern and cache the instance in this variable
   *
   * @var object
   * @static
   */
  static private $_singleton = NULL;

  /**
   * Mode of operation: live or test.
   *
   * @var object
   */
  protected $_mode = NULL;

  /**
   * TRUE if we are dealing with a live transaction
   *
   * @var boolean
   */
  private $_islive = FALSE;

  /**
   * We can use the smartdebit processor on the backend
   * @return bool
   */
  public function supportsBackOffice() {
    return FALSE;
  }

  public function supportsRecurring() {
    return FALSE;
  }

  /**
   * Constructor
   *
   * @param string $mode
   *   The mode of operation: live or test.
   *
   * @param object $paymentProcessor
   *
   * @return void
   */
  public function __construct($mode, &$paymentProcessor) {
    $this->_mode = $mode;
    $this->_islive = ($mode == 'live') ? 1 : 0;
    $this->_paymentProcessor = $paymentProcessor;
    $this->_processorName = ts('Cash Entry');
  }

  /**
  * This function checks to see if we have the right config values.
  *
  * @return string
  *   The error message if any.
  *
  * @public
  */
 public function checkConfig() {
   return NULL;
 }

 /**
  * No form entry fields needed
  * @return array array of fields needed to process payment
  */
 public function getPaymentFormFields() {
  return [];
 }

  /**
   * Process payment
   *
   * @param array $params
   *   Assoc array of input parameters for this transaction.
   *
   * @param string $component
   *
   * @return array
   *   Result array
   *
   * @throws \Civi\Payment\Exception\PaymentProcessorException
   */
  public function doPayment(&$params, $component = 'contribute') {
    // Create a completed contribution
    $completedStatusId = CRM_Core_PseudoConstant::getKey('CRM_Contribute_BAO_Contribution', 'contribution_status_id', 'Completed');
    $params['payment_status_id'] = $params['contribution_status_id'] = $completedStatusId;
    return $params;
  }

}
