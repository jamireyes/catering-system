<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("INSERT INTO `packages` (`id`, `user_id`, `name`, `pax`, `price`, `inclusion`, `created_at`, `updated_at`, `deleted_at`, `discount`) VALUES
        (1, 1, 'Wedding Package A', 10, '10000.00', 'Speakers, Accommodation, Venue', '2022-08-26 06:27:32', '2022-08-26 06:27:32', NULL, NULL),
        (2, 1, 'Wedding Package B', 20, '20000.00', 'Speakers, Accommodation, Venue', '2022-08-26 06:28:03', '2022-08-26 06:28:03', NULL, NULL),
        (3, 1, 'Wedding Package C', 30, '30000.00', 'Speakers, Accommodation, Venue', '2022-08-26 06:30:28', '2022-08-26 06:30:28', NULL, NULL),
        (4, 12, 'Birthday Package A', 40, '40000.00', 'Speakers, Venue', '2022-08-26 06:52:02', '2022-08-26 06:52:02', NULL, NULL),
        (5, 12, 'Birthday Package B', 50, '50000.00', 'Speakers, Venue', '2022-08-26 06:52:24', '2022-08-26 06:52:24', NULL, NULL),
        (6, 12, 'Birthday Package C', 60, '60000.00', 'Speakers, Venue', '2022-08-26 06:52:47', '2022-08-26 06:52:47', NULL, NULL),
        (7, 1, 'Package A', 100, '100000.00', 'Speakers, Decorations, Venue', '2022-08-27 04:24:46', '2022-08-27 04:24:46', NULL, NULL);");
    }
}
