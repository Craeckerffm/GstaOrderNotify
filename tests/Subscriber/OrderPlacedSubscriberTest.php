<?php declare(strict_types=1);

namespace GstaOrderNotify\Test\Subscriber;


use GstaOrderNotify\Service\DispatchHelper;
use GstaOrderNotify\Subscriber\OrderPlacedSubscriber;
use PHPUnit\Framework\TestCase;
use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;


class OrderPlacedSubscriberTest extends TestCase
{

    public function testGetSubscribedEvents(): void
    {
        $events = OrderPlacedSubscriber::getSubscribedEvents();
        $this->assertCount(1, $events);
        $this->assertContains('onOrderPlaced', $events);
    }
    
    public function testDispatchHelperGetsCalled(){
        $dispatchHelper = $this->createMock(DispatchHelper::class);
        $event = $this->createMock(CheckoutOrderPlacedEvent::class);
        $dispatchHelper
            ->expects($this->once())
            ->method('startDispatch');
        $subscriber = new OrderPlacedSubscriber($dispatchHelper);
        $subscriber->onOrderPlaced($event);
    }
}
