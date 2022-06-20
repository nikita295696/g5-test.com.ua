<?php

namespace frontend\models;

use yii\base\Model;
use yii\web\BadRequestHttpException;

/**
 * @property integer $minValue
 * @property integer $maxValue
 * @property integer $count
*/
class HappyTicketForm extends Model {

    public $minValue;
    public $maxValue;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['minValue', 'maxValue',], 'required'],
            [['minValue', 'maxValue', ], 'number', 'min'=>1, 'max'=>999999],
        ];
    }

    public function attributeLabels()
    {
        return [
            'minValue' => "N - from",
            'maxValue' => "N - to",
        ];
    }

    // получение кол-ва счастливых билетов в пределах максимального и минимального значения
    public function getCountHappyTicket()
    {
        $min = $this->minValue;
        $max = $this->maxValue;
        if($max < $min){
            throw new BadRequestHttpException("maxValue should be more minValue");
        }

        // минимально число должно быть минимальным 4-кратным - 1001
        if($min <= 1001) $min = 1001;
        if($max > 999999) $max = 999999;

        $count = 0;

        for($i = $min; $i <= $max; $i++){
            $iText = $this->formatNumeric($i);


            $arr = str_split($iText, 3);

            if($this->isHappy($arr[0], $arr[1])) $count++;

        }

        return $count;
    }

    // форматирование 3 и 5 кратных чисел
    private function formatNumeric($iText){
        switch (strlen($iText)){
            case 4:
                $iText = '00' . $iText;
                break;
            case 5:
                $iText = 0 . $iText;
                break;
        }

        return $iText;
    }

    // метод проверки на одинаковые значения 2-х чисел
    public function isHappy($numLeft, $numRight){

        return $this->countNum($numLeft) == $this->countNum($numRight);
    }

    // метод суммирования числа
    public function countNum($num){
        $strNum = $num .= "";
        $res = array_sum(str_split($strNum));
        if($res > 9){
            $res = $this->countNum($res);
        }

        return $res;
    }
}