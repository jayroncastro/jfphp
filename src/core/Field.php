<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\core;

use jayroncastro\jfphp\http\Request;
use jayroncastro\jfphp\http\RequestParams;
use jayroncastro\jfphp\persistence\PersistenceInterface;

/**
 * This class manages the entire lifecycle of a field: it gets the
 * new value from the request, gets the old value from persistence,
 * compares, and saves it.
 * @package jayroncastro
 * @subpackage jfphp/core
 * @since 1.2.0
 * @version 1.2.0
 */
final readonly class Field {

    /**
     * This parameter stores the old value of the field.
     * @var mixed
     */
    public mixed $oldValue;

    /**
     * This parameter stores the new value of the field.
     * @var mixed
     */
    public mixed $newValue;

    /**
     * Class constructor method
     * @param int $objectId This parameter receives the ID of a field.
     * @param Request $request This parameter receives an object of type Request.
     * @param PersistenceInterface $persistence This parameter receives an object
     * that implements the PersistenceInterface interface.
     * @param RequestParams $params This parameter receives a RequestParams object.
     */
    public function __construct(
        private int $objectId,
        private Request $request,
        private PersistenceInterface $persistence,
        private RequestParams $params
    ) {
        $this->oldValue = $this->persistence->get(
            $this->objectId,
            $this->params->paramName
        );
        $this->newValue = $this->request->getParam( $this->params )->getValue();
    }

    /**
     * This method returns true if and only if there is a difference
     * between the old value and the new value.
     * @return bool
     */
    public function hasChanged(): bool {
        # Convert to string for safer comparison between different types
        # (e.g. '123' vs. 123)
        return ( string ) $this->oldValue !== ( string ) $this->newValue;
    }

    /**
     * This method saves the value of this persistence layer field.
     * @return bool
     */
    public function save(): bool {
        return $this->persistence->save(
            $this->objectId,
            $this->params->paramName,
            $this->newValue
        );
    }

    /**
     * This method deletes the value of this field from the persistence layer.
     * @return bool
     */
    public function delete(): bool {
        return $this->persistence->delete(
            $this->objectId,
            $this->params->paramName
        );
    }

    /**
     * This method checks whether the value has remained unchanged.
     * @return bool
     */
    public function isSame(): bool {
        return !$this->hasChanged();
    }

    /**
     * This method saves the new value to the persistence layer only
     * if it has changed.
     * @return bool Returns `True` if the save operation was performed
     * (because there was a change), and `False` if nothing was done
     * (because the values were the same).
     */
    public function saveIfChanged(): bool {
        if ( $this->hasChanged() ) {
            return $this->save();
        }
        return false;
    }
}