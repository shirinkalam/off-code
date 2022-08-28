<?php

namespace App\Support\Cost;

use App\Support\Cost\Contracts\CostInterface;

class ShippingCost implements CostInterface
{
    const SHIPPING_COST = 20000 ;

    public function __construct(CostInterface $cost)
    {
        $this->cost = $cost ;
    }

    public function getCost()
    {
        return self::SHIPPING_COST;
    }
    public function getTotalCost()
    {
        return $this->cost->getTotalCost() + $this->getCost();
    }
    public function persianDescription()
    {
       return 'هزینه ی حمل و نقل';
    }
    public function getSummary()
    {
        return array_keys($this->cost->getSummary() , [
            $this->persianDescription() => $this->getCost(),
        ]);
    }
}
