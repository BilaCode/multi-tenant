<?php

namespace Database\Seeders\Tenant;

use App\Models\PaymentGateway;
use App\Models\StaticOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantDemoDataSeed extends Seeder
{
    public static function execute()
    {
        $data = file_get_contents('assets/tenant/page-layout/tenant-demo-data.json');
        $all_data_decoded = json_decode($data);

        foreach ($all_data_decoded as $key=>$item)
        {
            StaticOption::updateOrCreate([
                'option_name' => $key,
                'option_value' => $item,
            ]);
        }
    }
}
