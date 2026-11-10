<?php

namespace App\Http\Controllers\v1\subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Paddle\Cashier;
use App\Helpers\ApiResponseHandler;
use Illuminate\Http\JsonResponse;
class SubscriptionController extends Controller
{
    public function index() :JsonResponse{
      $productPrices = Cashier::previewPrices(["pro_01krg9pnfmens9e6ccqtc5t05e","pro_01kfymcasfg3bx29270c07xvkb","pro_01kg5zdjnfaqywgb9wbnrsrkka"]);
       return APiResponseHandler::success("prices recieved prices",$productPrices);
      }
}
