# Khrov Online store

A simple online store built with Vue 3 and Symfony.

## Deploy

https://store.khrov.com/

## Features

### Catalog

- You can like and unlike cards
- Implemented tabs for product categories
- Products can be added to cart
- Implemented pagination by clicking on the Show more button
- Likes and cart contents are saved in LocalStorage
- When the page loads, a request is sent to the server for the product catalog using fetch(). If an error is returned after the first request, the application makes three additional requests to the server at a dynamic interval. Between requests, a countdown timer is rendered until the next request:</br>

```
First request --> Error
A timer is rendered for 3 seconds --> Second request --> Error
A timer is rendered for 6 seconds --> Third request --> Error
A timer is rendered for 9 seconds --> Fourth request --> Error

If an error is returned after the third additional request,
then a message about problems on the server is rendered.
```

### Popup

- In the likes popup you can: unlike or go to the product page
- In the cart popup you can: delete an item, change the quantity of an item, go to the product page or the checkout page

### Product Cart

- You can add a product to your cart, like it or unlike it

### Сheckout Page

- You can delete a product, change the quantity of a product, or go to the product page
- You can choose the Pickup or Delivery option. Delivery costs vary for each option and are included in the order.
- When selecting the Delivery option, the application determines the user's country and city using the Geolocation API. If the user confirms his location, then the value is inserted into the Delivery Region field in the order form
- The set of fields in the form depends on the delivery option. For the Pickup option, the Delivery region and Delivery address fields are missing
- The Full name and Phone form fields are required. Validation of these fields for a minimum number of characters has been implemented. Errors are highlighted

### Successful Checkout Page

- When the page loads, a countdown timer starts for a few seconds, then a redirect to the main page

### 404 page

- When navigating to a non-existent route, a 404 page with a countdown timer is rendered. After the specified time has elapsed, a redirect to the main page occurs.

##Stack

- Vue 3 Composition API
- Vue Router
- Pinia
- REST API (Symfony):
- Geolocation API: [BigDataCloud](https://www.bigdatacloud.com/docs/api/free-reverse-geocode-to-city-api)
- Adaptive layout

## PS

This Project was intended to showcase my Vue 3 Knowledge, Logics and Code Organization Skills to:

The live preview can be viewed on a sub domain of my website https://store.khrov.com/ 

If you found it interesting and would love to have a talk with me, maybe to ask for a Copy of the full Project Code or to request for my Service, then I look forward to receiving your email message daniel@khrov.com


## Notice
This project was designed over three years ago using Vue Framework. 

Visit [https://store.khrov.com/](https://bigstore.khrov.com/) to see my current eCommerce desing using the Martvill Framework.

