<?php
declare(strict_types=1);

namespace app\models\repository;


use app\models\Temperature;
use app\models\WeatherReportItem;
use app\services\TemperatureRepositoryInterface;
use DateTimeImmutable;
use yii\db\Connection;

class TemperatureRepository implements TemperatureRepositoryInterface
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param Temperature[] $temperatures
     *
     * @throws \yii\db\Exception
     */
    public function save(array $temperatures): void
    {
        if (empty($temperatures)) {
            return;
        }

        $rows = array_map(function (Temperature $temperature) {
            return [
                $temperature->getCityId(),
                $temperature->getDate()->format('Y-m-d'),
                $temperature->getTemperature()
            ];
        }, $temperatures);
        $params = [];

        //Yii из коробки умеет upsert только для одной записи, поэтому финт небольшой, чтобы пачкой сразу вставлять

        //Здесь средствами Yii создаём запрос на вставку множества записей
        $sql = $this->connection->getQueryBuilder()->batchInsert(
            'temperature',
            ['city_id', 'date', 'temperature'],
            $rows,
            $params
        );
        //Поскольку при вставке могут быть конфликты и у нас postgresql модифицируем построенный Yii
        // запрос для решения конфликтов
        $sql .= '
            ON CONFLICT (city_id, date) DO UPDATE
            SET temperature = EXCLUDED.temperature
        ';

        $this->connection->createCommand($sql, $params)->execute();
    }

    /**
     * @param DateTimeImmutable $dateFrom
     * @param DateTimeImmutable $dateTo
     *
     * @return array
     * @throws \yii\db\Exception
     */
    public function getReportData(DateTimeImmutable $dateFrom, DateTimeImmutable $dateTo): array
    {
        $sql = '
          SELECT
            c.name_ru,
            t.date,
            t.temperature,
            CASE WHEN t2.temperature IS NULL
              THEN 0.0
            ELSE t.temperature - t2.temperature
            END AS delta
          FROM city c
            INNER JOIN temperature t ON c.city_id = t.city_id
            LEFT JOIN temperature t2 ON t.city_id = t2.city_id AND t2.date + INTERVAL \'1 day\' = t.date
          WHERE t.date BETWEEN :dateFrom AND :dateTo
          ORDER BY name_ru, t.date
        ';
        $params = [
            ':dateFrom' => $dateFrom->format('Y-m-d'),
            ':dateTo' => $dateTo->format('Y-m-d'),
        ];

        $rows = $this->connection->createCommand($sql, $params)->queryAll();
        
        return array_map(function ($row) {
            return new WeatherReportItem(
                $row['name_ru'],
                DateTimeImmutable::createFromFormat('Y-m-d', $row['date']),
                (float)$row['temperature'],
                (float)$row['delta']
            );
        }, $rows);
    }
}