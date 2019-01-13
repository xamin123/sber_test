<?php
declare(strict_types=1);

namespace app\models;


class City
{
    /**
     * @var int
     */
    private $cityId;

    /**
     * @var string
     */
    private $nameRu;

    /**
     * @var string
     */
    private $nameEn;

    public function __construct(int $cityId, string $nameRu, string $nameEn)
    {
        $this->cityId = $cityId;
        $this->nameRu = $nameRu;
        $this->nameEn = $nameEn;
    }

    /**
     * @return int
     */
    public function getCityId(): int
    {
        return $this->cityId;
    }

    /**
     * @return string
     */
    public function getNameRu(): string
    {
        return $this->nameRu;
    }

    /**
     * @return string
     */
    public function getNameEn(): string
    {
        return $this->nameEn;
    }
}