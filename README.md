# cs338project

### Overview

This repo contains all the scripts for Group 11's CS338 project. The project focuses on building a stock (equity) exploration application that aids users in stock selection and analysis. Primary features include the ability to query price data for stock tickers, create a shortlist of selected tickers, view a side-by-side comparison of ticker metrics, and display time-series price charts. 

Outlined below is the installation instructions for running the application on your local machine. 

### Prerequisites

We used the same tech stack as described in the Project example on the course homepage. 

As such, this repo uses MySQL for all database logic and PHP for web-based logic (the primary GUI for the user). Thus it assumed that users have the following installed on their local machine:

- PHP 

- MySQL 

### Installation

#### 1. Git Repo

Clone the repository to a dedicated folder using:

```bash
   git clone https://github.com/abains48/cs338project.git
```


#### 2. MySQL

After installing MySQL run these two commands in your terminal. Make sure to replace PATH in the second statement with the real path to the test.sql file in the cloned git repo. 

```bash
   sudo /usr/local/mysql/support-files/mysql.server start
   php setup.php
```


This will create the testDB in your MySQL. 

#### 2. PHP

Ensure the PHP is correctly installed. 

Then, change the USERNAME and PASS in the following lines in the test.php file to the username and password of your root user in MySQL:

```php
    $username = USERNAME; 
    $password = PASS;
```

To run PHP script execute the following commands. Ensure that PATH is replaced by the absolute path of the git repo on your local. 

```bash
    cd PATH
    php -S 127.0.0.1:8000 
    php login.php
```


Note: This will show the HTML in terminal as a sanity check that the connection is working. To view this in a web browser, start a PHP instance in terminal and navigate to the local php address. 











