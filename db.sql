CREATE TABLE class(
    name text,
    code text,
    instructor text
)

CREATE OR REPLACE FUNCTION create_class(
    n text,
    c text,
    i text
)
RETURNS VOID
AS 
$$
BEGIN
    INSERT INTO class values(n,c,i);
END;
$$
LANGUAGE 'plpgsql'
STRICT;