<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\collections;

/**
 * This abstract class provides the base implementation for
 * `SetInterface`, extending `AbstractCollection` and overriding
 * the addition methods to ensure uniqueness of elements.
 * @template TValue
 * @implements SetInterface
 * @extends AbstractCollection<TValue>
 * @package jayroncastro
 * @subpackage jfphp/collections
 * @since 1.0.0
 * @version 1.0.0
 */
abstract class AbstractSet extends AbstractCollection implements SetInterface {

    /**
     * Adds the specified element to this set if it is not already present.
     * @param TValue $value The element to be added to the set.
     * @return bool Returns `True` if the set did not already contain the specified element.
     */
    public function add( mixed $value ): bool {
        // If the collection already contains the value, it does nothing and returns false.
        if ( $this->contains( $value ) ) {
            return false;
        }
        // If it does not contain it, call the `add` method of the parent class `AbstractCollection`
        // which will do the addition and return true.
        return parent::add( $value );
    }

    /**
     * Adds all elements from the specified collection to this set that
     * are not already present.
     * @param CollectionInterface<TValue> $values
     * @return bool Returns `True` if the set was changed as a result of the call.
     */
    public function addAll( CollectionInterface $values ): bool {
        $modified = false;
        foreach ( $values as $value ) {
            if ( $this->add( $value ) ) {
                $modified = true;
            }
        }
        return $modified;
    }
}