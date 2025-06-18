<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PlanConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customerName, $planName, $amount, $authorizationCode, $transactionDate;
    public $loginEmail, $loginPassword, $tenantUrl;

    public function __construct($customerName, $planName, $amount, $authorizationCode, $transactionDate, $loginEmail, $loginPassword, $tenantUrl)
    {
        $this->customerName = $customerName;
        $this->planName = $planName;
        $this->amount = $amount;
        $this->authorizationCode = $authorizationCode;
        $this->transactionDate = $transactionDate;
        $this->loginEmail = $loginEmail;
        $this->loginPassword = $loginPassword;
        $this->tenantUrl = $tenantUrl;
    }


    public function build()
    {
        return $this->subject('Confirmación de compra de plan en AbogaSense')
            ->view('emails.plan_confirmation')
            ->with([
                'customerName' => $this->customerName,
                'planName' => $this->planName,
                'planPrice' => number_format($this->amount, 0, ',', '.'),
                'authorizationCode' => $this->authorizationCode,
                'transactionDate' => $this->transactionDate
            ]);
    }
}