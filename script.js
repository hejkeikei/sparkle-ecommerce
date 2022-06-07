// Get page name
var path = window.location.pathname;
var page = path.split("/").pop();


// landing page accordion
var landbox = document.querySelectorAll("#accordion a");
    var getSiblings = function(elem) {

        var siblings = [];
        var sibling = elem.parentNode.firstChild;

        while (sibling) {
            if (sibling.nodeType === 1 && sibling !== elem) {
                siblings.push(sibling);
            }
            sibling = sibling.nextSibling
        }

        return siblings;

    };

    if (window.innerWidth > 767) {
        for (let i of landbox) {
            i.addEventListener("mouseover", function(e) {

                e.stopPropagation();

                if (i.classList.contains("open")) {
                    i.classList.add("open");
                    i.classList.remove("blur");
                } else {
                    i.classList.add("open");
                    i.classList.remove("blur");
                    let sib = getSiblings(i)
                    for (let j of sib) {
                        j.classList.remove("open");
                        j.classList.add("blur");
                    }
                }
            });
        }
    } 

    // Product Gallery Sort
    
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

      if(page == 'products.php'){
        document.getElementById('sort_box').style.display="block";
          let product_sort = document.getElementById('product_sort');
          product_sort.addEventListener("change", function () {
            sortProduct(product_sort.value);
          });
      }



    // Set Cookie 
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        let name = cname + "=";
        let ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    const wishlist = getCookie("wishlist");
    const product_name = document.querySelector("h2").innerHTML;
    document.querySelector("a[href='wishlist.php']").style.display="block";
    if(page == 'product.php'){
        // Click wishlist button{
        // if (this product is in wishlist array){
        // class="", remove item from wishlist array;
        // }Else if (product not in wishlist){
        // class="like", set cookie;}}
        // Not clever but IT WORKS!! YASSS!
        heart.style.display="inline-block"
        heart.addEventListener("click", function() {
            let inner = document.querySelector('svg path');
            let hearted = inner.getAttribute("class");
            if(wishlist!=""){
                var arr = wishlist.split(",");
                
            }else{
                var arr = [];
            }
            if (hearted == "like") {
                // remove item
                let index = arr.indexOf(product_name);
                if (index > -1) {
                    arr.splice(index, 1);
                }
                let newCookie = arr.toString();
                setCookie("wishlist", newCookie, 365);
                inner.classList.remove("like");
            } else {
                // add item
                arr.push(product_name);
                let newCookie = arr.toString();
                setCookie("wishlist", newCookie, 365);
                inner.classList.add("like");
            }
        });
        if(wishlist!=""){
            let wishlist_decode = decodeURIComponent(wishlist);
            let wishlist_arr = wishlist_decode.split(",");
            for (let item of wishlist_arr) {
                if (item == product_name) {
                    let inner = document.querySelector('svg path');
                    inner.classList.add("like");
                }
            }
        }
        // Color switch
        let silver = document.getElementById('silver');
        let gold = document.getElementById('gold');
        let product_img = document.querySelector(".img_box img");
        let material = product_img.dataset.material;
        if(silver){
            silver.addEventListener("click", function() {
                if(material ==="gold"){
                    product_img.style.filter = "grayscale(100%)";
                }
            });
        }
        if(gold){
            gold.addEventListener("click", function() {
                if(material ==="gold"){
                    product_img.style.filter = "grayscale(0)";
                }
            });
        }
    }
    

// automatically open side cart for user in product page
if(window.innerWidth > 800 && page == 'product.php'){
    document.getElementById("cart_btn").checked = true;
}else if(window.innerWidth > 600 && page == 'products.php'){
    document.getElementById("cart_btn").checked = true;
}
if(window.innerWidth <600){
    let toggle = document.getElementById('toggle');
    let cart_btn = document.getElementById("cart_btn")
    toggle.addEventListener("change",function(){
        if(toggle.checked){
            cart_btn.checked = false;
        }
    });
    cart_btn.addEventListener("change",function(){
        if(cart_btn.checked){
            toggle.checked = false;
        }
    });
}

// Material filter
function productFilter(material){
    let arr = Array.prototype.slice.call(
        document.querySelectorAll(".card"),
        0
      );
    
    arr.forEach((item) => {
        let mat =item.dataset.main;
        let sec = item.dataset.sec;
        if(mat===material || sec ===material){
            item.style.display="block";
        }else{
            item.style.display="none";
        }
    });
    if (window.innerWidth < 600){

        document.getElementById('toggle').checked=false;
    }

    
}
if(page == 'products.php'){
    document.getElementById('filter').style.display="block";
    let filter_item = document.querySelectorAll('.filter_item input');
    for(let i of filter_item){
        let str = i.id.split('_')[0];
        let checkbox = document.getElementById(i.id);
        checkbox.addEventListener("change",function(){
            if(i.checked){
                productFilter(str);
            }
        })
    }
}
