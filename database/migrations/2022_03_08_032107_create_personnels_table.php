<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("personnels", function (Blueprint $table) {
            $table->increments("personnel_id");
            $table->string(column: "full_name");
            $table->string(column: "email");
            $table->string(column: "password");
            $table->string(column: "role"); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("personnels");
    }
};