<?php
// tests/test.php

namespace My; // Note the "My" namespace maps to the "tests" folder, as defined in the autoload part of `composer.json`.

use Lmc\Steward\Test\AbstractTestCase;

class Test extends AbstractTestCase
{
	
    public function testYandexVideo()
    {
        // Load the URL (will wait until page is loaded)
        $this->wd->get('https://yandex.ua/video');
		//locators
		$searchInput = '[type=search]';
		$searchBtn = 'div.search2__button';
		$img = 'div.related-video  div.thumb-preview:first-of-type img';

		//Actions
        $searchAction = $this->waitforCss($searchInput);
		$searchAction->sendKeys('ураган');
		
		$findAction = $this->waitForCss($searchBtn);
		$findAction->click();

		$mouseAction = $this->waitforCss($img);
		$this->wd->getMouse()->mouseMove( $mouseAction->getCoordinates());
		
		//getting tumbnail src attributes
		sleep(1);
		$a = $mouseAction -> getAttribute('src');
		sleep(2);
		$b = $mouseAction -> getAttribute('src');
		
		//providing assertion
        $this->assertNotEquals($a,$b);		
    }
}