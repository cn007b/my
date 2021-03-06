package main

import (
	"bytes"
	"encoding/gob"
	"encoding/json"
	"fmt"
	"io"
)

func main() {
	//one()
	//two()
	//three()
	//forth()
	//readTwiceFromBuffer()
	readTwiceFromBufferReaderWithReset()
}

func readTwiceFromBufferReaderWithReset() {
	msg := []byte("ok")

	b := bytes.NewReader(msg)

	content1, err := io.ReadAll(b)
	if err != nil {
		panic(err)
	}
	fmt.Printf("content1: '%s' \n", content1) // content1: 'ok'

	b.Reset(msg)

	content2, err := io.ReadAll(b)
	if err != nil {
		panic(err)
	}
	fmt.Printf("content2: '%s' \n", content2) // content2: 'ok'
}

func readTwiceFromBuffer() {
	b := bytes.NewBuffer([]byte("ok"))

	content1, err := io.ReadAll(b)
	if err != nil {
		panic(err)
	}
	fmt.Printf("content1: '%s' \n", content1) // content1: 'ok'

	content2, err := io.ReadAll(b)
	if err != nil {
		panic(err)
	}
	fmt.Printf("content2: '%s' \n", content2) // content2: ''
}

func one() {
	origin := `{"msg": "test"}`

	var buf bytes.Buffer
	enc := gob.NewEncoder(&buf)
	enc.Encode(origin)
	fmt.Printf("\n %+v", buf.Bytes())

	dec := gob.NewDecoder(&buf)
	var res string
	dec.Decode(&res)
	fmt.Printf("\n %+v", res)
}

func two() {
	origin := map[string]interface{}{"code": 200, "msg": "OK"}

	var buf bytes.Buffer
	enc := gob.NewEncoder(&buf)
	enc.Encode(origin)
	fmt.Printf("\n %+v", buf.Bytes())

	dec := gob.NewDecoder(&buf)
	res := make(map[string]interface{})
	dec.Decode(&res)
	fmt.Printf("\n %+v", res)
}

func three() {
	origin := []interface{}{204, "blank"}

	var buf bytes.Buffer
	enc := gob.NewEncoder(&buf)
	enc.Encode(origin)
	fmt.Printf("\n %+v", buf.Bytes())

	dec := gob.NewDecoder(&buf)
	res := make([]interface{}, 0)
	dec.Decode(&res)
	fmt.Printf("\n %+v", res)
}

func forth() {
	origin := map[string]interface{}{"key": "n", "value": 204}

	enc, _ := json.Marshal(origin)
	fmt.Printf("\n %+v", enc)

	res := make(map[string]interface{})
	json.Unmarshal(enc, &res)
	fmt.Printf("\n %+v", res)
}
