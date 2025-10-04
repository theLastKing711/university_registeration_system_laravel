<?php

namespace App\Services\API;

use App\Models\OpenCourseRegisteration;
use Stripe\StripeClient;

class StripeService
{
    public function __construct(
        public StripeClient $stripe
    ) {}

    public function createOpenCourseProduct(OpenCourseRegisteration $open_course)
    {
        $this
            ->stripe
            ->products
            ->create([
                'id' => $open_course->id,
                'name' => $open_course->course->name,
            ]);

        // one-time purchase pricing
        $this
            ->stripe
            ->prices
            ->create([
                'product' => $open_course->id,
                'unit_amount' => $open_course->price_in_usd * 100,
                'currency' => 'usd',
                // 'lookup_key' => 'standard_monthly',
            ]);
    }

    public function updateOpenCourseProduct(OpenCourseRegisteration $open_course)
    {
        $old_price_id =
                              $this
                                  ->stripe
                                  ->products
                                  ->retrieve($open_course->id)
                                  ->default_price;

        $old_price_in_cents =
          $this
              ->stripe
              ->prices
              ->retrieve(
                  $old_price_id
              )
              ->unit_amount;

        $price_has_changed =
            $old_price_in_cents
            !=
            $open_course->price_in_usd * 100;

        if ($price_has_changed) {
            $new_price =
                $this
                    ->stripe
                    ->prices
                    ->create([
                        'product' => $open_course->id,
                        'unit_amount' => $open_course->price_in_usd * 100,
                        'currency' => 'usd',
                    ]);

            $this
                ->stripe
                ->products
                ->update(
                    $open_course->id,
                    [
                        'name' => $open_course->course->name,
                        'default_price' => $new_price,
                    ]);

            return;
        }

        $this
            ->stripe
            ->products
            ->update(
                $open_course->id,
                [
                    'name' => $open_course->course->name,
                ]);

    }
}
