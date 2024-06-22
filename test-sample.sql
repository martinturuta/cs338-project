INSERT INTO USERS (email, username, password) 
VALUES ('johndoe@gmail.com', 'JohnDoe', 'testing');

SELECT * FROM COMPANY WHERE COMPANY.sector = 'Technology' AND COMPANY.ebitda > 0;

SELECT 
	c.company_id,
	c.name, 
    c.sector, 
    c.ebitda, 
    c.market_cap,
    c.revenue_growth,
    s.sentiment,
    s.date_shortlisted
FROM SHORTLIST_CONTAINS s
LEFT JOIN COMPANY c
	ON c.company_id = s.company_id
WHERE s.user_id = '1' AND s.sid = 'asdas';

SELECT * FROM SHORTLIST_CONTAINS;

DELETE FROM SHORTLIST_CONTAINS s
WHERE s.sid = 'asdas' and s.company_id = 1 ;

SELECT * FROM SHORTLIST_CONTAINS;

INSERT INTO SHORTLIST_CONTAINS(sid,company_id,user_id,sentiment) VALUES
 ('asdas','1','1','Bullish');

SELECT * FROM SHORTLIST_CONTAINS;