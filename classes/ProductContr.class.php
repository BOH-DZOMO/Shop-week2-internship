<?php
require_once "../vendor/autoload.php";

class ProductContr extends Product{

    public function factoryCreate($num){
        $faker = Faker\Factory::create();
        // for ($i=0; $i < $num; $i++) { 
        //     $unit = $faker->numberBetween(500,8500);
        //     $this->addProduct($faker->numberBetween(0,11),$faker->unique()->ean13(),$faker->unique()->word,$faker->realText(150),"../assets/images/3.jpg",$faker->randomFloat(2,1,100),$unit,$unit + $faker->numberBetween(1500,10,000));
        // }
        $images = [
        "../assets/images/1.jpg", "../assets/images/2.jpg", "../assets/images/3.jpg",
        "../assets/images/4.jpg", "../assets/images/5.jpg", "../assets/images/6.jpg",
        "../assets/images/7.jpg", "../assets/images/8.jpg", "../assets/images/9.jpg",
        "../assets/images/10.jpg", "../assets/images/11.jpg", "../assets/images/12.jpg",
        "../assets/images/13.jpg", "../assets/images/14.jpg", "../assets/images/15.jpg",
        "../assets/images/16.jpg",
    ];

    $count = 0;
    while ($count < $num) {
        try {
            $unit = $faker->numberBetween(500, 8500);
            
            $this->addProduct(
                $faker->numberBetween(0, 11),               // user ID
                $faker->ean13(),                   // UNIQUE barcode
                $faker->words(3, true),                      // UNIQUE product name
                $faker->realText(150),                       // description
                $faker->randomElement($images),              // random image
                $faker->randomFloat(2, 1, 100),               // weight
                $unit,                                       // cost price
                $unit + $faker->numberBetween(1500, 10000)    // selling price
            );

            $count++;
        } catch (OverflowException $e) {
            // Pool exhausted — reset unique storage and try again
            $faker->unique(true); // resets unique tracker
        } catch (\Throwable $e) {
            // If DB rejects duplicate for another reason, retry
            continue;
        }
    }

    }

}