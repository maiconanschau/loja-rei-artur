<?php
class CTXTable_Row extends CTXTable_Element {
    protected $columns = array();
    protected $parent = null;

    public function __construct($parent) {
        if (!is_object($parent) && !is_resource($parent)) return false;
        $this->parent = $parent;
    }

    public function addCol($value = null,$returnThis = false) {
        $args = func_get_args();
        
        $column = new CTXTable_Column($this);
        $this->columns[] = &$column;
        if (count($args) >= 1) {
            if (empty($value)) $value = '&nbsp;';
            $column->val($value);
        }
        return $returnThis ? $this : $column;
    }

    public function addHea($value = null,$returnThis = false) {
        $args = func_get_args();

        $column = new CTXTable_Header($this);
        $this->columns[] = &$column;
        if (count($args) >= 1) {
            if (empty($value)) $value = '&nbsp;';
            $column->val($value);
        }
        return $returnThis ? $this : $column;
    }

    public function parent() {
        return $this->parent;
    }

    public function __toString() {
        $args = func_get_args();
        $ident = isset($args[0]) ? $args[0] : 0;
        $this->ident = str_repeat("\t",$ident);

        $this->addString("<tr",true,false);

        if (count($this->attributes)) $this->addString(" ",false,false);
        foreach ($this->attributes as $name=>$value) {
            $this->addString(" $name=\"$value\"",false,false);
        }

        if (count($this->styles)) $this->addString(" style=\"",false,false);
        foreach ($this->styles as $name=>$value) {
            $this->addString("$name:$value;",false,false);
        }
        if (count($this->styles)) $this->addString("\"",false,false);
        $this->addString(">",false);

        foreach ($this->columns as $column) {
            $this->addString($column->__toString($ident+1),false);
        }

        $this->addString("</tr>");

        return $this->buffString;
    }
}