<?php
/**
 * Classe geradora de tabela
 *
 */
class CTXTable extends CTXTable_Element {
    protected $rows = array();

    public function addRow() {
        $row = new CTXTable_Row($this);
        $this->rows[] = &$row;
        return $row;
    }

    public function __toString() {
        $args = func_get_args();
        $ident = isset($args[0]) ? $args[0] : 0;
        $this->ident = str_repeat("\t",$ident);

        $this->addString("<table",true,false);

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

        foreach ($this->rows as $row) {
            $this->addString($row->__toString($ident+1),false);
        }

        $this->addString("</table>");

        return $this->buffString;
    }
}