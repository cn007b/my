package main

import (
	"flag"
	"fmt"
)

func main() {
	limit := 0
	flag.IntVar(&limit, "limit", -1, "limit value")
	flag.Parse()
	fmt.Printf("Limit value: %d \n", limit)
}

// go run ed/l/go/examples/whatever/commandLineArguments.go --limit 9
// go run ed/l/go/examples/whatever/commandLineArguments.go --limit=9
