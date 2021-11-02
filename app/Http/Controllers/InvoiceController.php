<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

use App\Models\Order;

class InvoiceController extends Controller
{
    private $order;

    public function __construct()
    {
        $this->order = new Order;
    }

    // Test invoice creation function
    public function test()
    {
        $customer = new Buyer([
            'name'  => 'Test Customer',
            'custom_fields' => [
                'email' => 'test@example.com',
                // add buyer other fields data here
            ],
        ]);

        $item = (new InvoiceItem())->title('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->logo(public_path('assets/images/logo.png'))
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->addItem($item);

        return $invoice->stream();
    }

    public function orderInvoice( $order_number ) {
        // Initialization
            $items = [];
        // End Initialization

        $order_detail = $this->order->getOrderDetail(null, $order_number);
        //dd($order_detail);

        $client = new Party([
            'name'          => 'THEWAYSHOP',
            'phone'         => '+1-888 705 770',
            'custom_fields' => [
                'note'        => 'I am a test note.',
            ],
        ]);

        $customer = new Buyer([
            'name'  => $order_detail->billing_first_name.' '.$order_detail->billing_last_name,
            'custom_fields' => [
                'order no.' => $order_detail->order_number,
                'email' => $order_detail->billing_email,
                'payment method' => $order_detail->payment_method,
                // add buyer other fields data here
            ],
        ]);

        //dd($order_detail->items);
        foreach ( $order_detail->items as $item ) {
            $items[] = (new InvoiceItem())->title($item->title)->pricePerUnit($item->price);
        }

        $invoice = Invoice::make()
            ->seller($client)
            ->buyer($customer)
            ->logo(public_path('assets/images/logo.png'))
            ->currencySymbol(getCurrencySymbol())
            ->currencyCode(getCurrencyCode())
            ->addItems($items)
            ->totalDiscount( ($order_detail->coupen_amount)?$order_detail->coupen_amount:0)
            ->save('public');

        // send invoice link in email so that user can also directly open invoice through link.
        //dd($invoice->url());

        return $invoice->stream();
    }
}
