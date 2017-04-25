<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('username')->unique();
			$table->boolean('artist')->default(false);
			$table->string('description')->default('N/A');
			$table->string('password');
			$table->boolean('verified')->default(false);
			$table->string('email_token')->nullable(); // this column will be a VARCHAR with no default value and will also BE NULLABLE
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::dropIfExists('users');
	}
}
