<?php

namespace App\Imports;

use App\Members;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class MembersImport implements ToModel, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!empty($row[3])) {
            if ($row[3] == "女"){
                $gender = "0";
            }else{
                $gender = "1";
            }
        }else{
            $gender = "1";
        }

        return new Members([
            //

            'name' => !empty($row[0]) ? trim ($row[0]) : "测试",
            'phone' => !empty($row[1]) ? intval ($row[1]) : "11111111111",
            'amount' => !empty($row[2]) ? trim ($row[2]) : "0.00",
            'gender' => $gender,
            'level_id' => 0,
            'status' => "start",
            'created_at' => date ('Y-m-d H:i:s', time ()),
            'updated_at' => date ('Y-m-d H:i:s', time ()),
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
