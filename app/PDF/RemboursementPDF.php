<?php

namespace App\PDF;
use PDF;
use App\Models\Remboursement;

use Dompdf\Dompdf;
use Dompdf\Options;


class RemboursementPDF
{
    public function generatePDF()
    {
        $remboursements = Remboursement::all();

        $pdf = PDF::loadView('remboursement-pdf', compact('remboursements'));

        return $pdf->download('remboursement.pdf');
    }
}
