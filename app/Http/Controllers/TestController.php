<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use MahdiMajidzadeh\LaravelUnsplash\Photo;

class TestController extends Controller
{
    public function helloWorld(Request $request, Photo $photo)
    {
        $params = [
            'query' => 'avatar',
        ];
        $url = 'https://images.unsplash.com/photo-1527096267075-5ed3dc980196?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjMzOTkyfQ&s=46dd791fb1aae4dc1eaa5cc4369f33a9';
//        dd($url);
        $contents = file_get_contents($url);
        $file_name = str_random(20) . '.jpeg';
        $saved = \Storage::disk('public')->put($file_name, $contents);
        dd($saved);
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
