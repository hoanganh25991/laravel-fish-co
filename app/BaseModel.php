<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ModelForeignKey;

class BaseModel extends Model{
    use ModelForeignKey;
//    /**
//     * @param string $column column name
//     * @return string
//     */
//    public function getForeignKeyAt($column){
//        return "{$this->getTable()}_{$column}_foreign";
//    }
}
