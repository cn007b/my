Programming
-

CSS - fault tolerant.
JS - NOT fault tolerant.

Mixin better than OOP.

## Common stuff

An `expression` evaluates to a value. A `statement` does something.
````
y = x + 1   # an expression
print y     # a statement
````

## Paradigms

**Imperative** programming - is a programming paradigm that uses statements that change a program's state.
Imperative program consists of commands for the computer to perform.

**Structured** programming - is a programming paradigm
aimed at improving the clarity, quality, and development time of a computer program
by making extensive use of subroutines (procedure, function, method or subprogram),
block structures, for and while loops.

**Procedural** programming - is a programming paradigm, derived from structured programming,
based upon the concept of the procedure call.
(Fortran, Pascal).

**Declarative** programming - focuses on what the program should accomplish
without specifying how the program should achieve the result.
(SQL, CSS, regex).
<br>The declarative layer describes what the code will do,
while the implementation layer describes how the code does it.
(The declarative layer is, in effect, a small domain-specific language).

**Functional** programming - is a programming paradigm,
a style of building the structure and elements of computer programs
that treats computation as the evaluation of mathematical (pure & deterministic) functions
and avoids changing-state and mutable data.
(JavaScript, Scala).

**Object-oriented** programming - is a programming paradigm based on the concept of objects,
which may contain data, in the form of fields, often known as attributes,
and code, in the form of procedures, often known as methods.

**Event-driven** programming – program control flow is determined by events.
(JavaScript).

**Metaprogramming** - is a programming technique
in which computer programs have the ability to treat programs as their data.
It means that a program can be designed to read, generate, analyse or transform
other programs, and even modify itself while running.

#### Low coupling and high cohesion.

COUPLING refers to the interdependencies between modules.
<br>Tightly coupled code - bad code.

LOW COUPLING is often a sign of a well-structured computer system and a **good** design.
synonym: lose coupling, antonym: coupling.

COHESION describes how related the functions within a single module are.
<br>
Classes should have a small number of instance variables.
In general the more variables a method manipulates the more cohesive that method is to its class.
A class in which each variable is used by each method is maximally cohesive.

Basically, classes are the tightest form of coupling in object-oriented programming.

#### Code quality

Maintainable
Extendable
Reusable
Readable
Understandable
Testable
Documentable
Well designed (patterns)
Follow SOLID
Haven't memory leaks
Haven't vulnerabilities and secure
Cares about backward compatibility

Predictability
Resilience
Elasticity
Fault tolerance

Rigidity
Fragility
Immobility
Complexity

#### Comments

Good comment must explain: `what? why? how?`

#### [Clean Code](https://monosnap.com/file/9UGwycGbfCus8TRIXPjFWGsI2pKOKW)

Clean code always looks like it was written by someone who cares.

Methods should have verb or verb phrase names like postPayment, deletePage, or save.
Accessors, mutators, and predicates should be named for their value and prefixed
with get, set, and is according to the javabean standard.

Flag arguments are ugly. Passing a boolean into a function is a truly terrible practice.
It immediately complicates the signature of the method,
loudly proclaiming that this function does more than one thing.
It does one thing if the flag is true and another if the flag is false!

Noise words are another meaningless distinction.
Imagine that you have a Product class. If you have another called ProductInfo or ProductData,
you have made the names different without making them mean anything different.
Info and Data are indistinct noise words like a, an, and the.

Note that there is nothing wrong with using prefix conventions like a and the
so long as they make a meaningful distinction. For example you might use
a for all local variables and the for all function arguments.
The problem comes in when you decide to call a variable theZork
because you already have another variable named zork.

Noise words are redundant. The word `variable` should never appear in a variable name.
The word `table` should never appear in a table name. How is NameString better than Name?
Would a Name ever be a floating point number? If so, it breaks an earlier rule about disinformation.
Imagine finding one class named Customer and another named CustomerObject.
What should you understand as the distinction? Which one will represent the best path to a customer’s payment history?