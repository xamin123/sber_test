<?php
declare(strict_types=1);

namespace app\services;


use app\models\City;
use app\models\Temperature;
use DateTimeImmutable;

interface WeatherGrabberInterface
{
    /**
     * @param DateTimeImmutable $dateFrom
     * @param DateTimeImmutable $dateTo
     * @param City[] $cities
     *
     * @return Temperature[]
     */
    public function grabWeather(DateTimeImmutable $dateFrom, DateTimeImmutable $dateTo, array $cities): array;
}