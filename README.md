//* Ticket Hub Requirements *//

/* User Requirements */

#1 User Personas
Simon Hughes (Administrator) Male, 34 years old, United States 
Goals: Platform Management, User Support and Accessibility, Privacy and Security of User Data, Analytics and Reporting 
Quote: Mastering event management is not just about orchestrating moments, but about crafting unforgettable experiences that resonate long after the curtains close.
Background: Simon has been deeply involved in the event management industry for over a decade. He is an experienced event manager who oversees the operation of the event ticketing platform. Their expertise extends beyond the logistical aspects of event planning. Simon possesses a solid understanding of marketing principles, leveraging various channels to promote events and attract attendees. Their role involves not only overseeing the day-to-day operations but also strategizing for long-term growth and innovation. They thrive in dynamic environments where they can leverage their skills to drive success and exceed expectations.
Motivation: Creating and facilitating a fun event ticketing platform that is intuitive to use
Challenges: High Volume of Listings, User Support, Data Analysis and Platform Growth
How Simon Interacts with the System: 
1. Simon accesses the admin dashboard to monitor the platform activity, moderate and access analytical reports 
2. He responds to user inquiries and issues via email facilitated by the platform support system 
3. Simon collaborates with the development team to implement new features and improvements based on user feedback and data analysis

#2 User Personas
Lucy Brown (Registered User) Female, 22 years old, United States 
Goals: Discover Events, Purchase Tickets, Manage Tickets, Stay Informed
Quote: Life is a canvas, and every event is a brushstroke of colour and texture that adds depth to the masterpiece of our experiences. From the whispers of art galleries to the crescendo of music concerts, I embrace the diversity of experiences that shape my journey and ignite my passions.
Background:  Lucy is a college student pursuing her Bachelor of Arts in psychology and has a passion for exploring diverse cultural experiences and immersing herself in the vibrant tapestry of events her city has to offer. Emily has cultivated a keen eye for creativity and a deep appreciation for the arts. As a college student on a tight budget, Emily has learned to balance her academic commitments with her passion for attending events. She focuses on finding affordable ticket options and leveraging student discounts to make the most of her limited resources
Motivations: Enriching herself culturally and meeting new people in her community who share the same passions and interests.
Challenges: Budget Constraint, Prioritizing Event Selection, Planning
How Lucy Interacts with the System: 
1. Lucy logs into her account to browse upcoming events and purchase tickets 
2. She can search for upcoming events and artists and narrow down options by filtering dates, location and event 
3. Lucy will be able to facilitate the sale of tickets she has purchased on the platform and view and manage offers

#3 User Personas
Daniel Kane (Event Organizer) Male, 32 years, United States 
Goals: Post Event Tickets, Manage Ticket Inventories, Edit Event Information, Reach Target Audience
Quote: Behind every successful event lies a symphony of meticulous planning, tireless dedication, and unwavering passion. As an orchestrator of experiences, I thrive on the thrill of bringing visions to life, creating memories that linger long after the lights dim and the curtains fall
Background: Daniel’s journey into the realm of event organization began during his college years when he discovered his passion for bringing people together through memorable experiences. Daniel pursued a degree in Event Management, where he honed his skills in planning, marketing, and execution. Driven by a desire to create unique and immersive experiences, Daniel eventually ventured out on his own, founding his event production company. Specializing in music festivals and cultural showcases, Daniel's company quickly gained recognition for its innovative approach to event curation and its ability to blend entertainment, art, and community engagement. Today, Daniel is a seasoned event organizer with a reputation for excellence in his field. 
Motivation: Organizing fun events for his community that allow art lovers to find each other and build a community.
Challenges: Ticket Management Complexity, Marketing and Promotion, Technical Proficiency  and Coordination and Logistics

/* Functional Requirements */

What the system will do to support users
The system will allow guests to browse, login, or register for an account.
The system will allow registered users to browse events and tickets as well as purchase tickets and resell tickets.
The system will keep track of tickets sold and other statistics that are reported back to sellers and administrators.
The system will allow the seller to list events with relevant details for tickets, modify events, and review sales.
The system provides profiles for all registered users including sellers that can be modified.
The system grants admin privileges to detect fraudulent purchases/events and to take necessary action.
A shopping cart is provided by the system for registered users for ease of purchase.
The application provides safe and secure third-party payment processes as well as validation of tickets for buyers.

/* Non-functional Requirements */

Project Scope/Budget(timing and technical constraints)
The system responds to user actions within 2 seconds, and can effectively accommodate reasonable user loads of up to 1000 people.
Account information of registered users is confidential and secure under industry standard protocols.
Only authorized administrators have the ability to access specific functionalities. These functionalities remain confidential and encrypted.
The program can be run on Windows, Linux, and Mac OS.
The program adheres to industry standards.
The code is easily maintainable and modifiable.

/* Domain Requirements */

- User Management:
  - Determine the user's login status to distinguish between registered users and guest users.
  - Enable users to create an account and log in as a seller, buyer, or administrator.
  - Allow users to modify their profiles and ensure that the user database is updated accordingly.
  - Authorization/Permission Management:
  - Limit user access based on their user type and login status.

- Ticket Management
 - Enable seller users to propose creating a new ticket, providing event information and desired price.
 - Allow seller users to submit the proposal form.
 - Implement a verification process before creating a new event.
 - Provide administrators with a management page to review user requests.
 - Allow administrators to grant permission by clicking an "Ok" button.
 - Remove permitted requests from the list once permission is granted.
 - Upon permission granted by the administrator, enable users to see the "post" button on the create post page.
 - Update the ticket inventory as new tickets are posted.
 - Allow buyers to browse posted tickets on the browsing page.
 - Display the available quantity of tickets above the "add to cart" button.
 - Limit the number input to the available ticket quantity.
 - Update ticket inventory as tickets are ordered.
 - Automatically display the tickets past the event datetime invisibly/obscurely

- Transaction Management:
 - Display the ticket price above the "add to cart" button.
 - Allow sellers to view the ticket inventory in real-time.
 - Allow the users to choose to pay with external payment systems like PayPal for payment processing.
 - Provide users with confirmation of successful payment and ticket purchase.
 - Ensure encryption and secure transmission of payment information to safeguard user data.
 - Facilitate refund processes in case of cancellations or issues with transactions. (Discuss)
 - Update ticket inventory run-time every time new transaction status changes





