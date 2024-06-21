## extracting shortlist info from tables 
select 
	c.company_id,
	c.cname, 
    c.sector, 
    c.ebitda, 
    s.sentiment, 
    s.date_shortlisted
from shortlist_contains s
left join public_companies c
	on c.company_id = s.company_id
where s.user_id = '10000' and s.sid = '8b42e';