mongo
-

*MongoDB shell version: 2.4.6*

#### Introduction
````
sudo service mongodb start|stop|restart

sudo rm /var/lib/mongodb/mongod.lock
sudo service mongodb restart

mongo
````

MongoDB implements locks on a per-database basis for most read and write operations.
<br>[Which operations lock the database](http://docs.mongodb.org/manual/faq/concurrency/#which-operations-lock-the-database)

````js
// current database
db
show dbs
use mydb

// insert a collection
j = {name : "mongo"}
db.testData.insert(j)
db.test.insert({x :MaxKey})
db.test.insert({x :MinKey})

show collections
db.testData.find()
db.getCollection('_foo').find()
db.testData.findOne()
db.testData.find().limit(3)
db.testData.find({ name : "mongo" })
// iterate over the cursor with a loop
var c = db.testData.find()
while (c.hasNext()) printjson(c.next())
// print 4th item in list
printjson(c[4])
// print(tojson(c[4]));
var myCursor =  db.inventory.find( { type: 'food' } );
myCursor.forEach(printjson);
// cursor to array
var myCursor = db.inventory.find( { type: 'food' } );
var documentArray = myCursor.toArray();
var myDocument = documentArray[3];
// or
var myCursor = db.inventory.find( { type: 'food' } );
var myDocument = myCursor[3];
// or
myCursor.toArray() [3];
// search all documents with age exactly 18
db.users.find({age: 18})
// greater than condition
db.users.find({age:{$gt: 18}}).sort({age; 1})
db.users.find({age:{$gte: 18}}).sort({age; 1})
db.users.find({age:{$ne: 18}}) // not equal
//
db.records.find( { "user_id": { $lte: 42} }, { "name": 1, "email": 1} )
// switch on/off fields
db.users.find({age: {$gt: 18}}, {name: 1, address: 1, _id: 0}).limit(5)
// 'food' or 'snacks'
db.inventory.find({ type: { $in: [ 'food', 'snacks' ] } })
db.inventory.find({ type: { $nin: [ 'food', 'snacks' ] } })
// food and a less than ($lt) price
db.inventory.find( { type: 'food', price: { $lt: 9.95 } } )

// subdocument
db.inventory.find({producer: {company: 'ABC123', address: '123 Street'} })
db.inventory.find( { 'producer.company': 'ABC123' } )
// tags is an array
db.inventory.find( { tags: [ 'fruit', 'food', 'citrus' ] } )
// value of the tags field is an array whose first element equals 'fruit'
db.inventory.find( { 'tags.0' : 'fruit' } )
db.inventory.find( { 'memos.0.by': 'shipping' } )
// field memo equal to 'on time' and the field by equal to 'shipping'
db.inventory.find({'memos.memo': 'on time', 'memos.by': 'shipping'} )
// memos is an array that has memo equal to 'on time' and the field by equal to 'shipping'
db.inventory.find( {memos: {$elemMatch: {memo : 'on time', by: 'shipping'} } } )

// server will close CURSOR after 10 minutes, to avoid it do:
var myCursor = db.inventory.find().addOption(DBQuery.Option.noTimeout);
// data returns in batches
var myCursor = db.inventory.find();
var myFirstDocument = myCursor.hasNext() ? myCursor.next() : null;
// shows how many documents remain in batch
myCursor.objsLeftInBatch();
// info about all cursors
db.runCommand( { cursorInfo: 1 } )

// select count(user_id) from users
db.users.count( { user_id: { $exists: true } } )
db.users.distinct( "status" )

// copy all objects from one collection to another
db.collection.copyTo(newCollection)

// EXPLAIN
db.collection.find().explain()
// hint - Forces MongoDB to use a specific index for a query.
db.inventory.find( { type: 'food' } ).hint( { type: 1 } ).explain()
db.inventory.find( { type: 'food' } ).hint( { type: 1, name: 1 } ).explain()

// BSON-document size limit = 16MB
// In MongoDB, operations are atomic at the document level.
// No single write operation can change more than one document.

// INSERT
// MongoDB always adds the _id field
db.users.insert({name: "sue", age: 26, status: "A"})
// save() - replaces an existing document with the same _id
db.inventory.save({type: "book", item: "notebook", qty: 40})
db.inventory.save({_id: 10, type: "misc", item: "placard"} )

// UPDATE
// update() - modify existing data or modify a group of documents
// by default mongo update single row. use {multi: true} to update all maches documents
db.users.update({ age: { $gt: 18 } }, { $set: { status: "A" } }, { multi: true })
db.inventory.update({ type : "book" }, { $inc : { qty : -1 } }, { multi: true } )
db.students.update(
    { _id: 1 },
    { $push: { scores: {
        $each : [{ attempt: 3, score: 7 },
        { attempt: 4, score: 4 } ],
        $sort: { score: 1 },
        $slice: -3
    } } }
)
db.users.update(
    { },
    { $unset: { join_date: "" } },
    { multi: true }
)
book = {
    _id: 123456789,
    title: "MongoDB: The Definitive Guide",
    author: [ "Kristina Chodorow", "Mike Dirolf" ],
    published_date: ISODate("2010-09-24"),
    pages: 216,
    language: "English",
    publisher_id: "oreilly",
    available: 3,
    checkout: [ { by: "joe", date: ISODate("2012-10-15") } ]
}
db.books.findAndModify ({
    query: {
        _id: 123456789,
        available: { $gt: 0 }
    },
    update: {
        $inc: { available: -1 },
        $push: { checkout: { by: "abc", date: new Date() } }
    }
})
// REPLACE
db.inventory.update(
    { type: "book", item : "journal" },
    { $set : { qty: 10 } },
    { upsert : true }
)

// DELETE
db.users.remove({ status: "D" })
// delete documents but don't delete indexes
// to remove data and indexes use method drop()

// remove 1 document
db.inventory.remove( { type : "food" }, 1 )

db.users.drop()

// To set errors ignored write concern, specify w values of -1 to your driver.
// To set unacknowledged write concern, specify w values of 0 to your driver.
// To set acknowledged write concern, specify w values of 1 to your driver. DEFAULT.
// To set a journaled write concern,
// specify w values of 1 and set the journal or j option to true for your driver.
// To set replica acknowledged write concern, specify w values greater than 1 to your driver.

db.runCommand( { getLastError: 1, j: "true" } )
````

####[Database Commands](http://docs.mongodb.org/manual/reference/command/)!!!

####[mongo Shell Methods](http://docs.mongodb.org/manual/reference/method/)!!!

[Geospatial Query Operators](http://docs.mongodb.org/manual/reference/operator/query-geospatial/#geospatial-query-operators)

[MongoDB CRUD Reference](http://docs.mongodb.org/manual/reference/crud/#mongodb-crud-reference)

[SQL to MongoDB Mapping Chart](http://docs.mongodb.org/manual/reference/sql-comparison/#sql-to-mongodb-mapping-chart)

In general, use embedded data models when: you have one-to-one or one-to-many model
((link)[http://docs.mongodb.org/manual/core/data-model-design/]).
<br>For model many-to-many use relationships with document references.

````js
// Model Tree Structures with Parent References
db.categories.insert( { _id: "MongoDB", parent: "Databases" } )
db.categories.insert( { _id: "dbm", parent: "Databases" } )
db.categories.insert( { _id: "Databases", parent: "Programming" } )
db.categories.insert( { _id: "Languages", parent: "Programming" } )
db.categories.insert( { _id: "Programming", parent: "Books" } )
db.categories.insert( { _id: "Books", parent: null } )
// parent
db.categories.findOne( { _id: "MongoDB" } ).parent
// index
db.categories.ensureIndex( { parent: 1 } )

// Model Tree Structures with Child References
db.categories.insert( { _id: "MongoDB", children: [] } )
db.categories.insert( { _id: "dbm", children: [] } )
db.categories.insert( { _id: "Databases", children: [ "MongoDB", "dbm" ] } )
db.categories.insert( { _id: "Languages", children: [] } )
db.categories.insert( { _id: "Programming", children: [ "Databases", "Languages" ] } )
db.categories.insert( { _id: "Books", children: [ "Programming" ] } )

// Manual References
original_id = ObjectId()
db.places.insert({
    "_id": original_id,
    "name": "Broadway Center",
    "url": "bc.example.net"
})
db.people.insert({
    "name": "Erin",
    "places_id": original_id,
    "url":  "bc.example.net/Erin"
})
// DBRef
{ "$ref" : <value(collection)>, "$id" : <value(_id)>, "$db" : <value> }
{
    "_id" : ObjectId("5126bbf64aed4daf9e2ab771"),
    // .. application fields
    "creator" : {
        "$ref" : "creators",
        "$id" : ObjectId("5126bc054aed4daf9e2ab772"),
        "$db" : "users"
    }
}
oId = ObjectId();
db.address.insert({'_id' : oId, country: 'UK', city: 'London'});
db.user.insert({name : 'Bond', address: {'$ref': 'address', '$id': oId, '$db': 'user'}});

ObjectId("507f191e810c19729de860ea").getTimestamp();
ObjectId("507f191e810c19729de860ea").str;
ObjectId("507f191e810c19729de860ea").valueOf();
ObjectId("507f191e810c19729de860ea").toString();

var mydate1 = new Date();
var mydate2 = ISODate();
mydate1.toString();
````

[Development patterns](http://docs.mongodb.org/manual/tutorial/#development-patterns)

````js
// Limit Number of Elements in an Array after an Update.
/*
{
    _id: 1,
    scores: [
        {attempt: 1, score: 10},
        {attempt: 2, score:8}
    ]
}
*/
db.students.update(
    {_id: 1},
    {
        $push: {scores: {
            $each : [
                {attempt: 3, score: 7},
                {attempt: 4, score: 4}
            ],
            $sort: {score: 1},
            $slice: -3
        }}
    }
);
/*
Result:
{
    "_id" : 1,
    "scores" : [
        {"attempt" : 3, "score" : 7},
        {"attempt" : 2, "score" : 8},
        {"attempt" : 1, "score" : 10}
    ]
}
*/
````

#### Dump
````js
mongodump --host mongodb1.example.net --port 3017 --username user --password pass --out /opt/backup/mongodump-2013-10-24
mongorestore --host mongodb1.example.net --port 3017 --username user --password pass /opt/backup/mongodump-2013-10-24/
````