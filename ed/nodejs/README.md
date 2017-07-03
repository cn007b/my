Node JS
-

*v0.10.26*

````
sudo ln -s /usr/bin/nodejs /usr/bin/node
````
````
sudo npm install -g nodemon
nodemon ./server.js localhost 8080
````

````js
req.url    // Url string.
req.params // Parsed params from url.
````

#### Under the hood

Execution nodejs code pushes variables into **execution stack**.
Local variables are popped from the stack when the functions execution finishes.
It happens only when you work with simple values such as numbers, strings and booleans.
Values of objects, arrays and such are stored in the heap and your variable is merely a pointer to them.
If you pass on this variable, you will only pass the said pointer, making these values mutable in different stack frames.
When the function is popped from the stack, only the pointer to the Object gets popped with leaving the actual value in the heap.
The garbage collector is the guy who takes care of freeing up space once the objects outlived their usefulness.

`libuv` is the open source library that handles the thread-pool,
doing signaling and all other magic that is needed to make the asynchronous tasks work.

Javascript is a single-threaded, event-driven language (even V8 is single-threaded).

Whenever you call setTimeout, http.get or fs.readFile,
Node.js sends these operations to a different thread allowing V8 to keep executing our code.
Node also calls the callback when the counter has run down or the IO / http operation has finished.

We only have **one main thread** and **one call-stack**.

In case there is another request being served when the said file is read, its callback will need to wait for the stack to become empty.
The limbo where callbacks are waiting for their turn to be executed is called the task queue or event queue, or message queue.
*Callbacks are being called in an infinite loop whenever the main thread has finished its previous task.*

If this wasn’t enough, we actually have more then one **task queue**.
**One for microtasks** (process.nextTick, promises, Object.observe)
and **another for macrotasks** (setTimeout, setInterval, setImmediate, I/O).

After said macrotask has finished, all of the available microtasks will be processed within the same cycle.

#### Garbage Collector

Things to Keep in Mind When Using a Garbage Collector:

* performance impact - in order to decide what can be freed up, the GC consumes computing power
* unpredictable stalls - modern GC implementations try to avoid “stop-the-world” collections

Unset object link: `Mater = undefined`.

The heap has two main segments, the New Space and the Old Space.
Objects living in the New Space are called Young Generation.
The Old Space where the objects that survived the collector in the New Space are promoted into
- they are called the Old Generation.
Allocation in the Old Space is fast, however collection is expensive so it is infrequently performed.
V8 engine uses two different collection algorithms:

* Scavenge - fast and runs on the Young Generation
* Mark-Sweep collection - slower and runs on the Old Generation.

Node.js is great for doing asynchronous I/O operations,
but when it comes to real number-crunching, it’s not that great of a choice.

#### Streams

Streams are objects that let you read data from a source
or write data to a destination in continuous fashion.

* Readable − read operation.
* Writable − write operation.
* Duplex − both read and write operation.
* Transform − duplex stream where the output is computed based on input.

Each type of Stream is an EventEmitter instance and throws several events;

* data − data is available to read.
* end − there is no more data to read.
* error − error receiving or writing data.
* finish − all data has been flushed to underlying system.

Piping is a mechanism where we provide the output of one stream as the input to another stream.

#### Mongodb dereference

````js
collection.find({}, function (err, cursor) {
    cursor.toArray(function (err, docs) {
        var count = docs.length - 1;
        for (i in docs) {
            (function (docs, i) {
                db.dereference(docs[i].ref, function(err, doc) {
                    docs[i].ref = doc;
                    if (i == count) {
                        (function (docs) {
                            console.log(docs);
                        })(docs);
                    }
                });
            })(docs, i)
        }
    });
});
````

####Redis Sessions
````js
var redisSessions = require('redis-sessions');
global.session = new redisSessions();
global.session.create(
    {
        app: 'skipe',
        id: d._id,
        ip: req.connection.remoteAddress,
        ttl: 7200,
        d: {sname: d.sname}
    },
    function(err, res) {
        if (err) {
            console.error(err);
        }
        global.user.sname = d.sname;
        global.user.token = res.token;
    }
);
global.session.set(
    {
        app: 'skipe',
        token: global.user.token,
        d: {sname: global.user.sname}
    },
    function(err, res) {
        if (err) {
            console.error(err);
        }
        console.log(res);
    }
);
````

https://blog.risingstack.com/finding-a-memory-leak-in-node-js/
https://blog.risingstack.com/javascript-garbage-collection-orinoco/