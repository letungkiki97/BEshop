<?php

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class MailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmailTemplate::create([
            'title' => 'Order',
            'subject' => 'Order',
            'text' => '',
            'type' => 'order_mail',
            'user_id' => 0,
        ]);
        EmailTemplate::create([
            'title' => 'Receive',
            'subject' => 'Receive',
            'text' => '',
            'type' => 'receive_mail',
            'user_id' => 0,
        ]);
        EmailTemplate::create([
            'title' => 'Delivery',
            'subject' => 'Delivery',
            'text' => '',
            'type' => 'delivery_mail',
            'user_id' => 0,
        ]);
        EmailTemplate::create([
            'title' => 'Reset Password',
            'subject' => 'Reset Password',
            'text' => '',
            'type' => 'password_mail',
            'user_id' => 0,
        ]);
        EmailTemplate::create([
            'title' => 'Welcome Normal User',
            'subject' => 'Welcome Normal User',
            'text' => '',
            'type' => 'normal_user_mail',
            'user_id' => 0,
        ]);
        EmailTemplate::create([
            'title' => 'Pending Professional User',
            'subject' => 'Pending Professional User',
            'text' => '',
            'type' => 'pending_professional_mail',
            'user_id' => 0,
        ]);
        EmailTemplate::create([
            'title' => 'Welcome Professional User',
            'subject' => 'Welcome Professional User',
            'text' => '',
            'type' => 'professional_user_mail',
            'user_id' => 0,
        ]);
    }
}
