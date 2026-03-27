<?php


namespace App\Filters\V1;

use App\Filters\ApiFilter;


class InvoiceQuery extends ApiFilter{

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


}