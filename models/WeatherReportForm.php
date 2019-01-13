<?php
declare(strict_types=1);

namespace app\models;


use yii\base\Model;

class WeatherReportForm extends Model
{
    public const DATE_FORMAT = 'Y-m-d';
    public $dateFrom;
    public $dateTo;

    public function rules(): array
    {
        return [
            [['dateFrom', 'dateTo'], 'required'],
            [['dateFrom', 'dateTo'], 'date', 'format' => 'php:'.self::DATE_FORMAT],
        ];
    }
}