<?php
namespace App\Filters\V1;


use App\Filters\ApiFilter;

class CustomerQuery extends ApiFilter{

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

   

}