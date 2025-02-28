<?php

declare(strict_types=1);

namespace App\Tests\Application;

use App\Application\ApiFetcherService;
use App\Application\Strategy\ParameterEnum;
use App\Application\Strategy\Point\PointFetcher;
use App\Application\Strategy\Point\PointSerializer;
use App\Application\Strategy\ResourceStrategy;
use App\Infrastructure\ApiClient;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class ApiFetcherServiceTest extends TestCase
{
    use ProphecyTrait;

    private LoggerInterface $logger;
    private ApiClient|ObjectProphecy $apiClient;
    private ResourceStrategy $resourceStrategy;
    private ApiFetcherService $apiFetcherService;

    protected function setUp(): void
    {
        $this->apiClient = $this->prophesize(ApiClient::class);

        $this->logger = new NullLogger();
        $this->resourceStrategy = new ResourceStrategy(
            resources: [
                new PointFetcher(
                    apiClient: $this->apiClient->reveal(),
                    serializer: new PointSerializer(),
                )
            ],
            logger: $this->logger,
        );
        $this->apiFetcherService = new ApiFetcherService(
            resourceStrategy: $this->resourceStrategy,
        );
    }

    public function testShouldFetchDataFromInpostPointsResourceApi(): void
    {
        $this->apiClient
            ->fetch('points', ParameterEnum::CITY->value, 'Kozy')
            ->willReturn($this->getApiResponse())
        ;

        $result = $this->apiFetcherService->fetch('points', 'Kozy');

        $this->assertSame(13, $result->getCount());
        $this->assertSame(1, $result->getPage());
        $this->assertSame(1, $result->getTotalPages());
        $this->assertSame(1, count($result->getItems()));
        $this->assertSame('KZY01A', $result->getItems()[0]->getName());
        $this->assertSame('Kozy', $result->getItems()[0]->getAddressDetails()->getCity());
        $this->assertSame('śląskie', $result->getItems()[0]->getAddressDetails()->getProvince());
        $this->assertSame('43-340', $result->getItems()[0]->getAddressDetails()->getPostCode());
        $this->assertSame('Gajowa', $result->getItems()[0]->getAddressDetails()->getStreet());
        $this->assertSame('27', $result->getItems()[0]->getAddressDetails()->getBuildingNumber());
        $this->assertNull($result->getItems()[0]->getAddressDetails()->getFlatNumber());
    }

    private function getApiResponse(): string
    {
        return json_encode(json_decode('{
	"href": "https://api-pl-points.easypack24.net/v1/points",
	"count": 13,
	"page": 1,
	"per_page": 25,
	"total_pages": 1,
	"items": [
		{
			"href": "https://api-pl-points.easypack24.net/v1/points/KZY01A",
			"name": "KZY01A",
			"type": [
				"parcel_locker"
			],
			"status": "Operating",
			"location": {
				"longitude": 19.17134,
				"latitude": 49.84569
			},
			"location_type": "Outdoor",
			"location_date": null,
			"location_description": "obok sklepu",
			"location_description_1": null,
			"location_description_2": null,
			"distance": null,
			"opening_hours": "24/7",
			"address": {
				"line1": "Gajowa 27",
				"line2": "43-340 Kozy"
			},
			"address_details": {
				"city": "Kozy",
				"province": "śląskie",
				"post_code": "43-340",
				"street": "Gajowa",
				"building_number": "27",
				"flat_number": null
			},
			"phone_number": null,
			"payment_point_descr": "Płatność apką InPost oraz PayByLink",
			"functions": [
				"allegro_courier_collect",
				"allegro_courier_reverse_return_send",
				"allegro_courier_send",
				"allegro_letter_reverse_return_send",
				"allegro_letter_send",
				"allegro_parcel_collect",
				"allegro_parcel_reverse_return_send",
				"allegro_parcel_send",
				"parcel",
				"parcel_collect",
				"parcel_reverse_return_send",
				"parcel_send",
				"standard_courier_reverse_return_send",
				"standard_courier_send"
			],
			"partner_id": 0,
			"is_next": false,
			"payment_available": true,
			"payment_type": {
				"0": "Payments are not supported"
			},
			"virtual": "0",
			"recommended_low_interest_box_machines_list": [
				"KZY01BAPP",
				"KZY01APP",
				"KZY01N",
				"BUJ01M",
				"KZY04M"
			],
			"apm_doubled": null,
			"location_247": true,
			"operating_hours_extended": {
				"customer": null
			},
			"agency": "BBA",
			"image_url": "https://static.easypack24.net/points/pl/images/KZY01A.jpg",
			"easy_access_zone": true,
			"air_index_level": null,
			"physical_type_mapped": "003",
			"physical_type_description": null
		}
	]
}', true));
    }
}