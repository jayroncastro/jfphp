<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp;

/**
 * Defines the contract for a collection that guarantees the
 * uniqueness of its elements, extending `CollectionInterface`
 * to enforce a logic that does not allow duplicates.
 * @package jayroncastro
 * @subpackage jfphp
 * @template TValue
 * @extends CollectionInterface<TValue>
 * @since 1.0.0
 * @version 1.0.0
 */
interface SetInterface extends CollectionInterface {
    // No extra implementation is needed here.
    // It inherits all 12 methods from CollectionInterface.
    // Its purpose is purely contractual and semantic.
}