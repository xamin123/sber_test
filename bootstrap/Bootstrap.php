<?php
declare(strict_types=1);

namespace app\bootstrap;


use app\models\repository\CityRepository;
use app\models\repository\TemperatureRepository;
use app\services\ApixuWeatherGrabber;
use app\services\CityRepositoryInterface;
use app\services\TemperatureRepositoryInterface;
use app\services\WeatherGrabberInterface;
use app\services\WeatherReportService;
use Yii;
use yii\base\BootstrapInterface;
use yii\db\Connection;

class Bootstrap implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public function bootstrap($app): void
    {
        $container = \Yii::$container;
        $container->setSingleton(
            WeatherGrabberInterface::class,
            function () use ($app): ApixuWeatherGrabber {
                return new ApixuWeatherGrabber($app->params['apixuApiKey']);
            }
        );

        $container->setSingleton(
            CityRepositoryInterface::class,
            function () use ($app): CityRepository {
                /** @var Connection $connection */
                $connection = $app->get('db');

                return new CityRepository($connection);
            }
        );

        $container->setSingleton(
            TemperatureRepositoryInterface::class,
            function () use ($app): TemperatureRepository {
                /** @var Connection $connection */
                $connection = $app->get('db');

                return new TemperatureRepository($connection);
            }
        );

        $container->setSingleton(
            WeatherReportService::class,
            [],
            [Yii::$container->get(TemperatureRepositoryInterface::class)]
        );
    }

}