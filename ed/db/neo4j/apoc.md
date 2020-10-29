APOC
-

[funcs](https://neo4j.com/labs/apoc/4.1/overview/)
[import transaction size](https://neo4j.com/labs/apoc/4.1/graph-updates/periodic-execution/)
[atomic updates](https://neo4j.com/labs/apoc/4.1/graph-updates/atomic-updates/)
[ttl](https://neo4j.com/labs/apoc/4.1/graph-updates/ttl/)
[conversion functions](https://neo4j.com/labs/apoc/4.1/data-structures/conversion-functions/)
[conditionals](https://neo4j.com/labs/apoc/4.1/cypher-execution/conditionals/)
[parallel execution](https://neo4j.com/labs/apoc/4.1/cypher-execution/parallel/)
[virtual nodes](https://neo4j.com/labs/apoc/4.1/virtual/virtual-nodes-rels/)
[grouping](https://neo4j.com/labs/apoc/4.1/virtual/graph-grouping/)
[triggers](https://neo4j.com/labs/apoc/4.1/background-operations/triggers/)
[after db initialization](https://neo4j.com/labs/apoc/4.1/operational/init-script/)
[warmup](https://neo4j.com/labs/apoc/4.1/operational/warmup/)
[string funcs](https://neo4j.com/labs/apoc/4.1/misc/text-functions/)
[schema info](https://neo4j.com/labs/apoc/4.1/indexes/schema-index-operations/)

````js
CALL apoc.static.set('x.user', 'Mike');
RETURN apoc.static.get('x.user') AS value;

RETURN apoc.create.uuid() AS uuid;

apoc.node.id(node);
apoc.node.labels(node);

apoc.rel.id(relationship);
apoc.rel.type(relationship);

apoc.diff.nodes(node1, node2);

// cypher
CALL apoc.cypher.run("MATCH (n:Person {code:'007'}) RETURN n;", null) yield value
RETURN value;

// search
CALL apoc.search.nodeAll('{Person: ["name", "code"], Organization: "name"}', 'contains', '00')
YIELD node AS n RETURN n;

:param x => 1;
:param y => 2;
CALL apoc.when(
  $x > $y,
  'RETURN value1',
  'RETURN value2',
  {value1:$x, value2:$y}
)
YIELD value;
// Result: {"value2":2}

// monitoring
CALL apoc.monitor.kernel();
CALL apoc.monitor.store();
CALL apoc.monitor.tx();
````