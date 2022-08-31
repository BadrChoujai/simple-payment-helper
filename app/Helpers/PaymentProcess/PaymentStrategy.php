<?php

namespace App\Helpers\PaymentProcess;

interface PaymentStrategy
{
    /**
     * fill in payment details
     *
     * @param mixed $data
     * @return void
     */
    public function fillDetails($data): void;

    /**
     * check payment details
     *
     * @return bool
     */
    public function checkPayment(): bool;

    /**
     * Pay
     * @param mixed $data
     * @return array
     */
    public function pay($data): array;
}
