**Postman Documentation : https://documenter.getpostman.com/view/28791552/2sAXjQ3AqM**

**Reservation Approval System Documentation**
**Overview**
The Reservation Approval System is a web-based application built using Laravel, designed to manage reservations and approval processes for administrators and approvers.
**User Roles**
1. **Admin**: Responsible for creating reservations and managing the overall system.
2. **Approver**: Responsible for approving or rejecting reservations created by admins.
**Admin Perspective**
### Admin Login
* The admin logs in to the system using their credentials.
* Upon successful login, the admin is redirected to the dashboard.
### Create Reservation
* The admin clicks on the "Create Reservation" button to create a new reservation.
* The admin is presented with a form to fill in the reservation details, including:
	+ Reservation name
	+ Start date
	+ End date
	+ Vehicle model
	+ Driver name
	+ Purpose
* The admin submits the form to create the reservation.

## Approver Perspective
### Approver Login
* The approver logs in to the system using their credentials.
* Upon successful login, the approver is redirected to the dashboard.
### Approve Reservation
* The approver clicks on the "Approve Reservation" button to view pending reservations.
* The approver is presented with a list of pending reservations, including:
	+ Reservation name
	+ Start date
	+ End date
	+ Vehicle model
	+ Driver name
	+ Purpose
* The approver selects a reservation to approve or reject.
* The approver is presented with a form to fill in the approval details, including:
	+ Approval note
	+ Affirmation status (approved or rejected)
* The approver submits the form to approve or reject the reservation.
### Create Detail Reservation
* After approving a reservation, the approver can create a detailed reservation.
* The approver is presented with a form to fill in the detailed reservation information, including:
	+ Reservation ID
	+ Vehicle model
	+ Driver name
	+ Start date
	+ End date
	+ Purpose
	+ Approval note


* The approver submits the form to create the detailed reservation.
**System Flow**
1. Admin creates a reservation.
2. Approver logs in and views pending reservations.
3. Approver selects a reservation to approve or reject.
4. Approver fills in the approval details and submits the form.
5. If approved, the approver can create a detailed reservation.
6. The system updates the reservation status and sends notifications to relevant parties.
**Code Structure**
The code is organized into the following directories:
* `app`: Contains the application logic, including controllers, models, and views.
* `resources`: Contains the view templates and assets.
* `routes`: Defines the application routes.
**Key Files**
* `app/Http/Controllers/AdminController.php`: Handles admin-related logic.
* `app/Http/Controllers/ApproverController.php`: Handles approver-related logic.
* `resources/views/approve_reservations.blade.php`: View template for approver to approve reservations.
* `resources/views/create_reservation.blade.php`: View template for admin to create reservations.
Note: This documentation is a breakdown of the provided code snippets and may not cover all aspects of the application.
