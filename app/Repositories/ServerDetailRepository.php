<?php

namespace App\Repositories;

//use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\ServerDetailRepositoryInterface;
use App\Model\ServerDetail;


class ServerDetailRepository implements ServerDetailRepositoryInterface
{
    /**
     * Fetch Data based on filter
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response collection
     */
    public function fetchData($request) {

        $data = $request->input();

        $storageMax = null; $ramArr = null; 
        $hardDisk=null; $storageRange = null; $location = null;

        if($request->has('ram')) {
            $ramParsedArr = explode(',', $data['ram']);
            foreach ($ramParsedArr as $ram) {
                $ramArr[] = $this->capacityRamMB($ram);
            }
        }

        if($request->has('hardisk')){
            $hardDisk =  $data['hardisk'];
        }

        if($request->has('location')){
            $location =  $data['location'];
        }

        
        $storageMin = !empty( $data['minStorage']) ? $data['minStorage']*1000000 : 0;
        $storageMax = !empty( $data['maxStorage']) ? $data['maxStorage']*1000000 : 100*1000000;
        

        return ServerDetail::when($location, function ($query, $location) {
        return $query->where('location' , $location);  
        })

        ->when($hardDisk, function ($query, $hardDisk) {
            return $query->where('hardisk', 'like', '%' .$hardDisk. '%');
        })
        ->when($ramArr, function ($query, $ramArr) {
            return $query->whereIn('ram_capacity_mb', $ramArr);
        })
        ->whereBetween('hardisk_capacity_mb', [$storageMin , $storageMax])
        ->get();
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
         * @param Ram value is string formate ex: 16GBDDR3
         * @return capacity in MB
         */
        private function capacityRamMB($data)
        {
            if (preg_match('/(\d+)(M|G|T)B/', $data, $m)) {
                $capacity = $m[1];
                $capacity *= $m[2] === 'M' ? 1 : ($m[2] === 'G' ? 1000 : 1000000 );
                return $capacity;
            }
        }
}