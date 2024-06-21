## populate tables with sample values 

INSERT INTO shortlist VALUES(
	SUBSTRING(MD5(RAND()), 1, 5), 
    'tech companies',  
	 SUBSTRING(MD5(RAND()), 1, 5));
     
INSERT INTO public_companies VALUES(
	SUBSTRING(MD5(RAND()), 1, 5), 
    SUBSTRING(MD5(RAND()), 1, 10),  
    'Nvidia Inc.', 
    'Tech',
    123);
    
INSERT INTO public_companies VALUES(
	SUBSTRING(MD5(RAND()), 1, 5), 
    SUBSTRING(MD5(RAND()), 1, 10),  
    'Apple Inc.', 
    'Tech',
    150);
    
INSERT INTO public_companies VALUES(
	SUBSTRING(MD5(RAND()), 1, 5), 
    SUBSTRING(MD5(RAND()), 1, 10),  
    'Microsoft Inc.', 
    'Tech',
    300);
    
INSERT INTO public_companies VALUES(
	SUBSTRING(MD5(RAND()), 1, 5), 
    SUBSTRING(MD5(RAND()), 1, 10),  
    'Walmart Inc.', 
    'Store',
    131)
    ;
    select * from public_companies;
    
INSERT INTO shortlist_contains VALUES (
	'8b42e',
    'aa498ce8da',
    '10000', 
    'Bullish',
    '2024-06-10') ;
    
INSERT INTO shortlist_contains VALUES (
	'8b42e',
    'c472fa8cbb',
    '10000', 
    'Bullish',
    '2024-06-11') ;
    
INSERT INTO shortlist_contains VALUES (
	'8b42e',
    'd5a85a03d7',
    '10000', 
    'Bullish',
    '2024-06-19') ;
    
    
    
    
    
    

    

