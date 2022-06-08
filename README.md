# Sparkle | e-commerce

The repository was my final assignment for the Web communications II class at [SAIT](https://www.sait.ca/programs-and-courses/diplomas/new-media-production-and-design) in the winter 2021 intake.

## Table of contents

- [Overview](#overview)
  - [The assignment](#the-assignment)
  - [Design](#design)
  - [Links](#links)
- [My process](#my-process)
  - [Built with](#built-with)
  - [What I learned](#what-i-learned)
  - [Continued development](#continued-development)
  - [Useful resources](#useful-resources)
- [Author](#author)
- [Acknowledgments](#acknowledgments)

## Overview

### The assignment

The HTML5 should fully validate, and the website should run without any PHP errors. CSS should be written in a linked style sheet. Use external PHP files linked using the include() function where appropriate. All code used should be unique, and created by the student handing in the assignment. The site should be dynamic and database driven.

The site should have:

- A homepage that displays the four newest or featured products (populated from the database).
- No page over 300K in size (images, code, and content all included; fonts, audio and video are not).
- The exception to this is the product listing page (showing all products), which may be up to 600K in total size (again, fonts, audio and video not included).
- The pages that you make should be responsive and follow rules of good design in viewports between 320 and 3200 px wide.
- Product listings pages (using the database to populate each page)
- Show all products
- The ability to sort products by price, or name (one at a time)
- The ability to filter products by category
- A product detail page that shows extended information for each product (from the database), and allows the user to add it to their cart
- The ability for a user to add products to a shopping cart, and view the items in their cart
- All product information should be dynamic and pulled from the database at the time of checkout (so if the product were to go on sale, for example, the newest price is always used)
- The user should be able to checkout with the items in their cart (only a single quantity of each item is required). At checkout, save the following information to a database table named orders in your existing eCommerce database:
- Customer name
- Email address
- Product(s) purchased (human-readable list of product name or IDs)
- Total cost

### Design

- Screenshot
  ![landing page screenshot](.design/screenshot/landingpage.png)
  ![product page screenshot](.design/screenshot/ProductPage.png)
- Design System
  ![components](.design/designSystem/designSystem_components.png)
- Wireframe
  ![desktop](.design/wireframe/sparkle_Desktop.pdf)
  ![mobile](<.design/wireframe/sparkle_Mobile(320px).pdf>)

### Links

- Live Demo: http://dev.saitnewmedia.ca/~tchen/mmda225/final/
- Process Book: http://dev.saitnewmedia.ca/~tchen/visual_communications/process_book/

## My process

For the detailed process book please see the section on [Links](#links).

- Making contents(taking photos/products information)
- Set up database/tables
- Thumbnailing wireframes
- Design high fidelity wireframe
- Write with semantic markup.
- Go through validators.
- Link with database and get products being display.
- Make ordering, sorting, wishlist, filter function working
- Set all CSS root figures and font.
- Write CSS for general tags.
- Write classes' and ids' style.
- Responsive design
- Get all CSS done, check on both desktop and mobile.

### Built with

- Semantic HTML5 markup
- CSS custom properties
- Flexbox
- CSS Grid
- PHP
- MySQL
- JavaScript

### What I learned

- Toggle navigation bar

```css
nav {
  position: absolute;
  left: -40rem;
  transition: all 300ms cubic-bezier(0.18, 0.05, 0.03, 0.95);
}
#toggle:checked ~ nav {
  left: 0;
}
```

- Sort products

```js
function sortProduct(sortTerm) {
  let arr = Array.prototype.slice.call(document.querySelectorAll(".card"), 0);
  if (sortTerm == "price_low") {
    arr.sort((x, y) => x.dataset.price - y.dataset.price);
  }
  if (sortTerm == "price_high") {
    arr.sort((x, y) => y.dataset.price - x.dataset.price);
  }
  if (sortTerm == "new") {
    arr.sort((x, y) => x.dataset.id - y.dataset.id);
  }
  arr.forEach((item) => {
    product_gallery.appendChild(item);
  });
}
```

- Get page name

```js
var path = window.location.pathname;
var page = path.split("/").pop();
```

- Cart and redirect

```php
if (isset($_GET['save'])) {
    $val = $_GET['save'];
    $product_name = str_replace('_', ' ', $val);
    if (isset($_COOKIE['cart'])) {
        $cart = explode(",", $_COOKIE['cart']);

        if (($key = array_search($product_name, $cart)) !== false) {
            if (isset($_COOKIE['wishlist'])) {
                // echo "is set";
                $wishlist = explode(",", $_COOKIE['wishlist']);
                array_push($wishlist, $cart[$key]);
                $str2 = implode(',', $wishlist);
                setcookie("wishlist", $str2, strtotime("+365 day"), '/');
            } else {
                // echo "is not set";
                $wishlist = [];
                array_push($wishlist, $cart[$key]);
                $str2 = implode(',', $wishlist);
                setcookie("wishlist", $str2, strtotime("+365 day"));
            }
            unset($cart[$key]);
            $str1 = implode(',', $cart);
            setcookie("cart", $str1, strtotime("+60 day"));
            header("Location: checkout.php");
        }
    }
}
```

### Continued development

- Products filter improvement
- image display improvement

### Useful resources

- [CSS Grid](https://css-tricks.com/snippets/css/complete-guide-grid/).
- [How to keep your footer where it belongs ?](https://www.freecodecamp.org/news/how-to-keep-your-footer-where-it-belongs-59c6aa05c59c/).
- [Checkbox Filter With Vanilla JavaScript](https://medium.com/swlh/building-a-checkbox-filter-with-vanilla-javascript-29153cf466bd)
- [PHP explode](https://www.php.net/manual/en/function.explode.php)

## Author

- Codepen - [TingHueiChen](https://codepen.io/TingHueiChen)
- Frontend Mentor - [@hejkeikei](https://www.frontendmentor.io/profile/hejkeikei)
- Twitter - [@hej_keikei](https://twitter.com/hej_keikei)

## Acknowledgments

- JavaScript code for sorting elements is reference from [Dudley Storey](https://thenewcode.com/)’s code in class.
- JavaScript cookie setting reference from [w3schools](w3schools.com)
