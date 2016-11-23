-- Вывести на экран сотрудников, получающих заработную плату большую чем у непосредственного руководителя

SELECT E1.* FROM employee E1, employee E2 
WHERE  E2.id = E1.chief_id 
AND E1.salary > E2.salary;