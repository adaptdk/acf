<?php

namespace Adapt\Acf\Field;

use Adapt\Acf\FieldInterface;

/**
 * Class Boolean.
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class Boolean extends Text implements FieldInterface
{
    /**
     * @return bool
     */
    public function get()
    {
        return (bool) parent::get();
    }
}
