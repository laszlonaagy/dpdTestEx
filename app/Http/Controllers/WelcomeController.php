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

        // creating a rectangle object and assign values to its properties
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

        // calculate A-C and A-D distance and perimeter (not in meter)
          $AC =  sqrt(pow(($coordRect->latC - $coordRect->latA),2) + pow(($coordRect->longC - $coordRect->longA),2));
          $AD =  sqrt(pow(($coordRect->latD - $coordRect->latA),2) + pow(($coordRect->longD - $coordRect->longA),2));
          $perimeter = ($AD + $AC) * 2;

        // load data from csv file
        $csvFileName = "price_specification.csv";
        $csvFile = resource_path('data/' . $csvFileName);
        $prices = $this->readCSV($csvFile,array('delimiter' => ','));

        // assign data from csv file to variables
        $sarok = $prices[1];
        $oszlop = $prices[2];
        $drot = $prices[3];
        $kapu = $prices[4];



        // data structure of a record
        // $sarok = [ 0 : "sarok",  // nev
        //            1 : "0,5",    // meret(m)
        //            2 : "400"     // koltseg (eur)
        //           ]

        // Calculate AC and AD distance in meter
        $ACInMeter = $this->calculateDistanceInMeter($coordRect->latA,$coordRect->longA,$coordRect->latC,$coordRect->longC,6371000);
        $ADInMeter = $this->calculateDistanceInMeter($coordRect->latA,$coordRect->longA,$coordRect->latD,$coordRect->longD,6371000);

        // Calculate default cost
        $basePrice = $sarok[2] * 4 + $kapu[2] * 4 + $oszlop[2] * 8;

        // Calculate AC - Distance cost
        $ACSideDistance = ceil((($ACInMeter - ($sarok[1] * 2 + $kapu[1] + $oszlop[1] *2))/2) / ($drot[1] + $oszlop[1]));

        // If wire left from one AC side and it is longer than a unit (drot meret + oszlop meret) it can be used on DB side
        $wireLeft = fmod((($ACInMeter - $sarok[1] * 2 - $kapu[1] - $oszlop[1] *2)/2) / ($drot[1] + $oszlop[1]) , 1);
        if ($wireLeft > ($drot[1] + $oszlop[1] / 2))
        {
            $ACSideDistance += $ACSideDistance -1;
        }


        $ADSideDistance = ceil((($ADInMeter - ($sarok[1] * 2 + $kapu[1] + $oszlop[1] *2))/2) / ($drot[1] + $oszlop[1]));
        $wireLeft = fmod((($ADInMeter - $sarok[1] * 2 - $kapu[1] - $oszlop[1] *2)/2) / ($drot[1] + $oszlop[1]) , 1);
        if ($wireLeft > ($drot[1] + $oszlop[1] / 2))
        {
            $ADSideDistance += $ADSideDistance -1;
        }

        // Calculate the total price
        $totalPrice = $basePrice + ($ACSideDistance + $ADSideDistance) * ($oszlop[2] + $drot[2]) * 4;

        return response()->json(['latitudeC' => $coordRect->latC,
            'longitudeC' => $coordRect->longC,
            'longitudeD'=>$coordRect->longD,
            'latitudeD'=>$coordRect->latD,
            'perimeter'=>$perimeter,
            'totalPrice' => $totalPrice,
            'prices' => $prices
            ]);


}
    // Calculate the geographic distance in meter
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

    // read data from CSV file
    public function readCSV($csvFile, $array)
    {
        $file_handle = fopen($csvFile, 'r');
        while (!feof($file_handle))
        {
            $line_of_text[] = fgetcsv($file_handle, 0, $array['delimiter']);
        }
        fclose($file_handle);
        return $line_of_text;
    }

}
