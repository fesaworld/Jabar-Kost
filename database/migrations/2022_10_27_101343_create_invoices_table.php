<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softdeletes();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('room_id');
            $table->datetime('start');
            $table->datetime('end');
            $table->decimal('discount');
            $table->decimal('total_price', 25,5);
            $table->text('trf_image')->nullable();
            $table->string('status');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate(DB::raw('NO ACTION'))
                ->onDelete(DB::raw('NO ACTION'));

            $table->foreign('room_id')
                ->references('id')
                ->on('rooms')
                ->onUpdate(DB::raw('NO ACTION'))
                ->onDelete(DB::raw('NO ACTION'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
