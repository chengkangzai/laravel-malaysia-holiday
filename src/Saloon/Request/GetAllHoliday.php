<?php

namespace CCK\LaravelOfficeHolidays\Saloon\Request;

use CCK\LaravelOfficeHolidays\Saloon\Dto\HolidayDto;
use CCK\LaravelOfficeHolidays\Services\HtmlParserService;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GetAllHoliday extends Request
{
    protected Method $method = Method::GET;

    public function __construct(
        public int $year,
        protected string $country,
    ) {
    }

    public function resolveEndpoint(): string
    {
        return $this->country.'/'.$this->year;
    }

    /**
     * @return Collection<HolidayDto>
     */
    public function createDtoFromResponse(Response $response): Collection
    {
        return HtmlParserService::getHolidays($response->body(), $this->year);
    }
}
