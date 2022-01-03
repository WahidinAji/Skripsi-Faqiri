<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportPdf extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $date = $request->date;
        $month = date_format(date_create($request->date), 'm');
        $report = Transaction::whereMonth('updated_at', $month)->whereYear('updated_at', $date)->get();
        $name = \now() . '_data-transaction';

        // $customeSIze = array(0, 0, 684, 792);

        // $pdf = PDF::loadview('pdf', \compact('transaction'))->setPaper($customeSIze, 'landsacpe');
        $pdf = PDF::loadview('pdf', \compact('report', 'date'));
        // /** @var Response $response */
        $response = $pdf->stream($name);
        return $response;
    }
}
