<?php

namespace App\Helpers\PaymentProcess;

use Illuminate\Support\Str;

class PayByCard implements PaymentStrategy
{
    /**
     * user payment details
     *
     * @var array
     */
    private $paymentDetails;

    /**
     * Fill User Payment details
     *
     * @param mixed $data
     * @return void
     */
    public function fillDetails($data): void
    {
        $this->paymentDetails = [
            'Full Name' => $data['fullName'],
            'Card Number' => $data['cardNumber'],
            'Expiry Month' => $data['expiryMonth'],
            'Expiry Year' => $data['expiryYear'],
            'CVV' => $data['cvv'],
            'Paid' => false,
        ];
    }

    /**
     * Fill User Payment details
     *
     * @return bool
     */
    public function checkPayment(): bool
    {
        $info = $this->paymentDetails;

        if (!is_string($info['Full Name'])) {
            return false;
        }

        if (!\is_numeric($info['Card Number'])) {
            return false;
        }

        if (Str::length($info['Card Number']) < 16) {
            return false;
        }

        if ($info['Expiry Year'] < 2021) {
            return false;
        }

        if (strlen($info['CVV']) !== 3) {
            return false;
        }

        return true;
    }

    /**
     * pay the product
     *
     * @return array
     */
    public function pay($data): array
    {
        try {
            $this->fillDetails($data);

            if ($this->checkPayment()) {
                $this->paymentDetails['Paid'] = true;
                $this->paymentDetails['Card Number'] = '************' . substr($this->paymentDetails['Card Number'], -4);

                return [
                    'response' => [
                        'successful' => 'Payment Taken! Make sure to check your balance',
                    ],
                    'data' => $this->paymentDetails,
                ];
            }

            return [
                'response' => [
                    'errors' => 'Payment Failed! Try To Fill The Correct Details.',
                ],
                'data' => '',
            ];
        } catch (\Throwable $th) {
            return $th->__toString();
        }
    }

}
