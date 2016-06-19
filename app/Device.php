<?php

namespace App;

class Device extends BaseModel{
    const ID = "id";
    const SERIAL_NUMBER = "serial_number";
    const DES = "des";

    const TABLE = "device";
    protected $table = self::TABLE;
}
