<?php

namespace App\Exports;

use App\Models\Comment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class CommentsExport implements FromCollection
{
    /**
     * @var Collection
     */
    public $comments;

    /**
     * CommentsExport constructor.
     * @param Collection $comments
     */
    public function __construct(Collection $comments)
    {
        $this->comments = $comments;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->comments;
    }
}
