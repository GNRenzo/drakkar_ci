<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * @author		holivares
 * @copyright	Copyright (c) 2008 - 2011, inei.
 * @license		http://example.com/license.html
 * @since		Version 0.1
 * @filesource
 */
// ------------------------------------------------------------------------

/**
 * View Class
 * Representa una vista dentro del patron mvc. establece los recursos estaticos
 * a utlizarse al renderizar la vista para ser mostrada en el browser.
 *
 * @package		Microinei
 * @subpackage	core
 * @category	Core
 * @author		holivares
 */
abstract class FormBase {

    protected $_data = array();
    protected $_fields = array();
    public $attrs = array();
    public $_action = '';
    protected $_prefix = '';
    public $ci = NULL;

    public function get_prefix() {
        return $this->_prefix;
    }

    public function set_prefix($_prefix) {
        $this->_prefix = $_prefix;
    }

    public function __construct($params = array()) {
        if (is_array($params)) {
            if (array_key_exists('prefix', $params)) {
                $this->set_prefix($params['prefix']);
            }
            if (array_key_exists('attrs', $params)) {
                $this->set_attrs($params);
            }
            if (array_key_exists('data', $params)) {
                $data = $params['data'];
                $this->_data = array_key_exists($this->_prefix, $data) ? $data[$this->_prefix] : $data;
            }
        }
        $this->ci = & get_instance();
        $this->populateFields();
        $this->default_attrs();
    }

    public abstract function getFields();

    public function getData() {
        return $this->_data;
    }

    public function setData($data) {
        if (is_object($data)) {
            $data = (array) $data;
        }
        if (!is_array($data)) {
            return;
        }
        $this->_data = array_key_exists($this->_prefix, $data) ? $data[$this->_prefix] : $data;
    }

    /**
     *
     * @param type $attrs
     */
    public function setAttrs($attrs) {
        foreach ($attrs as $key => $value) {
            if ($key === 'action') {
                $this->_action = $value;
            } else {
                $this->attrs[$key] = $value;
            }
        }
    }

    public function getAttrs() {
        return $this->attrs;
    }

    public function fieldExists($field) {
        return array_key_exists($field, $this->_fields);
    }

    public function setFieldAttrs($field, $attrs) {
        if ($this->fieldExists($field)) {
            foreach ($attrs as $key => $value) {
                $f = $this->_fields[$field];
                $f->$key = $value;
            }
        }
    }

    public function setFieldsAttrs($attrs) {
        foreach ($attrs as $field => $values) {
            $this->setFieldAttrs($field, $values);
        }
    }

    /**
     * Devuelve la etiqueta de apertura HTML para el fomulario
     *
     * @return string
     */
    public function open_tag($data) {
        return form_open($this->_action, $data);
    }

    public function close_tag() {
        return '</form>';
    }

    public function get_action() {
        return $this->_action;
    }

    public function set_action($_action) {
        $this->_action = base_url() .  $_action;
    }

    protected function default_attrs() {
        $this->attrs = array();
        $this->attrs['name'] = $this->_prefix;
        $this->attrs['id'] = $this->_prefix . '_id';
        $this->attrs['method'] = 'POST';
        $this->attrs['class'] = 'formular';
        $this->_action = base_url();
    }

//    public abstract function save();

    public function __get($name) {
        if (array_key_exists($name, $this->_fields)) {
            return $this->_fields[$name];
        }
        return NULL;
    }

    public function __set($name, $value) {
        $this->_fields[$name] = $value;
    }

    protected abstract function getNameField($input);

    protected abstract function getIdField($input);

    protected function getHtmlNumberField($input, $inputs) {
        /* aqui buscar todos los campos para setearlos individualmente */
        $data = array('data-length' => $this->getLengthField($inputs));
        $type = $inputs['type'];
        if ($type === 'REAL') {
            $data['step'] = "any";
        }
        $data['name'] = $this->getNameField($input);
        $data['id'] = $this->getIdField($input);
        $data['class'] = $this->getClassField($inputs);
        $data['value'] = array_key_exists($input, $this->_data) ? trim($this->_data[$input]) : '';
        $data['type'] = 'number';
        $data['min'] = 0;
        $size = $this->getSizeField($inputs);
        if ($size > 0) {
            $data['size'] = $size;
        }
        $this->$input = (object) $data;
    }

    protected function getHtmlTextField($input, $inputs) {
        $data = array('maxlength' => $this->getLengthField($inputs));
        $data['name'] = $this->getNameField($input);
        $data['id'] = $this->getIdField($input);
        $data['class'] = $this->getClassField($inputs);
        $data['value'] = array_key_exists($input, $this->_data) ? trim($this->_data[$input]) : '';
        $data['type'] = 'text';
        $size = $this->getSizeField($inputs);
        if ($size > 0) {
            $data['size'] = $size;
        }
        $this->$input = (object) $data;
    }

    protected function getHtmlHiddenField($input, $inputs) {
        $data = array();

        $data['name'] = $this->getNameField($input);
        $data['id'] = $this->getIdField($input);
        $data['value'] = array_key_exists($input, $this->_data) ? $this->_data[$input] : '';
        $this->$input = (object) $data;
    }

    protected function getDropdownField($input, $inputs) {
        $data = array();
        $options = $this->getOptionsData($inputs);
        $data['name'] = $this->getNameField($input);
        $data['id'] = $this->getIdField($input);
        $data['class'] = $this->getClassField($inputs);
        $data['value'] = array_key_exists($input, $this->_data) ? $this->_data[$input] : '';
        $data['options'] = $options;
        $size = $this->getSizeField($inputs);
        if ($size > 0) {
            $data['size'] = $size;
        }
        if (array_key_exists('multiple', $inputs)) {
            $data['multiple'] = TRUE;
        }
        $this->$input = (object) $data;
    }

    protected function isMultiRow() {
        $count1 = count($this->_data);
        $count2 = count($this->_data, COUNT_RECURSIVE);
        return $count2 > $count1;
    }

    protected function getCheckboxField($input, $inputs) {
        $data = array();
        $key = array_key_exists($input, $this->_data) ? $this->_data[$input] : '';
        $options = $this->getOptionsData($inputs);
        $keys = array_keys($options);
        $values = array_values($options);
        $data['name'] = $this->getNameField($input);
        $data['id'] = $this->getIdField($input);
        $data['class'] = $this->getClassField($inputs);
        $data['value'] = count($keys) > 1 ? $keys[$key] : current($keys);
        $data['label'] = count($keys) > 1 ? $values[$key] : current($values);
        $data['type'] = 'checkbox';
        $this->$input = (object) $data;
    }

    protected function getRadioField($input, $inputs) {
        $data = array();
        $options = $this->getOptionsData($inputs);
        $data['name'] = $this->getNameField($input);
        $data['id'] = $this->getIdField($input);
        $data['class'] = $this->getClassField($inputs);
        $_value = array_key_exists($input, $this->_data) ? $this->_data[$input] : '';
        $data['value'] = $_value;
        $data['options'] = $options;
        $data['type'] = 'radio';
        $this->$input = (object) $data;
    }

    protected function isCheckbox($inputs) {
        $rpta = FALSE;
        if (array_key_exists('checkbox', $inputs)) {
            if (is_bool($inputs['checkbox'])) {
                $rpta = $inputs['checkbox'];
            }
        }
        return $rpta;
    }

    protected function isRadio($inputs) {
        $rpta = FALSE;
        if (array_key_exists('radio', $inputs)) {
            if (is_bool($inputs['radio'])) {
                $rpta = $inputs['radio'];
            }
        }
        return $rpta;
    }

    protected function isDropdown($inputs) {
        $rpta = FALSE;
        if (array_key_exists('dropdown', $inputs)) {
            if (is_bool($inputs['dropdown'])) {
                $rpta = $inputs['dropdown'];
            }
        }
        return $rpta;
    }

    protected function getOptionsData($inputs) {
        $options = array();
        if (array_key_exists('options', $inputs)) {
            if (is_array($inputs['options'])) {
                $options = $inputs['options'];
            }
        }
        return $options;
    }

    protected function getLengthField($inputs) {
        $length = 0;
        if (array_key_exists('length', $inputs)) {
            if ($inputs['length']) {
                $length = $inputs['length'];
            }
        }
        return $length;
    }

    protected function getSizeField($inputs) {
        $length = 0;
        if (array_key_exists('size', $inputs)) {
            if ($inputs['size']) {
                $length = $inputs['size'];
            }
        }
        return $length;
    }

    protected function getClassField($inputs, $default = 'form-control') {
        $class = FALSE;
        if (array_key_exists('class', $inputs)) {
            if ($inputs['class']) {
                $class = $inputs['class'];
            }
        }
        return $class ? $class : $default;
    }

    /*     * ******************************************************* */

    protected function getTextField($name, $inputs) {
        if ($this->isDropdown($inputs)) {
            $this->getDropdownField($name, $inputs);
        } else if ($this->isCheckbox($inputs)) {
            $this->getCheckboxField($name, $inputs);
        } else if ($this->isRadio($inputs)) {
            $this->getRadioField($name, $inputs);
        } else {
            $this->getHtmlTextField($name, $inputs);
        }
    }

    protected function getNumberField($name, $inputs) {
        if ($this->isDropdown($inputs)) {
            $this->getDropdownField($name, $inputs);
        } else if ($this->isCheckbox($inputs)) {
            $this->getCheckboxField($name, $inputs);
        } else if ($this->isRadio($inputs)) {
            $this->getRadioField($name, $inputs);
        } else {
            $this->getHtmlNumberField($name, $inputs);
        }
    }

    protected abstract function populateFields();

    protected abstract function setValue($field, $value);

    protected abstract function processData();

    protected function renderControl($type, $field, $label = FALSE) {
        $control = '';
        switch ($type) {
            case 'INPUT': {
                    $control = form_input($this->$field);
                }break;
            case 'RADIO': {
                    $control = form_radio_multiple($this->$field);
                    $label = FALSE;
                }break;
            case 'CHECKBOX': {
                    $control = form_checkbox($this->$field);
                }break;
            case 'HIDDEN': {
                    $control = form_hidden($this->$field->name, $this->$field->value, $this->$field->id);
                    $label = FALSE;
                }break;
            case 'DROPDOWN': {
                    $control = form_dropdown($this->$field);
                }break;
            case 'READONLY': {
                    $control = $this->$field->value;
                }break;
            default : {
                    $control = $this->$field->value;
                }
        }
        if ($label === TRUE) {
            return form_label($control, '', array('id' => 'la_' . $this->$field->id));
        }
        return $control;
    }

    /**
     * necesita renderizarse
     * necesita dibujar los campos
     * necesita validar los campos
     * necesita guardar los campos
     * necesita actualizar los campos
     * necesita pintar los valores
     */
}

abstract class Form extends FormBase {

    protected $_matrixFields = array();

    protected function getNameField($input) {
        $_name = sprintf('%s[%s]', $this->_prefix, $input);
        return $_name;
    }

    protected function getIdField($input) {
        $_id = sprintf('%s_%s', $this->_prefix, $input);
        return $_id;
    }

    protected function getHtmlMatrixField($inputs) {
//        foreach ($inputs as $key => $input) {
//            if (is_numeric($key)) {
//                $_input = str_replace('/', '_', $input);
//                $data = array_key_exists($_input, $this->_data) ? $this->_data[$_input] : array();
//                $instances = (!$data) ? array_key_exists('default_instances', $inputs) ? $inputs['default_instances'] : 0 : 0;
//                $extraParamsConstrutor = (array_key_exists('extra_constructor_params', $inputs)) ? $inputs['extra_constructor_params'] : array();
//                $constructorParams = array_merge(array('prefix' => $this->_prefix, 'matrix' => $_input, 'data' => $data, 'instances' => $instances), $extraParamsConstrutor);
//                    $form = Model::createForm($constructorParams, TRUE);
//                $form = new FormMatrix($constructorParams);
//                $this->$_input = $form;
//                $this->$_input->_fk = $this->getFkFields($inputs);
//                $this->_matrixFields[] = $_input;
//            }
//        }
    }

    public function __get($name) {
        if (in_array($name, $this->_matrixFields)) {
            $field = $this->_fields[$name];
            return $field;
        } else if (array_key_exists($name, $this->_fields)) {
            $this->setValue($name, '');
            return $this->_fields[$name];
        }
        return NULL;
    }

    public function setData($data) {
        $data = parent::setData($data);
        foreach ($this->_matrixFields as $mField) {
            $mdata = array_key_exists($mField, $this->_data) ? $this->_data[$mField] : array();
            $this->$mField->setData($mdata);
        }
    }

    protected function populateFields() {
        $type = NULL;
        foreach ($this->getFields() as $name => $fields_or_attr) {
            if (!$fields_or_attr) {
                continue;
            }
            if (array_key_exists('type', $fields_or_attr)) {
                $type = $fields_or_attr['type'];
            }
            if ($type === 'INTEGER' || $type === 'REAL') {
                $this->getNumberField($name, $fields_or_attr);
            } else if ($type === 'TEXT') {
                $this->getTextField($name, $fields_or_attr);
            } else if ($type === 'MATRIX') {
                $this->getHtmlMatrixField($name, $fields_or_attr);
            }
        }
    }

    protected function getFkFields($inputs) {
        $rpta = array();
        if (array_key_exists('fk', $inputs)) {
            if (is_array($inputs['fk'])) {
                $rpta = $inputs['fk'];
            }
        }
        return $rpta;
    }

    public function getFKData($fks) {
        $wherePK = array();
        foreach ($fks as $fk => $pk) {
            if (array_key_exists($pk, $this->_data)) {
                $wherePK[$fk] = $this->_data[$pk];
            }
        }
        return $wherePK;
    }

    private function _getMatrixFields($item) {
        return $item instanceof FormMatrix;
    }

    private function getMatrixFields() {
        $fields = array_keys(array_filter($this->_fields, array($this, '_getMatrixFields')));
        return $fields;
    }

    private function _setDataSaveMatrix(&$item, $key, $fkFields) {
        $item = array_merge($item, $fkFields);
    }

    private function _saveMatrix(&$data, $field) {
        $fkFields = $this->getFKData($this->$field->_fk);
        array_walk($data, array($this, '_setDataSaveMatrix'), $fkFields);
    }

    protected function saveMatrix($matrixData) {
        $rpta = TRUE;
        if ($matrixData) {
            array_walk($matrixData, array($this, '_saveMatrix'));
            foreach ($matrixData as $field => $data) {
                $this->$field->setData($data);
                $rpta = $rpta & $this->$field->save(TRUE);
            }
        }
        return $rpta;
    }

    protected function processMatrixData($matrixFields) {
        $matrixData = array();
        foreach ($matrixFields as $field) {
            if (array_key_exists($field, $this->_data)) {
                $matrixData[$field] = $this->_data[$field];
            }
        }
        return $matrixData;
    }

    protected function processData() {
        $keys = array_keys($this->getFields());
        $fvars = array_fill_keys($keys, NULL);
        $data = array_merge($fvars, $this->_data);
        return $data;
    }

//    public function save() {
//        $matrixFields = $this->_matrixFields;
//        $data = $this->processData();
//        $matrixData = $this->processMatrixData($matrixFields);
//        //si hay claves autonumericas deberian cogerse en este momento
//        $this->ci->load->model('common');
//        $save1 = $this->ci->common->save($data, TRUE);
//        $save2 = $this->saveMatrix($matrixData);
//        return $save1 & $save2;
//    }

    protected function setValue($field, $value) {
        $type = '';
//        var_dump($field, $value);
        if (property_exists($this->_fields[$field], 'type')) {
            $type = $this->_fields[$field]->type;
        }
        $value = array_key_exists($field, $this->_data) ? $this->_data[$field] : '';
        if (!in_array($type, array('checkbox',))) {
            $this->_fields[$field]->value = $value;
        } else {
            if ($this->_fields[$field]->value == trim($value)) {
                $this->_fields[$field]->checked = 'checked';
            }
        }
    }

}

abstract class FormMatrix extends FormBase implements Iterator {

    private $_matrix = NULL;
    private $_pos = NULL;
    private $_instances = 0;
    protected $_fk = array();
    private $_useFlagSave = FALSE;

    public function __construct($params) {
        $this->_matrix = array_key_exists('matrix', $params) ? $params['matrix'] : 'array';
        $this->_pos = array_key_exists('pos', $params) ? $params['pos'] : '__form__';
        $this->_instances = array_key_exists('instances', $params) ? $params['instances'] : 0;
        parent::__construct($params);
        if (array_key_exists($this->_matrix, $this->_data)) {
            $this->_data = $this->_data[$this->_matrix];
        }
        $this->setInitialValues();
    }

    public function getFields() {

    }

    protected function setInitialValues() {
        if (count($this->_data) > 0) {
            return;
        }
        if ($this->_instances > 0) {
            $this->_data = range(0, $this->_instances - 1);
        }
    }

    protected function getNameField($input) {
        $_name = sprintf('%s[%s][%s][%s]', $this->_prefix, $this->_matrix, $this->_pos, $input);
        return $_name;
    }

    public function setData($data) {
        parent::setData($data);
        $this->_data = array_key_exists($this->_matrix, $this->_data) ? $this->_data[$this->_matrix] : $this->_data;
    }

    protected function getIdField($input) {
        $_id = sprintf('%s_%s_%s_%s', $this->_prefix, $this->_matrix, $this->_pos, $input);
        return $_id;
    }

    protected function populateJsonValidate($scenario = FALSE) {
        $_rules = ($scenario) ? $this->getModelRules($scenario) : $this->_model->getRules();
        $rules = array();
        foreach ($_rules as $rule) {
            unset($rule['scenario']);
            $_fields = array_filter(array_keys($rule), create_function('$item', 'return is_numeric($item)===TRUE;'));
            $_keys = array_filter(array_keys($rule), create_function('$item', 'return is_numeric($item)===FALSE;'));
            $attrs = array_intersect_key($rule, array_flip($_keys));
            $fields = array_intersect_key($rule, array_flip($_fields));
            foreach ($fields as $field) {
                $rules[$field] = $attrs;
            }
        }
        return $rules;
    }

    protected function populateFields() {
        $length = NULL;
        $type = NULL;
        foreach ($this->getFields() as $fields_or_attr) {
            if (!$fields_or_attr) {
                continue;
            }
            if (array_key_exists('type', $fields_or_attr)) {
                $type = $fields_or_attr['type'];
            } else {
                throw new Exception('Debe especificar el tipo del campo');
            }
            if (array_key_exists('length', $fields_or_attr)) {
                $length = $fields_or_attr['length'];
            }
            if ($type === 'INTEGER' || $type === 'REAL') {
                $this->getNumberField($fields_or_attr, $length);
            } else if ($type === 'TEXT') {
                $this->getTextField($fields_or_attr, $length);
            }
        }
    }

    private function objectToArrayValues($object) {
        if (is_object($object)) {
            return (array) $object;
        }
        return $object;
    }

    protected function setDefaultValues($key) {
        foreach ($this->_fields as $namefield => $field) {
            if (is_object($field)) {
                $field->name = str_replace($this->_pos, $key, $this->getNameField($namefield));
                $field->id = str_replace($this->_pos, $key, $this->getIdField($namefield));
            }
        }
    }

    protected function setCurrentValues($key, $values) {
        foreach ($this->_fields as $fieldName => &$field) {
            if (is_object($field)) {
                $value = array_key_exists($fieldName, $values) ? $values[$fieldName] : NULL;
                $this->setValue($fieldName, trim($value));
                $field->name = str_replace($this->_pos, $key, $this->getNameField($fieldName));
                $field->id = str_replace($this->_pos, $key, $this->getIdField($fieldName));
            }
        }
    }

    public function current() {
        //var_dump($this->_data);exit;
        $_values = current($this->_data);
        $key = $this->key();
        $values = $this->objectToArrayValues($_values);
        if (is_array($values)) {
            $this->setCurrentValues($key, $values);
        } else {
            $this->setDefaultValues($key);
        }
        return $this;
    }

    public function key() {
        $key = key($this->_data);
        return $key;
    }

    protected function setValue($field, $value) {
        if (property_exists($this->$field, 'type')) {
            if (in_array($this->$field->type, array('checkbox'))) {
                if ($value == $this->$field->value) {
                    $this->$field->checked = TRUE;
                } else {
                    unset($this->$field->checked);
                }
            } else {
                //$this->$field->value = $value;
                $this->setValueOptional($field, $value);
            }
        } else {
            $this->$field->value = $value;
        }
    }

    protected function setValueOptional($field, $value) {
        if (isset($this->$field->optional)) {
            $values = array_keys($this->$field->optional);
            if (in_array($value, $values)) {
                $optField = $field . '_OPTIONAL';
                $this->$optField->value = $value;
                $this->$field->value = '';
            } else {
                $this->$field->value = $value;
            }
        } else {
            $this->$field->value = $value;
        }
    }

    public function next() {
        $_values = next($this->_data);
        $key = $this->key();
        $values = $this->objectToArrayValues($_values);
        if (is_array($values)) {
            $this->setCurrentValues($key, $values);
        } else if ($values) {
            $this->setDefaultValues($key);
        }
        return $this;
    }

    public function rewind() {
        reset($this->_data);
    }

    public function valid() {
        $key = key($this->_data);
        $var = ($key !== NULL && $key !== FALSE && is_numeric($key) === TRUE);
        return $var;
    }

    public function getIterator() {
        return $this;
    }

    public function add($value) {
        $this->items[$this->count++] = $value;
    }

    private function parseAttr($array) {
        $attr = '';
        if ($array !== NULL) {
            foreach ($array as $key => $val) {
                $attr .= $key . '="' . $val . '" ';
            }
        }
        return $attr;
    }

    /**
     * Tipo de columna debe ser input, select, radio, checkbox, readonly
     * @param type $tr
     * @param type $td
     * @return string
     */
    private function getPrototypeType(&$attrs) {
        $type = FALSE;
        if (array_key_exists('type', $attrs)) {
            $type = $attrs['type'];
            unset($attrs['type']);
        }
        return $type;
    }

    private function getPrototypeJoin(&$attrs) {
        $join = FALSE;
        if (array_key_exists('joinTo', $attrs)) {
            $join = $attrs['joinTo'];
            unset($attrs['joinTo']);
        }
        return $join;
    }

    public function prototypeHtmlTr($tr = array(), $td = array()) {
        $html = "<tr " . $this->parseAttr($tr) . ">";
        foreach ($td as $field => $attrs) {
            $type = $this->getPrototypeType($attrs);
            $joinField = $this->joinFields($type, $attrs);
            $this->setFieldAttrs($field, $attrs);
            if ($type) {
                $control = $this->renderControl($type, $field, TRUE) . $joinField;
                $html .= "<td>" . $control . "</td>";
            }
        }
        $html .= '</tr>';
        return $html;
    }

    public function joinFields($type, &$attrs) {
        $joinField = $this->getPrototypeJoin($attrs);
        $control = '';
        if (is_array($joinField)) {
            $type = array_key_exists('type', $joinField) ? $joinField['type'] : $type;
            unset($joinField['type']);
            foreach ($joinField as $_field) {
                $this->setFieldAttrs($_field, $attrs);
                $control .= $this->renderControl($type, $_field, TRUE);
            }
        } else if ($joinField) {
            $this->setFieldAttrs($joinField, $attrs);
            $this->_fields[$joinField]->class;
            $control .= $this->renderControl($type, $joinField, TRUE);
        }
        return $control;
    }

    protected function _save(&$item) {
        $mustSave = $this->_useFlagSave ? array_key_exists('FLAG_SAVE', $item) : TRUE;
        if (!$this->_useFlagSave) {
            unset($item['FLAG_SAVE']);
        }
        $item = $mustSave ? $item : NULL;
    }

//    public function save($fillFields = FALSE) {
//        $data = $this->processData();
////        if ($fillFields === TRUE) {
//        array_walk($data, array($this, '_save'));
////        }
//        return $this->_model->save($data, TRUE);
//    }

    private function _processData(&$data, $key, $fields) {
//        $data=array($data);
        //var_dump($data);
        //exit();
        foreach ($fields as $field) {
            if (array_key_exists($field . '_OPTIONAL', $data)) {
                $data[$field] = $data[$field . '_OPTIONAL'];
                unset($data[$field . '_OPTIONAL']);
            }
        }
    }

    protected function processData() {
        $_fields = array_keys($this->_fields);
        $oFields = $this->getOptionalFields();
        $fields = array_diff($_fields, $oFields);
        $_data = clone  $this->_data;
        $data = (array) $_data;
        array_walk($data, array($this, '_processData'), $fields);
        return $data;
    }

    public function get_useFlagSave() {
        return $this->_useFlagSave;
    }

    public function set_useFlagSave($_useFlagSave) {
        $this->_useFlagSave = $_useFlagSave;
    }

}

class FormLib {

}
