<?php

use Illuminate\Database\Seeder;
use App\Models\Option;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        //truncate existing data
        DB::table('options')->truncate();

        //priority options
        Option::create([
            'category' => 'priority',
            'title' => 'Low',
            'value' => 'Low'
        ]);
        Option::create([
            'category' => 'priority',
            'title' => 'High',
            'value' => 'High'
        ]);
        Option::create([
            'category' => 'priority',
            'title' => 'Very High',
            'value' => 'Very High'
        ]);

        //titles options
        Option::create([
            'category' => 'titles',
            'title' => 'Doctor',
            'value' => 'Doctor'
        ]);
        Option::create([
            'category' => 'titles',
            'title' => 'Madam',
            'value' => 'Madam'
        ]);
        Option::create([
            'category' => 'titles',
            'title' => 'Miss',
            'value' => 'Miss'
        ]);
        Option::create([
            'category' => 'titles',
            'title' => 'Mister',
            'value' => 'Mister'
        ]);
        Option::create([
            'category' => 'titles',
            'title' => 'Professor',
            'value' => 'Professor'
        ]);
        Option::create([
            'category' => 'titles',
            'title' => 'Sir',
            'value' => 'Sir'
        ]);

        //priority options
        Option::create([
            'category' => 'payment_methods',
            'title' => 'Cash',
            'value' => 'Cash'
        ]);
        Option::create([
            'category' => 'payment_methods',
            'title' => 'Check',
            'value' => 'Check'
        ]);
        Option::create([
            'category' => 'payment_methods',
            'title' => 'Bank Account',
            'value' => 'Bank Account'
        ]);
        Option::create([
            'category' => 'payment_methods',
            'title' => 'Credit Card',
            'value' => 'Credit Card'
        ]);

        //invoice_status
        Option::create([
            'category' => 'invoice_status',
            'title' => 'Open Invoice',
            'value' => 'Open Invoice'
        ]);
        Option::create([
            'category' => 'invoice_status',
            'title' => 'Overdue Invoice',
            'value' => 'Overdue Invoice'
        ]);
        Option::create([
            'category' => 'invoice_status',
            'title' => 'Paid Invoice',
            'value' => 'Paid Invoice'
        ]);

        //privacy statuses
        Option::create([
            'category' => 'privacy',
            'title' => 'Everyone',
            'value' => 'Everyone'
        ]);
        Option::create([
            'category' => 'privacy',
            'title' => 'Only me',
            'value' => 'Only me'
        ]);
        Option::create([
            'category' => 'privacy',
            'title' => 'Only internal users',
            'value' => 'Only internal users'
        ]);

        //show_times statuses
        Option::create([
            'category' => 'show_times',
            'title' => 'Free',
            'value' => 'Free'
        ]);
        Option::create([
            'category' => 'show_times',
            'title' => 'Busy',
            'value' => 'Busy'
        ]);

        //stages statuses
        Option::create([
            'category' => 'stages',
            'title' => 'New',
            'value' => 'New'
        ]);
        Option::create([
            'category' => 'stages',
            'title' => 'Qualification',
            'value' => 'Qualification'
        ]);
        Option::create([
            'category' => 'stages',
            'title' => 'Proposition',
            'value' => 'Proposition'
        ]);
        Option::create([
            'category' => 'stages',
            'title' => 'Negotiation',
            'value' => 'Negotiation'
        ]);
        Option::create([
            'category' => 'stages',
            'title' => 'Won',
            'value' => 'Won'
        ]);
        Option::create([
            'category' => 'stages',
            'title' => 'Lost',
            'value' => 'Lost'
        ]);
        Option::create([
            'category' => 'stages',
            'title' => 'Expired',
            'value' => 'Expired'
        ]);

        //stages statuses
        Option::create([
            'category' => 'lost_reason',
            'title' => 'Too expensive',
            'value' => 'Too expensive'
        ]);
        Option::create([
            'category' => 'lost_reason',
            'title' => 'We don\'t have people/skills',
            'value' => 'We don\'t have people/skills'
        ]);
        Option::create([
            'category' => 'lost_reason',
            'title' => 'Not enough stock',
            'value' => 'Not enough stock'
        ]);

        //interval statuses
        Option::create([
            'category' => 'interval',
            'title' => 'Day',
            'value' => 'day'
        ]);
        Option::create([
            'category' => 'interval',
            'title' => 'Week',
            'value' => 'week'
        ]);
        Option::create([
            'category' => 'interval',
            'title' => 'Month',
            'value' => 'month'
        ]);
        Option::create([
            'category' => 'interval',
            'title' => 'Year',
            'value' => 'year'
        ]);

        //currency statuses
        Option::create([
            'category' => 'currency',
            'title' => 'USD',
            'value' => 'USD'
        ]);
        Option::create([
            'category' => 'currency',
            'title' => 'EUR',
            'value' => 'EUR'
        ]);

        //product_type statuses
        Option::create([
            'category' => 'product_type',
            'title' => 'Stockable Product',
            'value' => 'Stockable Product'
        ]);
        Option::create([
            'category' => 'product_type',
            'title' => 'Consumable',
            'value' => 'Consumable'
        ]);
        Option::create([
            'category' => 'product_type',
            'title' => 'Service',
            'value' => 'Service'
        ]);

        //quotation statuses
        Option::create([
            'category' => 'quotation_status',
            'title' => 'Draft Quotation',
            'value' => 'Draft Quotation'
        ]);
        Option::create([
            'category' => 'quotation_status',
            'title' => 'Quotation Sent',
            'value' => 'Quotation Sent'
        ]);

        //product statuses
        Option::create([
            'category' => 'product_status',
            'title' => 'In Development',
            'value' => 'In Development'
        ]);
        Option::create([
            'category' => 'product_status',
            'title' => 'Normal',
            'value' => 'Normal'
        ]);
        Option::create([
            'category' => 'product_status',
            'title' => 'End of Lifecycle',
            'value' => 'End of Lifecycle'
        ]);
        Option::create([
            'category' => 'product_status',
            'title' => 'Obsolete',
            'value' => 'Obsolete'
        ]);

        //quotation statuses
        Option::create([
            'category' => 'sales_order_status',
            'title' => 'Pending',
            'value' => 'Pending'
        ]);
        Option::create([
            'category' => 'sales_order_status',
            'title' => 'Waiting',
            'value' => 'Waiting'
        ]);
        Option::create([
            'category' => 'sales_order_status',
            'title' => 'Ready to Delivery',
            'value' => 'Ready to Delivery'
        ]);
        Option::create([
            'category' => 'sales_order_status',
            'title' => 'Delivered',
            'value' => 'Delivered'
        ]);
        Option::create([
            'category' => 'sales_order_status',
            'title' => 'Cancelled',
            'value' => 'Cancelled'
        ]);
        Option::create([
            'category' => 'sales_order_status',
            'title' => 'Done',
            'value' => 'Done'
        ]);

        //Cloud Servers

        Option::create([
            'category' => 'backup_type',
            'title' => 'local',
            'value' => 'Local'
        ]);

        Option::create([
            'category' => 'backup_type',
            'title' => 'dropbox',
            'value' => 'Dropbox'
        ]);

        Option::create([
            'category' => 'backup_type',
            'title' => 's3',
            'value' => 'Amazon S3'
        ]);

        Option::create([
            'category' => 'backup_type',
            'title' => 's3',
            'value' => 'Amazon S3'
        ]);

        Eloquent::reguard();
    }
}