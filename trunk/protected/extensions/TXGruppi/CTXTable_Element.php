<?php
abstract class CTXTable_Element {
    protected $buffString = null;
    protected $ident = null;
    protected $attributes = array();
    protected $styles = array();

    public function css($styleName,$styleValue = null) {
        $args = func_get_args();

        if (is_array($styleName)) {
            foreach ($styleName as $k=>$v) {
                $this->css($k,$v);
            }
            return $this;
        }

        if (count($args) == 1 && isset($this->styles[$styleName])) return $this->styles[$styleName];

        $styleName = preg_replace("':$'","",$styleName);
        $styleValue = preg_replace(array("'^:'","';$'"),"",$styleValue);
        $this->styles[$styleName] = $styleValue;
        return $this;
    }

    public function attr($attrName,$attrValue = null) {
        $args = func_get_args();

        if (is_array($attrName)) {
            foreach ($attrName as $k=>$v) {
                $this->attr($k,$v);
            }
            return $this;
        }

        if (count($args) == 1 && isset($this->attributes[$attrName])) return $this->attributes[$attrName];

        if ($attrName == 'style') return $this;
        $this->attributes[$attrName] = $attrValue;
        return $this;
    }

    protected function addString($string,$ident = true,$newline = true) {
        if ($ident) $this->buffString .= $this->ident;
        $this->buffString .= preg_replace("'\s+$'","",$string);
        if ($newline) $this->buffString .= "\n";
    }

    public function __toString() {
        return null;
    }
}