mongo
-

*MongoDB shell version: 2.4.6*

    sudo service mongodb start|stop|restart

    sudo rm /var/lib/mongodb/mongod.lock
    sudo service mongodb restart

    mongo

````js
// current database
db
show dbs
use mydb

// insert a collection
j = {name : "mongo"}
db.testData.insert(j)
show collections
db.testData.find()
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
//
db.records.find( { "user_id": { $lte: 42} }, { "name": 1, "email": 1} )
// switch on/off fields
db.users.find({age: {$gt: 18}}, {name: 1, address: 1, _id: 0}).limit(5)
// 'food' or 'snacks'
db.inventory.find({ type: { $in: [ 'food', 'snacks' ] } })
// food and a less than ($lt) price
db.inventory.find( { type: 'food', price: { $lt: 9.95 } } )
// OR
db.inventory.find({ $or: [{ qty: { $gt: 100 } }, { price: { $lt: 9.95 } } ] })
// 'food' and either the qty has a value greater than ($gt) 100 or price is less than ($lt) 9.95
db.inventory.find( { type: 'food', $or: [ { qty: { $gt: 100 } }, { price: { $lt: 9.95 } } ] } )
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

// INDEX
// Each index requires at least 8KB of data space.
db.inventory.find({ type: 'aston' });
db.inventory.ensureIndex( { type: 1 })
// index uses
db.inventory.find({ type: "food", item:/^c/ }, { item: 1, _id: 0 })
// index not uses, bacause query returns _id field
db.inventory.find({ type: "food", item:/^c/ }, { item: 1 })

// EXPLAIN
db.collection.find().explain()
// hint
db.inventory.find( { type: 'food' } ).hint( { type: 1 } ).explain()
db.inventory.find( { type: 'food' } ).hint( { type: 1, name: 1 } ).explain()

// BSON-document size limit = 16MB
// In MongoDB, operations are atomic at the document level. No single write operation can change more than one document.

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
// To set a journaled write concern, specify w values of 1 and set the journal or j option to true for your driver.
// To set replica acknowledged write concern, specify w values greater than 1 to your driver.

// TRANSACTION
db.accounts.save({name: "A", balance: 1000, pendingTransactions: []})
db.accounts.save({name: "B", balance: 1000, pendingTransactions: []})
db.accounts.find()
// init
db.transactions.save({source: "A", destination: "B", value: 100, state: "initial"})
db.transactions.find()
// set status pending
t = db.transactions.findOne({state: "initial"})
db.transactions.update({_id: t._id}, {$set: {state: "pending"}})
db.transactions.find()
// apply transaction
db.accounts.update({name: t.source, pendingTransactions: {$ne: t._id}}, {$inc: {balance: -t.value}, $push: {pendingTransactions: t._id}})
db.accounts.update({name: t.destination, pendingTransactions: {$ne: t._id}}, {$inc: {balance: t.value}, $push: {pendingTransactions: t._id}})
db.accounts.find()
// set status commited
db.transactions.update({_id: t._id}, {$set: {state: "committed"}})
db.transactions.find()
// remove pending
db.accounts.update({name: t.source}, {$pull: {pendingTransactions: t._id}})
db.accounts.update({name: t.destination}, {$pull: {pendingTransactions: t._id}})
db.accounts.find()
// set status done
db.transactions.update({_id: t._id}, {$set: {state: "done"}})
db.transactions.find()
// rollback
// set status canceling
db.transactions.update({_id: t._id}, {$set: {state: "canceling"}})
db.accounts.update({name: t.source, pendingTransactions: t._id}, {$inc: {balance: t.value}, $pull: {pendingTransactions: t._id}})
db.accounts.update({name: t.destination, pendingTransactions: t._id}, {$inc: {balance: -t.value}, $pull: {pendingTransactions: t._id}})
db.accounts.find()
db.transactions.update({_id: t._id}, {$set: {state: "canceled"}})

t = db.transactions.findAndModify({
    query: {state: "initial", application: {$exists: 0}},
    update: {$set: {state: "pending", application: "A1"}},
    new: true
})
db.transactions.find({application: "A1", state: "pending"})

db.runCommand( { getLastError: 1, j: "true" } )

````
[MongoDB CRUD Reference](http://docs.mongodb.org/manual/reference/crud/#mongodb-crud-reference)

[SQL to MongoDB Mapping Chart](http://docs.mongodb.org/manual/reference/sql-comparison/#sql-to-mongodb-mapping-chart    )
````js

// In general, use embedded data models when:
// you have one-to-one or one-to-many model.
/* For model many-to-many use relationships with document references. */

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



````