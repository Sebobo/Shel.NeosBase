<?php

namespace Shel\NeosBase\Validation\Validator;

/*                                                                        *
 * This script belongs to the package "Shel.NeosBase".                    *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Validation\Validator\AbstractValidator;

/**
 * Validator for empty values.
 *
 * This is used for honeypot field where the human should not fill in,
 * otherwise it is a spam
 *
 * @api
 * @Flow\Scope("singleton")
 */
class IsEmptyValidator extends AbstractValidator
{
    /**
     * Checks if the given value is empty (NULL, empty string, empty array
     * or empty object that implements the Countable interface).
     *
     * @param mixed $value The value that should be validated
     *
     * @api
     */
    protected function isValid($value)
    {
        if ($value !== null) {
            $this->addError('This property is not required.', 1420791972);
        } elseif ($value !== '') {
            $this->addError('This property is not required.', 1420791998);
        } elseif (is_array($value) && (!empty($value))) {
            $this->addError('This property is not required', 1420792043);
        } elseif (is_object($value) && $value instanceof \Countable && $value->count() !== 0) {
            $this->addError('This property is not required.', 1420792070);
        }
    }
}
