<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class question_m_model extends Model
{

    use SoftDeletes;

    //コネクション名を指定
    protected $connection = 'mysql';
    protected $table = 'question_m';
    protected $primaryKey = 'question_id';
}
