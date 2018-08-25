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
        if($result){
            // Additional insert log to table
            $ref_data_id = $this->attributes[$this->primaryKey];
            $data_type = $this->table;
            $json =$this->attributes;

            // Log::debug("ref_data_id: $ref_data_id");
            // Log::debug("data_type: $data_type");
            // Log::debug("json: ");
            // Log::debug($json);

            DB::statement("INSERT INTO ms_log_data (data_type, ref_data_id, last_data, created_at) VALUES ('$data_type', $ref_data_id, '".str_replace("'","",json_encode($json))."', now())");
        }
        return true;
    }

    protected function performInsert(Builder $query, array $options = [])
    {
        $result = parent::performInsert($query, $options);
        if($result){
            // Additional insert log to table
            $ref_data_id = $this->attributes[$this->primaryKey];
            $data_type = $this->table;
            $json = $this->attributes;

            // Log::debug("ref_data_id: $ref_data_id");
            // Log::debug("data_type: $data_type");
            // Log::debug("json: ");
            // Log::debug($json);

            DB::statement("INSERT INTO ms_log_data (data_type, ref_data_id, last_data, created_at) VALUES ('$data_type', $ref_data_id, '".str_replace("'","",json_encode($json))."', now())");
        }
        return true;
    }
}