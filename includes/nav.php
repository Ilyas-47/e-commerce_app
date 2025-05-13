<!DOCTYPE html>
<html lang="en">
   <head>
      <title>E-commerce</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="format-detection" content="telephone=no">
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="author" content="">
      <meta name="keywords" content="">
      <meta name="description" content="">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="../assets/css/vendor.css">
      <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="../assets/css/navbar.css">
      <link rel="stylesheet" type="text/css" href="../assets/css/slide_scroll.css">
      <link rel="stylesheet" type="text/css" href="../assets/css/style2.css">
      <link rel="stylesheet" type="text/css" href="../assets/css/panier.css">
      <link rel="stylesheet" type="text/css" href="../assets/css/footer.css">
      <link rel="stylesheet" type="text/css" href="../assets/css/favoris.css">
      <link rel="stylesheet" type="text/css" href="../assets/css/profile.css">


      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
   </head>
   <body>
      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
         <defs>
            <symbol xmlns="http://www.w3.org/2000/svg" id="link" viewBox="0 0 24 24">
               <path fill="currentColor" d="M12 19a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0-4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm-5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm7-12h-1V2a1 1 0 0 0-2 0v1H8V2a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3Zm1 17a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-9h16Zm0-11H4V6a1 1 0 0 1 1-1h1v1a1 1 0 0 0 2 0V5h8v1a1 1 0 0 0 2 0V5h1a1 1 0 0 1 1 1ZM7 15a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0 4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Z"/>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="arrow-right" viewBox="0 0 24 24">
               <path fill="currentColor" d="M17.92 11.62a1 1 0 0 0-.21-.33l-5-5a1 1 0 0 0-1.42 1.42l3.3 3.29H7a1 1 0 0 0 0 2h7.59l-3.3 3.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l5-5a1 1 0 0 0 .21-.33a1 1 0 0 0 0-.76Z"/>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="category" viewBox="0 0 24 24">
               <path fill="currentColor" d="M19 5.5h-6.28l-.32-1a3 3 0 0 0-2.84-2H5a3 3 0 0 0-3 3v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-10a3 3 0 0 0-3-3Zm1 13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-13a1 1 0 0 1 1-1h4.56a1 1 0 0 1 .95.68l.54 1.64a1 1 0 0 0 .95.68h7a1 1 0 0 1 1 1Z"/>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="calendar" viewBox="0 0 24 24">
               <path fill="currentColor" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3Zm1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z"/>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="heart" viewBox="0 0 24 24">
               <path fill="currentColor" d="M20.16 4.61A6.27 6.27 0 0 0 12 4a6.27 6.27 0 0 0-8.16 9.48l7.45 7.45a1 1 0 0 0 1.42 0l7.45-7.45a6.27 6.27 0 0 0 0-8.87Zm-1.41 7.46L12 18.81l-6.75-6.74a4.28 4.28 0 0 1 3-7.3a4.25 4.25 0 0 1 3 1.25a1 1 0 0 0 1.42 0a4.27 4.27 0 0 1 6 6.05Z"/>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="plus" viewBox="0 0 24 24">
               <path fill="currentColor" d="M19 11h-6V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2Z"/>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="minus" viewBox="0 0 24 24">
               <path fill="currentColor" d="M19 11H5a1 1 0 0 0 0 2h14a1 1 0 0 0 0-2Z"/>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="cart" viewBox="0 0 24 24">
               <path fill="currentColor" d="M8.5 19a1.5 1.5 0 1 0 1.5 1.5A1.5 1.5 0 0 0 8.5 19ZM19 16H7a1 1 0 0 1 0-2h8.491a3.013 3.013 0 0 0 2.885-2.176l1.585-5.55A1 1 0 0 0 19 5H6.74a3.007 3.007 0 0 0-2.82-2H3a1 1 0 0 0 0 2h.921a1.005 1.005 0 0 1 .962.725l.155.545v.005l1.641 5.742A3 3 0 0 0 7 18h12a1 1 0 0 0 0-2Zm-1.326-9l-1.22 4.274a1.005 1.005 0 0 1-.963.726H8.754l-.255-.892L7.326 7ZM16.5 19a1.5 1.5 0 1 0 1.5 1.5a1.5 1.5 0 0 0-1.5-1.5Z"/>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="check" viewBox="0 0 24 24">
               <path fill="currentColor" d="M18.71 7.21a1 1 0 0 0-1.42 0l-7.45 7.46l-3.13-3.14A1 1 0 1 0 5.29 13l3.84 3.84a1 1 0 0 0 1.42 0l8.16-8.16a1 1 0 0 0 0-1.47Z"/>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="trash" viewBox="0 0 24 24">
               <path fill="currentColor" d="M10 18a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1ZM20 6h-4V5a3 3 0 0 0-3-3h-2a3 3 0 0 0-3 3v1H4a1 1 0 0 0 0 2h1v11a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8h1a1 1 0 0 0 0-2ZM10 5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1h-4Zm7 14a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8h10Zm-3-1a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1Z"/>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="star-outline" viewBox="0 0 15 15">
               <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M7.5 9.804L5.337 11l.413-2.533L4 6.674l2.418-.37L7.5 4l1.082 2.304l2.418.37l-1.75 1.793L9.663 11L7.5 9.804Z"/>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="star-solid" viewBox="0 0 15 15">
               <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z"/>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="search" viewBox="0 0 24 24">
               <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z"/>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="user" viewBox="0 0 24 24">
               <path fill="currentColor" d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19ZM12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4Z"/>
            </symbol>
            <symbol xmlns="http://www.w3.org/2000/svg" id="close" viewBox="0 0 15 15">
               <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z"/>
            </symbol>
         </defs>
      </svg>
      <!-- <div class="preloader-wrapper">
         <div class="preloader">
         </div>
         </div>  -->
      <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasSearch" aria-labelledby="Search">
         <div class="offcanvas-header justify-content-center">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
         </div>
         <div class="offcanvas-body">
            <div class="order-md-last">
               <h4 class="d-flex justify-content-between align-items-center mb-3">
                  <span class="text-primary">Search</span>
               </h4>
               <form role="search" action="index.html" method="get" class="d-flex mt-3 gap-0">
                  <input class="form-control rounded-start rounded-0 bg-light" type="email" placeholder="What are you looking for?" aria-label="What are you looking for?">
                  <button class="btn btn-dark rounded-end rounded-0" type="submit">Search</button>
               </form>
            </div>
         </div>
      </div>
      <header>
         <div class="container-fluid">
            <div class="row py-3 border-bottom">
               <!-- Logo -->
               <div class="col-sm-4 col-lg-3 text-center text-sm-start">
                  <div class="main-logo">
                     <a href="../user/accueil.php">
                     <img src="../assets/images/d-product.png" alt="logo" class="img-fluid">
                     </a>
                  </div>
               </div>
               <!-- Barre de recherche -->
               <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
                  <div class="search-bar row bg-light p-2 my-2 rounded-4">
                     <div class="col-12 relative" id="input">
                        <input
                           value=""
                           placeholder="Chercher un produit..."
                           class="block w-full text-sm h-[50px] px-4 text-slate-900 bg-white rounded-[8px] border border-slate-200 appearance-none focus:border-transparent focus:outline focus:outline-2 focus:outline-primary focus:ring-0 hover:border-brand-500-secondary- peer invalid:border-error-500 invalid:focus:border-error-500 overflow-ellipsis overflow-hidden text-nowrap pr-[48px]"
                           id="floating_outlined"
                           type="text"
                           />
                        <label
                           class="peer-placeholder-shown:-z-10 peer-focus:z-10 absolute text-[14px] leading-[150%] text-primary peer-focus:text-primary peer-invalid:text-error-500 focus:invalid:text-error-500 duration-300 transform -translate-y-[1.2rem] scale-75 top-2 z-10 origin-[0] bg-white data-[disabled]:bg-gray-50-background- px-2 peer-focus:px-2 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-[1.2rem] rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1"
                           for="floating_outlined"
                           >
                        Chercher...
                        </label>
                        <div class="absolute top-3 right-3">
                           <svg
                              xmlns="http://www.w3.org/2000/svg"
                              fill="slate-300"
                              viewBox="0 0 24 24"
                              height="24"
                              width="24"
                              >
                              <path
                                 d="M10.979 16.8991C11.0591 17.4633 10.6657 17.9926 10.0959 17.9994C8.52021 18.0183 6.96549 17.5712 5.63246 16.7026C4.00976 15.6452 2.82575 14.035 2.30018 12.1709C1.77461 10.3068 1.94315 8.31525 2.77453 6.56596C3.60592 4.81667 5.04368 3.42838 6.82101 2.65875C8.59833 1.88911 10.5945 1.79039 12.4391 2.3809C14.2837 2.97141 15.8514 4.21105 16.8514 5.86977C17.8513 7.52849 18.2155 9.49365 17.8764 11.4005C17.5979 12.967 16.8603 14.4068 15.7684 15.543C15.3736 15.9539 14.7184 15.8787 14.3617 15.4343C14.0051 14.9899 14.0846 14.3455 14.4606 13.9173C15.1719 13.1073 15.6538 12.1134 15.8448 11.0393C16.0964 9.62426 15.8261 8.166 15.0841 6.93513C14.3421 5.70426 13.1788 4.78438 11.81 4.34618C10.4412 3.90799 8.95988 3.98125 7.641 4.55236C6.32213 5.12348 5.25522 6.15367 4.63828 7.45174C4.02135 8.74982 3.89628 10.2276 4.28629 11.6109C4.67629 12.9942 5.55489 14.1891 6.75903 14.9737C7.67308 15.5693 8.72759 15.8979 9.80504 15.9333C10.3746 15.952 10.8989 16.3349 10.979 16.8991Z"
                                 ></path>
                              <rect
                                 transform="rotate(-49.6812 12.2469 14.8859)"
                                 rx="1"
                                 height="10.1881"
                                 width="2"
                                 y="14.8859"
                                 x="12.2469"
                                 ></rect>
                           </svg>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Icons + Cart -->
               <div class="col-sm-8 col-lg-4 d-flex align-items-center justify-content-center justify-content-sm-end gap-4 mt-4 mt-sm-0">
                  <!-- Icons -->
                  <ul class="d-flex list-unstyled m-0 align-items-center gap-3">
                     <li class="d-flex align-items-center gap-2">
                        <a href="#" class="rounded-circle bg-light p-2 d-flex align-items-center justify-content-center" data-bs-toggle="offcanvas" data-bs-target="#offcanvasUser" aria-controls="offcanvasUser">
                           <svg width="24" height="24" viewBox="0 0 24 24">
                              <use xlink:href="#user"></use>
                           </svg>
                        </a>
                     </li>
                     <li>
                        <a href="#" class="rounded-circle bg-light p-2 d-flex align-items-center justify-content-center" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFavoris" aria-controls="offcanvasFavoris">
                          <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#heart"></use></svg>
                        </a>
                        </li>
                     <li class="d-lg-none">
                        <a href="#" class="rounded-circle bg-light p-2 d-flex align-items-center justify-content-center" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                           <svg width="24" height="24" viewBox="0 0 24 24">
                              <use xlink:href="#cart"></use>
                           </svg>
                        </a>
                     </li>
                     <li class="d-lg-none">
                        <a href="#" class="rounded-circle bg-light p-2 d-flex align-items-center justify-content-center" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch">
                           <svg width="24" height="24" viewBox="0 0 24 24">
                              <use xlink:href="#search"></use>
                           </svg>
                        </a>
                     </li>
                  </ul>
                  <!-- Panier (Desktop only) -->
                  <div class="cart d-none d-lg-block dropdown">
                     <button class="border-0 bg-transparent d-flex flex-column gap-1 lh-1 align-items-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                     <span class="fs-6 text-muted" style="color:black;">Votre Panier</span>
                     <span class="cart-total fs-5 fw-bold" style="color:black;">00.00 MAD</span>
                     </button>
                  </div>
               </div>

<!-- Panier Widget (version bureau) -->
<!-- <div class="cart d-none d-lg-block dropdown">
  <button class="border-0 bg-transparent d-flex align-items-center gap-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
    <div class="cart-icon">
      <svg width="24" height="24" viewBox="0 0 24 24">
        <use xlink:href="#cart"></use>
      </svg>
      <span class="cart-count">3</span>
    </div>
    <div class="d-flex flex-column gap-1 lh-1 align-items-start">
      <span class="fs-6 text-muted">Votre Panier</span>
      <span class="cart-total fs-5 fw-bold">89.97</span>
    </div>
  </button>
</div> -->



<!-- Panier Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
  <div class="cart-header">
    <h4 id="offcanvasCartLabel">Votre Panier (3)</h4>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  
  <div class="cart-body">
    <ul class="cart-items">
      <!-- Item 1 -->
      <li class="cart-item">
        <div class="cart-item-image">
          <img src="../assets/images/office.png" alt="Produit 1">
        </div>
        <div class="cart-item-details">
          <div class="cart-item-top">
            <h5 class="cart-item-title">Microsoft Office 2024 Home PC</h5>
            <button class="cart-item-remove" aria-label="Retirer l'article">×</button>
          </div>
          <div class="cart-item-price">200 MAD</div>
          <div class="cart-item-bottom">
            <div class="quantity-selector">
              <button class="quantity-btn" data-action="decrease">−</button>
              <input type="number" class="quantity-input" value="1" min="1" max="10" aria-label="Quantité">
              <button class="quantity-btn" data-action="increase">+</button>
            </div>
            <div class="cart-item-subtotal">200 MAD</div>
          </div>
        </div>
      </li>
      
      <!-- Item 2 -->
      <li class="cart-item">
        <div class="cart-item-image">
          <img src="../assets/images/office.png" alt="Produit 2">
        </div>
        <div class="cart-item-details">
          <div class="cart-item-top">
            <h5 class="cart-item-title">Microsoft Office 2024 Home PC</h5>
            <button class="cart-item-remove" aria-label="Retirer l'article">×</button>
          </div>
          <div class="cart-item-price">200 MAD</div>
          <div class="cart-item-bottom">
            <div class="quantity-selector">
              <button class="quantity-btn" data-action="decrease">−</button>
              <input type="number" class="quantity-input" value="1" min="1" max="10" aria-label="Quantité">
              <button class="quantity-btn" data-action="increase">+</button>
            </div>
            <div class="cart-item-subtotal">200 MAD</div>
          </div>
        </div>
      </li>
      
      <!-- Item 3 -->
      <li class="cart-item">
        <div class="cart-item-image">
          <img src="../assets/images/office.png" alt="Produit 3">
        </div>
        <div class="cart-item-details">
          <div class="cart-item-top">
            <h5 class="cart-item-title">Microsoft Office 2024 Home PC</h5>
            <button class="cart-item-remove" aria-label="Retirer l'article">×</button>
          </div>
          <div class="cart-item-price">200 MAD</div>
          <div class="cart-item-bottom">
            <div class="quantity-selector">
              <button class="quantity-btn" data-action="decrease">−</button>
              <input type="number" class="quantity-input" value="1" min="1" max="10" aria-label="Quantité">
              <button class="quantity-btn" data-action="increase">+</button>
            </div>
            <div class="cart-item-subtotal">200 MAD</div>
          </div>
        </div>
      </li>
    </ul>
    
    <!-- Panier vide (état alternatif) -->
    <div class="empty-cart" style="display: none;">
      <div class="empty-cart-icon">
        <svg width="48" height="48" viewBox="0 0 24 24">
          <use xlink:href="#cart"></use>
        </svg>
      </div>
      <h5>Votre panier est vide</h5>
      <p class="empty-cart-message">Découvrez notre catalogue et ajoutez des produits à votre panier.</p>
      <a href="#" class="cart-shop-btn">Continuer mes achats</a>
    </div>
  </div>
  
  <div class="cart-footer">
    <div class="cart-summary">
      <div class="summary-row">
        <span>Sous-total</span>
        <span>200 MAD</span>
      </div>
      <!-- Code promo -->
      <div class="promo-code-container">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Code promo" aria-label="Code promo" id="promoCodeInput">
          <button class="btn btn-outline-secondary" type="button" id="applyPromoBtn">Appliquer</button>
        </div>
        <div class="promo-feedback text-success" style="display: none; font-size: 13px; margin-bottom: 10px;">
          Code promo appliqué : -50 MAD
        </div>
      </div>
      <div class="summary-row discount-row" style="display: none; color: #ff6b6b;">
        <span>Réduction</span>
        <span>-50 MAD</span>
      </div>
      <div class="summary-row total">
        <span>Total</span>
        <span>200 MAD</span>
      </div>
    </div>
    
    <button class="checkout-btn">Passer à la caisse</button>
    <a href="#" class="continue-shopping" data-bs-dismiss="offcanvas">Continuer mes achats</a>
  </div>
</div>

<!-- Toast notifications container -->
<div class="toast-container">
  <!-- Toast notification template -->
  <div class="toast" id="addToCartToast">
    <div class="toast-icon">
      <svg width="20" height="20" viewBox="0 0 24 24">
        <use xlink:href="#check"></use>
      </svg>
    </div>
    <div class="toast-content">
      <div class="toast-title">Article ajouté au panier</div>
      <div class="toast-message">Chemise en lin premium a été ajouté à votre panier.</div>
    </div>
    <button class="toast-close">&times;</button>
  </div>
</div>


<!-- Favoris Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFavoris" aria-labelledby="offcanvasFavorisLabel">
  <div class="favoris-header">
    <h4 id="offcanvasFavorisLabel">Vos Favoris (3)</h4>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  
  <div class="favoris-body">
    <ul class="favoris-items">
      <!-- Item 1 -->
      <li class="favoris-item">
        <div class="favoris-item-image">
          <img src="../assets/images/d-product.png" alt="Produit 1">
        </div>
        <div class="favoris-item-details">
          <div class="favoris-item-top">
            <h5 class="favoris-item-title">Microsoft Office 2024 Home PC</h5>
            <div class="favoris-item-actions">
              <button class="favoris-item-cart" aria-label="Ajouter au panier">
                <svg width="18" height="18" viewBox="0 0 24 24">
                  <use xlink:href="#cart"></use>
                </svg>
              </button>
              <button class="favoris-item-remove" aria-label="Retirer des favoris">
                <svg width="18" height="18" viewBox="0 0 24 24">
                  <use xlink:href="#trash"></use>
                </svg>
              </button>
            </div>
          </div>
          <div class="favoris-item-price">200 MAD</div>
          <div class="favoris-item-description">
            Microsoft Office 2024 Home PC
          </div>
        </div>
      </li>
      
      <!-- Item 2 -->
      <li class="favoris-item">
        <div class="favoris-item-image">
          <img src="../assets/images/d-product.png" alt="Produit 2">
        </div>
        <div class="favoris-item-details">
          <div class="favoris-item-top">
            <h5 class="favoris-item-title">Microsoft Office 2024 Home PC</h5>
            <div class="favoris-item-actions">
              <button class="favoris-item-cart" aria-label="Ajouter au panier">
                <svg width="18" height="18" viewBox="0 0 24 24">
                  <use xlink:href="#cart"></use>
                </svg>
              </button>
              <button class="favoris-item-remove" aria-label="Retirer des favoris">
                <svg width="18" height="18" viewBox="0 0 24 24">
                  <use xlink:href="#trash"></use>
                </svg>
              </button>
            </div>
          </div>
          <div class="favoris-item-price">200 MAD</div>
          <div class="favoris-item-description">
            Microsoft Office 2024 Home PC
          </div>
        </div>
      </li>
      
      <!-- Item 3 -->
      <li class="favoris-item">
        <div class="favoris-item-image">
          <img src="../assets/images/d-product.png" alt="Produit 3">
        </div>
        <div class="favoris-item-details">
          <div class="favoris-item-top">
            <h5 class="favoris-item-title">Microsoft Office 2024 Home PC</h5>
            <div class="favoris-item-actions">
              <button class="favoris-item-cart" aria-label="Ajouter au panier">
                <svg width="18" height="18" viewBox="0 0 24 24">
                  <use xlink:href="#cart"></use>
                </svg>
              </button>
              <button class="favoris-item-remove" aria-label="Retirer des favoris">
                <svg width="18" height="18" viewBox="0 0 24 24">
                  <use xlink:href="#trash"></use>
                </svg>
              </button>
            </div>
          </div>
          <div class="favoris-item-price">200 MAD</div>
          <div class="favoris-item-description">
            Microsoft Office 2024 Home PC
          </div>
        </div>
      </li>
    </ul>
    
    <!-- Favoris vides (état alternatif) -->
    <div class="empty-favoris" style="display: none;">
      <div class="empty-favoris-icon">
        <svg width="48" height="48" viewBox="0 0 24 24">
          <use xlink:href="#heart"></use>
        </svg>
      </div>
      <h5>Votre liste de favoris est vide</h5>
      <p class="empty-favoris-message">Explorez notre catalogue et ajoutez des produits à vos favoris.</p>
      <a href="#" class="favoris-shop-btn" data-bs-dismiss="offcanvas">Découvrir nos produits</a>
    </div>
  </div>
  
  <div class="favoris-footer">
    <button class="add-all-to-cart-btn">Tout ajouter au panier</button>
    <a href="#" class="continue-shopping" data-bs-dismiss="offcanvas">Continuer mes achats</a>
  </div>
</div>

<!-- User Profile Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasUser" aria-labelledby="offcanvasUserLabel">
  <div class="user-header">
    <h4 id="offcanvasUserLabel">Mon Profil</h4>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  
  <div class="user-body">
    <!-- Profile Info -->
    <div class="profile-info">
      <div class="profile-avatar">
        <img src="../assets/images/d-product.png" alt="Profile Avatar">
      </div>
      <div class="profile-details">
        <h5 class="profile-name">Ilias</h5>
        <p class="profile-email">Ilias@example.com</p>
      </div>
    </div>

    <!-- Menu Items -->
    <ul class="profile-menu">
      <li>
        <a href="../user/user_info.php">
          <svg width="20" height="20" viewBox="0 0 24 24">
            <use xlink:href="#user"></use>
          </svg>
          Mon Compte
        </a>
      </li>
      <li>
        <a href="../user/user_commande.php">
          <svg width="20" height="20" viewBox="0 0 24 24">
            <use xlink:href="#calendar"></use>
          </svg>
          Mes Commandes
        </a>
      </li>
      <li>
        <a href="../user/user_favoris.php" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFavoris" aria-controls="offcanvasFavoris">
          <svg width="20" height="20" viewBox="0 0 24 24">
            <use xlink:href="#heart"></use>
          </svg>
          Mes Favoris
        </a>
      </li>
      <li>
        <a href="../user/user_info.php">
          <svg width="20" height="20" viewBox="0 0 24 24">
            <use xlink:href="#category"></use>
          </svg>
          Paramètres
        </a>
      </li>
    </ul>
  </div>
  
  <div class="user-footer">
    <button class="logout-btn">
      Se déconnecter
    </button>
  </div>
</div>

      <!-- nav -->
<div class="input">
    <button class="value">
        Produit
        <div class="dropdown-menu">
            <a href="../user/product_page.php">Produit</a>
            <a href="../user/product_page.php">Produit</a>
        </div>
    </button>
    <button class="value">
        Produit
        <div class="dropdown-menu">
            <a href="../user/product_page.php">Produit</a>
            <a href="../user/product_page.php">Produit</a>
        </div>
    </button>
    <button class="value">
        Produit
        <div class="dropdown-menu">
            <a href="../user/product_page.php">Produit</a>
            <a href="../user/product_page.php">Produit</a>
        </div>
    </button>
    <button class="value">
        Produit
        <div class="dropdown-menu">
            <a href="../user/product_page.php">Produit</a>
            <a href="../user/product_page.php">Produit</a>
        </div>
    </button>
    <button class="value">
        Produit
        <div class="dropdown-menu">
            <a href="../user/product_page.php">Produit</a>
            <a href="../user/product_page.php">Produit</a>
        </div>
    </button>
    <button class="value">
        Produit
        <div class="dropdown-menu">
            <a href="../user/product_page.php">Produit</a>
            <a href="../user/product_page.php">Produit</a>
        </div>
    </button>
    <button class="value">
        Produit
        <div class="dropdown-menu">
            <a href="../user/product_page.php">Produit</a>
            <a href="../user/product_page.php">Produit</a>
        </div>
    </button>
    <button class="value">
        Produit
        <div class="dropdown-menu">
            <a href="../user/product_page.php">Produit</a>
            <a href="../user/product_page.php">Produit</a>
        </div>
    </button>
    <button class="value">
        Produit
        <div class="dropdown-menu">
            <a href="../user/product_page.php">Produit</a>
            <a href="../user/product_page.php">Produit</a>
        </div>
    </button>
</div>
</div>
</div>
</div>
</div>


<script src="../assets/js/panier2.js"></script>
<script src="../assets/js/favoris.js"></script>

</header>
</html>