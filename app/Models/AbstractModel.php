<?php

namespace App\Models;


abstract class AbstractModel {

    /**
     * The table associated with the model.
     * @var string
     */

    protected $table;

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
        $dbh = DatabaseFactory();

        $keys = array_keys($this->attributes);

        $results = $dbh->execute(
            'INSERT INTO @'.$this->table.' ( '.implode(', ', $keys).' ) VALUES ( :'.implode(', :', $keys).' ) ',
            $this->attributes
        );

        return $dbh->lastInsertId();
    }

    public function delete( $primaryKey )
    {
        $dbh = DatabaseFactory();

        $results = $dbh->execute(
            'DELETE FROM @'.$this->table.' WHERE id = :primaryKey',
            ['primaryKey' => $primaryKey]
        );

        return $result;
    }

    public static function find( $primaryKey )
    {
        $dbh = DatabaseFactory();

        $results = $dbh->single(
            'SELECT * FROM @'.$this->table.' WHERE id = :primaryKey',
            ['primaryKey' => $primaryKey]
        );

        if( $results )
        {
            return ( new static($results) );
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
