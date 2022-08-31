<?php

namespace App\Helpers\PaymentProcess;

use Illuminate\Support\Str;

class PayByPaypal implements PaymentStrategy
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
            'username' => $data['username'],
            'password' => $data['password'],
            'token' => $data['token'],
            'Paid' => $data['Paid'],
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

        if (!is_string($info['username'])) {
            return false;
        }

        if (Str::length($info['password']) < 8) {
            return false;
        }

        if (Str::length($info['token']) < 32) {
            return false;
        }

        return true;
    }

    /**
     * pay the product
     *
     * @param mixed $data
     * @return array
     */
    public function pay($data): array
    {
        try {
            $this->fillDetails($data);

            if ($this->checkPayment()) {
                $this->paymentDetails['Paid'] = true;
                $this->paymentDetails['password'] = password_hash($this->paymentDetails['password'], PASSWORD_DEFAULT);

                return [
                    'response' => [
                        'successful' => 'Payment Taken! Make sure to check your balance',
                    ],
                    'data' => $this->paymentDetails,
                ];
            }

            return [
                'response' => [
                    'error' => 'Payment Failed! Make Sure The Details Are Filled Correctly',
                ],
                'data' => '',
            ];
        } catch (\Throwable $th) {
            return $th->__toString();
        }
    }
}
