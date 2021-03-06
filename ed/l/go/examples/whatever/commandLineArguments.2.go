package main

import (
	"flag"
	"fmt"
)

func main() {
	limit := flag.Int("limit", -1, "limit value")
	version := flag.String("v", "v1", "version: v1 or v2")
	flag.Parse()

	fmt.Printf("Limit value: %v \n", *limit)
	fmt.Printf("Version value: %v \n", *version)
}

// go run ed/l/go/examples/whatever/commandLineArguments.2.go -limit=9 -v=v1
