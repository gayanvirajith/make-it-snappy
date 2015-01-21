<?php 

class BaseModel extends Eloquent {

  /**
   * Base validator
   * @return Validator 
   */
  public static function validate($data) {
    return Validator::make($data, static::$rules);
  }
}