<?php
class CTXTable_Column extends CTXTable_Element {
    protected $content = null;
    protected $parent = null;
    protected $nodeName = 'td';

    public function __construct($parent) {
        if (!is_object($parent) && !is_resource($parent)) return false;
        $this->parent = $parent;
    }

    public function val($content = null) {
        $args = func_get_args();

        if (count($args) == 0) return $this->content;
        if (empty($content)) $content = '&nbsp;';

        $this->content = $content;
        return $this;
    }

    public function parent() {
        return $this->parent;
    }

    public function __toString() {
        $args = func_get_args();
        $ident = isset($args[0]) ? $args[0] : 0;
        $this->ident = str_repeat("\t",$ident);

        $this->addString("<$this->nodeName",true,false);

        if (count($this->attributes)) $this->addString(" ",false,false);
        foreach ($this->attributes as $name=>$value) {
            $this->addString(" $name=\"$value\"",false,false);
        }

        if (count($this->styles)) $this->addString(" style=\"",false,false);
        foreach ($this->styles as $name=>$value) {
            $this->addString("$name:$value;",false,false);
        }
        if (count($this->styles)) $this->addString("\"",false,false);
        $this->addString(">",false,false);

        $this->addString($this->content,false,false);

        $this->addString("</$this->nodeName>",false);

        return $this->buffString;
    }
}