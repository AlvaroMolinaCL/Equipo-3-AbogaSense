<?php

namespace App\Mail;

use App\Models\LegalCase;
use Illuminate\Mail\Mailable;

class CaseUpdated extends Mailable
{
    public $case;

    public function __construct(LegalCase $case)
    {
        $this->case = $case;
    }

    public function build()
    {
        return $this->subject('Actualización de Caso')
                    ->view('emails.case_updated');
    }
}