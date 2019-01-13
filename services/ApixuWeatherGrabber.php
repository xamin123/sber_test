<?php
declare(strict_types=1);

namespace app\services;


use Apixu\Exception\ApiKeyMissingException;
use Apixu\Factory;
use Apixu\Response\Forecast\ForecastDay;
use app\models\City;
use app\models\Temperature;
use DateInterval;
use DatePeriod;
use DateTime;
use DateTimeImmutable;
use Serializer\Format\UnknownFormatException;

class ApixuWeatherGrabber implements WeatherGrabberInterface
{
    private $apixuClient;

    /**
     * @param string $apiKey
     *
     * @throws ApiKeyMissingException
     * @throws UnknownFormatException
     */
    public function __construct(string $apiKey)
    {
        $this->apixuClient = Factory::create($apiKey);
    }

    /**
     * @param DateTimeImmutable $dateFrom
     * @param DateTimeImmutable $dateTo
     * @param City[] $cities
     *
     * @return Temperature[]
     * @throws \Apixu\Exception\ApixuException
     * @throws \Exception
     */
    public function grabWeather(DateTimeImmutable $dateFrom, DateTimeImmutable $dateTo, array $cities): array
    {
        if (empty($cities)) {
            return [];
        }
        /** @noinspection CallableParameterUseCaseInTypeContextInspection */
        $dateFrom = $dateFrom->setTime(0, 0, 0);
        /** @noinspection CallableParameterUseCaseInTypeContextInspection */
        $dateTo = $dateTo->setTime(0, 0, 0)->modify('+1 day');
        /** @noinspection ExceptionsAnnotatingAndHandlingInspection */
        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($dateFrom, $interval , $dateTo);

        $result = [];
        foreach ($dateRange as $date) {
            foreach ($cities as $city) {
                $history = $this->apixuClient->history($city->getNameEn(), $this->convertToDateTime($date));
                /** @var ForecastDay $forecastDay */
                $forecastDay = $history->getForecast()->getForecastDay()->current();
                $day = $forecastDay->getDay();
                if (null === $day) {
                    continue;
                }
                $result[] = new Temperature($day->getAvgTempCelsius(), $city->getCityId(), $date);
            }
        }

        return $result;
    }

    /**
     * @param DateTimeImmutable $date
     *
     * @return DateTime
     */
    private function convertToDateTime(DateTimeImmutable $date): DateTime
    {
        $convertedDate = new DateTime('now', $date->getTimezone());
        $convertedDate->setTimestamp($date->getTimestamp());

        return $convertedDate;
    }
}