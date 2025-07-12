<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\collections;

use Iterator;
use jayroncastro\jfphp\exception\IndexOutOfBoundsException;
use jayroncastro\jfphp\exception\NoSuchElementException;

/**
 * An iterator for lists that allows you to traverse the list in any
 * direction, modify the list during iteration, and get the current
 * position of the iterator.
 * @package jayroncastro
 * @subpackage jfphp/collections
 * @template TValue The type of value the iterator iterates through.
 * @extends Iterator<int, TValue>
 * @since 1.0.0
 * @version 1.0.0
 */
interface ListIteratorInterface extends Iterator {

    // --- Methods Inherited from \Iterator (Re-declared for Clarity) ---

    /**
     * Returns the element at the current cursor position.
     * @return TValue
     * @throws NoSuchElementException|IndexOutOfBoundsException
     */
    public function current(): mixed;

    /**
     * Returns the index `(key)` of the current cursor position.
     * @return int
     */
    public function key(): int;

    /**
     * Advances the cursor to the next position in the list.
     * @return void
     */
    public function next(): void;

    /**
     * Returns the cursor to the starting position `(index 0)`.
     * @return void
     */
    public function rewind(): void;

    /**
     * Checks if the current cursor position is valid.
     * @return bool
     */
    public function valid(): bool;


    // --- ListIteratorInterface Specific Methods ---

    /**
     * Inserts a new element into the list, exactly at the current cursor position.
     * @param mixed $value This parameter receives a value to be added to this list.
     * @return void
     */
    public function add( mixed $value ): void;

    /**
     * Checks if there are previous elements in the list when going backwards in the iteration.
     * @return bool
     */
    public function hasPrevious(): bool;

    /**
     * Returns the index of the element that would be returned by a future call to `next()`.
     * @return int
     */
    public function nextIndex(): int;

    /**
     * Returns the previous element of the list and moves the cursor position backwards.
     * @return mixed
     */
    public function previous(): mixed;

    /**
     * Returns the index of the element that would be returned by a future call to `previous()`.
     * @return int
     */
    public function previousIndex(): int;

    /**
     * Removes from the collection the last element that was returned
     * by `next()` or `previous()`.
     * @return void
     */
    public function remove(): void;

    /**
     * Replace the last element that was returned by `next()`
     * or `previous()` with the new value provided.
     * @param mixed $value
     * @return void
     */
    public function set( mixed $value ): void;

}