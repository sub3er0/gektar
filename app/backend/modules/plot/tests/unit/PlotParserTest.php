<?php

namespace backend\modules\plot\tests\unit;

use backend\modules\plot\dto\PlotDto;
use backend\modules\plot\services\CadastralDataResponseService;

/**
 * PlotParserTest
 */
class PlotParserTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider additionProvider
     * @test
     */
    public function getPlotDtoFromResponseTest(array $responseData, $expected)
    {
        $cadastralDataResponseService = new CadastralDataResponseService();
        $result = $cadastralDataResponseService->getPlotDtoFromResponse($responseData);
        $this->assertEquals($expected, $result);
    }

    /**
     * @return array[]
     */
    public function additionProvider()
    {
        return
            [
                [
                    [
                        [
                            "id" => "69:27:22:1306",
                            "number"=> "69:27:0000022:1306",
                            "attrs"=> [
                                "plot_id"=> "69:27:22:1306",
                                "plot_area"=> 10035,
                                "plot_price"=> 36126,
                                "plot_number"=> "69:27:0000022:1306",
                                "plot_address"=> "Тверская область, р-н Ржевский, с/пос \"Успенское\", северо-западнее д. Горшково из земель СПКколхоз \"Мирный\"",
                                "category_code"=> "003001000000",
                                "category_name"=> "Земли сельскохозяйственного назначения",
                                "plot_area_inaccuracy"=> 877,
                                "permitted_use_document_name"=> "Для ведения сельского хозяйства",
                                "permitted_use_classifier_code"=> null,
                                "permitted_use_classifier_name"=> null
                            ],
                        ],
                        [
                            "id"=> "69:27:22:1307",
                            "number"=> "69:27:0000022:1307",
                            "attrs"=> [
                                "plot_id"=> "69:27:22:1307",
                                "plot_area"=> 10176,
                                "plot_price"=> 36633.6,
                                "plot_number"=> "69:27:0000022:1307",
                                "plot_address"=> "Тверская область, р-н Ржевский, с/пос \"Успенское\", северо-западнее д. Горшково из земель СПКколхоз \"Мирный\"",
                                "category_code"=> "003001000000",
                                "category_name"=> "Земли сельскохозяйственного назначения",
                                "plot_area_inaccuracy"=> 883,
                                "permitted_use_document_name"=> "Для ведения сельского хозяйства",
                                "permitted_use_classifier_code"=> null,
                                "permitted_use_classifier_name"=> null
                            ],
                        ],
                    ],
                    [
                        new PlotDto(
                            "69:27:0000022:1306",
                            "Тверская область, р-н Ржевский, с/пос \"Успенское\", северо-западнее д. Горшково из земель СПКколхоз \"Мирный\"",
                            "36126",
                            "10035"
                        ),
                        new PlotDto(
                            "69:27:0000022:1307",
                            "Тверская область, р-н Ржевский, с/пос \"Успенское\", северо-западнее д. Горшково из земель СПКколхоз \"Мирный\"",
                            "36633.6",
                            "10176"
                        ),
                    ]
                ],
                [
                    [
                        [
                            "id" => "69:27:22:1306",
                            "number"=> "69:27:0000022:1306",
                            "attrs"=> [
                                "plot_id"=> "69:27:22:1306",
                                "plot_area"=> null,
                                "plot_price"=> 36126,
                                "plot_number"=> "69:27:0000022:1306",
                                "plot_address"=> "Тверская область, р-н Ржевский, с/пос \"Успенское\", северо-западнее д. Горшково из земель СПКколхоз \"Мирный\"",
                                "category_code"=> "003001000000",
                                "category_name"=> "Земли сельскохозяйственного назначения",
                                "plot_area_inaccuracy"=> 877,
                                "permitted_use_document_name"=> "Для ведения сельского хозяйства",
                                "permitted_use_classifier_code"=> null,
                                "permitted_use_classifier_name"=> null
                            ],
                        ],
                    ],
                    [
                        new PlotDto(
                            "69:27:0000022:1306",
                            "Тверская область, р-н Ржевский, с/пос \"Успенское\", северо-западнее д. Горшково из земель СПКколхоз \"Мирный\"",
                            "36126",
                            ""
                        ),
                    ]
                ]
            ];
    }
}