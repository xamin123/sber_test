<?php
declare(strict_types=1);

namespace app\services;


use app\models\City;

interface CityRepositoryInterface
{
    /**
     * @return City[]
     */
    public function getCities(): array;
}