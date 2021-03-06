<?php

namespace Cybersai\Tests\Adapters;

use Cybersai\Tests\Helpers\IAmSimpleView;
use Cybersai\Ussd\Adapters\TxtGhanaRequestAdapter;
use Cybersai\Ussd\Constants\TxtGhana;
use PHPUnit\Framework\TestCase;

class TxtGhanaRequestAdapterTest extends TestCase
{
    /** @test */
    function it_parses_the_correct_txt_ghana_response()
    {
        $request = [
            TxtGhana::SESSION_ID => '1234',
            TxtGhana::MSISDN => '233234567890',
            TxtGhana::NETWORK => '1',
            TxtGhana::USER_INPUT => '*365#'
        ];

        $adapter = new TxtGhanaRequestAdapter($request);
        $view = new IAmSimpleView($adapter);
        $response = $adapter->respondToProvider($view);
        $this->assertIsArray($response);
        $this->assertEquals([
            TxtGhana::RESPONSE_MESSAGE => 'I am simple',
            TxtGhana::RESPONSE_TYPE => TxtGhana::RESPONSE_TYPE_END,
        ], $response);
    }
}
