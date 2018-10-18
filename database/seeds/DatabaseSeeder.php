<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Efriandika\LaravelSettings\Facades\Settings;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		Sentinel::getRoleRepository()->createModel()->create(array(
            'name' => 'Admin',
            'slug' => 'admin',
        ));

	    Sentinel::getRoleRepository()->createModel()->create(array(
            'name' => 'Sales staff',
            'slug' => 'sales_staff',
        ));

        Sentinel::getRoleRepository()->createModel()->create(array(
            'name' => 'Sales manager',
            'slug' => 'sales_manager',
        ));

        Sentinel::getRoleRepository()->createModel()->create(array(
            'name' => 'Purchasing staff',
            'slug' => 'purchasing_staff',
        ));

        Sentinel::getRoleRepository()->createModel()->create(array(
            'name' => 'Purchasing manager',
            'slug' => 'purchasing_manager',
        ));

        Sentinel::getRoleRepository()->createModel()->create(array(
            'name' => 'Warehouse staff',
            'slug' => 'warehouse_staff',
        ));

        Sentinel::getRoleRepository()->createModel()->create(array(
            'name' => 'Warehouse manager',
            'slug' => 'warehouse_manager',
        ));

        $admin = Sentinel::registerAndActivate(array(
            'email' => 'admin@caza.vn',
            'password' => "admin",
            'first_name' => 'Caza',
            'last_name' => 'Admin',
        ));
        $admin->user_id = $admin->id;
        $admin->save();
        $admin->roles()->attach(1);

        $staff = Sentinel::registerAndActivate(array(
            'email' => 'sales@caza.vn',
            'password' => "sales",
            'first_name' => 'Sales',
            'last_name' => 'Staff',
        ));
        $staff->user_id = $admin->id;
        $staff->save();
        $staff->roles()->attach(2);

        Settings::set('site_name', "Caza Backend System");
        Settings::set('site_email', 'admin@caza.vn');
        Settings::set('allowed_extensions', 'gif,jpg,jpeg,png,pdf,txt');
        Settings::set('max_upload_file_size', 10000);
        Settings::set('backup_type', 'local');
        Settings::set('email_driver', 'smtp');
        Settings::set('minimum_characters', 3);
        Settings::set('date_format', 'd/m/Y');
        Settings::set('jquery_date', 'DD/MM/YYYY');
        Settings::set('time_format', 'H:i');
        Settings::set('jquery_date_time', 'DD/MM/YYYY HH:mm');
        Settings::set('ordering_fee', 4.5);
        Settings::set('deposit', 30);
        Settings::set('sales_person', 2);
        Settings::set('picking_lead_time', 1);
        Settings::set('tracking_number', 1);

		Model::reguard();
	}

}
