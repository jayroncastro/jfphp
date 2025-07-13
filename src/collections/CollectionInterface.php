<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\collections;

use Countable;
use IteratorAggregate;
use Traversable;

/**
 * This interface is the root in the collection hierarchy.
 * A collection represents a group of objects, known as its elements.
 * @template TValue The type of value the collection stores.
 * @extends IteratorAggregate
 * @extends Countable
 * @package jayroncastro
 * @subpackage jfphp/collections
 * @since 1.0.0
 * @version 1.0.0
 */
interface CollectionInterface extends IteratorAggregate, Countable {

    /**
     * This method returns an Iterator.
     * @access public
     * @since 1.0
     * @return Traversable<int, TValue>
     */
    public function getIterator(): Traversable;

    /**
     * This method returns the number of elements in this collection.
     * @access public
     * @since 1.0
     * @return int
     */
    public function count(): int;

    /**
     * This method adds an element to the collection.
     * @access public
     * @since 1.0
     * @param TValue $value The element whose presence in this collection must be guaranteed.
     * @return bool
     */
    public function add( mixed $value ): bool;

    /**
     * This method adds all specified elements to this collection.
     * @access public
     * @since 1.0
     * @param CollectionInterface $values
     * @return bool
     */
    public function addAll( CollectionInterface $values ): bool;

    /**
     * This method clears the contents of this collection.
     * @access public
     * @since 1.0
     * @return void
     */
    public function clear(): void;

    /**
     * This method returns `True` if this collection contains the value specified in the parameter.
     * @access public
     * @since 1.0
     * @param TValue $value The element to be checked.
     * @return bool
     */
    public function contains( mixed $value ): bool;

    /**
     * This method returns `True` if this collection contains all the specified elements.
     * @access public
     * @since 1.0
     * @param CollectionInterface $values
     * @return bool
     */
    public function containsAll( CollectionInterface $values ): bool;

    /**
     * This method returns `True` if this collection contains no elements.
     * @access public
     * @since 1.0
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * This method removes the specified value from this collection, returning `True` if deletion occurred.
     * @access public
     * @since 1.0
     * @param TValue $value The element to be removed from this collection.
     * @return bool
     */
    public function remove( mixed $value ): bool;

    /**
     * This method removes all the elements provided from this collection, returning `True` if the deletion has occurred.
     * @access public
     * @since 1.0
     * @param CollectionInterface<TValue> $values Collection containing elements to be removed from this collection.
     * @return bool Returns `True` if the collection was changed as a result of the call.
     */
    public function removeAll( CollectionInterface $values ): bool;

    /**
     * This method retains only the values given in the argument and deletes the rest of the collection, returning `True` if the deletion occurred.
     * @access public
     * @since 1.0
     * @param CollectionInterface<TValue> $values
     * @return bool Returns `True` if the collection was changed as a result of the call.
     */
    public function retainAll( CollectionInterface $values ): bool;

    /**
     * This method returns this collection in array format.
     * @access public
     * @since 1.0
     * @return array
     */
    public function toArray(): array;
}