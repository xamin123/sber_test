<?php
declare(strict_types=1);

namespace app\models;


use DateTimeImmutable;

class WeatherReport
{
    /**
     * @var DateTimeImmutable
     */
    private $dateFrom;
    /**
     * @var DateTimeImmutable
     */
    private $dateTo;
    /**
     * @var WeatherReportItem[]|array
     */
    private $reportItems;

    /**
     * @param DateTimeImmutable $dateFrom
     * @param DateTimeImmutable $dateTo
     * @param WeatherReportItem[] $reportItems
     */
    public function __construct(DateTimeImmutable $dateFrom, DateTimeImmutable $dateTo, array $reportItems)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->reportItems = $reportItems;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDateFrom(): DateTimeImmutable
    {
        return $this->dateFrom;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDateTo(): DateTimeImmutable
    {
        return $this->dateTo;
    }

    /**
     * @return WeatherReportItem[]
     */
    public function getReportItems(): array
    {
        return $this->reportItems;
    }
}