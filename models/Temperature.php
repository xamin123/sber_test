<?php
declare(strict_types=1);

namespace app\models;


use DateTimeImmutable;

class Temperature
{
    /**
     * @var float
     */
    private $temperature;
    /**
     * @var int
     */
    private $cityId;
    /**
     * @var DateTimeImmutable
     */
    private $date;

    /**
     * @param float $temperature
     * @param int $cityId
     * @param DateTimeImmutable $date
     */
    public function __construct(float $temperature,int $cityId, DateTimeImmutable $date)
    {
        $this->temperature = $temperature;
        $this->cityId = $cityId;
        $this->date = $date;
    }

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->cityId;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

}