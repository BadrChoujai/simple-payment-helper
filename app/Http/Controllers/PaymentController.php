<?php

namespace App\Http\Controllers;

use App\Helpers\PaymentProcess\PayByCard;
use App\Helpers\PaymentProcess\PayByPaypal;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Payment done by paypal
     *
     * @param Request $request
     * @return mixed
     */
    public function paymentByPaypal(Request $request)
    {
        $payDetails = $request->get('data');

        $result = (new PayByPaypal())->pay($payDetails);

        return response()->json([
            'response' => $result['response'],
            'data' => $result['data'],
        ]);

    }

    /**
     * Payment done by Card
     *
     * @param Request $request
     * @return mixed
     */
    public function paymentByCard(Request $request)
    {
        $payDetails = $request->get('data');

        $result = (new PayByCard())->pay($payDetails);

        return response()->json([
            'response' => $result['response'],
            'data' => $result['data'],
        ]);
    }
}
