<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RectangleModel;
use Maatwebsite\Excel\Excel;

class WelcomeController extends Controller
{
    public function doCalculations(Request $request)
    {
        $input = $request->all();

        $coordRect = new RectangleModel();
        $coordRect->latA = $input['latA'];
        $coordRect->longA = $input['longA'];
        $coordRect->latB = $input['latB'];
        $coordRect->longB = $input['longB'];
        $coordRect->latC = $input['latB'];
        $coordRect->longC = $input['longA'];
        $coordRect->longD = $input['longB'];
        $coordRect->latD = $input['latA'];

        //
        //      A  --------------------------- C
        //        |                           |
        //        |                           |
        //        |                           |
        //        |                           |
        //        |                           |
        //        |                           |
        //      D  --------------------------- B
        //

          $AC =  sqrt(pow(($coordRect->latC - $coordRect->latA),2) + pow(($coordRect->longC - $coordRect->longA),2));
          $AD =  sqrt(pow(($coordRect->latD - $coordRect->latA),2) + pow(($coordRect->longD - $coordRect->longA),2));
          $perimeter = ($AD + $AC) * 2;


        $sarok = [
            'elem' => 'sarok',
            'meret' => 0.5,
            'koltseg' => 400
        ];

        $oszlop = [
            'elem' => 'oszlop',
            'meret' => 0.2,
            'koltseg' => 100
        ];

        $drot = [
            'elem' => 'drot',
            'meret' => 2,
            'koltseg' => 50
        ];

        $kapu = [
            'elem' => 'kapu',
            'meret' => 5,
            'koltseg' => 1000
        ];

        $ACInMeter = $this->calculateDistanceInMeter($coordRect->latA,$coordRect->longA,$coordRect->latC,$coordRect->longC,6371000);
        $ADInMeter = $this->calculateDistanceInMeter($coordRect->latA,$coordRect->longA,$coordRect->latD,$coordRect->longD,6371000);

        $basePrice = $sarok['koltseg'] * 4 + $kapu['koltseg'] * 4 + $oszlop['koltseg'] * 8;
        $wireLeft = [];
        $ACSideDistance = ceil((($ACInMeter - ($sarok['meret'] * 2 + $kapu['meret'] + $oszlop['meret'] *2))/2) / ($drot['meret'] + $oszlop['meret']));
        array_push($wireLeft,fmod((($ACInMeter - $sarok['meret'] * 2 - $kapu['meret'] - $oszlop['meret'] *2)/2) / ($drot['meret'] + $oszlop['meret']) , 1));
        if ($wireLeft[0] > ($drot['meret'] + $oszlop['meret'] / 2))
        {
            $ACSideDistance += $ACSideDistance -1;
        }
        unset($wireLeft); // remove from symbol table

        $wireLeft = array();

        $ADSideDistance = ceil((($ADInMeter - ($sarok['meret'] * 2 + $kapu['meret'] + $oszlop['meret'] *2))/2) / ($drot['meret'] + $oszlop['meret']));
        array_push($wireLeft,fmod((($ADInMeter - $sarok['meret'] * 2 - $kapu['meret'] - $oszlop['meret'] *2)/2) / ($drot['meret'] + $oszlop['meret']) , 1));
        if ($wireLeft[0] > ($drot['meret'] + $oszlop['meret'] / 2))
        {
            $ADSideDistance += $ADSideDistance -1;
        }
        unset($wireLeft); // remove from symbol table

        $totalPrice = $basePrice + ($ACSideDistance + $ADSideDistance) * ($oszlop['koltseg'] + $drot['koltseg']) * 4;

        return response()->json(['latitudeC' => $coordRect->latC,
            'longitudeC' => $coordRect->longC,
            'longitudeD'=>$coordRect->longD,
            'latitudeD'=>$coordRect->latD,
            'perimeter'=>$perimeter,
            'totalPrice' => $totalPrice,
            ]);


}

    public function calculateDistanceInMeter(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

}
