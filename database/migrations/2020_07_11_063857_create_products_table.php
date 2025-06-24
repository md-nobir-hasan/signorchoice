<?php

use App\Models\DisplaySize;
use App\Models\DisplayType;
use App\Models\Graphic;
use App\Models\hdd;
use App\Models\ProcessorGeneration;
use App\Models\ProcessorModel;
use App\Models\ProductOffer;
use App\Models\Ram;
use App\Models\SpecialFeature;
use App\Models\ssd;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            //  😯😲😲 (88 fields) .. 😯😲😲
            // main attributes => (22)
            $table->id();
            $table->string('slug');
            $table->string('title');
            // $table->string('price');
            $table->text('photo');
            // $table->string('final_price');
            // $table->float('discount')->default(0);
            // $table->string('inventory_cost');
            // $table->text('model')->nullable();
            $table->string('mpn')->nullable();
            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->integer('stock')->nullable()->default(1);
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('child_cat_id')->nullable();
            $table->date('upcomming')->nullable();
            $table->boolean('is_featured')->deault(false);
            // $table->boolean('is_student')->deault(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            // $table->longText('special_feature')->nullable();
            $table->integer('average_rating')->default(5);
            $table->unsignedBigInteger('views')->nullable();
            $table->unsignedBigInteger('serial');
            // $table->string('size')->default('M')->nullable();
            $table->string('condition')->nullable();
            $table->boolean('is_showable_to_user')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('SET NULL');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('child_cat_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreignIdFor(ProductOffer::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();


            //Physical Specification => (4)
            // $table->string('color')->nullable();
            // $table->string('dimension')->nullable();
            // $table->string('weight')->nullable();
            // $table->text('physi_other')->nullable();

            //Warranty => (1)
            $table->string('replacement_warranty')->nullable(); //replacement_warranty
            $table->string('motherboard_warranty')->nullable(); //motherboard_warranty
            $table->string('service_warranty')->nullable(); //service_warranty
            $table->text('disclaimer')->nullable(); //service_warranty
            $table->text('note')->nullable(); //service_warranty
            $table->string('w_details')->nullable(); //Other warranty



            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            // Remove old photo column if needed
            // $table->dropColumn('photo');

            // Add new image columns
            $table->string('banner_image')->nullable()->after('title');
            $table->string('product_thumbnail_image')->nullable()->after('banner_image');
            $table->string('best_collection_image')->nullable()->after('product_thumbnail_image');
            $table->string('collection_arrived_image')->nullable()->after('best_collection_image');
            $table->string('instagram_image')->nullable()->after('collection_arrived_image');
            $table->string("instragram_link", 500)->nullable()->after('instagram_image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'banner_image',
                'product_thumbnail_image',
                'best_collection_image',
                'collection_arrived_image',
                'instagram_image',
                'instragram_link'
            ]);

            // Restore old photo column if needed
            // $table->text('photo')->nullable();
        });
    }
}
