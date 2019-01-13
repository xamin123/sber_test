<?php
declare(strict_types=1);

/* @var $this yii\web\View */
/* @var $report \app\models\WeatherReport */
/* @var $dateFrom DateTimeImmutable*/
/* @var $dateTo DateTimeImmutable*/
/* @var $weatherForm \app\models\WeatherReportForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin(
    [
        'id' => 'weather-report-form',
        'method' => 'get',
        'action' => \yii\helpers\Url::to('weather-report'),
        'options' => [
            'class' => 'form-horizontal',
        ]
]); ?>

<?= $form->field($weatherForm, 'dateFrom')->textInput(['autofocus' => true, 'placeholder' => '2019-11-01'])->label('Начальная дата') ?>

<?= $form->field($weatherForm, 'dateTo')->textInput(['placeholder' => '2019-11-03'])->label('Конечная дата') ?>


<div class="form-group">
<!--    <div class="col-lg-offset-1 col-lg-11">-->
        <?= Html::submitButton('Показать отчёт', ['class' => 'btn btn-default']) ?>
<!--    </div>-->
</div>

<?php ActiveForm::end(); ?>

<table class="table">
    <thead>
    <tr>
        <th>Город</th>
        <th>Дата</th>
        <th>Температура</th>
        <th>delta</th>
    </tr>
    </thead>
    <?php
    if (null !== $report) {
        foreach ($report->getReportItems() as $reportItem) {
            ?>
            <tr>
                <td><?= $reportItem->getCity() ?></td>
                <td><?= $reportItem->getDate()->format('Y-m-d') ?></td>
                <td><?= $reportItem->getTemperature() ?></td>
                <td><?= $reportItem->getDelta() ?></td>
            </tr>
            <?php
        }
    }
    ?>
</table>
