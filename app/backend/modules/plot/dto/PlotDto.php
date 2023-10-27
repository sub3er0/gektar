<?php

namespace  backend\modules\plot\dto;

class PlotDto
{
    public function __construct(
        string $cadastralNumber,
        string $address,
        string $price,
        string $area
    ) {}

    public string $cadastralNumber;

    public string $address;

    public string $price;

    public string $area;
}