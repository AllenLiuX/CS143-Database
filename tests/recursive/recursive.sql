WITH RECURSIVE Ancestor(child, ancestor) AS (
(SELECT child, parent AS ancestor FROM Parent)
UNION (
    SELECT P.child, A.ancestor
    FROM Parent P, Ancestor A
    WHERE P.parent = A.child
    )
)
SELECT ancestor FROM Ancestor WHERE child='A';
