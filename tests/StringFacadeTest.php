<?php

namespace Tests;

use Str;

class StringFacadeTest extends TestCase
{
    public function test_some_string_helper_methods()
    {
        $this->assertEquals('fooBar', Str::of('foo_bar')->camel());

        $this->assertEquals('foo-bar', Str::of('fooBar')->kebab());

        $this->assertEquals('cars', Str::of('car')->plural());
        $this->assertEquals('car', Str::of('car')->plural(1));
        $this->assertEquals('cars', Str::of('car')->plural(2));
        $this->assertEquals('VerifiedHumans', Str::of('VerifiedHuman')->plural());
        $this->assertEquals('VerifiedHuman', Str::of('VerifiedHuman')->plural(1));
        $this->assertEquals('VerifiedHumans', Str::of('VerifiedHuman')->plural(2));

        $this->assertEquals('child', Str::of('children')->singular());

        $this->assertEquals('laravel-5-framework', Str::of('Laravel 9 Framework')->slug());

        $this->assertEquals('foo_bar', Str::of('fooBar')->snake());
        $this->assertEquals('foo-bar', Str::of('fooBar')->snake('-'));

        $this->assertEquals('FooBar', Str::of('foo_bar')->studly());

        $this->assertEquals('Email Notification Sent', Str::of('EmailNotificationSent')->headline());

        $this->assertEquals('A Nice Title Uses The Correct Case', Str::of('a nice title uses the correct case')->title());

        $this->assertEquals('Foo bar', Str::of('a foo bar')->ucfirst()Str::ucfirst('foo bar'));
    }
}
