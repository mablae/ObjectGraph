<?php
declare(strict_types = 1);

namespace Tests\Innmind\ObjectGraph;

use Innmind\ObjectGraph\{
    Node,
    Relation,
    Relation\Property,
};
use Innmind\Immutable\SetInterface;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{
    public function testInterface()
    {
        $node = new Node(new \stdClass);

        $this->assertInstanceOf(SetInterface::class, $node->relations());
        $this->assertSame(Relation::class, (string) $node->relations()->type());
        $this->assertCount(0, $node->relations());
        $this->assertSame($node, $node->relate($relation = new Relation(
            new Property('bar'),
            new Node(new \stdClass)
        )));
        $this->assertCount(1, $node->relations());
        $this->assertSame([$relation], $node->relations()->toPrimitive());
    }
}
