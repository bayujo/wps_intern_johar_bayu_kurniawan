<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('statuses')->insert([
            ['name' => 'Pending'],
            ['name' => 'Disetujui'],
            ['name' => 'Ditolak'],
        ]);

        Schema::table('daily_logs', function (Blueprint $table) {
            $table->foreign('status')->references('id')->on('statuses');
        });
    }

    public function down()
    {
        Schema::table('daily_logs', function (Blueprint $table) {
            $table->dropForeign(['status']);
        });

        Schema::dropIfExists('statuses');
    }
}
