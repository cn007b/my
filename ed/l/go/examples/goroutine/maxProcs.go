package main

import (
	"fmt"
	"runtime"
	"sync"
	"time"
)

const (
	procs = 1
)

func init() {
	runtime.GOMAXPROCS(procs)
}

func main() {
	startedAt := time.Now().UnixNano()
	action()
	endedAt := time.Now().UnixNano()

	fmt.Printf("With: %d procs, Took: %d microseconds\n", procs, (endedAt-startedAt)/1000)
}

func action() {
	wg := sync.WaitGroup{}

	for i := 0; i < 10; i++ {
		wg.Add(1)
		go func(i int) {
			defer wg.Done()
			time.Sleep(time.Millisecond * 100)
			fmt.Printf("Done task #%d \n", i)
		}(i)
	}

	wg.Wait()
}
