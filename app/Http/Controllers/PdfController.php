<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Shop\Order;
use Barryvdh\DomPDF\Facade\Pdf;
class PdfController extends Controller
{
    public function __invoke(Event $event)
    {
        $pdf = PDF::loadView('pdf', compact('event'));
        return $pdf->download('event_' . $event->case_number . '.pdf');
    }
}
