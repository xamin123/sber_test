<?php
declare(strict_types=1);

namespace app\models\repository;


use app\models\City;
use app\services\CityRepositoryInterface;
use function array_map;
use yii\db\Connection;

class CityRepository implements CityRepositoryInterface
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
     * {@inheritdoc}
     */
    public function getCities(): array
    {
        $query = 'SELECT * FROM city';
        $data = $this->connection->createCommand($query)->queryAll();

        return array_map(
            function (array $item) {
                return new City($item['city_id'], $item['name_ru'], $item['name_en']);
            },
            $data
        );
    }
}