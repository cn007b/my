// create table test_mysql (id int key, code int);
// insert into test_mysql values (1, 200);

package main

import (
	"database/sql"
	"fmt"
	"github.com/cliqueinc/mysql-wear/sqlq"
	"time"

	mw "github.com/cliqueinc/mysql-wear"
)

const (
	CONN_STR = "dbu:dbp@tcp(xmysql:3306)/test?charset=utf8"
)

type TestMysql struct {
	ID   int
	Code int
}

type UserProfile struct {
	ID        int `mw:"pk"`
	FirstName string
	LastName  string
	Tags      []string
	CreatedAt time.Time
}

func main() {
	f11()
}

func checkErr(err error) {
	if err != nil {
		panic(err)
	}
}

func getDB() *mw.DB {
	dbc, err := sql.Open("mysql", CONN_STR)
	checkErr(err)
	db := mw.New(dbc)
	return db
}

func f1() {
	db := getDB()
	v, err := db.Count(&TestMysql{})
	checkErr(err)
	fmt.Printf("got count: %d\n", v)
}

func f2() {
	fmt.Println(mw.GenerateModel(&UserProfile{}, "up")) // panic: Missing primary key for table (user_profile)
}

func f3() {
	fmt.Println(mw.GenerateModelTest(&UserProfile{}, "upt")) // panic: Missing primary key for table (user_profile)
}

func f4() {
	u1 := &UserProfile{ID: 1, FirstName: "James", LastName: "Bond"}
	db := getDB()
	db.MustInsert(u1)
}

func f5() {
	var data []TestMysql
	db := getDB()
	db.MustSelect(&data, sqlq.Columns("id", "code"),
		sqlq.Limit(10), sqlq.GreaterThan("code", 100),
	)
	fmt.Printf("Got data:\n%#v\n", data)
}

func f6() {
	var data []TestMysql
	db := getDB()
	db.MustSelect(&data, sqlq.Columns("id", "code + 1000")) // panic: unrecognized column (code + 1000)
	fmt.Printf("Got data:\n%#v\n", data)
}

func f7() {
	t := &TestMysql{}
	db := getDB()
	found := db.MustGet(t, sqlq.Equal("code", 200))
	fmt.Printf("Found: %v, Got data: %#v\n", found, t)
}

func f8() {
	t := &TestMysql{}
	db := getDB()
	found := db.MustGet(t, sqlq.Equal("code", 200))

	if !found {
		return
	}

	t.Code = 201
	if err := db.Update(t); err != nil {
		fmt.Printf("Got update error 1: %#v\n", err)
	}

	t.Code = 200
	if err := db.Update(t); err != nil {
		fmt.Printf("Got update error 2: %#v\n", err)
	}
}

func f9() {
	t := &TestMysql{ID: 3, Code: 501}
	db := getDB()
	db.MustInsert(t) // panic: Please pass a struct pointer to parseModel

	if err := db.Delete(t); err != nil {
		fmt.Printf("Got delete error: %#v\n", err)
	}
}

func f10() {
	db := getDB()
	count := db.MustCount(&TestMysql{}, sqlq.LessThan("code", 1000))
	fmt.Printf("Got count: %d\n", count)
}

func f11() {
	fmt.Println(mw.GenerateSchema(&UserProfile{}))
}

// -------------------------------------------- //
// AUTO GENERATED - Place in a new models file
// -------------------------------------------- //

func NewUserProfile() *UserProfile {
	return &UserProfile{}
}

func GetUserProfile(db *mw.DB, id int) (*UserProfile, error) {
	up := &UserProfile{ID: id}
	found, err := db.Get(up)
	if err != nil {
		return nil, err
	}
	if !found {
		return nil, nil
	}
	return up, nil
}

func (up *UserProfile) Insert(db *mw.DB) error {
	//up.Created = time.Now().UTC()
	//up.Updated = time.Now().UTC()
	res, err := db.Insert(up)
	if err != nil {
		return err
	}
	id, err := res.LastInsertId()
	if err != nil {
		return fmt.Errorf("fail get last id: %v", err)
	}
	up.ID = int(id)
	return nil
}

func (up *UserProfile) Update(db *mw.DB) error {
	//up.Updated = time.Now().UTC()
	if err := db.Update(up); err != nil {
		return err
	}
	return nil
}

func (up *UserProfile) Delete(db *mw.DB) error {
	if err := db.Delete(up); err != nil {
		return err
	}
	return nil
}

// -------------------------------------------- //
// AUTO GENERATED - Place in a new models file
// -------------------------------------------- //