<?php
declare(strict_types=1);

namespace app\services;


use app\models\Temperature;

interface TemperatureRepositoryInterface
{
    /**
     * @param Temperature[] $temperatures
     */
    public function save(array $temperatures): void;
}