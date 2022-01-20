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

        $price_total = Transaction::whereMonth('updated_at', $month)->whereYear('updated_at', $date)->select('price_total')->get();
        $arr = array();
        foreach ($price_total as $key) {
            $arr[] = $key->price_total;
        }
        $total = array_sum($arr);

        $pdf = PDF::loadview('pdf', \compact('report', 'date','total'));
        // /** @var Response $response */
        $response = $pdf->stream($name);
        return $response;
    }
}
