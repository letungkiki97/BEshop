<?php


use Efriandika\LaravelSettings\Facades\Settings;

class SettingsSeeder extends DatabaseSeeder
{

    public function run()
    {
        Settings::set('site_name', "Caza Backend System");
        Settings::set('site_email', 'admin@caza.vn');
        Settings::set('allowed_extensions', 'gif,jpg,jpeg,png,pdf,txt');
        Settings::set('backup_type', 'local');
        Settings::set('email_driver', 'smtp');
        Settings::set('minimum_characters', 3);
        Settings::set('date_format', 'F j,Y');
        Settings::set('time_format', 'H:i');

    }

}