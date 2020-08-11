<?php

namespace App\Imports;

use App\Model\ServerDetail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportServerDetail implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        /**
         * Todo - parse price and save as float and unit as seperate column
         * Method already written - parsePrice
         */


         /**
          * Store server Details
          * @param Model information
          * @return  Model object
          */
        return new ServerDetail([
            'model'     => @$row['model'],
            'ram'       => @$row['ram'],
            'hardisk'   => @$row['hdd'],
            'location'  => @$row['location'],
            'price'     => @$row['price'],
            'hardisk_capacity_mb' => $this->capacityHardiskMB($row['hdd']),
            'ram_capacity_mb' => $this->capacityRamMB($row['ram'])
        ]);
    }
     /**
     * Return the integer version of hardisk size
     * @param Hardisk value is string formate ex: 2x2TBSATA2
     * @return capacity in MB
     */
    private function capacityHardiskMB($data)
    {
        if (preg_match('/(\d+)x(\d+)(M|G|T)B/', $data, $m)) {
            $capacity = $m[1];
            $capacity *= $m[3] === 'M' ? 1 : ($m[3] === 'G' ? 1000 : 1000000 );
            return $capacity * $m[2];
        }
    }

    /**
     * Return the integer version of ram size
     * @param String Ram value is string formate ex: 16GBDDR3
     * @return String capacity in MB
     */
    private function capacityRamMB($data)
    {
        if (preg_match('/(\d+)(M|G|T)B/', $data, $m)) {
            $capacity = $m[1];
            $capacity *= $m[2] === 'M' ? 1 : ($m[2] === 'G' ? 1000 : 1000000 );
            return $capacity;
        }
    }

    /**
     * Return the integer version of ram size
     * @param Prince value is string formate ex: 16GBDDR3
     * @return Array
     */
    private function parsePrice($data)
    {
        if (preg_match('(\€|\$|S\$)(\d*)(\.\d+)', $data, $m)) {
            $priceData['unit'] = $m[1];
            $priceData['price'] = $m[2] + $m[2];
            return $priceData;
        }
    }
}
