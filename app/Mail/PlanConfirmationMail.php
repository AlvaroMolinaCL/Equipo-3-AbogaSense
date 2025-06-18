<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlanConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customerName;
    public $planName;
    public $planPrice;
    public $authorizationCode;
    public $transactionDate;

    public function __construct($customerName, $planName, $planPrice, $authorizationCode, $transactionDate)
    {
        $this->customerName = $customerName;
        $this->planName = $planName;
        $this->planPrice = $planPrice;
        $this->authorizationCode = $authorizationCode;
        $this->transactionDate = $transactionDate;
    }

    public function build()
    {
        return $this->subject('Confirmación de compra de plan en AbogaSense')
                    ->view('emails.plan_confirmation')
                    ->with([
                        'customerName' => $this->customerName,
                        'planName' => $this->planName,
                        'planPrice' => number_format($this->planPrice, 0, ',', '.'),
                        'authorizationCode' => $this->authorizationCode,
                        'transactionDate' => $this->transactionDate
                    ]);
    }
}