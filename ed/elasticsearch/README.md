Elasticsearch
-
1.6.0

elasticsearch.org/download
````
curl -L -O http://download.elasticsearch.org/PATH/TO/VERSION.zip
unzip elasticsearch-$VERSION.zip
cd elasticsearch-$VERSION
````

Installation
````
wget https://download.elasticsearch.org/elasticsearch/elasticsearch/elasticsearch-0.90.7.deb
sudo dpkg -i elasticsearch-0.90.7.deb
````

Installing Marvel
````
./bin/plugin -i elasticsearch/marvel/latest

http://localhost:9200/_plugin/marvel/
http://localhost:9200/_plugin/marvel/sense/
````

Running Elasticsearch
````
./bin/elasticsearch

sudo /etc/init.d/elasticsearch status
sudo /etc/init.d/elasticsearch restart

curl 'http://localhost:9200/?pretty'
````

Shut down
````
curl -XPOST 'http://localhost:9200/_shutdown'
````

````json
curl -XGET 'http://localhost:9200/_count?pretty' -d '
{
 "query": {
 "match_all": {}
 }
}
'

curl -i -XGET 'localhost:9200/'

curl -XGET 'localhost:9200/_count?pretty' -d '
{
 "query": {
 "match_all": {}
 }
}'

curl -XPUT localhost:9200/megacorp/employee/1 -d '
{
 "first_name" : "John",
 "last_name" : "Smith",
 "age" : 25,
 "about" : "I love to go rock climbing",
 "interests": [ "sports", "music" ]
}
'
curl -XPUT localhost:9200/megacorp/employee/2 -d '
{
 "first_name" : "Jane",
 "last_name" : "Smith",
 "age" : 32,
 "about" : "I like to collect rock albums",
 "interests": [ "music" ]
}
'
curl -XPUT localhost:9200/megacorp/employee/3 -d '
{
 "first_name" : "Douglas",
 "last_name" : "Fir",
 "age" : 35,
 "about": "I like to build cabinets",
 "interests": [ "forestry" ]
}
'

curl -XGET localhost:9200/megacorp/employee/1
````
We could use the DELETE verb to delete the document.
And the HEAD verb to check whether the document exists.
To replace an existing document - just PUT it again.

In Elasticsearch, a document belongs to a type, and those types live inside an index.
You can draw some (rough) parallels to a traditional relational database:
````
Relational DB ⇒ Databases ⇒ Tables ⇒ Rows      ⇒ Columns
Elasticsearch ⇒ Indices   ⇒ Types  ⇒ Documents ⇒ Fields
````

#### Search
````json
curl -XGET localhost:9200/megacorp/employee/_search
curl -XGET localhost:9200/megacorp/employee/_search?q=last_name:Smith
curl -XGET localhost:9200/megacorp/employee/_search -d '
{
    "query" : {
        "filtered" : {
            "filter" : {
                "range" : {
                    "age" : { "gt" : 30 }
                }
            },
            "query" : {
                "match" : {
                    "last_name" : "smith"
                }
            }
        }
    }
}
'
````

#### Full-text search
````json
curl -XGET localhost:9200/megacorp/employee/_search -d '
{
    "query" : {
        "match" : {
           "about" : "rock climbing"
        }
    }
}
'
# we'll receive: "I love to go rock climbing" and "I like to collect rock albums"

curl -XGET localhost:9200/megacorp/employee/_search -d '
{
    "query" : {
        "match_phrase" : {
           "about" : "rock climbing"
        }
    }
}
'
# we'll receive: "I love to go rock climbing"

curl -XGET localhost:9200/megacorp/employee/_search -d '
{
    "query" : {
        "match_phrase" : {
           "about" : "rock climbing"
        }
    },
    "highlight": {
        "fields" : {
            "about" : {}
        }
    }
}
'

curl -XGET localhost:9200/megacorp/employee/_search -d '
{
    "query" : {
        "wildcard" : {
           "about" : "*limbing"
        }
    }
}'
# we'll receive: "I love to go rock climbing"
````

#### Analytics
````json
curl -XGET localhost:9200/megacorp/employee/_search -d '
{
    "aggs": {
        "all_interests": {
            "terms": { "field": "interests" }
        }
    }
}
'

curl -XGET localhost:9200/megacorp/employee/_search -d '
{
    "query": {
        "match": {
            "last_name": "smith"
        }
    },
    "aggs": {
        "all_interests": {
            "terms": {
                "field": "interests"
            }
        }
    }
}
'

curl -XGET localhost:9200/megacorp/employee/_search -d '
{
    "aggs" : {
        "all_interests" : {
            "terms" : { "field" : "interests" },
            "aggs" : {
                "avg_age" : {
                    "avg" : { "field" : "age" }
                }
            }
        }
    }
}
'
````