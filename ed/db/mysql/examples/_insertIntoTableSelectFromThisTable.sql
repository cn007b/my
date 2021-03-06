select * from author;
+----+-------------+
| id | name_author |
+----+-------------+
|  1 | david       |
|  2 | kate        |
|  3 | tom         |
|  4 | mark        |
+----+-------------+
insert into author select null as id, name_author from author;
ERROR 1062 (23000): Duplicate entry '0' for key 'PRIMARY'

create temporary table tmpTbl1 (
id int auto_increment,
code int,
primary key (id)
);
drop table tmpTbl1;

insert into tmpTbl1 values (null, 101), (null, 200);
select * from tmpTbl1;
insert into tmpTbl1 select null, code from tmpTbl1;
-- ERROR 1137 (HY000): Can't reopen table: 'tmpTbl1'
-- This error only for temporary table,
-- for normal table this error is not actual.

create table tbl1 (
id int,
code int
);
insert into tbl1 values (null, 101), (null, 200);
insert into tbl1 select * from tbl1;
-- Query OK, 2 rows affected
