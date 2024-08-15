Subscription Management System
Description:
An upgrade to a subscription-based blog site to handle user subscriptions more efficiently. This system allows users to register, subscribe, and manage their subscription status.

Features:

Form Handling: Users can register and subscribe via a form with fields for name, email, and subscription status.
Database Operations: Connects to a MySQL database with CRUD operations:
Create: Add new subscribers to the 'Subscribers' table.
Read: Display a list of all subscribers.
Update: Modify subscription status from the account page.
Delete: Remove a user and their data from the database.
Composer Integration: Uses Composer to install and utilize the "nesbot/carbon" package for displaying the current date and time.
Technologies:

Backend: PHP, MySQL
Packages: Composer, Carbon