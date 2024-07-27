CREATE TABLE Old_Users (
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE New_Users (
    id INT AUTO_INCREMENT NOT NULL,
    email VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE (email)
);

INSERT INTO Old_Users (email, username, password) VALUES
('test@example.com', 'user1', 'password1'),
('test@example.com', 'user2', 'password2'),
('test@example.com', 'user3', 'password3'),
('test@example.com', 'user4', 'password4'),
('test@example.com', 'user5', 'password5'),
('test@example.com', 'user6', 'password6'),
('test@example.com', 'user7', 'password7'),
('test@example.com', 'user8', 'password8'),
('test@example.com', 'user9', 'password9'),
('test@example.com', 'user10', 'password10'),
('test@example.com', 'user11', 'password11'),
('test@example.com', 'user12', 'password12'),
('test@example.com', 'user13', 'password13'),
('test@example.com', 'user14', 'password14'),
('test@example.com', 'user15', 'password15'),
('test@example.com', 'user16', 'password16'),
('test@example.com', 'user17', 'password17'),
('test@example.com', 'user18', 'password18'),
('test@example.com', 'user19', 'password19'),
('test@example.com', 'user20', 'password20');

INSERT INTO New_Users (email, username, password) VALUES
('test@example.com', 'uniqueuser', 'uniquepassword');

SELECT * FROM Old_Users WHERE email = 'test@example.com';
SELECT * FROM New_Users WHERE email = 'test@example.com';

select * from COMPANY WHERE sector = 'Technology';
select * from COMPANY WHERE sector = 'Technology' LIMIT 20;

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
       WHERE u.email = 'test@gmail.com' and sh.sname = 'Sample Companies 1' and s.date_shortlisted > DATE_ADD(CURDATE(), INTERVAL -30 DAY);

SELECT DISTINCT sc.sid
FROM SHORTLIST_CONTAINS sc
JOIN COMPANY c ON sc.company_id = c.company_id
WHERE c.sector = 'Technology' AND c.revenue_growth > 2;

# delete from shortlist;
DELETE FROM SHORTLIST WHERE sname in ('Sample Companies 1', 'Sample Companies 2') and user_id = 1;
select * from shortlist;

UPDATE private_company SET valuation='500' WHERE company_id='16' AND valuation != '500';
select * from private_company

