<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp;

use jayroncastro\jfphp\exception\IndexOutOfBoundsException;

/**
 * This interface defines all the methods needed to have precise control
 * over where each element can be inserted in the list. Elements can be
 * accessed by their integer index, that is, their position in the list,
 * as well as iterating over the elements in the list.
 * @package jayroncastro
 * @subpackage jfphp
 * @template TValue The type of value the list stores.
 * @extends CollectionInterface<TValue>
 * @since 1.0.0
 * @version 1.0.0
 */
interface ListInterface extends CollectionInterface {

    /**
     * This method inserts the specified element at the specified position in this list.
     * @throws IndexOutOfBoundsException
     * @param int $index This parameter receives the index at which the element should be inserted.
     * @param mixed $value This parameter receives the value to be inserted.
     * @return void
     */
    public function addAt( int $index, mixed $value ): void;

    /**
     * This method returns the element at the specified position in the list.
     * @throws IndexOutOfBoundsException
     * @param int $index This parameter receives the collection index.
     * @return mixed
     */
    public function get( int $index ): mixed;

    /**
     * This method returns the index of the first occurrence of the specified element in the list, or -1 if the list does not contain the searched element.
     * @param mixed $value This parameter receives a value to be searched in the collection.
     * @return int
     */
    public function indexOf( mixed $value ): int;

    /**
     * This method returns the index of the last occurrence of the specified element in the list, or -1 if the list does not contain the searched element.
     * @param mixed $value This parameter receives a value to be searched in the collection.
     * @return int
     */
    public function lastIndexOf( mixed $value ): int;

    /**
     * This method removes the element at the specified position in this list.
     * @throws IndexOutOfBoundsException
     * @param int $index This parameter receives the index to be removed.
     * @return mixed
     */
    public function removeAt( int $index ): mixed;

    /**
     * This method replaces an element in the list with the new element at the specified position.
     * @throws IndexOutOfBoundsException
     * @param int $index This parameter receives the index of the element to be replaced.
     * @param mixed $value This parameter receives the element to be replaced at the specified position.
     * @return void
     */
    public function set( int $index, mixed $value ): void;

    /**
     * This method returns a view of a portion of the list.
     * @throws IndexOutOfBoundsException
     * @param int $from This parameter receives the index at the beginning of the list.
     * @param int $to This parameter receives the index at the end of the list.
     * @return ListInterface
     */
    public function subList( int $from, int $to ): ListInterface;

    /**
     * Returns a list iterator over the elements of this list.
     * @param int $index The index of the first element to be returned by the iterator.
     * @return ListIteratorInterface<TValue>
     */
    public function listIterator(int $index = 0): ListIteratorInterface;
}