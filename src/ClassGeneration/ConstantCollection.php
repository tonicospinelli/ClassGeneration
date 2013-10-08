<?php

/**
 * ClassGeneration
 * Copyright (c) 2012 ClassGeneration
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
namespace ClassGeneration;

use ClassGeneration\Collection\ArrayCollection;

/**
 * Constant Collection ClassGeneration
 * @category   ClassGeneration
 * @package    ClassGeneration
 * @copyright  Copyright (c) 2012 ClassGeneration (https://github.com/tonicospinelli/ClassGeneration)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 * @version    ##VERSION##, ##DATE##
 */
class ConstantCollection extends ArrayCollection
{

    /**
     * Adds a new Constant at ConstantCollection.
     *
     * @param ConstantInterface $constant
     *
     * @throws \InvalidArgumentException
     * @return bool
     */
    public function add($constant)
    {
        if (!$constant instanceof ConstantInterface) {
            throw new \InvalidArgumentException(
                'This Constant must be a instance of \ClassGeneration\ConstantInterface'
            );
        }

        if ($constant->getName() === null) {
            $constant->setName('constant' . ($this->count() + 1));
        }

        return parent::add($constant);
    }

    /**
     * Gets the element of the collection at the current internal iterator position.
     * @return ConstantInterface
     */
    public function current()
    {
        return parent::current();
    }

    /**
     * Gets the Constant Iterator.
     * @return ConstantIterator|Constant[]
     */
    public function getIterator()
    {
        return new ConstantIterator($this);
    }

    /**
     * Parse the Constant Collection to string.
     * @return string
     */
    public function toString()
    {
        $string = '';
        $constants = $this->getIterator();
        foreach ($constants as $constant) {
            $string .= $constant->toString();
        }

        return $string;
    }

    /**
     * Removes tags by name.
     *
     * @param $constantName
     *
     * @return ConstantCollection
     */
    public function removeByName($constantName)
    {
        $removedList = new self();
        $list = $this->getIterator();
        foreach ($list as $index => $constant) {
            $currentName = $constant->getName();
            if ((is_array($constantName) and in_array($currentName, $constantName))
                or ($constant->getName() === $constantName)
            ) {
                $removedList->add(clone $constant);
                $this->remove($index);
            }
        }

        return $removedList;
    }
}
