<?php

namespace  backend\modules\plot\dto;

/**
 * Класс DTO
 */
class PlotDto
{
    /**
     * @var string
     */
    public string $cadastralNumber;

    /**
     * @var string
     */
    public string $address;

    /**
     * @var string
     */
    public string $price;

    /**
     * @var string
     */
    public string $area;

    /**
     * @param string $cadastralNumber
     * @param string $address
     * @param string $price
     * @param string $area
     */
    public function __construct(
        string $cadastralNumber,
        string $address,
        string $price,
        string $area
    ) {
        $this->cadastralNumber = $cadastralNumber;
        $this->address = $address;
        $this->price = $price;
        $this->area = $area;
    }
}