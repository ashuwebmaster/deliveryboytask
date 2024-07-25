<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DeliveryBoy;
use App\Models\Order;
use Carbon\Carbon;

class AssignOrders extends Command
{
    protected $signature = 'assign:orders';
    protected $description = 'Assign orders to delivery boys based on availability and order limits';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        // Get all not delivered order
        $orders = Order::whereNull('delivery_boy_id')->get();

        if ($orders->isEmpty()) {
            $this->info('No unassigned orders found.');
            return;
        }

        // Fetch available delivery boys not assigned
        $availableDeliveryBoys = DeliveryBoy::where(function ($query) {
            $query->whereNull('last_assigned')
                ->orWhere('last_assigned', '<=', Carbon::now()->subMinutes(30));
        })->get();

        if ($availableDeliveryBoys->isEmpty()) {
            $this->info('All delivery boys are currently occupied.');
            return;
        }

        $this->assignOrdersToDeliveryBoys($orders, $availableDeliveryBoys);
        $this->info('Orders assigned successfully!');
    }

    private function assignOrdersToDeliveryBoys($orders, $deliveryBoys)
    {
        foreach ($deliveryBoys as $deliveryBoy) {
            $ordersToAssign = $orders->splice(0, $deliveryBoy->max_orders);

            foreach ($ordersToAssign as $order) {
                $order->delivery_boy_id = $deliveryBoy->id;
                $order->assigned_at = Carbon::now();
                $order->save();
            }

            $deliveryBoy->last_assigned = Carbon::now();
            $deliveryBoy->save();

            if ($orders->isEmpty()) {
                break;
            }
        }
    }
}
