<?php

namespace JMBTechnologyLimited\ICalDissect;

/**
 *
 * @link https://github.com/JMB-Technology-Limited/ICalDissect
 * @license https://raw.github.com/JMB-Technology-Limited/ICalDissect/master/LICENSE.txt 3-clause BSD
 * @copyright (c) 2014, JMB Technology Limited, http://jmbtechnology.co.uk/
 * @author James Baster <james@jarofgreen.co.uk>
 */
class RawTest  extends \PHPUnit_Framework_TestCase {


	function testGetDefaultValuesIfKeyNotFoundFromEvent() {
		$parser = new ICalParser();
		$this->assertTrue($parser->parseFromFile(dirname(__FILE__)."/data/rawtest1.ics"));
		$events = $parser->getEvents();
		$this->assertEquals(1, count($events));

		/** @var $event ICalEvent */
		$event = $events[0];

		$rawAll = $event->getRaw();
		$this->assertFalse(isset($rawAll['OUEHUENU']));

		$this->assertTrue(is_array($event->getRaw('OUEHUENU')));
		$this->assertEquals(0, count($event->getRaw('OUEHUENU')));
	}


    function testGetFromFile()
    {
        $parser = new ICalParser();
        $this->assertTrue($parser->parseFromFile(dirname(__FILE__) . "/data/rawtest1.ics"));
        $events = $parser->getEvents();
        $this->assertEquals(1, count($events));

        $this->assertTrue(is_array($parser->getRaw('X-WR-CALNAME')));
        $this->assertEquals(1, count($parser->getRaw('X-WR-CALNAME')));
        $this->assertEquals('TEST', $parser->getRaw('X-WR-CALNAME')[0]);

    }

    function testGetFromEvent()
    {
        $parser = new ICalParser();
        $this->assertTrue($parser->parseFromFile(dirname(__FILE__) . "/data/rawtest1.ics"));
        $events = $parser->getEvents();
        $this->assertEquals(1, count($events));

        /** @var $event ICalEvent */
        $event = $events[0];

        $this->assertTrue(is_array($event->getRaw('UID')));
        $this->assertEquals(1, count($event->getRaw('UID')));
        $this->assertEquals('gktoo7adirkje5lgvt6gqf14ik@google.com', $event->getRaw('UID')[0]);
    }
}
