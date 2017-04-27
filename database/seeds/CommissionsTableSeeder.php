<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CommissionsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$commissions = [
			[
				"user_id"		=> "1",
				"type"			=> "Photography",
				"description"	=> "2 Hour Photo Session",
				"price"			=> "10.05",
				"created_at"	=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"	=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"user_id"		=> "1",
				"type"			=> "Digital Art",
				"description"	=> "Cartoon Portrait",
				"price"			=> "8.99",
				"created_at"	=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"	=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"user_id"		=> "1",
				"type"			=> "Sketch",
				"description"	=> "Logo Brainstorm",
				"price"			=> "55.00",
				"created_at"	=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"	=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"user_id"		=> "2",
				"type"			=> "Photography",
				"description"	=> "Wedding Photos",
				"price"			=> "100",
				"created_at"	=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"	=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"user_id"		=> "2",
				"type"			=> "Digital Art",
				"description"	=> "Wedding Invitations",
				"price"			=> "70.85",
				"created_at"	=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"	=> Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				"user_id"		=> "3",
				"type"			=> "Photography",
				"description"	=> "Food Photography for Menus",
				"price"			=> "35.55",
				"created_at"	=> Carbon::now()->format('Y-m-d H:i:s'),
				"updated_at"	=> Carbon::now()->format('Y-m-d H:i:s')
			],
		];

		DB::table('commissions')->insert($commissions);
	}
}
