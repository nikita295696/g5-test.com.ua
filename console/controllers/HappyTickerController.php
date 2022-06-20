<?php


namespace console\controllers;


use frontend\models\HappyTicketForm;
use yii\console\Controller;

class HappyTickerController extends Controller
{
    public function actionCountNum($num){
        $form = new HappyTicketForm();
        echo $form->countNum($num);
    }

    public function actionHappy($num1, $num2){
        $form = new HappyTicketForm();
        echo ($form->isHappy($num1, $num2) ? "is happy" : "not happy");
    }

    public function actionTotalCount($min, $max){
        $form = new HappyTicketForm();
        $form->minValue = $min;
        $form->maxValue = $max;
        echo $form->getCountHappyTicket();
    }
}