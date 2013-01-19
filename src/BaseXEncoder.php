<?php
/**
 * Base X Encoder
 *
 * Copyright (c) 2013 Christopher Davis <http://christopherdavis.me>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 *
 * @link        http://stackoverflow.com/a/742047/1031898
 * @author      Christopher Davis <http://christopherdavis.me>
 * @copyright   2012 Christopher Davis
 * @license     http://opensource.org/licenses/MIT MIT
 */

class BaseXEncoder
{
    /**
     * The alphabet used to encode the number.
     *
     * @since   0.1
     * @access  private
     * @var     string
     */
    private $alphabet;

    /**
     * the base to which the numbers are encoded/decoded. strlen($this->alphabet)
     *
     * @since   0.1
     * @access  public
     * @var     int
     */
    private $base;

    /**
     * Constructor.
     *
     * @since   0.1
     * @access  public
     * @param   string $alphabet The alphabet to which integers are encoded
     * @return  void
     */
    public function __construct($alphabet=null)
    {
        if (!$alphabet) {
            $alphabet = 'bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ0123456789';
        }

        $this->alphabet = $alphabet;
        $this->base = strlen($this->alphabet);
    }

    /**
     * Encode an integer with the alphabet and return the resulting string.
     *
     * @since   0.1
     * @access  public
     * @param   int $id The ID to encode
     * @return  string
     */
    public function encode($id)
    {
        $id = abs(intval($id));

        $str = '';

        while ($id > 0) {
            $str .= $this->alphabet[$id % $this->base];
            $id = floor($id / $this->base);
        }

        return strrev($str);
    }

    /**
     * Decode a string to its integer equivelent. Returns false if it encouters
     * a letter that's not in the alphabet.
     *
     * @since   0.1
     * @access  public
     * @param   string $string The string to decode.
     * @return  int
     */
    public function decode($string)
    {
        $len = strlen($string) - 1;

        $total = 0;

        for ($i = 0; $i <= $len; $i++) {
            if (false === $index = strpos($this->alphabet, $string[$i])) {
                return false; // got a letter not in our alphabet.
            }

            $total += $index * pow($this->base, $len - $i);
        }

        return $total;
    }
}
