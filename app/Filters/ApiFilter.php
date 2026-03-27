<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter{

    protected $safeParams = [
    ];

    protected $columnMap = [
    ];

    protected $operatorMap = [
    ];

    public function transform(Request $request){

        $result = [];

        foreach ($this->safeParams as $param => $operators){
            $query = $request->query($param);

            if (!isset($query)){
                continue;
            }

            foreach($operators as $operator){
                if (isset($query[$operator])){
                    $result[] = [$param, $this->operatorMap[$operator], $query[$operator]];
                }


            }



        }

        return $result;

    }

}