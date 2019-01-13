<?php
declare(strict_types=1);

namespace app\models;


use DateTimeImmutable;

class WeatherReportItem
{
    /**
     * @var string
     */
    private $city;
    /**
     * @var DateTimeImmutable
     */
    private $date;
    /**
     * @var float
     */
    private $temperature;
    /**
     * @var float
     */
    private $delta;

    /**
     * @param string $city
     * @param DateTimeImmutable $date
     * @param float $temperature
     * @param float $delta
     */
    public function __construct(string $city, DateTimeImmutable $date, float $temperature, float $delta)
    {
        $this->city = $city;
        $this->date = $date;
        $this->temperature = $temperature;
        $this->delta = $delta;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @return float
     */
    public function getDelta(): float
    {
        return $this->delta;
    }
}