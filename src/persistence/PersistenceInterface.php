<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\persistence;

/**
 * This interface defines what any "persistence layer" should be
 * able to do: get, save, and delete a value associated with a
 * key and an ID.
 * @package jayroncastro
 * @subpackage jfphp/persistence
 * @since 1.2.0
 * @version 1.2.0
 */
interface PersistenceInterface {

    /**
     * This method gets the value of a field
     * @param int $objectId This parameter receives the id of a field.
     * @param string $key This parameter receives the name of a field's key.
     * @return mixed
     * @since 1.2.0
     * @version 1.2.0
     */
    public function get( int $objectId, string $key ): mixed;

    /**
     * This method saves the field value.
     * @param int $objectId This parameter receives the id of a field.
     * @param string $key This parameter receives the name of a field's key.
     * @param mixed $value This parameter receives the value to be stored.
     * @return bool
     * @since 1.2.0
     * @version 1.2.0
     */
    public function save( int $objectId, string $key, mixed $value ): bool;

    /**
     * This method deletes the value of a field.
     * @param int $objectId This parameter receives the id of a field.
     * @param string $key This parameter receives the name of a field's key.
     * @return bool
     * @since 1.2.0
     * @version 1.2.0
     */
    public function delete( int $objectId, string $key ): bool;

}