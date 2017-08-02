<?php

class Stuntcoders_CustomerGroupTheme_Helper_Data extends Mage_Core_Helper_Abstract
{
    const THEME_MAP_CONFIG_PATH = 'design/theme/sc_customer_group_map';

    /**
     * @param mixed $store
     * @return array
     */
    public function getThemeMap($store = null)
    {
        $value = $this->_unserialize(Mage::getStoreConfig(self::THEME_MAP_CONFIG_PATH, $store));

        return $this->_decodeArrayFieldValue($value);
    }

    /**
     * @param mixed $value
     * @return array
     */
    protected function _unserialize($value)
    {
        if (is_string($value) && !empty($value)) {
            try {
                return Mage::helper('core/unserializeArray')->unserialize($value);
            } catch (Exception $e) {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * @param array $value
     * @return array
     */
    protected function _decodeArrayFieldValue($value)
    {
        $result = array();
        unset($value['__empty']);
        foreach ($value as $id => $row) {
            if (!is_array($row) || !array_key_exists('group_id', $row) || !array_key_exists('theme', $row)) {
                continue;
            }

            $result[$row['group_id']] = $row['theme'];
        }

        return $result;
    }
}
