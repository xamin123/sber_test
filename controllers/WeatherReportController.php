<?php
declare(strict_types=1);

namespace app\controllers;


use app\models\WeatherReportForm;
use app\services\WeatherReportService;
use DateTimeImmutable;
use Yii;
use yii\web\Controller;

class WeatherReportController extends Controller
{
    /**
     * @var WeatherReportService
     */
    private $weatherReportService;

    /**
     * @param string $id
     * @param $module
     * @param WeatherReportService $weatherReportService
     * @param array $config
     */
    public function __construct(string $id, $module, WeatherReportService $weatherReportService, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->weatherReportService = $weatherReportService;
    }

    /**
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionIndex(): string
    {
        $weatherForm = new WeatherReportForm();
        $weatherForm->load(Yii::$app->request->get());
        $report = null;
        if ($weatherForm->validate()) {
            $report = $this->weatherReportService->getWeatherReport(
                DateTimeImmutable::createFromFormat(WeatherReportForm::DATE_FORMAT, $weatherForm->dateFrom),
                DateTimeImmutable::createFromFormat(WeatherReportForm::DATE_FORMAT, $weatherForm->dateTo)
            );
        }


        return $this->render('index', ['report' => $report, 'weatherForm' => $weatherForm]);
    }
}