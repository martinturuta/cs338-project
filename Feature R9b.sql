## extracting shortlist info from tables for user 10000 
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

