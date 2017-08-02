<?php

class StuntCoders_CustomerGroupTheme_Block_Form_Field_Array extends
    Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    protected function _prepareToRender()
    {
        $this->addColumn('group_id', array(
            'label' => Mage::helper('adminhtml')->__('Customer Group'),
            'renderer' => $this->_getGroupRenderer(),
        ));

        $this->addColumn('theme', array(
            'label' => Mage::helper('adminhtml')->__('Theme'),
            'style' => 'width:250px',
        ));

        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('adminhtml')->__('Add Rule');

        parent::_prepareToRender();
    }

    /**
     * @return StuntCoders_CustomerGroupTheme_Block_Form_Field_Customergroup
     */
    protected function _getGroupRenderer()
    {
        if (!$this->getData('_renderer')) {
            $renderer = $this->getLayout()->createBlock(
                'stuntcoders_customergrouptheme/form_field_customergroup',
                '',
                array('is_render_to_js_template' => true)
            );

            $renderer->setClass('customer_group_select');
            $renderer->setExtraParams('style="width:150px"');

            $this->setData('_renderer', $renderer);
        }

        return $this->getData('_renderer');
    }

    /**
     * {@inheritdoc}
     */
    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
            'option_extra_attr_' . $this->_getGroupRenderer()->calcOptionHash($row->getData('group_id')),
            'selected="selected"'
        );
    }
}
