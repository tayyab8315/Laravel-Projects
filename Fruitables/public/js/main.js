  // Set CSRF token in AJAX setup
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  (function($) {
      "use strict";

      // Spinner
      var spinner = function() {
          setTimeout(function() {
              if ($('#spinner').length > 0) {
                  $('#spinner').removeClass('show');
              }
          }, 1);
      };
      spinner(0);


      // Fixed Navbar
      $(window).scroll(function() {
          if ($(window).width() < 992) {
              if ($(this).scrollTop() > 55) {
                  $('.fixed-top').addClass('shadow');
              } else {
                  $('.fixed-top').removeClass('shadow');
              }
          } else {
              if ($(this).scrollTop() > 55) {
                  $('.fixed-top').addClass('shadow').css('top', -55);
              } else {
                  $('.fixed-top').removeClass('shadow').css('top', 0);
              }
          }
      });


      // Back to top button
      $(window).scroll(function() {
          if ($(this).scrollTop() > 300) {
              $('.back-to-top').fadeIn('slow');
          } else {
              $('.back-to-top').fadeOut('slow');
          }
      });
      $('.back-to-top').click(function() {
          $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
          return false;
      });


      // Testimonial carousel
      $(".testimonial-carousel").owlCarousel({
          autoplay: true,
          smartSpeed: 2000,
          center: false,
          dots: true,
          loop: true,
          margin: 25,
          nav: true,
          navText: [
              '<i class="bi bi-arrow-left"></i>',
              '<i class="bi bi-arrow-right"></i>'
          ],
          responsiveClass: true,
          responsive: {
              0: {
                  items: 1
              },
              576: {
                  items: 1
              },
              768: {
                  items: 1
              },
              992: {
                  items: 2
              },
              1200: {
                  items: 2
              }
          }
      });


      // vegetable carousel
      $(".vegetable-carousel").owlCarousel({
          autoplay: true,
          smartSpeed: 1500,
          center: false,
          dots: true,
          loop: true,
          margin: 25,
          nav: true,
          navText: [
              '<i class="bi bi-arrow-left"></i>',
              '<i class="bi bi-arrow-right"></i>'
          ],
          responsiveClass: true,
          responsive: {
              0: {
                  items: 1
              },
              576: {
                  items: 1
              },
              768: {
                  items: 2
              },
              992: {
                  items: 3
              },
              1200: {
                  items: 4
              }
          }
      });


      // Modal Video
      $(document).ready(function() {
          var $videoSrc;
          $('.btn-play').click(function() {
              $videoSrc = $(this).data("src");
          });
        //   console.log($videoSrc);

          $('#videoModal').on('shown.bs.modal', function(e) {
              $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
          })

          $('#videoModal').on('hide.bs.modal', function(e) {
              $("#video").attr('src', $videoSrc);
          })
      });



      $('.quantity button').on('click', function() {
          var button = $(this);
          var oldValue = button.parent().parent().find('input').val();
          if (button.hasClass('btn-plus')) {
              var newVal = parseFloat(oldValue) + 1;
          } else {
              if (oldValue > 0) {
                  var newVal = parseFloat(oldValue) - 1;
              } else {
                  newVal = 0;
              }
          }
          button.parent().parent().find('input').val(newVal);
      });


  })(jQuery);

  document.addEventListener('DOMContentLoaded', () => {
      // Select all increase buttons
      var increaseButtons = document.querySelectorAll('.increase');

      increaseButtons.forEach(button => {
          button.addEventListener('click', () => {
              // Find the closest product container
              var productContainer = button.closest('.product');

              if (productContainer) {
                  // Get the quantity input within this container
                  var quantityInput = productContainer.querySelector('.quantity');
                  var priceElement = productContainer.querySelector('.price');
                  var totalPriceElement = productContainer.querySelector('.total_price');
                  var productId = quantityInput.getAttribute('product'); // Correct attribute name
                  // Parse values
                  var quantity = parseInt(quantityInput.value, 10);
                  var price = parseFloat(priceElement.innerText);

                  // Increase the quantity and update the input
                  quantity += 1;
                  quantityInput.value = quantity;

                  // Calculate the new total price
                  var totalPrice = quantity * price;
                  totalPriceElement.innerText = totalPrice.toFixed(2);

                  // Send AJAX request to update session in Laravel
                  $.ajax({
                      url: updateCartUrl,
                      method: 'POST',
                      data: {
                          quantity: quantity,
                          productId: productId, // Corrected variable name to match backend expectation
                      },
                      success: function(response) {
                          //   alert('Product updated in cart successfully!' + response.quantity + response.product);
                          //   Optionally update cart UI or show success message
                      },
                      error: function(xhr, status, error) {
                          console.error(error);
                          alert('Something went wrong. Please try again.');
                      }
                  });
                  $.ajax({
                      url: Showpro,
                      method: 'POST',
                      success: function(response) {
                          //   alert(response.totalAmount);
                          document.getElementById('flat_rate').innerText = response.totalAmount + " $";
                          var deliveryamount = response.totalAmount + 3;
                          document.getElementById('order_amount').innerText = deliveryamount + " $";
                          //   document.getElementById('totalcartimes').innerText = response.totalitems;
                          // Optionally update cart UI or show success message
                      },
                      error: function(xhr, status, error) {
                          //   console.error(error);
                          alert('Something went wrong. Please try again.');
                      }
                  });
              }
          });
      });
  });

  document.addEventListener('DOMContentLoaded', () => {


      // Select all decrease buttons
      var decreaseButtons = document.querySelectorAll('.decrease');

      decreaseButtons.forEach(button => {
          button.addEventListener('click', () => {
              // Find the closest product container
              var productContainer = button.closest('.product');

              if (productContainer) {
                  // Get the quantity input within this container
                  var quantityInput = productContainer.querySelector('.quantity');
                  var priceElement = productContainer.querySelector('.price');
                  var totalPriceElement = productContainer.querySelector('.total_price');
                  var productId = quantityInput.getAttribute('product'); // Correct attribute name
                  // console.log(productId);
                  // Parse values
                  var quantity = parseInt(quantityInput.value, 10);
                  var price = parseFloat(priceElement.innerText);
                  if (quantity < 2) {
                      alert('Invalid Quantity');

                  } else {
                      quantity -= 1;
                      quantityInput.value = quantity;

                      // Calculate the new total price
                      var totalPrice = quantity * price;
                      totalPriceElement.innerText = totalPrice.toFixed(2);

                      // Send AJAX request to update session in Laravel
                      $.ajax({
                          url: updateCartUrl,
                          method: 'POST',
                          data: {
                              quantity: quantity,
                              productId: productId, // Corrected variable name to match backend expectation
                          },
                          success: function(response) {
                              //   alert(response.message);
                              // Optionally update cart UI or show success message
                          },
                          error: function(xhr, status, error) {
                              //   console.error(error);
                              alert('Something went wrong. Please try again.');
                          }
                      });
                      $.ajax({
                          url: Showpro,
                          method: 'POST',
                          success: function(response) {
                              //   alert(response.totalAmount);
                              document.getElementById('flat_rate').innerText = response.totalAmount + " $";
                              var deliveryamount = response.totalAmount + 3;

                              document.getElementById('order_amount').innerText = deliveryamount + " $";

                              //   document.getElementById('totalcartimes').innerText = response.totalitems;
                              // Optionally update cart UI or show success message
                          },
                          error: function(xhr, status, error) {
                              //   console.error(error);
                              alert('Something went wrong. Please try again.');
                          }
                      });
                  }

                  // Decrease the quantity and update the input

              }
          });
      });
  });

  // File: public/js/rating.js

  document.addEventListener('DOMContentLoaded', function() {
      var rating = 0;
      var stars = document.querySelectorAll('.star-rating .fa-star');
      var ratingInput = document.getElementById('rating');
      var commentForm = document.getElementById('commentForm');

      // Handle star click
      stars.forEach(function(star) {
          star.addEventListener('click', function() {
              rating = this.getAttribute('data-rating');
              ratingInput.value = rating;

              // Remove text-warning class from all stars
              stars.forEach(function(star) {
                  star.classList.remove('text-warning');
              });

              // Add text-warning class to selected star and previous stars
              for (var i = 1; i <= rating; i++) {
                  document.querySelector('.star-rating .fa-star[data-rating="' + i + '"]').classList.add('text-warning');
              }
          });
      });

      // Handle form submission
      commentForm.addEventListener('submit', function(e) {
          if (rating === 0) {
              e.preventDefault();
              alert('Please select a rating.');
          }
      });
  });


  //   check box on checkout
  document.addEventListener('DOMContentLoaded', function() {
      const deliveryCheckbox = document.getElementById('delivery_1');
      const paypalCheckbox = document.getElementById('paypal_1');

      function toggleCheckboxes(selectedCheckbox, otherCheckbox) {
          selectedCheckbox.addEventListener('change', function() {
              if (this.checked) {
                  otherCheckbox.checked = false;
              }
          });
      }

      toggleCheckboxes(deliveryCheckbox, paypalCheckbox);
      toggleCheckboxes(paypalCheckbox, deliveryCheckbox);


  });

  //   Resend Mail

  document.addEventListener('DOMContentLoaded', (event) => {
      var resendbtn = document.querySelector('#resendMail');
      if (resendbtn) { // Check if the element exists
          resendbtn.addEventListener('click', () => {
              location.reload();
          });
      }
  });


  //   Resend Mail remaining time
  document.addEventListener('DOMContentLoaded', (event) => {
      var resendbtn = document.querySelector('#resendMail');
      var countdownElement = document.querySelector('#countdown');
      var timeLeft = 120; // Time left in seconds (2 minutes)

      // Function to format the time as MM:SS
      function formatTime(seconds) {
          const minutes = Math.floor(seconds / 60);
          const secs = seconds % 60;
          return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
      }

      // Update the countdown every second
      var countdownInterval = setInterval(() => {
          if (timeLeft > 0) {
              timeLeft--;
              countdownElement.textContent = `if You Not Yet Recieved Any Mail You can Resend Mail After:  ${formatTime(timeLeft)}`;
          } else {
              clearInterval(countdownInterval);
              countdownElement.textContent = ''; // Clear the countdown text
              resendbtn.style.display = 'block'; // Show the button
          }
      }, 1000); // Update every second

      // Add event listener to the button to reload the page
      if (resendbtn) {
          resendbtn.addEventListener('click', () => {
              location.reload();
          });
      }
  });





  document.addEventListener('DOMContentLoaded', () => {
    let pagenumber=1;
    href='all';
    console.log(href);
    SendAjaxOn('/pordcat','POST',href,pagenumber);
      // Select all tab buttons      
      var tabbtns = document.querySelectorAll('.tabbtns');
      tabbtns.forEach(button => {
          button.addEventListener('click', (event) => {
            document.querySelector('#products_items').innerHTML = '';
              event.preventDefault(); // Prevent the default action if it's a link
              var href = button.getAttribute('href').substring(5);
              console.log(href);
              
              SendAjaxOn('/pordcat','POST',href,pagenumber);
          });
      });
 
    const rangeInput = document.getElementById('rangeInput');
    const amount = document.getElementById('amount');
    
    rangeInput.addEventListener('input', function() {
        console.clear();
        var inputvalue = rangeInput.value;
        amount.value = inputvalue;
        let pagenumber=1;
        SendAjaxOn('/Shop/range','POST',inputvalue,pagenumber);
      
    });

    const ShopSearch = document.getElementById('ShopSearch'); 
    ShopSearch.addEventListener('input', function() {
       console.log(ShopSearch.value);
     var search=ShopSearch.value;
     let pagenumber=1;
       SendAjaxOn('/Shop/search','POST',search,pagenumber);
    });


let radiobuttons = document.querySelectorAll('.Additional');
radiobuttons.forEach(radio=>{
    radio.addEventListener('change',()=>{
// console.log();
let pagenumber=1;
var radioval=radio.value;
SendAjaxOn('/Shop/additional','POST',radioval,pagenumber);
    });
})

let fruits = document.querySelector('#fruits');

    fruits.addEventListener('change',()=>{

var radioval=fruits.value;
console.log(radioval);
let pagenumber=1;
SendAjaxOn('/Shop/additional','POST',radioval,pagenumber);
    });


});

function SendAjaxOn(url,method,...data) {
    console.log(data);
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ data: data })
    })
    .then(response => response.json())
    .then(data => {
        let recieveddata = data.data;
        console.clear();
        console.log(recieveddata);
        let operation = data.operation;  // Extract the operation value
        let query = data.query;
        let current_page = data.current_page;
        let totalt_pages=data.totalt_pages;
        let task=data.task;
Pagination(query,current_page,totalt_pages,operation,task);
        // console.clear();
        console.log('Total Number Of Pages '+totalt_pages);
        // console.log(operation);
        console.log(recieveddata); 
         if(operation=='range' || operation=='topbarsearch'){
            RangeRecieved(recieveddata,operation);  
         }else if(operation=='tabs'){
            TabsRecieved(recieveddata);
         }else if(operation=='cart'){
          var crtitms = recieveddata;

            alert(data.message)
            let cartdisplay = document.querySelector('#totalcartitems');
            console.log("Before Update: ", cartdisplay.innerText);
            
            // Force re-render by temporarily clearing the content
            cartdisplay.innerText = '';
            
            // Now, update with the new value
            cartdisplay.innerText = crtitms;
            
            console.log("After Update: ", cartdisplay.innerText);
         }else if(operation=='wishlist'){
            alert(data.message)
         }
    })
    .catch(error => {
        console.error('Error:', error);
        // alert(error);
        console.log(error);
    });
}

function RangeRecieved(data,operation){

    let topbarsearchbody = document.querySelector('#topbarsearchbody');

    
    let rangeProductHtml = '';

    // console.log(rangedat.length);
    if (data.length === 0) {
        rangeProductHtml = `<h4 class="text-center">No Product Found</h4>`;
    } else {
        data.forEach(product => {
            let discount = '';
if(product.discount > 1){

    discount =  `<span class="fs-5 fw-bold mb-0 text-decoration-line-through text-danger">$${ (parseFloat(product.discount) / 100 * parseFloat(product.price)) + parseFloat(product.price)
    }/ kg</span> `
} else {
    discount = ''; 
}
            rangeProductHtml += `
                <div class="col-md-6 col-lg-6 col-xl-4 mb-4">
                    <div class="rounded position-relative fruite-item">
                        <div class="fruite-img">
                            <img src="/storage/${product.image}" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">${product.category.category_name}</div>
                        <a href="/Shop/${product.id}/edit" class="text-dark">
                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                            <h4>${product.name}</h4>
                            <p>${product.description.split(' ').slice(0, 20).join(' ')}...</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <span  class="text-dark w-100 fs-5 fw-bold mb-2 me-3">${product.price} / kg</span >
                                ${discount}
                                    <div>
                                     <a class="btn border border-secondary rounded-pill px-3 text-primary mb-2" id="addtocart"  prodid="${product.id}"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                               
                                     <a class="btn border border-secondary rounded-pill px-3 text-primary" id="addtowish"  prodid="${product.id}"><i class="fa fa-heart me-2 text-primary"></i> Add to wishlist</a></div >

                                    </div>
                                 </div>
                                       </a>
                                   </div>
                     </div>
                </div>`;
        });
    }
if(operation === 'topbarsearch'){
    topbarsearchbody.innerHTML = rangeProductHtml;
}else if(operation === 'range'){
    let shoprow = document.querySelector('#shoprow');
    shoprow.innerHTML = rangeProductHtml;
}


    let cartbtn = document.querySelectorAll('#addtocart');
    cartbtn.forEach(function(event){
        event.addEventListener('click',function(){
            console.clear();
           
            let prodctid =  event.getAttribute('prodid');
            let quantity =1;
            let gone =[prodctid,quantity];
    cartAjax('/Cart/store','POST',gone);

        });
    });
    let cartbt2 = document.querySelectorAll('#addtowish');
    cartbt2.forEach(function(event){
        event.addEventListener('click',function(){
            console.clear();
           
            let prodctid =  event.getAttribute('prodid');
          
            cartAjax(`/Cart/${prodctid}/wishlist`,'POST',prodctid);

        });
    });
}



function TabsRecieved(products){
    var content = '';
    if (products.length === 0 ) {
      content=`<h4 class="text-center">No Products Found For This Category.</h4>`;
    }else{
    products.forEach(product => {
    // Correct JavaScript template literal syntax
const imagePath = `/images/Product/Images/Product/${product.image}`;
// 'storage/'.$product->image)

let text =product.description;
// Split the text into an array of words
let wordsArray = text.split(' ');

// Get the first 45 words
let first45Words = wordsArray.slice(0, 17).join(' ')+"....";
let discount = '';
if(product.discount > 1){

    discount =  `<span class="fs-5 fw-bold mb-0 text-decoration-line-through text-danger">$${ (parseFloat(product.discount) / 100 * parseFloat(product.price)) + parseFloat(product.price)
    }/ kg</span> `
} else {
    discount = ''; 
}

      document.querySelector('#products_items').innerHTML = content += `<div class="col-md-6 col-lg-4 col-xl-3">
                          <div class="rounded position-relative fruite-item">
                              <div class="fruite-img">
                                  <img src="storage/${product.image}" class="img-fluid w-100 rounded-top" alt="">
                              </div>
                              <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">${product.category.category_name}</div>
                            <a href="/Shop/${product.id}/edit" class="text-dark">
                              <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                  <h4 class="text-start">${product.name}</h4>
                                  <p class="text-start">${first45Words}</p>
                                  <div class="d-flex justify-content-between flex-lg-wrap">
                                      <span class="text-dark fs-5 fw-bold me-3">$${product.price} / kg</span>
                                        ${discount}
                                        <a class="btn  border border-secondary rounded-pill px-3  text-primary CartBtn mb-1 mt-1" id="addtocart" prodid="${product.id}"><i class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                         <a  class="btn  border border-secondary rounded-pill px-3  text-primary " id="wishBtn2" prodid="${product.id}"><i class="fa fa-heart me-2 text-primary"></i> Add to Wishlist</a>
                                  </div>
                              </div>
                              </a>
                          </div>
                      </div>
        `;
    });

    let cartbtn = document.querySelectorAll('#addtocart');
    cartbtn.forEach(function(event){
        event.addEventListener('click',function(){
            console.clear();
           
            let prodctid =  event.getAttribute('prodid');
            let quantity =1;
            let gone =[prodctid,quantity];
    cartAjax('/Cart/store','POST',gone);

        });
    });
    let cartbt2 = document.querySelectorAll('#wishBtn2');
    cartbt2.forEach(function(event){
        event.addEventListener('click',function(){
            console.clear();
           
            let prodctid =  event.getAttribute('prodid');
          
            cartAjax(`/Cart/${prodctid}/wishlist`,'POST',prodctid);

        });
    });
  }
 
}

function Pagination(category_id,current_page,totalt_pages,operation,task){
    let  looppages='';

    let shoppaginate = document.querySelector('.dynamic');


    
    // console.log(indss.classList);
    let currentPageNumber = parseInt(current_page, 10);
    for(let i=1; i<=totalt_pages;i++ ){
       looppages+=`<a class="rounded cursor-pointer ${i === currentPageNumber ? 'active' : ''}" id="indexpages" data-current="${i}" data-category="${category_id}" >${i}</a>`;
    }
    let cdlass='';
    let gggg2='';
   if(current_page===1){
           cdlass='d-none';
    }else{
       cdlass=' ';
    }
   
    if(current_page===totalt_pages){
       gggg2='d-none';
   }else{
       gggg2=' ';
   }
    let pagesdaata=`
     <div class="pagination d-flex justify-content-end  mt-3" >
                                    <a  class="rounded ${cdlass} cursor-pointer" data-current="first" data-category="${category_id}" id="indexpages">&laquo;</a>
                               ${looppages}
                   <a  class="rounded  ${gggg2} cursor-pointer" data-current="last" data-category="${category_id}" id="indexpages">&raquo;</a>
                                    </div>`;
                             

                   if(operation==='tabs'){
                    let indss = document.querySelector('.dynamicpages');
                    if(totalt_pages===1){
                        indss.innerHTML='';
                    }else{
                        indss.innerHTML=pagesdaata;
                    }
                   }else if(operation==='range'){
                    if(totalt_pages===1){
                        shoppaginate.innerHTML='';
                    }else{
                        shoppaginate.innerHTML=pagesdaata;
                    }
                   } if(operation==='topbarsearch'){
                    let topbarsearchpaginate = document.querySelector('#topbarsearchpaginate');
                    if(totalt_pages===1){
                        topbarsearchpaginate.innerHTML='';
                    }else{
                        topbarsearchpaginate.innerHTML=pagesdaata;
                    }
                   }
                   
                  
   
   
   let indexpages = document.querySelectorAll('#indexpages');
   indexpages.forEach((e) => {
       e.addEventListener('click', () => {
           let pagenumbersss = '';
           let currentPageNumber = parseInt(current_page, 10);
   
           if (e.dataset.current === 'first') {
               pagenumbersss = currentPageNumber - 1;
           } else if (e.dataset.current === 'last') {
               pagenumbersss = currentPageNumber + 1;
           } else {
               pagenumbersss = parseInt(e.dataset.current, 10);
           }
           if(task==='tabs'){
            SendAjaxOn('/pordcat', 'POST', e.dataset.category, pagenumbersss);
           }else if(task==='range'){
            SendAjaxOn('/Shop/range','POST',e.dataset.category,pagenumbersss);
           }if(task==='additional'){
            SendAjaxOn('/Shop/additional','POST',e.dataset.category,pagenumbersss);
           }if(task==='search'){
            SendAjaxOn('/Shop/search','POST',e.dataset.category,pagenumbersss);
           }if(task==='topbarsearch'){
            SendAjaxOn('/Shop/topbarsearch','POST',e.dataset.category,pagenumbersss);
           }
           
           indexpages.forEach((el) => el.classList.remove('active'));
           e.classList.add('active');
       });
   });
}

document.addEventListener('DOMContentLoaded', function () {
    const alertBox = document.querySelector('.alert');

    if (alertBox) {
        setTimeout(function () {
            alertBox.style.display = 'none';
        }, 3000);
    }
});


// Add To Cart 
document.addEventListener('DOMContentLoaded', function () {
    const CartBtn = document.querySelectorAll('.CartBtn');
    CartBtn.forEach(e=>{
        e.addEventListener('click',()=>{
let prodid=  e.getAttribute('prodid');
let quantity = 1;
var gone =[prodid,quantity]

cartAjax('/Cart/store','POST',gone);

        });
    })
});


// Add To Cart 
document.addEventListener('DOMContentLoaded', function () {
    const CartBtn2 = document.querySelectorAll('.CartBtn');

    const CartBtn = document.querySelector('#add-to-cart-btn');
    CartBtn.addEventListener('click',()=>{
        let prodid=  CartBtn.getAttribute('prodid');
        let quantity = document.querySelector('#quantity-input').value; 
        var gone =[prodid,quantity]
        cartAjax('/Cart/store','POST',gone);
    });
    CartBtn2.forEach(e=>{
        e.addEventListener('click',()=>{
let prodid=  e.getAttribute('prodid');
let quantity = 1;
addtocart(quantity,prodid)
        });
    })






});

document.addEventListener('DOMContentLoaded', function () {
    let removecart = document.querySelectorAll('#removecart');
    removecart.forEach(e=>{
        e.addEventListener('click',()=>{
       
let productid=e.dataset.prodid;
cartAjax(`/Cart/${productid}/destroy`,'POST',productid);
let cartRow = e.closest('#cartrow'); 
if (cartRow) {
    cartRow.style.display = 'none';
}
        });
    });


 

});
document.addEventListener('DOMContentLoaded',()=>{
    const wishBtn = document.querySelectorAll('#wishBtn');
  wishBtn.forEach(e=>{
 e.addEventListener('click',()=>{
let data=e.getAttribute('prodid');

cartAjax(`/Cart/${data}/wishlist`,'POST',data);
})
})
})


document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('#addtocart').forEach(function(button) {
        button.addEventListener('click', function() {
            const row = this.closest('tr');
            const quantityInput = row.querySelector('.quantity');
            const quantityValue = quantityInput.value;
           const prodctid = quantityInput.getAttribute('product');
           addtocart(quantityValue,prodctid)

           function addtocart(quan,prodctid){
            var data =[prodctid,quan]
            cartAjax('/Cart','POST',data);
        }
        });
    });


    document.querySelectorAll('#removewish').forEach(function(removewishlist) {
        removewishlist.addEventListener('click', function() {
          let productid =  removewishlist.dataset.prodid;
          let data =productid;
          cartAjax(`/Cart/${productid}/removewishlist`,'POST',data);
          const row = this.closest('tr');
          row.style.display='none';
        });
    });

    cartAjax('/Cart/count','POST','cart');
    cartAjax('/wish/count','POST','wish');

});




function cartAjax(url,method,bring) {
console.log(bring);
    fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ send: bring })
        
    })
    .then(response => response.json())
    .then(data => {
        let recieveddata = data.comingdata;

        console.log(recieveddata);
        if( data.operation==='cart' ){
            let cartdisplay = document.querySelector('#totalcartitems');
            cartdisplay.innerText=recieveddata;
            if( data.message != 'no'){
                alert(data.message);
                    }
        }else if(data.operation==='wishlist'){
            let wishdisplay = document.querySelector('#totalwishitems');
            wishdisplay.innerText=recieveddata;
            if( data.message != 'no'){
                alert(data.message);
                    }
        }else if(data.operation==='subscription'){
            alert(data.message);
        }else if(data.operation==='order'){
            order_got(recieveddata)
        }

    })
    .catch(error => {
    
        console.log(error);
    });
}

let topbarsearch = document.querySelector('#topbarsearch');
topbarsearch.addEventListener('input',function(){
    console.clear();
    let search=topbarsearch.value;  
    let pagenumber=1;
    SendAjaxOn('/Shop/topbarsearch','POST',search,pagenumber);
});

document.addEventListener('DOMContentLoaded',()=>{
   let subscribemail  = document.querySelector('#subscribemail')
   let subscribebtn  = document.querySelector('#subscribebtn')
   subscribebtn.addEventListener('click',function(){
    cartAjax('/user/subscription','POST',subscribemail.value);
//   alert()
   })


   let OrderSearch  = document.querySelector('#OrderSearch')

   OrderSearch.addEventListener('input',function(){
cartAjax(`/Order/search_order`,'POST',OrderSearch.value);

   })



})
function order_got(orders){
    console.log(orders)
    let orderhtml =''
    let order_table = document.querySelector('#order-tbl')
    orders.map((order)=>{
        let payment_method = '';
        let verify = '';
    
        if (order.payment_method == 'paypal'){
            payment_method = 'Paypal'
        }else{
            payment_method = 'Cash On Delivery'
        }
           
        if(order.order_confirmed_at === null){
    verify = ' Not Confirmed'
        }else{
    verify = 'Confirmed'
    
        }
        let dateStr = order.created_at;
    
    // Create a new Date object
    let date = new Date(dateStr);
    
    // Format the date
    let formattedDate = date.getFullYear() + '-' +
        String(date.getMonth() + 1).padStart(2, '0') + '-' +
        String(date.getDate()).padStart(2, '0') + ' ' +
        String(date.getHours()).padStart(2, '0') + ':' +
        String(date.getMinutes()).padStart(2, '0') + ':' +
        String(date.getSeconds()).padStart(2, '0');
          
    orderhtml +=`<tr class="product text-center">
                            <th scope="row">
                                <p class="mb-0 mt-4">
                                    ${order.order_number }
                                </p>
                            </th>
                            <td>
                                <p class="mb-0 mt-4">
                                 ${verify}
                                </p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4 price">
                                    ${order.order_status }
                                </p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4 price">
                                  ${payment_method}
                                </p>
                            </td>
                            <td>
                                <p class="mb-0 mt-4 price">
                                    ${formattedDate}
                                </p>
                            </td>
                            <td>
                                <button class="btn fs-1 text-primary px-2 py-0 rounded-circle bg-light" data-bs-toggle="modal" data-bs-target="#staticBackdropDelivery${order.order_number}">
                                    &#128065;
                                </button>
                            </td>
                            <td>
                                <button class="btn fs-1 text-primary px-2 py-0 rounded-circle bg-light" data-bs-toggle="modal" data-bs-target="#staticBackdropOrder${order.order_number}">
                                    &#128065;
                                </button>
                            </td>
                            <td>
                                <button class="btn fs-1 text-primary px-2 py-0 rounded-circle bg-light" data-bs-toggle="modal" data-bs-target="#staticBackdropPayment${order.order_number}">
                                    &#128065;
                                </button>
                            </td>
                        </tr>`;
    });

  

           
                    order_table.innerHTML = orderhtml
   }