INSERT INTO USERS (email, username, password) 
VALUES ('johndoe@gmail.com', 'JohnDoe', 'testing');
select * from users;

SELECT * FROM COMPANY WHERE COMPANY.sector = 'Technology' AND COMPANY.ebitda > 0;

SELECT
	   c.company_id,
	   c.name,
	   c.sector,
	   if(pc.company_id is not null, 'Private Company', 'Public Company') as company_type,
	   pc.valuation,
	   pb.market_cap,
	   pb.market_price,
	   c.ebitda,
	   c.revenue_growth,
	   s.date_shortlisted
	FROM SHORTLIST_CONTAINS s
	LEFT JOIN COMPANY c
	   ON c.company_id = s.company_id
	LEFT JOIN PRIVATE_COMPANY pc
	   ON pc.company_id = c.company_id
	LEFT JOIN PUBLIC_COMPANY pb
	   ON pb.company_id = c.company_id
	LEFT JOIN SHORTLIST sh
	   on sh.sid = s.sid
	LEFT JOIN USERS u
	   ON u.id = sh.user_id
WHERE u.email = 'test@gmail.com' and sh.sname = 'Sample Companies 1';

# show contents 
SELECT * FROM SHORTLIST;
# add a shortlist;
INSERT INTO SHORTLIST(sname, user_id) VALUES('TEST SHORTLIST', 1); 
# show contents 
SELECT * FROM SHORTLIST;
# delete from shortlist;
DELETE FROM SHORTLIST WHERE sname = 'TEST SHORTLIST' and user_id = 1; 
# show contents 
SELECT * FROM SHORTLIST;

SELECT COUNT(*) AS Total_Company, MAX(ebitda) AS highest_EBITDA,
   	MIN(ebitda) AS lowest_EBITDA,
    	MAX(revenue_growth) AS highest_RevGrowth,
    	MIN(revenue_growth) AS lowest_RevGrowth
FROM COMPANY;

SELECT DISTINCT sc.sid
FROM SHORTLIST_CONTAINS sc
WHERE sc.company_id IN
    (SELECT c.company_id from COMPANY c
     WHERE c.sector = 'Technology' AND c.revenue_growth > 2);