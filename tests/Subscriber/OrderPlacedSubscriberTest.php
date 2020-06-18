<?php declare(strict_types=1);

namespace GstaOrderNotify\Test\Subscriber;


use GstaOrderNotify\Subscriber\OrderPlacedSubscriber;
use PHPUnit\Framework\TestCase;


class OrderPlacedSubscriberTest extends TestCase
{

    public function testGetSubscribedEvents(): void
    {
        $events = OrderPlacedSubscriber::getSubscribedEvents();
        $this->assertCount(1, $events);
        $this->assertContains('onOrderPlaced', $events);
    }


}
