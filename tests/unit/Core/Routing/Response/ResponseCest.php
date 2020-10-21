<?php

namespace Core\Routing\Response;

use UnitTester;
use App\Core\Routing\Response\Response;
use Exception;
use stdClass;

class ResponseCest
{
    public function web_response_is_created(UnitTester $I)
    {
        $response = new Response('web');
        $I->assertSame('web', $response->type);
    }

    public function api_response_is_created(UnitTester $I)
    {
        $response = new Response('api');
        $I->assertSame('api', $response->type);
    }

    public function incorrect_response_type_throws_exception(UnitTester $I)
    {
        $I->expectThrowable(new Exception('incorrect_type response type is not supported.', 500), function() {
            $response = new Response('incorrect_type');
        });
    }

    public function characters_are_converted_to_html_entities_string(UnitTester $I)
    {
        $text = '<a href="https://www.google.com">Go to google.com</a>';
        $response = new Response('web');
        $cleanedText = $response->cleanData($text);
        $I->assertIsString($cleanedText);
        $I->assertSame('&lt;a href=&quot;https://www.google.com&quot;&gt;Go to google.com&lt;/a&gt;', $cleanedText);        
    }

    public function characters_are_converted_to_html_entities_array(UnitTester $I)
    {
        $text = [
            '<a href="https://www.google.com">Go to google.com</a>',
            "#000' onload='alert(document.cookie)",
            "A 'quote' is <b>bold</b>"
        ];
        $response = new Response('web');
        $cleanedText = $response->cleanData($text);
        $I->assertIsArray($cleanedText);
        $I->assertSame('&lt;a href=&quot;https://www.google.com&quot;&gt;Go to google.com&lt;/a&gt;', $cleanedText[0]);
        $I->assertSame('#000&#039; onload=&#039;alert(document.cookie)', $cleanedText[1]);
        $I->assertSame('A &#039;quote&#039; is &lt;b&gt;bold&lt;/b&gt;', $cleanedText[2]);
    }

    public function characters_are_converted_to_html_entities_object(UnitTester $I)
    {
        $text = new stdClass; 
        $text->el1 = '<a href="https://www.google.com">Go to google.com</a>'; 
        $text->el2 = "#000' onload='alert(document.cookie)"; 
        $text->el3 = "A 'quote' is <b>bold</b>"; 
        $response = new Response('web');
        $cleanedText = $response->cleanData($text);
        $I->assertIsArray($cleanedText);
        $I->assertSame('&lt;a href=&quot;https://www.google.com&quot;&gt;Go to google.com&lt;/a&gt;', $cleanedText['el1']);
        $I->assertSame('#000&#039; onload=&#039;alert(document.cookie)', $cleanedText['el2']);
        $I->assertSame('A &#039;quote&#039; is &lt;b&gt;bold&lt;/b&gt;', $cleanedText['el3']);        
    }
}
