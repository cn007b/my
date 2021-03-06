<?php
/**
 * Decorator (also known as Wrapper, an alternative naming shared with the Adapter pattern)
 *
 * @category Structural
 */

abstract class Component
{
    abstract public function operation();
}

class ConcreteComponent extends Component
{
    public function operation()
    {
        return 'I am component';
    }
}

abstract class Decorator extends Component
{
    protected $component = null;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    public function operation()
    {
        return $this->component->operation();
    }
}

class ConcreteDecoratorA extends Decorator
{
    public function operation()
    {
        return '<a>' . parent::operation() . '</a>';
    }
}

class ConcreteDecoratorS extends Decorator
{
    public function operation()
    {
        return '<strong>' . parent::operation() . '</strong>';
    }
}

$element = new ConcreteComponent();
$extendedElement = new ConcreteDecoratorA($element);
$superExtendedElement = new ConcreteDecoratorS($extendedElement);
print $superExtendedElement->operation();

/*
<strong><a>I am component</a></strong>
*/
