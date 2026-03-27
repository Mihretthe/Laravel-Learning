<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class InvoiceQuery{

    protected $safeParams = [
        'customerId' => ['eq'],
        'amount'=> ['eq', 'gt', 'lt'],
        'status'=> ['eq'],
        'billedDate'=> ['eq'],
        'paidDate'=> ['eq'],
    ];

    protected $operatorMap = [
        'eq' => '=',
        'gt' => '>',
        'lt' => '<',
        'gte' => '>=',
        'lte' => '<='
    ];

    protected $columnMap = [
        'customerId' => 'customer_id',
    ];

    public function transform(Request $request){
        $result = [];

        foreach ($this->safeParams as $param => $operators){
            
            $query = $request->query($param);
            if (!isset($query)){
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach($operators as $operator){
                if(isset($query[$operator])){
                    $result[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }


        }

        return $result;

    }



}