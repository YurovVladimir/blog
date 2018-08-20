<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistributeRequest;

class MakeConsultController extends Controller
{
    /**
     * @param int $m
     * @param int $n
     * @return int
     */
    protected function distributeStake(int $m, int $n): int
    {
        return (int)($m / $n);
    }

    /**
     * @param DistributeRequest $request
     * @return int
     */
    public function distribute(DistributeRequest $request): int
    {
        return $this->distributeStake($request->m, $request->n);
    }
}
