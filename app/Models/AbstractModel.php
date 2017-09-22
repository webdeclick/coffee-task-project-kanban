<?php

namespace App\Models;

use Database\Interfaces\ConnectionRetrieveInterface;
use Database\ConnectionRetrieveTrait;


abstract class AbstractModel implements ConnectionRetrieveInterface {

    use ConnectionRetrieveTrait;

    /**
     * The table associated with the model.
     * @var string
     */

    protected $table;

    /**
     * primary key for the model
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * attributes
     * @var array
     */
    protected $attributes = [];


    /**
     * Constructor
     * 
     * @param mixed $attributes
     */
    public function __construct( array $attributes = [] )
    {
        $this->attributes($attributes);
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return static
     */
    public function create()
    {
        $dbh = $this->connection();

        $results = $dbh->execute(
            'INSERT INTO @'.$this->table.' ( '.implode(', ', $this->attributes).' ) VALUES ( :'.implode(', :', $this->attributes).' ) ',
            $this->attributes
        );

        return $dbh->lastInsertId();
    }

    public function delete( $primaryKey )
    {
        // $model = ( new static );
        
        $dbh = $this->connection();

        $results = $dbh->execute(
            'DELETE FROM @'.$this->table.' WHERE '.$this->primaryKey.' = :primaryKey',
            ['primaryKey' => $primaryKey]
        );

        return $result;
    }

    public static function find( $primaryKey )
    {
        $model = ( new static );
        
        $dbh = $model->connection();

        $results = $dbh->single(
            'SELECT * FROM @'.$this->table.' WHERE '.$this->primaryKey.' = :primaryKey',
            ['primaryKey' => $primaryKey]
        );

        if( $results )
        {
            return $model->attributes($results);
        }

        return null;
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * Set attributes
     *
     * @param array $attributes
     */
    public function attributes( array $attributes = [] )
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute( $key, $default = null )
    {
        if( isset($this->attributes[$key]) )
        {
            return $this->attributes[$key];
        }
        return $default;
    }

    /**
     * Dynamically retrieve attributes on the model
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get( $key )
    {
        return $this->getAttribute($key);
    }

    /**
     * Set a given attribute on the model
     *
     * @param  string  $key
     * @param  mixed   $value
     */
    public function setAttribute( $key, $value )
    {
        $this->attributes[$key] = $value;
    }

    /**
     * Dynamically set attributes on the model
     *
     * @param  string  $key
     * @param  mixed   $value
     */
    public function __set( $key, $value )
    {
        $this->setAttribute($key, $value);
    }

    /**
     * Determine if an attribute exists on the model
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset( $key )
    {
        return isset($this->attributes[$key]);
    }

    /**
     * Unset an attribute on the model
     *
     * @param  string  $key
     * @return void
     */
    public function __unset( $key )
    {
        unset($this->attributes[$key]);
    }


}
