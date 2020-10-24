<?php
/**
 * Created by PhpStorm.
 * User: phangiahai
 * Date: 2020-10-22
 * Time: 10:22
 */

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model as BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

abstract class Model extends BaseModel
{
    use HasFactory;
}