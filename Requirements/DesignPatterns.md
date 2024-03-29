## COSC 310 Two Possible Design Patterns for Project M3

For our project we’re choosing the Model-View-Controller (MVC) and observer design pattern.

MVC is the best for desktop and web applications specifcally. Some benefits of MVC specifically for our project (ticketing platform) include separation of concerns, flexibility, maintainability, code reusability, support for multiple platforms.

Separation of concerns includes:

- The model manages data and business logic
- The view handles the user interface and presentation
- The controller handles user input, processes requests, and manages flow

Flexibility:

- Each component (Model, View, Controller) can be developed independently, promoting modular and scalable code. Flexibility provides extensible architecture that can adapt to changing requirements and business needs.

Maintainability:

- Changes to one component do not affect the others, making it easier to maintain and update the system

Code reusability:

- Reusable components for user authentication, event management, and transaction processing can be implemented across the application

Performance:

- The MVC design pattern allows for efficient handling of user actions, ensuring that the system responds to use actions within the specified timeframe.

Implementing the MVC design pattern for the Ticket purchasing platform adheres to industry standards, promotes code maintainability, and ensures a balance between reason (logical structure) and passion (user interface and experience)

For our ticketing platform, TicktHub, our Model would consist of User, Event, and Transaction as shown below:

1.  Model:

    - a.) User Model:

      - Manages user information, login status, and user roles (guest, buyer, seller, administrator).
      - Handles user account creation, modification, and profile updates.
      - limits user access based on their user type and login status

    - b.) Event Model:

      - Manages events, tickets, and related statistics.
      - Handles the creation, modification, and review of events by sellers.

    - c.) Transaction Model:
      - Manages the funds transitioning from the buyer's specified payment option and into the seller's account.
      - Ensures real-time updates to the ticket inventory.

For our project the View would consist of the User Interface as shown below:

2. View:
   - a.) User Interface:
     - Displays pages for browsing events, viewing tickets, and managing user profiles.
     - Provides a secure shopping cart for registered users during the purchasing process.
     - Displays confirmation messages for successful payments and transactions.
     - The sign-up page will allow the guest user to join the platform as a buyer or seller

The Controllers for our project consist of User Controller, Event Controller, Transaction Controller as shown below:

3. Controller:

   - a.) User Controller :

     - Handles user authentication, registration, and profile modification.
     - Manages user access based on roles and login status.

   - b.) Event Controller (Admin):

     - Manages the creation, modification, and review of events by sellers.
     - Facilitates the verification process before creating a new event.

   - c.) Transaction Controller (Paypal):
     - Handles the purchasing process, including validation of tickets and payment processing.
     - Manages real-time updates to the ticket inventory.
     - Facilitates refund processes in case of cancellations or issues with transactions.

Another suitable design pattern for our platform TicktHub, complementing the MVC pattern or used independently, is the "Observer Pattern." The Observer Pattern is particularly valuable when there is a need for one-to-many dependency between objects, and a change in one object triggers updates in multiple dependent objects. In the context of a ticketing platform, it can be applied to efficiently handle real-time updates, notifications, and event-driven functionalities. Here's how we could integrate the Observer Pattern:

1. Subject (Observable):

   - Ticket Inventory:
     - Serves as the subject that is observed by multiple components.
     - Maintains a list of observers (buyers, sellers, administrators) interested in real-time updates.

2. Observers:

   - a.) Buyer Observer:

     - Allows buyers to moniter their buyer-specific activities when the ticket inventory changes (e.g., new tickets posted, tickets sold).
     - Updates the user interface to display the latest ticket information.

   - b.) Seller Observer:

     - Allows sellers to moniter their seller-specific activities about changes in events, ticket sales, and requests to administrators for event creation & modifications.
     - Updates the seller dashboard in real-time.

   - c.) Administrator Observer:
     - Monitors for notifications related to potential fraudulent activities or abnormal changes in ticketing statistics.
     - Allows administrators to moniter for administrator-specific functionalities, such as
       - administrators keeping track of user history/activities.
       - administrators granting permission to seller's request for posting.

3. Concrete Observers:

   - a.) Shopping Cart Observer:

     - Monitors changes in the shopping cart, ensuring that the cart is updated in real-time as users add or remove items.

   - b.) Transaction Observer:
     - Keeps track of transaction status changes, facilitating the immediate update of the user interface and relevant statistics.

Benefits of Observer Pattern for the Ticketing Platform:

1. Real-time Updates:

   - The Observer Pattern facilitates real-time updates to different components of the ticketing platform without the need for continuous polling.

2. Loose Coupling:

   - The Subject and observers are loosely coupled, allowing for flexibility and ease of modification without affecting other parts of the system.

3. Flexibility / Scalability:

   - Easily accommodates additional observers without modifying the subject, supporting the scalability of the platform.

4. Event-Driven Architecture:

   - Fits well with the event-driven nature of a ticketing platform where changes in ticket availability, sales, and events trigger corresponding updates.

5. Dynamic:
   - Allowing for dynamic addition and removal of Observers at runtime.

Integrating the Observer Pattern into the ticketing platform enhances its responsiveness, flexibility, and adaptability to real-time changes, providing a seamless and dynamic user experience.
