<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\lang;

/**
 * An object that represents a simple value. The main
 * feature is immutability after creation.
 * @package jayroncastro
 * @subpackage jfphp/lang
 * @since 1.0.0
 * @version 1.0.0
 */
abstract readonly class ValueObject {

    /**
     * This argument stores a value
     * @var mixed
     */
    protected mixed $value;

    /**
     * Class constructor method
     * @param mixed $value
     */
    public function __construct( mixed $value ) {
        $this->value = $value;
    }

    /**
     * This method returns the stored value of the object.
     * @return mixed
     */
    public function getValue(): mixed {
        return $this->value;
    }

}