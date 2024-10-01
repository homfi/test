<?php

namespace Tests\Feature;

use App\Commons\Database\ConstantsPool as D;
use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderObserverTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_observer_should_not_run_order_processing(): void
    {
        //given
        $order = Order::find(1);

        //when
        $order
            ->setAttribute(D::STATUS, OrderStatus::REJECTED->name)
            ->save();

        //then
        self::assertEmpty($order->processedItems()->get());
        self::assertEquals($order->status, OrderStatus::REJECTED->name);
    }

    public function test_order_observer_should_run_order_processing(): void
    {
        //given
        $orderItem = OrderItem::find(1);
        $orderItem
            ->setAttribute(D::AMOUNT, 1)
            ->save();
        $order = Order::find($orderItem->order_id);

        //when
        $order
            ->setAttribute(D::STATUS, OrderStatus::PAID->name)
            ->save();

        //then
        $processedOrderItemAmount = $order
            ->processedItems()
            ->first()
            ?->getAttribute(D::AMOUNT);
        $addedOrderItemAmount = $order
            ->items()
            ->first()
            ?->getAttribute(D::AMOUNT);
        self::assertEquals(
            $processedOrderItemAmount,
            $addedOrderItemAmount
        );
        self::assertEquals($order->status, OrderStatus::ACCEPTED->name);
    }

    public function test_order_observer_should_prepare_more_processed_orders(): void
    {
        //given
        $orderItem = OrderItem::find(1);
        $orderItem
            ->setAttribute(D::AMOUNT, 12)
            ->save();
        $order = Order::find($orderItem->order_id);

        //when
        $order
            ->setAttribute(D::STATUS, OrderStatus::PAID->name)
            ->save();

        //then
        $processedOrderItemCount = $order
            ->processedItems()
            ->count();
        self::assertGreaterThan(2, $processedOrderItemCount);
        self::assertEquals($order->status, OrderStatus::ACCEPTED->name);
    }
}
