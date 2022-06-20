<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MembersImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        /* return new Member([
            'org_id' => $row['org_id'],
            'is_admin' => $row['is_admin'],
            'status' => $row['status'],
        ]); */

        return new Member($row);
    }

    public function rules(): array
    {
        return [
            'org_id' => 'required|unique:members',
            '*.org_id' => 'required|unique:members',
            'is_admin' => 'required',
            '*.is_admin' => 'required',
            'status' => 'required',
            '*.status' => 'required',
        ];
    }
}
