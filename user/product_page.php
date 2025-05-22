<!DOCTYPE html>
<html lang="en">
<body>
    <?php include_once '../includes/nav.php'; ?>
    <link rel="stylesheet" href="../assets/css/product_page.css">
    
    <main class="container">
        <div class="product-container animate-fade">
            <div class="product-image">
                <img src="../assets/images/office.png" alt="Produit Digital">
            </div>
            <div class="product-info">
                <h1 class="product-title">Lorem Ipsum Dolor Sit Amet</h1>
                <div class="product-price">0.00 Prix</div>
                <div class="product-rating">
                    <span class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </span>
                    <span class="review-count">(00 Lorem)</span>
                </div>
                <p class="product-description">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
                <div class="product-features">
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Lorem ipsum dolor</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Consectetur adipiscing</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Sed do eiusmod</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Tempor incididunt</span>
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i>
                        <span>Ut labore et dolore</span>
                    </div>
                </div>
                <div class="product-actions">
                    <button class="cta-button">
                        <i class="fas fa-shopping-cart"></i> Ajouter au panier
                    </button>
                </div>
            </div>
        </div>
        
         <!-- review client -->
<h2 class="title4"><strong>Découvrez <span class="highlight">les Avis </span>de Nos Clients</strong></h2>
<main class="container_review">
  <div class="marquee pause-on-hover" style="--total: 6;">
    <review-card name="Sophie" username="@Sophie" avatar="https://avatar.vercel.sh/jhon" content="Absolument incroyable. Je ne peux plus imaginer ma vie sans cela." style="--index: 1;"></review-card>
    <review-card name="Marc" username="@Marc" avatar="https://avatar.vercel.sh/jane" content="Vraiment impressionnant ! C’est un véritable changement de jeu." style="--index: 2;"></review-card>
    <review-card name="Élise" username="@Élise" avatar="https://avatar.vercel.sh/jack" content="Je n’aurais pas pu être plus heureuse. C’est fantastique." style="--index: 3;"></review-card>
    <review-card name="Julien" username="@Julien" avatar="https://avatar.vercel.sh/jill" content="Vraiment exceptionnel. Cela a dépassé toutes mes attentes." style="--index: 4;"></review-card>
    <review-card name="Claire" username="@Claire" avatar="https://avatar.vercel.sh/jenny" content="C’est exactement ce que je recherchais." style="--index: 5;"></review-card>
    <review-card name="Pierre" username="@Pierre" avatar="https://avatar.vercel.sh/james" content="Je suis impressionné ! Cela a fait une telle différence." style="--index: 6;"></review-card>
  </div>

  <div class="marquee pause-on-hover reverse" style="--total: 6;">
    <review-card name="Léa" username="@Léa" avatar="https://avatar.vercel.sh/emily" content="Vraiment exceptionnel. Ma journée a changé grâce à cela. Je le recommande vivement." style="--index: 1;"></review-card>
    <review-card name="Alexandre" username="@Alexandre" avatar="https://avatar.vercel.sh/olivia" content="C’est tout simplement incroyable. Cela a révolutionné mes habitudes. À ne surtout pas manquer." style="--index: 2;"></review-card>
    <review-card name="Inès" username="@Inès" avatar="https://avatar.vercel.sh/william" content="Phénoménal. Cela a totalement amélioré ma routine. Je le recommande sans hésiter." style="--index: 3;"></review-card>
    <review-card name="Louis" username="@Louis" avatar="https://avatar.vercel.sh/charlotte" content="Un produit incroyable. Il a transformé ma façon de fonctionner au quotidien." style="--index: 4;"></review-card>
    <review-card name="Juliette" username="@Juliette" avatar="https://avatar.vercel.sh/michael" content="Absolument génial. Ma routine quotidienne est beaucoup plus simple maintenant." style="--index: 5;"></review-card>
    <review-card name="Maxime" username="@Maxime" avatar="https://avatar.vercel.sh/elizabeth" content="Complètement impressionnée. Cela a véritablement changé ma manière de vivre au quotidien." style="--index: 6;"></review-card>
  </div>
</main>
<br>
<br>

        <!-- best product -->
    <section class="py-5 overflow-hidden">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

            <div class="section-header d-flex justify-content-between">
              
              <h2 class="section-title">Produits les plus populaires</h2>

              <div class="d-flex align-items-center">
                <a href="products.php" class="btn-link text-decoration-none">Voir toutes les Produits →</a>
                <div class="swiper-buttons">
                  <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
                  <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
                </div>  
              </div>
            </div>
            
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">

            <div class="products-carousel swiper">
              <div class="swiper-wrapper">
                
                <div class="product-item swiper-slide">
                  <a href="#" class="btn-wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></a>
                  <figure>
                    <a href="product_page.php" title="Product Title">
                      <img src="../assets/images/office.png"  class="tab-image">
                    </a>
                  </figure>
                  <h3>Microsoft Office 2024 Home PC</h3>
                  <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> 4.5</span>
                  <span class="price">200 MAD</span>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="input-group product-qty">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                            </button>
                        </span>
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                            </button>
                        </span>
                    </div>
                    <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                  </div>
                </div>

                <div class="product-item swiper-slide">
                  <a href="#" class="btn-wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></a>
                  <figure>
                    <a href="product_page.php" title="Product Title">
                      <img src="../assets/images/office.png"  class="tab-image">
                    </a>
                  </figure>
                  <h3>Microsoft Office 2024 Home PC</h3>
                  <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> 4.5</span>
                  <span class="price">200 MAD</span>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="input-group product-qty">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                            </button>
                        </span>
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                            </button>
                        </span>
                    </div>
                    <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                  </div>
                </div>

                <div class="product-item swiper-slide">
                  <a href="#" class="btn-wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></a>
                  <figure>
                    <a href="product_page.php" title="Product Title">
                      <img src="../assets/images/office.png"  class="tab-image">
                    </a>
                  </figure>
                  <h3>Microsoft Office 2024 Home PC</h3>
                  <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> 4.5</span>
                  <span class="price">200 MAD</span>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="input-group product-qty">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                            </button>
                        </span>
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                            </button>
                        </span>
                    </div>
                    <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                  </div>
                </div>

                <div class="product-item swiper-slide">
                  <a href="#" class="btn-wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></a>
                  <figure>
                    <a href="product_page.php" title="Product Title">
                      <img src="../assets/images/office.png"  class="tab-image">
                    </a>
                  </figure>
                  <h3>Microsoft Office 2024 Home PC</h3>
                  <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> 4.5</span>
                  <span class="price">200 MAD</span>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="input-group product-qty">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                            </button>
                        </span>
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                            </button>
                        </span>
                    </div>
                    <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                  </div>
                </div>
                <div class="product-item swiper-slide">
                  <a href="#" class="btn-wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></a>
                  <figure>
                    <a href="product_page.php" title="Product Title">
                      <img src="../assets/images/office.png"  class="tab-image">
                    </a>
                  </figure>
                  <h3>Microsoft Office 2024 Home PC</h3>
                  <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> 4.5</span>
                  <span class="price">200 MAD</span>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="input-group product-qty">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                            </button>
                        </span>
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                            </button>
                        </span>
                    </div>
                    <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                  </div>
                </div>

                <div class="product-item swiper-slide">
                  <a href="#" class="btn-wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></a>
                  <figure>
                    <a href="product_page.php" title="Product Title">
                      <img src="../assets/images/office.png"  class="tab-image">
                    </a>
                  </figure>
                  <h3>Microsoft Office 2024 Home PC</h3>
                  <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> 4.5</span>
                  <span class="price">200 MAD</span>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="input-group product-qty">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                            </button>
                        </span>
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                            </button>
                        </span>
                    </div>
                    <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                  </div>
                </div>

                <div class="product-item swiper-slide">
                  <a href="#" class="btn-wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></a>
                  <figure>
                    <a href="product_page.php" title="Product Title">
                      <img src="../assets/images/office.png"  class="tab-image">
                    </a>
                  </figure>
                  <h3>Microsoft Office 2024 Home PC</h3>
                  <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> 4.5</span>
                  <span class="price">200 MAD</span>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="input-group product-qty">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                            </button>
                        </span>
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                            </button>
                        </span>
                    </div>
                    <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                  </div>
                </div>

                <div class="product-item swiper-slide">
                  <a href="#" class="btn-wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></a>
                  <figure>
                    <a href="product_page.php" title="Product Title">
                      <img src="../assets/images/office.png"  class="tab-image">
                    </a>
                  </figure>
                  <h3>Microsoft Office 2024 Home PC</h3>
                  <span class="qty">1 Unit</span><span class="rating"><svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> 4.5</span>
                  <span class="price">200 MAD</span>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="input-group product-qty">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-left-minus btn btn-danger btn-number" data-type="minus">
                              <svg width="16" height="16"><use xlink:href="#minus"></use></svg>
                            </button>
                        </span>
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1">
                        <span class="input-group-btn">
                            <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus">
                                <svg width="16" height="16"><use xlink:href="#plus"></use></svg>
                            </button>
                        </span>
                    </div>
                    <a href="#" class="nav-link">Add to Cart <iconify-icon icon="uil:shopping-cart"></a>
                  </div>
                </div>
                
              </div>
            </div>
            <!-- / products-carousel -->

          </div>
        </div>
      </div>
    </section>

    </main>
    
    
    <?php include_once '../includes/footer.php'; ?>
</body>
</html>