<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceProductLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_product_lots', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_lots_id');
            $table->foreign('product_lots_id')->references('id')->on('product_lots');
            $table->unsignedInteger('invoices_id');
            $table->foreign('invoices_id')->references('id')->on('invoices');
            $table->integer('cantidad');
            $table->decimal('precio_venta',10,2);
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
        Schema::dropIfExists('invoice_product_lots');
    }
}
