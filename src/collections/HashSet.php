<?php

/**
 * This file is part of the small JFPHP Framework.
 * @author Jayron Castro <eu@jayroncastro.com>
 * @license https://www.gnu.org/licenses/gpl-3.0.html
 * @link https://github.com/jayroncastro/jfphp
 */
namespace jayroncastro\jfphp\collections;

/**
 * Implementation of `SetInterface` based on a hash table (array).
 * It guarantees the uniqueness of its elements but does not offer
 * guarantees regarding the order of iteration of the set.
 * @template TValue
 * @extends AbstractSet<TValue>
 * @package jayroncastro
 * @subpackage jfphp/collections
 * @since 1.0.0
 * @version 1.0.0
 */
final class HashSet extends AbstractSet {
    // No additional logic is needed here for the base functionality.
}