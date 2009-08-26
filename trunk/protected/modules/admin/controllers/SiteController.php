<?php
class SiteController extends CController {
    public $defaultAction='sobre';

    public function actionLogin() {
        CTXSession::open();
        if (Yii::app()->request->isPostRequest) {
            $senha = Yii::app()->request->getPost('senha');

            $num = $_SESSION['login']['num'];
            $diak = array_shift($num);
            $mesk = array_shift($num);
            $anok = array_shift($num);
            $dia = date('d');
            $mes = date('m');
            $ano = date('Y');

            $diak += ($diak % 2 == 0 ? +$dia : -$dia);
            $mesk += ($mesk % 2 == 0 ? +$mes : -$mes);
            $anok  = ($anok % 2 == 0 ? $ano+$anok : $ano-$anok);

            if ($diak <= 9) $diak = "0$diak";
            if ($mesk <= 9) $diak = "0$mesk";

            $chave = $diak.$mesk.$anok;
            if ($chave == $senha) {
                $identity = new UserIdentity('admin','admin');
                Yii::app()->user->login($identity,0);
                $this->redirect(array('/admin/'));
            } else {
                CTXFeedback::addError("Login inválido.");
            }
        }

        $num = array(rand(31, 62),rand(12, 24),rand(10, 99));
        $_SESSION['login']['num'] = $num;
        $this->render('login',array(
            'num'=>implode(" ",$num)
        ));
    }

    /**
     * Logout the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionSobre() {
        $this->render('sobre');
    }
}