<?php

// >>>>>>>>>>>>>>>>> AV Distribution Coding Standard
// PHP

// This document aims to standardise and agree on a style

// >>>>>>>>>>>>>>>>> comment

/**
 * block comment
 */

// inline comment

// >>>>>>>>>>>>>>>>> namespace

namespace Foo\Bar;

use Foo;



/**
 * 
 */
class ClassName extends AnotherClass
{
	
	// methods
}


// >>>>>>>>>>>>>>>>> file organisation

/*
app/
	class/
		foo.php
			foo/
				bar.php
		bar.php
			bar/
				foo.php
*/

foo
bar
foo\bar
bar\foo



Naming Conventions

How will you name your methods, variables, classes and interfaces? Which notation will you be using?

Also something else included in our standards was a split off standards for SQL, so we had similar names for tables, procedures, columns, id fields, triggers, etc.

Indentation

What will you be using for indentation? A single tab? 3 spaces?

Layout

Will braces be kept on the same line as the opening method line? (generally java) or on the next line or a line of its own? (generally C#)

Exception Handling / Logging

What are your standards for exception handling & logging, is it all home grown or are you using a third party tool? How should it be used?

Commenting

We have standards to dictate grammatical correctness, and that comments begin on the line before, or after, not on the same line, this increases readability. Will comments have to be indented to the same depth as the code? Will you accept those comment borders used around larger texts?

How about the \\\ on Methods for descriptions? Are these to be used? When?

Exposure

Should all of your methods and fields be implementing the lowest level of access possible?

Also an important thing to note. A good standards document can go a long way in helping review code, does it meet these minimum standards?

I've barely scratched the surface of what can go into one of these documents, but K.I.S.S.

Don't make it long, and boring, and impossible to get through, or those standards just wont be followed, keep it simple.