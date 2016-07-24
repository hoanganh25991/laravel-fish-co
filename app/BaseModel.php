<?php

namespace App;

use App\Traits\ApiUtil;
use App\Traits\ModelForeignKey;
use App\Traits\ModelIndex;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Expression;

/**
 * Class BaseModel
 * @package App
 * @method static firstOrFail($id)
 */
class BaseModel extends Model{
    use ModelForeignKey;
    use ModelIndex;
    use ApiUtil;


//    /**
//     * @param string $column column name
//     * @return string
//     */
//    public function getForeignKeyAt($column){
//        return "{$this->getTable()}_{$column}_foreign";
//    }
    public function getDates(){
        return [];
    }
    
    public function getCreatedAtAttribute($value){
        return $this->timestamp($value);
    }
    
    public function getUpdatedAtAttribute($value){
        return $this->timestamp($value);
    }
    
    public function addSelectRaw($expression){
        /** @var Builder $query */
        $query = $this->query();
        $query->columns = array_merge((array) $query->columns, (new Expression($expression)));
        return $query;
    }
}
