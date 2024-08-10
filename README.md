# POSTMAN DOCUMENTATION

## 1.Users Endpoint

### SUCCESS RESPONSE:

-   Register
    ![alt text](image.png)

-   Login
    ![alt text](image-1.png)

### ERROR RESPONSE:

-   Register, if required data not filled.
    ![alt text](image-2.png)

-   Register, if email or password is invalid.
    ![alt text](image-3.png)

-   Register, if email already exist.
    ![alt text](image-4.png)

-   Login, if required data not filled.
    ![alt text](image-5.png)

-   Login, if username or password invalid.
    ![alt text](image-6.png)

## 2. Product Categories Endpoint

### SUCCESS RESPONSE:

-   Create
    ![alt text](image-7.png)

-   Get All
    ![alt text](image-8.png)
    ![alt text](image-9.png)

-   Get By Id
    ![alt text](image-10.png)

-   Update By Id
    ![alt text](image-11.png)

-   Delete By Id
    ![alt text](image-12.png)

### ERROR RESPONSE:

-   Access to product categories endpoints requires authentication, otherwise, an authentication error will be thrown.
    ![alt text](image-13.png)

-   Create, if required data not filled.
    ![alt text](image-14.png)

-   Create, if category is already exist.
    ![alt text](image-15.png)

-   Find By Id, Update By Id, and Delete By Id operations require an Id to be provided, if data with id provided not found an error will be thrown.
    ![alt text](image-16.png)

## 3.Products Endpoint

### SUCCESS RESPONSE:

-   Create
    ![alt text](image-17.png)

-   Get All
    ![alt text](image-18.png)
    ![alt text](image-19.png)

-   Get By Id
    ![alt text](image-20.png)

-   Update By Id
    ![alt text](image-21.png)

-   Delete By Id
    ![alt text](image-22.png)

## ERROR RESPONSE:

-   Access to products endpoints requires authentication, otherwise, an authentication error will be thrown.
    ![alt text](image-23.png)

-   Create, if required data not filled.
    ![alt text](image-24.png)

-   Create, if product name already exist or category not found.
    ![alt text](image-25.png)

-   Find By Id, Update By Id, and Delete By Id operations require an Id to be provided, if data with id provided not found an error will be thrown.
    ![alt text](image-26.png)
