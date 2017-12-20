<?php

namespace App\Models;

use ArrayAccess;


/**
 * Abstract model
 */
abstract class AbstractModel implements ArrayAccess {

    /**
     * The table associated with the model.
     * @var string
     */
    const table = null;

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
            'INSERT INTO @'.static::table.' ( '.implode(', ', $keys).' ) VALUES ( :'.implode(', :', $keys).' ) ',
            
            $this->attributes
        );

        return $dbh->lastInsertId();
    }

    /**
     * Save model
     *
     * @return mixed
     */
    public function save()
    {
        $dbh = DatabaseFactory();
        
        $attributes = $this->attributes;

        $keys = array_keys($attributes);

        $keysString = array_map(function( $key ){ return ''.$key. ' = :'.$key; }, $keys);


        $attributes['primaryKey'] = $this->id;

        $results = $dbh->execute(
            'UPDATE @'.static::table.' SET '.implode(', ', $keysString).' WHERE id = :primaryKey ',
            
            $attributes
        );

        return $results;
    }

    /**
     * Delete model
     *
     * @return mixed
     */
    public function delete()
    {
        $dbh = DatabaseFactory();

        $results = $dbh->execute(
            'UPDATE @'.static::table.' SET is_deleted = :is_deleted, deleted_at = :deleted_at WHERE id = :primaryKey',
            
            ['is_deleted' => '1', 'deleted_at' => DatabaseDatetime(), 'primaryKey' => $this->id]
        );

        return $results;
    }

    /**
     * Find model by its id
     *
     * @param int $primaryKey
     * @return bool|mixed
     */
    public static function find( $primaryKey )
    {
        $dbh = DatabaseFactory();

        $results = $dbh->row(
            'SELECT * FROM @'.static::table.' WHERE id = :primaryKey AND is_deleted = :is_deleted',

            ['primaryKey' => $primaryKey, 'is_deleted' => '0']
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
        foreach( $attributes as $key => $value )
        {
            $this->attributes[$key] = $value;
        }
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
     * Get all attributes from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttributes()
    {
        return $this->attributes;
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



    /********************************************************************************
     * ArrayAccess interface
     *******************************************************************************/


    /**
     * Does this collection have a given key?
     *
     * @param  string $key The data key
     *
     * @return bool
     */
    public function offsetExists( $key )
    {
        return isset($this->attributes[$key]);
    }

    /**
     * Get collection item for key
     *
     * @param string $key The data key
     *
     * @return mixed The key's value, or the default value
     */
    public function offsetGet( $key )
    {
        return $this->getAttribute($key);
    }

    /**
     * Set collection item
     *
     * @param string $key   The data key
     * @param mixed  $value The data value
     */
    public function offsetSet( $key, $value )
    {
        $this->setAttribute($key, $value);
    }

    /**
     * Remove item from collection
     *
     * @param string $key The data key
     */
    public function offsetUnset( $key )
    {
        unset($this->attributes[$key]);
    }

    /**
     * Get number of items in collection
     *
     * @return int
     */
    public function count()
    {
        return count($this->attributes);
    }


}
