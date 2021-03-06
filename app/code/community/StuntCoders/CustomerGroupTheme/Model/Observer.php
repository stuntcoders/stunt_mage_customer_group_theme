<?php

class StuntCoders_CustomerGroupTheme_Model_Observer
{
    /**
     * @param Varien_Event_Observer $observer
     */
    public function setTheme(Varien_Event_Observer $observer)
    {
        $map = $this->_getHelper()->getThemeMap();
        $groupId = $this->_getCustomerGroupId(); Mage::helper('customer')->getCustomer()->getGroupId();

        if (isset($map[$groupId]) && !empty($map[$groupId])) {
            $arr = explode('/', $map[$groupId]);
            if (isset($arr[1])) {
                Mage::getDesign()->setPackageName($arr[0])->setTheme($arr[1]);
            } else {
                Mage::getDesign()->setTheme($map[$groupId]);
            }
        }
    }

    /**
     * @return int
     */
    protected function _getCustomerGroupId()
    {
        if (!$this->_getCustomerHelper()->isLoggedIn()) {
            return Mage_Customer_Model_Group::NOT_LOGGED_IN_ID;
        }

        return $this->_getCustomerHelper()->getCustomer()->getGroupId();
    }

    /**
     * @return StuntCoders_CustomerGroupTheme_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('stuntcoders_customergrouptheme');
    }

    /**
     * @return Mage_Customer_Helper_Data
     */
    protected function _getCustomerHelper()
    {
        return Mage::helper('customer');
    }
}
