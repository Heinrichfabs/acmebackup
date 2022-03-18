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
        Schema::create("rescuers", function (Blueprint $table) {
            $table->increments("id");
            $table->string(column: "first_name");
            $table->string(column: "last_name");
            $table->string(column: "phone_number");
            $table->string(column: "images");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create("adopters", function (Blueprint $table) {
            $table->increments("id");
            $table->string(column: "first_name");
            $table->string(column: "last_name");
            $table->string(column: "phone_number");
            $table->string(column: "images");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create("animals", function (Blueprint $table) {
            $table->increments("id");
            $table->string(column: "animal_name");
            $table->integer(column: "age");
            $table->string(column: "gender");
            $table->string(column: "type");
            $table->string(column: "images");
            $table->integer(column: "rescuer_id")->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table
                ->foreign("rescuer_id")
                ->references("id")
                ->on("rescuers")
                ->onDelete("cascade");
        });

        Schema::create("animal_adopter", function (Blueprint $table) {
            $table->integer("animals_id")->unsigned();
            $table
                ->foreign("animals_id")
                ->references("id")
                ->on("animals")
                ->onDelete("cascade");
            $table->integer("adopter_id")->unsigned();
            $table
                ->foreign("adopter_id")
                ->references("id")
                ->on("adopters")
                ->onDelete("cascade");
        });

        Schema::create("disease_injuries", function (Blueprint $table) {
            $table->increments("id");
            $table->string(column: "classify");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create("animal_disease_injury", function (Blueprint $table) {
            $table->integer("animals_id")->unsigned();
            $table
                ->foreign("animals_id")
                ->references("id")
                ->on("animals")
                ->onDelete("cascade");
            $table->integer("disease_injury_id")->unsigned();
            $table
                ->foreign("disease_injury_id")
                ->references("id")
                ->on("disease_injuries")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("rescuers");
        Schema::dropIfExists("animals");
        Schema::dropIfExists("adopters");
        Schema::dropIfExists("animal_adopter");
        Schema::dropIfExists("disease_injuries");
        Schema::dropIfExists("animal_disease_injury");
    }
};
