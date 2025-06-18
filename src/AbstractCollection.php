<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp;

use jayroncastro\jfphp\CollectionInterface;
use ReturnTypeWillChange;
use Traversable;

/**
 * The abstract base class that implements `CollectionInterface`. Provides
 * the default implementation and common logic for all collections in the
 * framework, ensuring code reuse and consistency.
 * @template TValue
 * @implements CollectionInterface<TValue>
 * @package jayroncastro
 * @subpackage jfphp
 * @since 1.0.0
 * @version 1.0.0
 */
abstract class AbstractCollection implements CollectionInterface {

    /**
     * @var array<int, TValue>
     */
    protected array $items;

    /**
     * This is the constructor method of the class
     * @param array $items This parameter receives an array.
     */
    public function __construct( array $items = [] ) {
        $this->items = array_values( $items );
    }

    /**
     * @inheritDoc
     * @return Traversable
     */
    public function getIterator(): Traversable {
        return new \ArrayIterator( $this->items );
    }

    /**
     * @inheritDoc
     * @return int
     */
    public function count(): int {
        return count( $this->items );
    }

    /**
     * @inheritDoc
     * @param TValue $value The element to be added to the collection.
     * @return bool
     */
    public function add( mixed $value ): bool {
        $this->items[] = $value;
        return true;
    }

    /**
     * @inheritDoc
     * @return bool
     */
    public function addAll( CollectionInterface $values ): bool {
        foreach ( $values as $value ) {
            $this->add( $value );
        }
        return true;
    }

    /**
     * @inheritDoc
     * @return void
     */
    public function clear(): void {
        $this->items = [];
    }

    /**
     * @inheritDoc
     * @return bool
     */
    public function contains( mixed $value ): bool {
        return in_array( $value, $this->items, true );
    }

    /**
     * @inheritDoc
     * @return bool
     */
    public function containsAll( CollectionInterface $values ): bool {
        //If the other collection is empty, the condition is always true.
        if ( $values->isEmpty() ) {
            return true;
        }
        //For each item in the received collection, we check whether it is contained in the current collection.
        return array_all(
            $values->toArray(),
            fn( $value ) => $this->contains( $value )
        );

    }

    /**
     * @inheritDoc
     * @return bool
     */
    public function isEmpty(): bool {
        return $this->count() === 0;
    }

    /**
     * @inheritDoc
     * @return bool
     */
    public function remove( mixed $value ): bool {
        //1. Searches for the element key in the array, using strict comparison (===).
        $key = array_search( $value, $this->items, true );
        //2. If the key is not found (the result is false), the item does not exist.
        #Nada é alterado, então retornamos false.
        if ($key === false) {
            return false;
        }
        //3. If the key was found, we remove the element using the key.
        unset($this->items[$key]);
        //4. (Optional, but recommended) We re-index the array so that the keys
        $this->items = array_values($this->items);
        //5. Since the collection has been modified, we return true.
        return true;
    }

    /**
     * @inheritDoc
     * @return bool Returns `True` if the collection was changed as a result of the call.
     */
    public function removeAll( CollectionInterface $values ): bool {
        //1. Store the original item count so you know if anything changed in the end.
        $originalCount = $this->count();
        //2. Converts the collection of values to be removed to a native array.
        $valuesToRemove = $values->toArray();
        //If there is nothing to remove, we do nothing.
        if ( empty( $valuesToRemove ) ) {
            return false;
        }
        //3. Use array_diff to compute a new array containing only the items
        //   from our collection that are NOT on the removal list.
        $this->items = array_diff( $this->items, $valuesToRemove );
        //4. Re-indexes the array to ensure keys are sequential.
        $this->items = array_values($this->items);
        //5. Compare the new count with the original. If the new count is lower,
        //   the collection has been modified, so we return true.
        return $this->count() < $originalCount;
    }

    /**
     * @inheritDoc
     * @return bool Returns `True` if the collection was changed as a result of the call.
     */
    public function retainAll( CollectionInterface $values ): bool {
        //1. Keeps the original item count so you know if the collection has been modified.
        $originalCount = $this->count();
        //2. Converts the collection of values to be held into an array.
        $valuesToRetain = $values->toArray();
        //3. Use array_intersect to compute a new array containing only the elements
        //   that exist in BOTH lists (the intersection).
        $this->items = array_intersect( $this->items, $valuesToRetain );
        //4. Re-indexes the array to maintain sequential keys.
        $this->items = array_values($this->items);
        //5. Compare the new count with the original to determine if there has been a change.
        return $this->count() < $originalCount;
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function toArray(): array {
        return $this->items;
    }


}