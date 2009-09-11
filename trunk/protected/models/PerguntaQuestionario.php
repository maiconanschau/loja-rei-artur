<?php

class PerguntaQuestionario extends CActiveRecord {
/**
 * The followings are the available columns in table 'PerguntaQuestionario':
 * @var integer $idPergunta
 * @var string $textoPergunta
 * @var integer $tipoPergunta
 * @var integer $ordemPergunta
 * @var integer $ativoPergunta
 */

    const TIPO_TEXTFIELD = 1;
    const TIPO_TEXTAREA = 2;
    const TIPO_SELECT = 3;
    const TIPO_CHECKBOX = 4;
    const TIPO_RADIO = 5;

    public $opcoesPergunta;
    public $_fieldName;
    public $_formMethod;
    public $_options;
    public $_value;

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'PerguntaQuestionario';
    }

    public function getTipoOptions() {
        return array(
        self::TIPO_TEXTFIELD=>'Campo de texto',
        self::TIPO_TEXTAREA=>'Caixa de texto',
        self::TIPO_SELECT=>'Lista de seleção',
        self::TIPO_CHECKBOX=>'Campo de seleção multipla',
        self::TIPO_RADIO=>'Campo de seleção unica',
        );
    }

    public function getTipoText() {
        $options = $this->getTipoOptions();
        return isset($options[$this->tipoPergunta]) ? $options[$this->tipoPergunta] : "desconhecido ({$this->tipoPergunta})";
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        array('textoPergunta','length','max'=>255),
        array('textoPergunta, tipoPergunta', 'required'),
        array('tipoPergunta, ordemPergunta, ativoPergunta', 'numerical', 'integerOnly'=>true),
        array('opcoesPergunta','opcaoValida','on'=>'save'),
        );
    }

    public function opcaoValida($attribute,$params) {
        if (in_array($this->tipoPergunta, array(3,4,5))) {
            if (empty($this->opcoesPergunta)) {
                $this->addError($attribute, "Você deve informar as opções da pergunta");
            }
        }
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
        return array(
        'opcoes'=>array(self::HAS_MANY,'OpcaoPergunta','idPergunta'),
        'respostas'=>array(self::HAS_MANY,'RespostaQuestionario','idPergunta'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
        'idPergunta' => 'Id',
        'textoPergunta' => 'Texto',
        'tipoPergunta' => 'Tipo',
        'ordemPergunta' => 'Ordem',
        'ativoPergunta' => 'Ativo',
        );
    }

    public function getOpcoes() {
        $opcoes = explode("\n",$this->opcoesPergunta);
        foreach ($opcoes as &$v) {
            $temp = new OpcaoPergunta();
            $temp->valorOpcao = $v;
            $v = $temp;
        }
        return $opcoes;
    }

    public function beforeValidate() {
        if (empty($this->scenario)) {
            $this->scenario = "save";
        }
        return true;
    }
}