Test
-

## Test

````
goapp test -v transactional/users/service -run TestGetServiceAccountsForAdmin
````

````
t.Run("fail send email", func(t *testing.T) {})
t.Errorf("Got: %s, want: %s", a, e)
t.Skip("skipping...")
b.RunParallel(func(pb *testing.PB) {})
````

## Bench

Bench output:

````
goos: linux
goarch: amd64
BenchmarkFibComplete-4     1000000        2185 ns/op      3911 B/op        0 allocs/op
PASS
ok    _/gh/ed/go/examples/bench 2.446s
````

Means that the loop ran 100000000 times at a speed of 2185 ns (nanosecond) per loop.