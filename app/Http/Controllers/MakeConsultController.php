<?php

namespace App\Http\Controllers;

use App\Http\Requests\DistributeRequest;
use App\Http\Requests\UploadFileRequest;
use Carbon\Carbon;

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

    /**
     * @return \Illuminate\Http\Response
     */
    public function smile()
    {
        return response()->view('make_consult.smile');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function atmosphere()
    {
        return response()->view('make_consult.atmosphere');
    }

    /**
     * @param UploadFileRequest $request
     * @return false|string
     */
    public function uploadFile(UploadFileRequest $request)
    {
        return $request->file('file')->storeAs(
            'atmosphere',
            Carbon::now()->format('Ymdhis') . '-' . $request->height . 'x' . $request->width
        );
    }
}
