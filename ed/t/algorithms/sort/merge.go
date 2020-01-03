package main

import (
	"fmt"
)

func main() {
	fmt.Println(MergeSort([]int{9, 3, 11, -1, 3, 7}))
}

func MergeSort(slice []int) []int {
	if len(slice) < 2 {
		return slice
	}
	mid := len(slice) / 2
	r1 := MergeSort(slice[:mid])
	r2 := MergeSort(slice[mid:])
	r := merge(r1, r2)
	return r
}

func merge(left, right []int) []int {
	size := len(left) + len(right)
	slice := make([]int, size, size)
	i := 0
	j := 0
	for k := 0; k < size; k++ {
		if i > len(left)-1 && j <= len(right)-1 { // Case 3
			slice[k] = right[j]
			j++
		} else if j > len(right)-1 && i <= len(left)-1 { // Case 4
			slice[k] = left[i]
			i++
		} else if left[i] < right[j] { // Case 1
			slice[k] = left[i]
			i++
		} else { // Case 2
			slice[k] = right[j]
			j++
		}
	}
	return slice
}