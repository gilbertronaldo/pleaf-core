<?php

/**
 * Created by PhpStorm.
 * User: Ali Irawan (boylevantz@gmail.com)
 * Date: 8/3/16
 * Time: 11:43 AM
 */
namespace Sts\PleafCore;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Log;
use DB;

class ModelWithLogger extends Model
{
    protected function performUpdate(Builder $query, array $options = [])
    {
        $result = parent::performUpdate($query, $options);
        return true;
    }

    protected function performInsert(Builder $query, array $options = [])
    {
        $result = parent::performInsert($query, $options);
        return true;
    }
}