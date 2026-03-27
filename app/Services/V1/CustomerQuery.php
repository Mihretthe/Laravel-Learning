<?php
namespace App\Services\V1;

use Illuminate\Http\Request;

class CustomerQuery{

    protected $safeParams = [
        'name' => ['eq'],
        'email' => ['eq'],
        'type' => ['eq'],
        'address' => ['eq'],
        'city' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt'],
    ];

    // protected $columnMap = [
    //     'postalCode' => 'postalCode'
    // ];

    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'lt' => '<',
        'lte' => '<=',
        'gte' => '>='
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