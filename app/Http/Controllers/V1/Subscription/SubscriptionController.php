<?php

declare(strict_types=1);

namespace App\Http\Controllers\v1\subscription;

use App\Helpers\ApiResponseHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Laravel\Paddle\Cashier;

class SubscriptionController extends Controller
{
    // I think this is not need maybe ?
    // public function index() :JsonResponse{
    //   $productPrices = Cashier::previewPrices(["pro_01krg9pnfmens9e6ccqtc5t05e","pro_01kfymcasfg3bx29270c07xvkb","pro_01kg5zdjnfaqywgb9wbnrsrkka"]);
    //    return APiResponseHandler::success("prices recieved prices",$productPrices);
    //   }

    public function store() {}
}
