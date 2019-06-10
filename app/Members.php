<?php
/**
 * MembersModel
 * @author chapin <chapinwan@yahoo.com>
 * @date 2019-06-10
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    //
    protected $fillable = ['name', 'gender', 'phone', 'amount'];
}
