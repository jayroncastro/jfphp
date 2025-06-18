<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp;

use jayroncastro\jfphp\AbstractCollection;
use jayroncastro\jfphp\exception\IndexOutOfBoundsException;
use jayroncastro\jfphp\ListInterface;

/**
 * This abstract class extends `AbstractCollection` and implements
 * `List Interface`. It provides the standard logic for ordered
 * collections with access to elements by numeric index, such as
 * `get`, `set`, and `indexOf`.
 * @template TValue
 * @implements ListInterface<TValue>
 * @extends AbstractCollection
 * @package jayroncastro
 * @subpackage jfphp
 * @since 1.0.0
 * @version 1.0.0
 */
abstract class AbstractList extends AbstractCollection implements ListInterface {

    /**
     * @inheritDoc
     * @throws IndexOutOfBoundsException
     * @return void
     */
    public function addAt( int $index, mixed $value ): void {
        // Allows adding to the end of the list (index === count)
        if ( $index < 0 || $index > $this->count() ) {
            throw new IndexOutOfBoundsException();
        }
        array_splice( $this->items, $index, 0, [ $value ] );
    }

    /**
     * @inheritDoc
     * @throws IndexOutOfBoundsException
     * @return mixed
     */
    public function get( int $index ): mixed {
        if ( isset( $this->items[ $index ] ) ) {
            return $this->items[ $index ];
        }
        throw new IndexOutOfBoundsException();
    }

    /**
     * @inheritDoc
     * @return int
     */
    public function indexOf( mixed $value ): int {
        $key = array_search( $value, $this->items, true );
        return ( $key === false ) ? -1 : $key;
    }

    /**
     * @inheritDoc
     * @return int
     */
    public function lastIndexOf( mixed $value ): int {
        $keys = array_keys( $this->items, $value, true );
        return empty( $keys ) ? -1 : end( $keys );
    }

    /**
     * @inheritDoc
     * @throws IndexOutOfBoundsException
     * @return mixed
     */
    public function removeAt( int $index ): mixed {
        if ( isset( $this->items[ $index ] ) ) {
            // Array_splice returns an array with the elements removed.
            // Since we only removed 1, we got the first (and only) item from that array.
            return array_splice( $this->items, $index, 1 )[0];
        }
        throw new IndexOutOfBoundsException();
    }

    /**
     * @inheritDoc
     * @throws IndexOutOfBoundsException
     * @return void
     */
    public function set(int $index, mixed $value): void {
        if ( isset( $this->items[ $index ] ) ) {
            $this->items[ $index ] = $value;
            return;
        }
        throw new IndexOutOfBoundsException();
    }

    /**
     * @inheritDoc
     */
    public function subList( int $from, int $to ): ListInterface {
        $count = $this->count();
        if ($from < 0 || $to > $count || $from > $to) {
            throw new IndexOutOfBoundsException();
        }
        $length = $to - $from;
        $subset = array_slice( $this->items, $from, $length );
        return new static($subset);
    }

    /**
     * {@inheritdoc}
     * @return ListIteratorInterface
     * @throws IndexOutOfBoundsException
     */
    public function listIterator( int $index = 0 ): ListIteratorInterface {
        if ( $index < 0 || $index > $this->count() ) {
            throw new IndexOutOfBoundsException("Iterator starting index out of bounds.");
        }
        return new ArrayListIterator( $this, $index );
    }

}