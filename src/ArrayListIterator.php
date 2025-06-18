<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp;

use jayroncastro\jfphp\exception\IllegalStateException;
use jayroncastro\jfphp\exception\IndexOutOfBoundsException;
use jayroncastro\jfphp\exception\NoSuchElementException;
use jayroncastro\jfphp\ListIteratorInterface;

/**
 * Implementation of `ListIteratorInterface` that allows you to
 * traverse a list in any direction, get index information, and
 * safely modify the list during the iteration itself.
 * @template TValue
 * @implements ListIteratorInterface<TValue>
 * @package jayroncastro
 * @subpackage jfphp
 * @since 1.0.0
 * @version 1.0.0
 */
class ArrayListIterator implements ListIteratorInterface {

    /**
     * The list we are iterating over.
     * @var ListInterface<TValue>
     */
    private ListInterface $list;

    /**
     * The current cursor position (points to the next element to be returned by next()).
     * @var int
     */
    private int $cursor;

    /**
     * The index of the last element returned by `next()` or `previous()`,
     *  It is `-1` if the last operation was `add()` or `remove()`.
     * @var int
     */
    private int $lastReturnedIndex = -1;

    /**
     * This method is the constructor of this Iterator
     * @param ListInterface<TValue> $list The list to iterate over.
     * @param int $startIndex The starting position of the cursor.
     * @throws IndexOutOfBoundsException
     */
    public function __construct( ListInterface $list, int $startIndex = 0 ) {
        if ( $startIndex < 0 || $startIndex > $list->count() ) {
            throw new IndexOutOfBoundsException( "Iterator starting index out of bounds." );
        }
        $this->list = $list;
        $this->cursor = $startIndex;
    }

    // --- METHODS INHERITED FROM ITERATOR ---

    /**
     * @inheritDoc
     * @return mixed
     * @throws NoSuchElementException|IndexOutOfBoundsException
     */
    public function current(): mixed {
        if ( ! $this->valid() ) {
            throw new NoSuchElementException();
        }
        return $this->list->get( $this->cursor );
    }

    /**
     * @inheritDoc
     * @return int
     */
    public function key(): int {
        return $this->cursor;
    }

    /**
     * @inheritDoc
     * @return void
     */
    public function next(): void {
        $this->lastReturnedIndex = $this->cursor;
        $this->cursor++;
    }

    /**
     * @inheritDoc
     * @return void
     */
    public function rewind(): void {
        $this->cursor = 0;
        $this->lastReturnedIndex = -1;
    }

    /**
     * @inheritDoc
     * @return bool
     */
    public function valid(): bool {
        return $this->cursor < $this->list->count();
    }

    // --- ListIteratorInterface SPECIFIC METHODS ---

    /**
     * @inheritDoc
     * @return void
     * @throws IndexOutOfBoundsException
     */
    public function add( mixed $value ): void {
        $this->list->addAt( $this->cursor, $value );
        $this->cursor++;
        $this->lastReturnedIndex = -1; //Invalidates set() and remove()
    }

    /**
     * @inheritDoc
     * @return bool
     */
    public function hasPrevious(): bool {
        return $this->cursor > 0;
    }

    /**
     * @inheritDoc
     * @return int
     */
    public function nextIndex(): int {
        return $this->cursor;
    }

    /**
     * @inheritDoc
     * @return mixed
     * @throws IndexOutOfBoundsException
     */
    public function previous(): mixed {
        if ( ! $this->hasPrevious() ) {
            throw new NoSuchElementException();
        }
        $this->cursor--;
        $this->lastReturnedIndex = $this->cursor;
        return $this->list->get( $this->lastReturnedIndex );
    }

    /**
     * @inheritDoc
     * @return int
     */
    public function previousIndex(): int {
        return $this->cursor - 1;
    }

    /**
     * @inheritDoc
     * @return void
     * @throws IndexOutOfBoundsException
     */
    public function remove(): void {
        if ( $this->lastReturnedIndex === -1 ) {
            throw new IllegalStateException( 'The remove() method cannot be called now.' );
        }
        $this->list->removeAt( $this->lastReturnedIndex );
        $this->cursor = $this->lastReturnedIndex;
        $this->lastReturnedIndex = -1; //Invalid to prevent double removal
    }

    /**
     * @inheritDoc
     * @return void
     * @throws IndexOutOfBoundsException
     */
    public function set(mixed $value): void {
        if ( $this->lastReturnedIndex === -1 ) {
            throw new IllegalStateException( 'The set() method cannot be called now.' );
        }
        $this->list->set( $this->lastReturnedIndex, $value );
    }
}