<?php
declare(strict_types=1);

namespace app\services;


use DateTimeImmutable;

class WeatherCollector
{
    /**
     * @var WeatherGrabberInterface
     */
    private $weatherGrabber;

    /**
     * @var TemperatureRepositoryInterface
     */
    private $temperatureRepository;

    /**
     * @var CityRepositoryInterface
     */
    private $cityRepository;

    /**
     * @param WeatherGrabberInterface $weatherGrabber
     * @param TemperatureRepositoryInterface $temperatureRepository
     * @param CityRepositoryInterface $cityRepository
     */
    public function __construct(
        WeatherGrabberInterface $weatherGrabber,
        TemperatureRepositoryInterface $temperatureRepository,
        CityRepositoryInterface $cityRepository
    ) {
        $this->weatherGrabber = $weatherGrabber;
        $this->temperatureRepository = $temperatureRepository;
        $this->cityRepository = $cityRepository;
    }

    public function collectWeather(DateTimeImmutable $dateFrom, DateTimeImmutable $dateTo): void
    {
        $cities = $this->cityRepository->getCities();
        $temperatures = $this->weatherGrabber->grabWeather($dateFrom, $dateTo, $cities);
        $this->temperatureRepository->save($temperatures);
    }

}