Foreign key
-

Foreign key - is a field in 1 table which uniquely identifies row in another table.

````sql
CREATE TABLE f_products (
  product_no integer PRIMARY KEY,
  name text,
  price numeric
);

CREATE TABLE orders (
  order_id integer PRIMARY KEY,
  product_no integer
  REFERENCES f_products (product_no),
  quantity integer
);

CREATE TABLE order_items (
  product_no integer REFERENCES products ON DELETE RESTRICT,
  order_id integer REFERENCES orders ON DELETE CASCADE,
  quantity integer,
  PRIMARY KEY (product_no, order_id)
);

DROP TABLE f_products CASCADE;
````
