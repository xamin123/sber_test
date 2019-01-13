<?php
declare(strict_types=1);

namespace app\services;


use app\models\repository\TemperatureRepository;
use app\models\WeatherReport;
use DateTimeImmutable;

class WeatherReportService
{
    /**
     * @var TemperatureRepository
     */
    private $temperatureRepository;

    /**
     * @param TemperatureRepository $temperatureRepository
     */
    public function __construct(TemperatureRepository $temperatureRepository)
    {
        $this->temperatureRepository = $temperatureRepository;
    }

    /**
     * @param DateTimeImmutable $dateFrom
     * @param DateTimeImmutable $dateTo
     *
     * @return WeatherReport
     * @throws \yii\db\Exception
     */
    public function getWeatherReport(DateTimeImmutable $dateFrom, DateTimeImmutable $dateTo): WeatherReport
    {
        $reportItems = $this->temperatureRepository->getReportData($dateFrom, $dateTo);

        return new WeatherReport($dateFrom, $dateTo, $reportItems);
    }
}