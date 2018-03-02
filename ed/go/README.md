GO
-

go1.9.3

[online editor](https://play.golang.org/)
[packages](https://godoc.org/)
[examples](https://gobyexample.com/)
[badges](https://goreportcard.com/)

Go is compiled, garbage-collected, concurrent, type-safe.

A workspace is a directory hierarchy with three directories at its root:
* bin (executable commands)
* pkg (package objects)
* src

````
$GOROOT
$GOPATH // environment variable specifies the location of your workspace.

go run --work ed/go/examples/hw.go
````

````go
import (
    "fmt"
    "os"
)

var (
    msq = "str"
    message string = "str"
)

const (
    PI = 3.14
    A = iota
    B = iota
    C = iota
)
const s string = "constant"
const n = 500000000

fmt.Printf("%+v", myType)
fmt.Printf("%#v", myType)

// init module
func init() {}

var power int
power = 9000
fmt.Printf("It's over %d\n", power)

var power int = 9000
power := 9000

if (name == "Goku" && power > 9000) || (name == "gohan" && power < 4000) {
    print("super Saiyan")
    println("it's over 9000!")
}

if p := "MR"; isFormal {
} else {
}

if len(os.Args) != 2 {
    os.Exit(1)
}
fmt.Println("It's over", os.Args[1])

//
defer file.Close()

// read input from CLI
var option string
fmt.ScanIn(&option)
println(option)
````

````go
for i := 0; i < 100; i++ {
}
````

#### Basic types

* bool
* string
* int (int8, int16, int32, int64)
* uint (uint8, uint16, uint32, uint64, uintptr)
* byte // alias for uint8
* rune // alias for int32
* float32 float64
* complex64 complex128

Other types:

* Array
* Slice
* Struct
* Pointer
* Function
* Interface
* Map
* Channel

#### Function Declaration

````go
func log(message string) { }
func add(a int, b int) int { }
func power(name string) (int, bool) { }

value, exists := power("goku")
_, exists := power("goku")
````

#### Structure

OOP in go represented by structures.
Inheritance in go represented by composition.

````go
type Saiyan struct {
    Name string
    Power int
}

goku := Saiyan {
  Name: "Goku",
  Power: 9000,
}

goku := Saiyan{}

goku := Saiyan{Name: "Goku"}
goku.Power = 9000

goku := Saiyan{"Goku", 9000}
````

#### Array

````go
var scores [10]int
scores[0] = 339
scores := [4]int{9001, 9333, 212, 33}
// size from elements in {}
scores := [...]int{9001, 9333, 212, 33}

scores = append(scores, 5)

// foreach
powers := make([]int, len(saiyans))
for index, saiyan := range saiyans {
    powers[index] = saiyan.Power
}
````

#### Map

````go
myMap := make(map[int]string)
myMap[42] = "Foo"

total := len(lookup)
delete(lookup, "goku")
````

#### Interface

````go
type Logger interface {
    Log(message string)
}

type Server struct {
    logger Logger
}
````

#### HTTP

````
url := req.URL
query := url.Query()
q := query["q"]
page := query.Get("page")

err := req.ParseForm()
f := req.Form
un := f["username"]
p := f.Get["username"]
````

#### Goroutine

#### Channel

panic
defer
livereload
tests
"net/http/pprof"