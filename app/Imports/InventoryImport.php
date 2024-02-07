<?php

namespace App\Imports;

use App\Models\Inventory; //this does not exist
use Maatwebsite\Excel\Concerns\ToModel;

class InventoryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Inventory([
            'school_property' => $row[0],
            'property_number'=> $row[1],
            'unit_of_measure'=> $row[2],
            'unit_value'=> $row[3],
            'quantity_per_property'=> $row[4],
            'quantity_per_physical'=> $row[5],
            'quantity'=> $row[6],
            'value'=> $row[7],
            'total_value'=> $row[8],
            'remarks'=> $row[9],
            'category'=> $row[10],
            'item_purchased_through_MOOE'=> $row[11],
            'donation'=> $row[12],
            'grade_level'=> $row[13]
     
        ]);
    }
}


?>