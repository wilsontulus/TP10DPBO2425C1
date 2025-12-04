<?php

class FormSection {
    private $inputSection =
    "<div class=\"row mb-4\">
        <label class=\"col-md-2\">FORM_NAME:</label>
        <input class=\"col\" type=\"FORM_TYPE\" id=\"FORM_ID\" name=\"FORM_ID\" FORM_IS_REQUIRED FORM_IS_READONLY FORM_MIN_VALUE FORM_MAX_VALUE value=\"FORM_VALUE\">
    </div>";

    private $selectSection =
    "<div class=\"row mb-4\">
        <label class=\"col-md-2\">FORM_NAME</label>
        <select class=\"col\" name=\"FORM_ID\" FORM_IS_REQUIRED FORM_IS_READONLY>
            <option value=\"\">Pilih FORM_NAME...</option>
            FORM_OPTIONS
        </select>
    </div>";

    public function getInputSection($formName, $formType, $formId, $formValue="", $formRequired=false, $formReadOnly=false, $formMinValue=null, $formMaxValue=null) {
        $newSection = str_replace("FORM_NAME", $formName, $this->inputSection);
        $newSection = str_replace("FORM_TYPE", $formType, $newSection);
        $newSection = str_replace("FORM_ID", $formId, $newSection);
        $newSection = str_replace("FORM_VALUE", $formValue, $newSection);

        // Required attribute
        if (isset($formRequired) && $formRequired) {
            $newSection = str_replace("FORM_IS_REQUIRED", "required=yes", $newSection);
        } else {
            $newSection = str_replace("FORM_IS_REQUIRED", "", $newSection);
        }

        // Readonly attribute
        if (isset($formReadOnly) && $formReadOnly) {
            $newSection = str_replace("FORM_IS_READONLY", "readonly=yes", $newSection);
        } else {
            $newSection = str_replace("FORM_IS_READONLY", "", $newSection);
        }

        // Min value attribute
        if (isset($formMinValue)) {
            $newSection = str_replace("FORM_MIN_VALUE", "min=$formMinValue", $newSection);
        } else {
            $newSection = str_replace("FORM_MIN_VALUE", "", $newSection);
        }

        // Max value attribute
        if (isset($formMaxValue)) {
            $newSection = str_replace("FORM_MAX_VALUE", "max=$formMaxValue", $newSection);
        } else {
            $newSection = str_replace("FORM_MAX_VALUE", "", $newSection);
        }

        return $newSection;
    }

    public function getSelectSection($formName, $formId, $formValues=[], $formSelectedIndex=null, $formRequired=false, $formReadOnly=false) {
        $newSection = str_replace("FORM_NAME", $formName, $this->selectSection);
        $newSection = str_replace("FORM_ID", $formId, $newSection);
        
        $newFormOptions = "";
        foreach ($formValues as $idx => $value) {
            $newFormOptions .= "<option value=\"$idx\" VALUE_SELECTED >$value</option>";
            if (isset($formSelectedIndex) && $formSelectedIndex == $idx) {
                $newFormOptions = str_replace("VALUE_SELECTED", "selected", $newFormOptions);
            } else {
                $newFormOptions = str_replace("VALUE_SELECTED", "", $newFormOptions);
            }
        }

        $newSection = str_replace("FORM_OPTIONS", $newFormOptions, $newSection);

        // Required attribute
        if (isset($formRequired) && $formRequired) {
            $newSection = str_replace("FORM_IS_REQUIRED", "required=yes", $newSection);
        } else {
            $newSection = str_replace("FORM_IS_REQUIRED", "", $newSection);
        }

        // Readonly attribute
        if (isset($formReadOnly) && $formReadOnly) {
            $newSection = str_replace("FORM_IS_READONLY", "readonly=yes", $newSection);
        } else {
            $newSection = str_replace("FORM_IS_READONLY", "", $newSection);
        }
        return $newSection;
    }
}
?>