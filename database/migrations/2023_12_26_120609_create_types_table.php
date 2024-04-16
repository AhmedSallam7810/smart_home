<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ar_name')->nullable();
            $table->integer('category')->nullable();
            $table->boolean('show_in_app')->default(1);
            $table->string('image')->nullable();
            $table->timestamps();
        });

        \App\Models\Type::create([
            'name'=>'Living',
            'category'=>1
        ]);
        \App\Models\Type::create([
            'name'=>'Sleeping',
            'category'=>1
        ]);

        \App\Models\Type::create([
            'name'=>'Kitchen',
            'category'=>1
        ]);
        \App\Models\Type::create([
            'name'=>'lamp',
            'category'=>2
        ]);

        \App\Models\Type::create([
            'name'=>'air conditioner',
            'category'=>2
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('types');
    }
};
