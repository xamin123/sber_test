<?php
declare(strict_types=1);

namespace app\commands;


use app\services\WeatherCollector;
use DateTimeImmutable;
use yii\console\Controller;

class WeatherGrabberController extends Controller
{
    private const DATE_FORMAT = 'Y-m-d';
    /**
     * @var WeatherCollector
     */
    private $weatherCollector;

    /**
     * @param string $id
     * @param $module
     * @param WeatherCollector $weatherCollector
     * @param array $config
     */
    public function __construct(string $id, $module, WeatherCollector $weatherCollector, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->weatherCollector = $weatherCollector;
    }

    /**
     * @param string $dateFrom
     * @param string $dateTo
     */
    public function actionGrab(string $dateFrom, string $dateTo): void
    {
        $dateFrom = DateTimeImmutable::createFromFormat(self::DATE_FORMAT, $dateFrom);
        $dateTo = DateTimeImmutable::createFromFormat(self::DATE_FORMAT, $dateTo);
        $this->weatherCollector->collectWeather($dateFrom, $dateTo);
    }
}