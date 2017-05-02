<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CommissionImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
			[
				"commission_id"		=> "1",
				"image"				=> "0B-mHz_IrAi-aUW5wMFVTVVQ0c3M",
				"created_at"		=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"		=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"commission_id"		=> "1",
				"image"				=> "0B-mHz_IrAi-acDhwVktJLVZLcFk",
				"created_at"		=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"		=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"commission_id"		=> "1",
				"image"				=> "0B-mHz_IrAi-aRkxtZVVhZU9xSzA",
				"created_at"		=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"		=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"commission_id"		=> "2",
				"image"				=> "0B-mHz_IrAi-abGpsTkUyT2JGb1U",
				"created_at"		=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"		=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"commission_id"		=> "2",
				"image"				=> "0B-mHz_IrAi-aRmI5NUtuRV9XR28",
				"created_at"		=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"		=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"commission_id"		=> "3",
				"image"				=> "0B-mHz_IrAi-abUJEMHdMY1Z1bms",
				"created_at"		=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"		=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"commission_id"		=> "3",
				"image"				=> "0B-mHz_IrAi-aRXlnVzhWNG9kSk0",
				"created_at"		=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"		=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"commission_id"		=> "4",
				"image"				=> "0B-mHz_IrAi-aZGxJVnBtVk1UQXc",
				"created_at"		=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"		=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"commission_id"		=> "4",
				"image"				=> "0B-mHz_IrAi-aTnVVUk9GMmIyYms",
				"created_at"		=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"		=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"commission_id"		=> "5",
				"image"				=> "0B-mHz_IrAi-ab3VudUllQUVqZmc",
				"created_at"		=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"		=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"commission_id"		=> "5",
				"image"				=> "0B-mHz_IrAi-aZk9QNjNSNzZrY2M",
				"created_at"		=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"		=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"commission_id"		=> "6",
				"image"				=> "0B-mHz_IrAi-aczQ1dHVXZVBkRW8",
				"created_at"		=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"		=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"commission_id"		=> "6",
				"image"				=> "0B-mHz_IrAi-aT2NGbE9CTzNYNjQ",
				"created_at"		=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"		=> Carbon::now()->format('Y-m-d H:i:s')
			],
		];

		DB::table('commission__images')->insert($images);
    }
}
