# Specification / Context
Please design a ticket tracking system. This system allows QA to report a bug and RD can mark a bug as resolved.
A. Phase I Requirement:
- There are two types of user: QA and RD.
- Only QA can create a bug, edit a bug and delete a bug.
- Only RD can resolve a bug.
- Summary field and Description filed are required of a bug when QA is creating a bug. 
  
B. Phase II Requirement:
- Adding new field Severity and Priority to a ticket.
- Adding new type of user “PM” that can create new ticket type “Feature Request”. And only RD can mark it as resolved.
- Adding new ticket type “Test Case” that only QA can create and resolve. It’s read-only for other type of users.
- Adding new type of user “Administrator” user that can manage all the stuffs including adding new QA, RD and PM user.

## Tasks


Task 1 - Please write down all the use cases either in text or diagram you can think for Phase I and Phase II requirement separately.

Task 2 - Please implement the A. Phase I Requirement by .NET Core MVC/Java Spring MVC/PHP Laravel 8/ Python Django. For front-end, you can use any framework you like, but we prefer Vue XDD.

Task 3 - Think of yourself as an architect. How will you design this system, please write down the design document at least to include data model, class diagram and UI mock up.

---

# Languages / Framework

- PHP / Laravel8
- Javascript / Vue
- Bootstrap5

# Task 1

### Phase 1

- RD / QA are able to login

- Developer could use command to create user

  ```bash
  php artisan user:create
  ```

- RD is able to:

    - Start Fixing bug

  ![image-20210923201922172](./images/image-20210923201922172.png)

    - Resolve bug

      <img src="./images/image-20210923201957633.png" alt="image-20210923201957633" style="zoom:200%;" />

- QA is able to:

    - create bug
    - modify the bug which he created
    - delete the bug  which he created

  ![image-20210923201810171](./images/image-20210923201810171.png)

  ![image-20210923201755541](./images/image-20210923201755541.png)

- RD / QA are able to see 3 statuses of bugs

  ![image-20210923201732499](./images/image-20210923201732499.png)



### Phase 2

- RD / QA / PM / Administor are able to login
- RD is able to resolve bugs / tickets
- QA is able to CURD bugs / Test Case Tickets
- PM is able to CURD  Feature Request Tickets
- Administrator is able to manage all the stuffs (how ?)

---

# Task 3

data model, class diagram and UI mock up

## Phase1

![image-20210923201249554](./images/image-20210923201249554.png)

## Phase 2

![image-20210923201334837](./images/image-20210923201334837.png)



## Mockup

![image-20210923202334244](./images/image-20210923202334244.png)



