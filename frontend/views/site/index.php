<?php

/** @var yii\web\View $this */
/** @var integer $count */
/** @var \frontend\models\HappyTicketForm $model */

use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <div class="col-lg-8">
                <h2>Happy Ticket</h2>

                <?php $form = ActiveForm::begin(["method" => "GET"]) ?>
                    <?= $form->field($model, "minValue") ?>
                    <?= $form->field($model, "maxValue") ?>

                <div class="count">
                    <b>Number of tickets: </b> <?= $count ?>
                </div>
                <button class="btn btn-success" type="submit">Run</button>
                <?php if(is_numeric($count) && $count >= 0) { ?>
                    <a class="btn btn-dark" href="<?= \yii\helpers\Url::to("site/index") ?>">Clear</a>
                <?php } ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>

    </div>
</div>
