# Webshop with php and mysql
This webshop was created as part of my studies. It is a simple webshop with a login system, a shopping cart and a checkout. The webshop is written in PHP and uses a MySQL database.

## Video Presentation of the Project in German
https://user-images.githubusercontent.com/49081477/235468107-b53c27cc-1857-4c5a-9ded-033b08239b9f.mp4

# Technologies
- PHP
- mysql
- ajax
- bootstrap
- w3
- javasrcipt 
- phpmailer

## Features
- authentication is implemented without a library
- password hashes are stored in the mysql database (no salt)
- Contactform with phpmailer backend
- Orderconfirmations via email are automated
- shoppingcart is stored in the session
- the counter for how many users are currently online works with ajax and polling (no browser refreh needed)

These are the criteria on which the project is graded:
1.	 Login page + (display + function)
2.	 Validate the data before sending it (client side) (function)
3.	 User registration + (display + function) (prevent double registration!)
4.	 Registration confirmation => by email
5.	 Password SHA2 encrypted in database (function)
6.	 Encrypt password before sending (only transfer encrypted passwords)
7.	 Online status with AJAX without reloading the page (number of users online) (display + function)
8.	 Display article overview (display + function)
9.	 Put articles in shopping cart and buy (display + function)
10.	 When ordering, 2 shipping methods can be selected / Normal or Express (+ X €)
11.	 Confirmation by email (function) with article quantity + article name + total amount + shipping costs
12.	 Overview of purchased items (display + function)
13.	 In the overview a button with the function to execute the same order again.
14.	 Support for special characters (ä, ö, ü, ...)
15.	 Security - Only logged in users are allowed to access the page
16.	 On the start page a carousel - Example: (https://getbootstrap.com/docs/4.3/components/carousel/)
17.	 User is greeted when logging in with: "Hello Mustermann, you were last online on XX.XX.XXXX"
18.	 Readability of the website

As an extra, a Linux server with Apache was set up and made available online with the help of ngrok.io.

The project was programmed with the code editor VSCode.

The design is mostly self-made, and the layout was optimized using css for a responsive design.

