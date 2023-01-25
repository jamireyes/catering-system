<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\Item;
use App\Models\CategoryRule;
use App\Notifications\NotifyUserOrderPlaced;
use Notification;
use Auth;
use PDF;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function created(Order $order)
    {
        // $orders = Order::selectRaw("
        //         orders.id as order_id,
        //         DATE_FORMAT(orders.created_at, '%M %d, %Y') as order_date,
        //         orders.subtotal as subtotal,
        //         orders.discount as discount,
        //         orders.status as status,
        //         c.id as user_id,
        //         c.name as c_name,
        //         c.phone_number as c_contact,
        //         c.email as c_email,
        //         CONCAT_WS(' ', c.address_1, c.address_2, c.city, c.state, c.zipcode) as c_address,
        //         u.name as u_name,
        //         u.phone_number as u_contact,
        //         u.email as u_email,
        //         CONCAT_WS(' ', u.address_1, u.address_2, u.city, u.state, u.zipcode) as u_address,
        //         packages.id as package_id,
        //         packages.name as package_name, 
        //         packages.pax,
        //         packages.inclusion,
        //         DATE_FORMAT(orders.reservation_date, '%M %d, %Y') as reservation_date,
        //         orders.note as note
        //     ")
        //     ->join('packages', 'orders.package_id', 'packages.id')
        //     ->join('users AS c', 'packages.user_id', 'c.id')
        //     ->join('users AS u', 'orders.user_id', 'u.id')
        //     ->where('orders.id', $order->id)
        //     ->get();

        // $order_id = $orders->pluck('order_id');
        // $package_id = $orders->pluck('package_id');

        // $items = Item::selectRaw('order_items.order_id as order_id, items.name as name, order_items.quantity as qty, categories.name as category')
        //     ->join('order_items', 'items.id', 'order_items.item_id')
        //     ->join('categories', 'items.category_id', 'categories.id')
        //     ->whereIn('order_items.order_id', $order_id)
        //     ->get();

        // $categories = CategoryRule::selectRaw('name, package_id')
        //     ->join('categories', 'category_rules.category_id', 'categories.id')
        //     ->whereIn('category_rules.package_id', $package_id)
        //     ->get();

        // $pdf = PDF::loadView('components.order-to-pdf', compact(['orders', 'items', 'categories']))->setOptions(['defaultFont' => 'sans-serif'])->setPaper('letter', 'landscape');

        // Notification::route('mail', Auth::user()->email)->notify(new NotifyUserOrderPlaced($order->id, $pdf->output()));
        Notification::route('mail', Auth::user()->email)->notify(new NotifyUserOrderPlaced($order->id));
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
