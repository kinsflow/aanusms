<?php

namespace App\Imports;

use App\Result;
use Maatwebsite\Excel\Concerns\ToModel;

class ResultImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Result([
            'matric_no' => $row[0],
            'course_code' => $row[1],
            'test' => $row[2],
            'exam' => $row[3],
            'semester' => $row[4],
            'session' => $row[5]
        ]);
    }
}
