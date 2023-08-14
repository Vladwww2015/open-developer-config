<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $connection = config('developer.database.connection') ?: config('database.default');

        $table = config('developer.extensions.config.table', 'developer_config');

        if (Schema::hasTable($table)) {
            Schema::connection($connection)->create($table, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('value');
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $connection = config('developer.database.connection') ?: config('database.default');

        $table = config('developer.extensions.config.table', 'developer_config');

        Schema::connection($connection)->dropIfExists($table);
    }
}
