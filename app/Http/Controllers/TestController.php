<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function helloWorld(Request $request)
    {
        phpinfo();
    }

    /**
     * @param Request $request
     * @return string
     */
    public function fact(Request $request): string
    {
        $num = $request->input('n');
        $factorial = $this->f($num);
        return $factorial;
    }

    private function f($n)
    {
        return ($n < 2 ? 1 : $n * $this->f($n - 1));
    }

    /**
     * @param Request $request
     * @return array|null|string
     */
    public function notString(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'num' => 'required|integer|max:5',
        ]);
        $errors = $validator->errors();
        if ($validator->fails()) {
            return $errors->first();
        } else {
            $num = $request->input('num');
            $factorial = $this->f($num);
            return $factorial;
        }
    }

    /**
     * @param array $params
     * @return
     */
    public function image()
    {
        $params = [
            'query' => 'avatar',
        ];

        $unsplash = new \MahdiMajidzadeh\LaravelUnsplash\Photo();
        return $unsplash->random($params)->get()->urls->thumb;
    }
}
