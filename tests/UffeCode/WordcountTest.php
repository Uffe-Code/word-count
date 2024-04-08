<?php

/**
 * Copyright (c) 2019 Keira Dueck <sylae@calref.net>
 * Use of this source code is governed by the MIT license, which
 * can be found in the LICENSE file.
 */

namespace UffeCode;


use OutOfRangeException;
use PHPUnit\Framework\TestCase;

class WordcountTest extends TestCase
{

    /**
     * These are copy-pasted from Iarna's test suite.
     */
    public function testCountAccuracy(): void
    {
        $this->assertEquals(4, Wordcount::count('This is a test'), 'plain text');
        $this->assertEquals(5, Wordcount::count('now with 23 a number'), 'integer');
        $this->assertEquals(3, Wordcount::count('now with 23.17'), 'decimal');
        $this->assertEquals(4, Wordcount::count("emoji 😍😍 do not count"), 'emoji');
        $this->assertEquals(4, Wordcount::count("possessive's are one word"), 'possessive');
        $this->assertEquals(4, Wordcount::count('possessive’s are one word'), 'possessive unicode');
        $this->assertEquals(6, Wordcount::count('some "quoted text" does not impact'), 'quotes');
        $this->assertEquals(5, Wordcount::count("also 'single quotes' are ok"), 'single quotes');
        $this->assertEquals(3, Wordcount::count("don't do contractions"), 'contractions count as a single word');
        $this->assertEquals(4, Wordcount::count('hyphenated words-are considered whole'), 'hyphenated words');
        $this->assertEquals(4, Wordcount::count('underbars are_too just one'), 'underbars');
        $this->assertEquals(6, Wordcount::count('n-dash ranges 1–3 are NOT'), 'en-dash');
        $this->assertEquals(6, Wordcount::count('m-dash connected—bits also are not'), 'em-dash');
    }

    /**
     * Tests some weird shit that might result from parser stuff being wonky.
     */
    public function testCountWeirdShit(): void
    {
        $this->assertEquals(0, Wordcount::count(''), 'empty string');
        $this->assertEquals(0, Wordcount::count('---'), 'just some hyphens');
        $this->assertEquals(0, Wordcount::count(' '), 'just a space');
        $this->assertEquals(1, Wordcount::count('hi'), 'just one word');

        $this->expectException(OutOfRangeException::class);
        Wordcount::count("\u{FDD0}");
    }
}
