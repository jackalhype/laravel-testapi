<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::raw('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";');

        Schema::create('documents', function (Blueprint $table) {
            $table->uuid('id')->nullable(false)->primary()->unique()->default(DB::raw('uuid_generate_v4()'));
            $table->smallInteger('status')->default(0);
            $table->json('payload')->default('{}');
            $table->softDeletesTz();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
