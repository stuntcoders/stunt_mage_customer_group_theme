<?php

class StuntCoders_CustomerGroupTheme_Block_Form_Field_Customergroup extends Mage_Core_Block_Html_Select
{
    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        if (empty($this->_options)) {
            $collection = Mage::getModel('customer/group')->getCollection();

            foreach ($collection as $item) {
                $this->addOption($item->getId(), addslashes($item->getCustomerGroupCode()));
            }
        }

        return $this->_options;
    }

    public function setInputName($value)
    {
        return $this->setName($value);
    }
}
