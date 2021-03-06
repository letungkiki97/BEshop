@extends('frontend.layouts.master')
@section('title', 'Chi tiết sản phẩm')
@section('Content')
@include('frontend.layouts.breadcrumb')
<div id="PageContainer" class="is-moved-by-drawer">
  <main class="main-content" role="main">
    <!-- HRV LAST VIEW PRODUCT -->
    <script>
      (function saveAlgorithm() {
      	lastViewProducts.add('{{@$product->slug}}');
      }());
    </script>
    <!-- END: HRV LAST VIEW PRODUCT -->
    <section id="product-wrapper">
      <div class="wrapper">
        <div class="inner">
          <div itemscope >
            <meta itemprop="url" content="{{@$product->meta_title}}">
            <meta itemprop="image" content="{{url('uploads/products/'.@$product->image->name)}}g">
            <div class="product-detail-inner">
              <div class="grid product-single">
                <div class="grid__item large--five-twelfths medium--five-twelfths small--one-whole">
                  <div class="customize-product-slider clearfix">
                    <div id="surround" class="clearfix">
                      <div class="product-images text-center" id="ProductPhoto">
                        <img class="product-image-feature" src="{{url('uploads/products/'.@$product->image->name)}}"
                          alt="{{url('uploads/products/'.@$product->image->alt)}}">
                        <div id="sliderproduct" style="display: none !important;">
                          <ul class="slides">
                            <li class="product-thumb">
                              <a href="javascript:void(0)" class="product__thumbnail--target-1" data-image="//product.hstatic.net/1000305059/product/suplo-002a-04_3c78db8101a649d98079d01e7522c8e2_master.jpg"
                                data-zoom-image="http://product.hstatic.net/1000305059/product/suplo-002a-04_3c78db8101a649d98079d01e7522c8e2_master.jpg">
                              <img alt="SUPLO Gas Gasoline Petrol Fuel Filter OE 23300-31100, 186100-4730 Replacement Parts for Toyota Prado 4700/2700/3400 Land Cruiser"
                                data-image="//product.hstatic.net/1000305059/product/suplo-002a-04_3c78db8101a649d98079d01e7522c8e2_master.jpg"
                                src="http://product.hstatic.net/1000305059/product/suplo-002a-04_3c78db8101a649d98079d01e7522c8e2_small.jpg">
                              </a>
                            </li>
                            <li class="product-thumb">
                              <a href="javascript:void(0)" class="product__thumbnail--target-2" data-image="//product.hstatic.net/1000305059/product/suplo-006a-01_2b0ee81db92549da876c4774883ae536_master.jpg"
                                data-zoom-image="http://product.hstatic.net/1000305059/product/suplo-006a-01_2b0ee81db92549da876c4774883ae536_master.jpg">
                              <img alt="SUPLO Gas Gasoline Petrol Fuel Filter OE 23300-31100, 186100-4730 Replacement Parts for Toyota Prado 4700/2700/3400 Land Cruiser"
                                data-image="//product.hstatic.net/1000305059/product/suplo-006a-01_2b0ee81db92549da876c4774883ae536_master.jpg"
                                src="http://product.hstatic.net/1000305059/product/suplo-006a-01_2b0ee81db92549da876c4774883ae536_small.jpg">
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="product-single__thumbnails inline-list">
                        <ul class="product-single__thumbnails inline-list" id="ProductThumbs">
                          <div id="owl-product-thumbs" class="owl-carousel owl-theme">
                            <div class="item">
                              <div class="thumbnail-item" data-alt="">
                                <a href="http://product.hstatic.net/1000305059/product/suplo-002a-04_3c78db8101a649d98079d01e7522c8e2_master.jpg"
                                  class="product-single__thumbnail  active " data-trigger="1">
                                <img src="http://product.hstatic.net/1000305059/product/suplo-002a-04_3c78db8101a649d98079d01e7522c8e2_small.jpg"
                                  alt="">
                                </a>
                              </div>
                            </div>
                            <div class="item">
                              <div class="thumbnail-item" data-alt="">
                                <a href="http://product.hstatic.net/1000305059/product/suplo-006a-01_2b0ee81db92549da876c4774883ae536_master.jpg"
                                  class="product-single__thumbnail " data-trigger="2">
                                <img src="http://product.hstatic.net/1000305059/product/suplo-006a-01_2b0ee81db92549da876c4774883ae536_small.jpg"
                                  alt="">
                                </a>
                              </div>
                            </div>
                          </div>
                        </ul>
                      </div>
                    </div>
                    <a href="javascript:void(0)" id="product-playYoutube"><i class="fas fa-play"></i> Xem video về sản phẩm</a>
                    <div class="customize-variants-products-slider text-center" style="display: none !important;">
                      <div id="owl-customize-variants-products-slider" class="owl-carousel owl-theme">
                        <div class="item product_variant_item" data-variant-color="Đỏ" data-alt="" data-image="//product.hstatic.net/1000305059/product/suplo-002a-03_bb84bfed09d14801a36ca1faf577a8dc_small.jpg"
                          data-feature-image="http://product.hstatic.net/1000305059/product/suplo-002a-03_bb84bfed09d14801a36ca1faf577a8dc_master.jpg">
                          <img src="http://product.hstatic.net/1000305059/product/suplo-002a-03_bb84bfed09d14801a36ca1faf577a8dc_small.jpg"
                            alt="">
                        </div>
                        <div class="item product_variant_item" data-variant-color="Đen" data-alt="" data-image="//product.hstatic.net/1000305059/product/suplo-006a-01_2b0ee81db92549da876c4774883ae536_small.jpg"
                          data-feature-image="http://product.hstatic.net/1000305059/product/suplo-006a-01_2b0ee81db92549da876c4774883ae536_master.jpg">
                          <img src="http://product.hstatic.net/1000305059/product/suplo-006a-01_2b0ee81db92549da876c4774883ae536_small.jpg"
                            alt="">
                        </div>
                        <div class="item product_variant_item" data-variant-color="Đen" data-alt="" data-image="//product.hstatic.net/1000305059/product/suplo-005a-01_d8830fa2da1742bcba6c6ac64301767d_small.jpg"
                          data-feature-image="http://product.hstatic.net/1000305059/product/suplo-005a-01_d8830fa2da1742bcba6c6ac64301767d_master.jpg">
                          <img src="http://product.hstatic.net/1000305059/product/suplo-005a-01_d8830fa2da1742bcba6c6ac64301767d_small.jpg"
                            alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="grid__item large--seven-twelfths medium--seven-twelfths small--one-whole">
                  <div class="product-content">
                    <h1 itemprop="name">{{$product->product_name}}</h1>
                    <div class="pro-sku ProductSku">
                      <span class="title">Mã SP: </span> <span class="sku-number">{{$product->product_sku}}</span>
                    </div>
                    <div class="pro-brand">
                      <span class="title">Thương hiệu: </span> <a>{{$product->category->name}}</a>
                    </div>
                    <div class="pro-stock">
                      <span class="title">Tình trạng: </span> <span>{{$product->made_to_order?"Còn hàng":"Hết hàng"}}</span>
                    </div>
                    <!-- <div class="pro-price clearfix">
                      <span class="current-price ProductPrice">{{number_format($product->sale_price)}}₫</span>professional_price
                      
                      <?php if ($product->promotion_price && $product->promotion_price > 0)  : ?>
                      <span class="original-price ComparePrice"><s>{{number_format($product->promotion_price)}}₫</s></span>
                      <?php endif ?>
                      <div class="sale-percentage"><span class="PriceSaving"></span></div>
                    </div> -->
                    <div class="pro-short-desc">
                      <p style="text-align: justify;" data-mce-style="text-align: justify;">{!!$product->description!!}</p>
                      <p style="text-align: justify;" data-mce-style="text-align: justify;">
                        <span style="color: #000000;" data-mce-style="color: #000000;"></span>
                      </p>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data"
                      id="AddToCartForm" class="form-vertical">
                      <div class="product-variants-wrapper">
                        <div class="product-size-hotline">
                          <div class="product-hotline">
                            Hotline hỗ trợ bán hàng 24/7: <a href="tel:{{@Settings::get('hotline')}}">{{@Settings::get('hotline')}}</a>
                          </div>
                          <span>|</span>
                          <div class="social-network-actions text-left">
                            <div class="fb-like" data-href="{{url('productdetail/'.@$product->id)}}"
                              data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                          </div>
                        </div>
                      </div>
                      <div class="grid mg-left-5">
                        <div class="grid__item large--one-fifth medium--one-third small--one-third pd-left5">
                          <div class="product-quantity clearfix">
                            <div class="qty-addcart clearfix">
                              <span>Số lượng </span>
                              <input type="number" id="Quantity" name="quantity" value="1" min="1" class="quantity-selector">
                            </div>
                          </div>
                        </div>
                        <div class="grid__item large--two-thirds medium--two-thirds small--two-thirds pd-left5">
                          <div class="product-actions clearfix">
                            <button type="submit" name="add" id="AddToCart" class="btnAddToCart">Thêm vào giỏ</button>
                            <button type="button" name="buy" id="buy-now" class="btnBuyNow">Mua ngay</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-description-wrapper">
              <div class="tab clearfix">
                <button class="pro-tablinks" onclick="openProTabs(event, 'protab1')" id="defaultOpenProTabs">Mô tả sản phẩm</button>
                <!-- <button class="pro-tablinks" onclick="openProTabs(event, 'protab2')">Hướng dẫn tháo lắp</button> -->
                <button class="pro-tablinks" onclick="openProTabs(event, 'protab3')">Hình ảnh</button>
                <button class="pro-tablinks" onclick="openProTabs(event, 'protab4')">Bình luận</button>
              </div>
              <div id="protab1" class="pro-tabcontent">
                </span></p>
                {!!$product['long_description']!!}
              </div>
              <div id="protab3" class="pro-tabcontent">
                </span></p>
                <?php foreach ($product->images as $image): ?>
                <p><img src="{{url('uploads/products/'.$image->name)}}" alt="{{$image->alt}}" style="display: block; margin-left: auto; margin-right: auto;"
                  data-mce-src="{{url('uploads/products/'.$image->name)}}" data-mce-style="display: block; margin-left: auto; margin-right: auto;"></p>
                <p><br></p>
                <?php endforeach ?>
                <p><br></p>
                <p><br></p>
                <p><br></p>
                <p style="text-align: justify;" data-mce-style="text-align: justify;"><br></p>
              </div>
              <div id="protab4" class="pro-tabcontent">
                <div class="product-fb-comments">
                  <div class="fb-comments" data-href="{{url('productdetail/'.@$product->id)}}"
                    data-numposts="5"></div>
                </div>
              </div>
            </div>
            <section id="related-products">
              <div class="home-section-head clearfix">
                <h2>
                  <span>Sản phẩm tương tự</span>
                </h2>
              </div>
              <div class="home-section-body">
                <div class="section-desc">
                  Các sản phẩm mà bạn cũng có thể bạn muốn xem
                </div>
                <div id="owl-related-products-slider" class="owl-carousel owl-theme">
                  <div class="item">
                    <div class="product-item">
                      <div class="product-img">
                        <a href="../collections/cac-san-pham-khac/products/suplo-gas-gasoline-petrol-fuel-filter-oe-23300-31100-186100-4730-replacement-parts-for-toyota-prado-4700-2700-3400-land-cruiser-3.html">
                        <img id="1090714311" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-006a-02_023bb50277a7493d8d7a7b3bd226f9ee_large.jpg"
                          alt="SUPLO Gas Gasoline Petrol Fuel Filter OE 23300-31100, 186100-4730 Replacement Parts for Toyota Prado 4700/2700/3400 Land Cruiser" />
                        <img id="1090714312" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-005a-02_d08e539ec50b44adaef7e55024a0b666_large.jpg"
                          alt="SUPLO Gas Gasoline Petrol Fuel Filter OE 23300-31100, 186100-4730 Replacement Parts for Toyota Prado 4700/2700/3400 Land Cruiser" />
                        </a>
                        <div class="product-actions medium--hide small--hide">
                          <div>
                            <button type="button" class="btnQuickView quick-view medium--hide small--hide" data-handle="/products/suplo-gas-gasoline-petrol-fuel-filter-oe-23300-31100-186100-4730-replacement-parts-for-toyota-prado-4700-2700-3400-land-cruiser-3"><span><i
                              class="fa fa-search-plus" aria-hidden="true"></i></span></button>
                          </div>
                        </div>
                        <div class="tag-saleoff-img text-center">
                          -9%
                        </div>
                      </div>
                      <div class="product-item-info">
                        <div class="product-title">
                          <a href="suplo-gas-gasoline-petrol-fuel-filter-oe-23300-31100-186100-4730-replacement-parts-for-toyota-prado-4700-2700-3400-land-cruiser-3.html">SUPLO
                          Gas Gasoline Petrol Fuel Filter O...</a>
                        </div>
                        <div class="product-desc">
                          Bọc vô lăng Sparco chính hãng SPC1111RS lấy cảm hứng thể thao từ các dòng xe đua kết hợp với công nghệ
                          sản xuất tiên tiến. Các mẫu bọc vô lăng SPARCO đều có kích thước đường kín...
                        </div>
                        <div class="product-price clearfix">
                          <span class="current-price">10,500,000₫</span>
                          <span class="original-price"><s>11,500,000₫</s></span>
                        </div>
                      </div>
                      <div class="product-buynow">
                        <button type="button" class="btnAddToCart add-to-cart  medium--hide small--hide" data-id="1031638556"><span><i
                          class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ</span></button>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-item">
                      <div class="product-img">
                        <a href="../collections/cac-san-pham-khac/products/suplo-gas-gasoline-petrol-fuel-filter-oe-23300-31100-186100-4730-replacement-parts-for-toyota-prado-4700-2700-3400-land-cruiser-2.html">
                        <img id="1090712683" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-004a-02_1e327fc3290e43e9a6b5e36bdf11678a_large.jpg"
                          alt="SUPLO Gas Gasoline Petrol Fuel Filter OE 23300-31100, 186100-4730 Replacement Parts for Toyota Prado 4700/2700/3400 Land Cruiser" />
                        <img id="1090712684" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-006a-01_0f6f585791194a5b8e7a2577bdc1b466_large.jpg"
                          alt="SUPLO Gas Gasoline Petrol Fuel Filter OE 23300-31100, 186100-4730 Replacement Parts for Toyota Prado 4700/2700/3400 Land Cruiser" />
                        </a>
                        <div class="product-actions medium--hide small--hide">
                          <div>
                            <button type="button" class="btnQuickView quick-view medium--hide small--hide" data-handle="/products/suplo-gas-gasoline-petrol-fuel-filter-oe-23300-31100-186100-4730-replacement-parts-for-toyota-prado-4700-2700-3400-land-cruiser-2"><span><i
                              class="fa fa-search-plus" aria-hidden="true"></i></span></button>
                          </div>
                        </div>
                        <div class="tag-saleoff-img text-center">
                          -28%
                        </div>
                      </div>
                      <div class="product-item-info">
                        <div class="product-title">
                          <a href="suplo-gas-gasoline-petrol-fuel-filter-oe-23300-31100-186100-4730-replacement-parts-for-toyota-prado-4700-2700-3400-land-cruiser-2.html">SUPLO
                          Gas Gasoline Petrol Fuel Filter O...</a>
                        </div>
                        <div class="product-desc">
                          Bọc vô lăng Sparco chính hãng SPC1111RS lấy cảm hứng thể thao từ các dòng xe đua kết hợp với công nghệ
                          sản xuất tiên tiến. Các mẫu bọc vô lăng SPARCO đều có kích thước đường kín...
                        </div>
                        <div class="product-price clearfix">
                          <span class="current-price">30,000,000₫</span>
                          <span class="original-price"><s>41,500,000₫</s></span>
                        </div>
                      </div>
                      <div class="product-buynow">
                        <button type="button" class="btnAddToCart add-to-cart  medium--hide small--hide" data-id="1031637974"><span><i
                          class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ</span></button>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-item">
                      <div class="product-img">
                        <a href="../collections/cac-san-pham-khac/products/suplo-gas-gasoline-petrol-fuel-filter-oe-23300-31100-186100-4730-replacement-parts-for-toyota-prado-4700-2700-3400-land-cruiser.html">
                        <img id="1090047797" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-001a-03_large.jpg" alt="SUPLO Gas Gasoline Petrol Fuel Filter OE 23300-31100, 186100-4730 Replacement Parts for Toyota Prado 4700/2700/3400 Land Cruiser" />
                        <img id="1090047815" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-001a-04_large.jpg" alt="SUPLO Gas Gasoline Petrol Fuel Filter OE 23300-31100, 186100-4730 Replacement Parts for Toyota Prado 4700/2700/3400 Land Cruiser" />
                        </a>
                        <div class="product-actions medium--hide small--hide">
                          <div>
                            <button type="button" class="btnQuickView quick-view medium--hide small--hide" data-handle="/products/suplo-gas-gasoline-petrol-fuel-filter-oe-23300-31100-186100-4730-replacement-parts-for-toyota-prado-4700-2700-3400-land-cruiser"><span><i
                              class="fa fa-search-plus" aria-hidden="true"></i></span></button>
                          </div>
                        </div>
                        <div class="tag-saleoff-img text-center">
                          -2%
                        </div>
                      </div>
                      <div class="product-item-info">
                        <div class="product-title">
                          <a href="suplo-gas-gasoline-petrol-fuel-filter-oe-23300-31100-186100-4730-replacement-parts-for-toyota-prado-4700-2700-3400-land-cruiser.html">SUPLO
                          Gas Gasoline Petrol Fuel Filter O...</a>
                        </div>
                        <div class="product-desc">
                          Bọc vô lăng Sparco chính hãng SPC1111RS lấy cảm hứng thể thao từ các dòng xe đua kết hợp với công nghệ
                          sản xuất tiên tiến. Các mẫu bọc vô lăng SPARCO đều có kích thước đường kín...
                        </div>
                        <div class="product-price clearfix">
                          <span class="current-price">5,300,000₫</span>
                          <span class="original-price"><s>5,400,000₫</s></span>
                        </div>
                      </div>
                      <div class="product-buynow">
                        <button type="button" class="btnAddToCart add-to-cart  medium--hide small--hide" data-id="1031634559"><span><i
                          class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ</span></button>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-item">
                      <div class="product-img">
                        <a href="../collections/cac-san-pham-khac/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-9.html">
                        <img id="1090801495" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-012a-01_b4073d98b6534c619a361549e0b2f118_large.jpg"
                          alt="SUPLO Smart Gravity Holder Cute Mount 10W Fast Wireless Car Charger Bracket Car Accessories" />
                        <img id="1090801496" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-007a-01_0f20da25349d4464bcb9e87104b92602_large.jpg"
                          alt="SUPLO Smart Gravity Holder Cute Mount 10W Fast Wireless Car Charger Bracket Car Accessories" />
                        </a>
                        <div class="product-actions medium--hide small--hide">
                          <div>
                            <button type="button" class="btnQuickView quick-view medium--hide small--hide" data-handle="/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-9"><span><i
                              class="fa fa-search-plus" aria-hidden="true"></i></span></button>
                          </div>
                        </div>
                      </div>
                      <div class="product-item-info">
                        <div class="product-title">
                          <a href="suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-9.html">SUPLO
                          Smart Gravity Holder Cute Mount 1...</a>
                        </div>
                        <div class="product-desc">
                          Bọc vô lăng Sparco chính hãng SPC1111RS lấy cảm hứng thể thao từ các dòng xe đua kết hợp với công nghệ
                          sản xuất tiên tiến. Các mẫu bọc vô lăng SPARCO đều có kích thước đường kín...
                        </div>
                        <div class="product-price clearfix">
                          <span class="current-price">150,000₫</span>
                        </div>
                      </div>
                      <div class="product-buynow">
                        <button type="button" class="btnAddToCart add-to-cart  medium--hide small--hide" data-id="1031664345"><span><i
                          class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ</span></button>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-item">
                      <div class="product-img">
                        <a href="../collections/cac-san-pham-khac/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-8.html">
                        <img id="1090800284" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-011a-01_2985b98a85c64d96b1825f3943fa1b94_large.jpg"
                          alt="SUPLO Smart Gravity Holder Cute Mount 10W Fast Wireless Car Charger Bracket Car Accessories" />
                        <img id="1090800285" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-008a-01_55e427e3130944029c0b03adcb2aa347_large.jpg"
                          alt="SUPLO Smart Gravity Holder Cute Mount 10W Fast Wireless Car Charger Bracket Car Accessories" />
                        </a>
                        <div class="product-actions medium--hide small--hide">
                          <div>
                            <button type="button" class="btnQuickView quick-view medium--hide small--hide" data-handle="/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-8"><span><i
                              class="fa fa-search-plus" aria-hidden="true"></i></span></button>
                          </div>
                        </div>
                      </div>
                      <div class="product-item-info">
                        <div class="product-title">
                          <a href="suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-8.html">SUPLO
                          Smart Gravity Holder Cute Mount 1...</a>
                        </div>
                        <div class="product-desc">
                          Bọc vô lăng Sparco chính hãng SPC1111RS lấy cảm hứng thể thao từ các dòng xe đua kết hợp với công nghệ
                          sản xuất tiên tiến. Các mẫu bọc vô lăng SPARCO đều có kích thước đường kín...
                        </div>
                        <div class="product-price clearfix">
                          <span class="current-price">1,750,000₫</span>
                        </div>
                      </div>
                      <div class="product-buynow">
                        <button type="button" class="btnAddToCart add-to-cart  medium--hide small--hide" data-id="1031664184"><span><i
                          class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ</span></button>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-item">
                      <div class="product-img">
                        <a href="../collections/cac-san-pham-khac/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-7.html">
                        <img id="1016605819" class="only-one lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-010a-01_9c5acf2a9eea4973bc832b421847d665_large.jpg"
                          alt="SUPLO Smart Gravity Holder Cute Mount 10W Fast Wireless Car Charger Bracket Car Accessories" />
                        </a>
                        <div class="product-actions medium--hide small--hide">
                          <div>
                            <button type="button" class="btnQuickView quick-view medium--hide small--hide" data-handle="/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-7"><span><i
                              class="fa fa-search-plus" aria-hidden="true"></i></span></button>
                          </div>
                        </div>
                      </div>
                      <div class="product-item-info">
                        <div class="product-title">
                          <a href="suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-7.html">SUPLO
                          Smart Gravity Holder Cute Mount 1...</a>
                        </div>
                        <div class="product-desc">
                          Bọc vô lăng Sparco chính hãng SPC1111RS lấy cảm hứng thể thao từ các dòng xe đua kết hợp với công nghệ
                          sản xuất tiên tiến. Các mẫu bọc vô lăng SPARCO đều có kích thước đường kín...
                        </div>
                        <div class="product-price clearfix">
                          <span class="current-price">500,000₫</span>
                        </div>
                      </div>
                      <div class="product-buynow">
                        <button type="button" disabled class="btnAddToCart  medium--hide small--hide" data-id=""><span>Hết hàng</span></button>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-item">
                      <div class="product-img">
                        <a href="../collections/cac-san-pham-khac/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-6.html">
                        <img id="1090799919" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-009a-01_large.jpg" alt="SUPLO Smart Gravity Holder Cute Mount 10W Fast Wireless Car Charger Bracket Car Accessories" />
                        <img id="1090799920" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-010a-01_large.jpg" alt="SUPLO Smart Gravity Holder Cute Mount 10W Fast Wireless Car Charger Bracket Car Accessories" />
                        </a>
                        <div class="product-actions medium--hide small--hide">
                          <div>
                            <button type="button" class="btnQuickView quick-view medium--hide small--hide" data-handle="/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-6"><span><i
                              class="fa fa-search-plus" aria-hidden="true"></i></span></button>
                          </div>
                        </div>
                        <div class="tag-saleoff-img text-center">
                          -19%
                        </div>
                      </div>
                      <div class="product-item-info">
                        <div class="product-title">
                          <a href="suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-6.html">SUPLO
                          Smart Gravity Holder Cute Mount 1...</a>
                        </div>
                        <div class="product-desc">
                          Bọc vô lăng Sparco chính hãng SPC1111RS lấy cảm hứng thể thao từ các dòng xe đua kết hợp với công nghệ
                          sản xuất tiên tiến. Các mẫu bọc vô lăng SPARCO đều có kích thước đường kín...
                        </div>
                        <div class="product-price clearfix">
                          <span class="current-price">1,210,000₫</span>
                          <span class="original-price"><s>1,500,000₫</s></span>
                        </div>
                      </div>
                      <div class="product-buynow">
                        <button type="button" class="btnAddToCart add-to-cart  medium--hide small--hide" data-id="1031663692"><span><i
                          class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ</span></button>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-item">
                      <div class="product-img">
                        <a href="../collections/cac-san-pham-khac/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-5.html">
                        <img id="1090719996" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-007a-01_0a2ce72402ab45bcb8bdd8d35730ca32_large.jpg"
                          alt="SUPLO Smart Gravity Holder Cute Mount 10W Fast Wireless Car Charger Bracket Car Accessories" />
                        <img id="1090719997" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-008a-01_0db9335e7eb54e86bca4916efccda559_large.jpg"
                          alt="SUPLO Smart Gravity Holder Cute Mount 10W Fast Wireless Car Charger Bracket Car Accessories" />
                        </a>
                        <div class="product-actions medium--hide small--hide">
                          <div>
                            <button type="button" class="btnQuickView quick-view medium--hide small--hide" data-handle="/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-5"><span><i
                              class="fa fa-search-plus" aria-hidden="true"></i></span></button>
                          </div>
                        </div>
                        <div class="tag-saleoff-img text-center">
                          -2%
                        </div>
                      </div>
                      <div class="product-item-info">
                        <div class="product-title">
                          <a href="suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-5.html">SUPLO
                          Smart Gravity Holder Cute Mount 1...</a>
                        </div>
                        <div class="product-desc">
                          Bọc vô lăng Sparco chính hãng SPC1111RS lấy cảm hứng thể thao từ các dòng xe đua kết hợp với công nghệ
                          sản xuất tiên tiến. Các mẫu bọc vô lăng SPARCO đều có kích thước đường kín...
                        </div>
                        <div class="product-price clearfix">
                          <span class="current-price">31,500,000₫</span>
                          <span class="original-price"><s>32,000,000₫</s></span>
                        </div>
                      </div>
                      <div class="product-buynow">
                        <button type="button" class="btnAddToCart add-to-cart  medium--hide small--hide" data-id="1031640086"><span><i
                          class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ</span></button>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-item">
                      <div class="product-img">
                        <a href="../collections/cac-san-pham-khac/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-4.html">
                        <img id="1090718647" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-008a-01_large.jpg" alt="SUPLO Smart Gravity Holder Cute Mount 10W Fast Wireless Car Charger Bracket Car Accessories" />
                        <img id="1090718648" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-007a-01_large.jpg" alt="SUPLO Smart Gravity Holder Cute Mount 10W Fast Wireless Car Charger Bracket Car Accessories" />
                        </a>
                        <div class="product-actions medium--hide small--hide">
                          <div>
                            <button type="button" class="btnQuickView quick-view medium--hide small--hide" data-handle="/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-4"><span><i
                              class="fa fa-search-plus" aria-hidden="true"></i></span></button>
                          </div>
                        </div>
                        <div class="tag-saleoff-img text-center">
                          -4%
                        </div>
                      </div>
                      <div class="product-item-info">
                        <div class="product-title">
                          <a href="suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-4.html">SUPLO
                          Smart Gravity Holder Cute Mount 1...</a>
                        </div>
                        <div class="product-desc">
                          Bọc vô lăng Sparco chính hãng SPC1111RS lấy cảm hứng thể thao từ các dòng xe đua kết hợp với công nghệ
                          sản xuất tiên tiến. Các mẫu bọc vô lăng SPARCO đều có kích thước đường kín...
                        </div>
                        <div class="product-price clearfix">
                          <span class="current-price">51,000,000₫</span>
                          <span class="original-price"><s>53,000,000₫</s></span>
                        </div>
                      </div>
                      <div class="product-buynow">
                        <button type="button" class="btnAddToCart add-to-cart  medium--hide small--hide" data-id="1031639469"><span><i
                          class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ</span></button>
                      </div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="product-item">
                      <div class="product-img">
                        <a href="../collections/cac-san-pham-khac/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-3.html">
                        <img id="1090716010" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-005a-02_5d3b786d8a17438f928a3c84ee7e71fa_large.jpg"
                          alt="SUPLO Smart Gravity Holder Cute Mount 10W Fast Wireless Car Charger Bracket Car Accessories" />
                        <img id="1090716011" class="lazyload" src="http://theme.hstatic.net/1000305059/1000394224/14/lazyload.jpg?v=3593"
                          data-src="http://product.hstatic.net/1000305059/product/suplo-003a-01_f494c194a73f4f8fa6d9787d29d3ff27_large.jpg"
                          alt="SUPLO Smart Gravity Holder Cute Mount 10W Fast Wireless Car Charger Bracket Car Accessories" />
                        </a>
                        <div class="product-actions medium--hide small--hide">
                          <div>
                            <button type="button" class="btnQuickView quick-view medium--hide small--hide" data-handle="/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-3"><span><i
                              class="fa fa-search-plus" aria-hidden="true"></i></span></button>
                          </div>
                        </div>
                      </div>
                      <div class="product-item-info">
                        <div class="product-title">
                          <a href="suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-3.html">SUPLO
                          Smart Gravity Holder Cute Mount 1...</a>
                        </div>
                        <div class="product-desc">
                          Bọc vô lăng Sparco chính hãng SPC1111RS lấy cảm hứng thể thao từ các dòng xe đua kết hợp với công nghệ
                          sản xuất tiên tiến. Các mẫu bọc vô lăng SPARCO đều có kích thước đường kín...
                        </div>
                        <div class="product-price clearfix">
                          <span class="current-price">21,000,000₫</span>
                        </div>
                      </div>
                      <div class="product-buynow">
                        <button type="button" class="btnAddToCart add-to-cart  medium--hide small--hide" data-id="1031639038"><span><i
                          class="fa fa-cart-plus" aria-hidden="true"></i> Thêm vào giỏ</span></button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <div id="seen-products" class="seen-products-slider">
              <div class="home-section-head clearfix">
                <h2>
                  <span>Sản phẩm đã xem</span>
                </h2>
              </div>
              <div class="home-section-body">
                <div class="section-desc">
                  Những sản phẩm của chúng tôi mà bạn đã xem
                </div>
                <div class="show">
                  <div id="owl-spdx" class="owl-carousel new-slide">
                  </div>
                  <div id="clone-item">
                    <div class="item hide">
                      <div class="seen-item">
                        <div class="product-item">
                          <div class="product-img">
                            <a href="../collections/cac-san-pham-khac.html">
                            <img class="only-one" src="http://hstatic.net/0/0/global/noDefaultImage6_large.gif" alt="" />
                            </a>
                          </div>
                          <div class="product-item-info">
                            <div class="product-title">
                              <a href="#"></a>
                            </div>
                            <div class="product-price clearfix">
                              <span class="current-price">0₫</span>
                              <span class="original-price"><s>0₫</s></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <script>
              var product_handle = 'suplo-gas-gasoline-petrol-fuel-filter-oe-23300-31100-186100-4730-replacement-parts-for-toyota-prado-4700-2700-3400-land-cruiser-1';
              var last_view_products_current = localStorage.getItem('last_view_products');
              var max_last_view_products = 20;
              
              if (!last_view_products_current) {
              	last_view_products_current = [];
              } else {
              	last_view_products_current = JSON.parse(last_view_products_current);
              }
              
              if (last_view_products_current.indexOf(product_handle) == -1) {
              	if (last_view_products_current.length >= max_last_view_products) {
              		last_view_products_current.shift();
              	}
              
              	last_view_products_current.push(product_handle);
              	localStorage.setItem('last_view_products', JSON.stringify(last_view_products_current));
              } else {
              	var remove_at = last_view_products_current.indexOf(product_handle);
              	last_view_products_current.splice(remove_at, 1);
              	last_view_products_current.push(product_handle);
              	if (last_view_products_current.length >= max_last_view_products) {
              		last_view_products_current.shift();
              	}
              }
              
            </script>
          </div>
        </div>
      </div>
    </section>
    <script>
      function getImageByAlt(alt) {
      	$('.thumbnail-item').each(function () {
      		if ($(this).data('alt') != alt) {
      			$(this).hide();
      		} else {
      			$(this).show();
      		}
      	})
      }
      $('.product_variant_item').click(function () {
      	var vid = $(this).data('variant-color');
      	var imgf = $(this).data('feature-image');
      	$(".product-thumb img[data-image='" + imgf + "']").click().parents('li').addClass('active');
      	$('#product-select-option-0').val(vid);
      	if ($(window).width() > 480) {
      		getImageByAlt($(this).data('alt'));
      	};
      	$('.product_variant_item').removeClass('active');
      	$(this).addClass('active');
      })
      $('.product_variant_item').trigger('click');
    </script>
    <script>
      $(".product-thumb img").click(function () {
      	$(".product-thumb").removeClass('active');
      	$(this).parents('li').addClass('active');
      	$(".product-image-feature").attr("src", $(this).attr("data-image"));
      	$(".product-image-feature").attr("data-zoom-image", $(this).attr("data-zoom-image"));
      });
      
      $(".product-thumb").first().addClass('active');
    </script>
    <script>
      $(document).ready(function () {
      	if ($(".slides .product-thumb").length > 4) {
      		$('#sliderproduct').flexslider({
      			animation: "slide",
      			controlNav: false,
      			animationLoop: false,
      			slideshow: false,
      			itemWidth: 95,
      			itemMargin: 10,
      		});
      	}
      	if ($(window).width() > 960) {
      		jQuery(".product-image-feature").elevateZoom({
      			gallery: 'sliderproduct',
      			scrollZoom: true
      		});
      	} else {
      
      	}
      	jQuery('.slide-next').click(function () {
      		if ($(".product-thumb.active").prev().length > 0) {
      			$(".product-thumb.active").prev().find('img').click();
      		}
      		else {
      			$(".product-thumb:last img").click();
      		}
      	});
      	jQuery('.slide-prev').click(function () {
      		if ($(".product-thumb.active").next().length > 0) {
      			$(".product-thumb.active").next().find('img').click();
      		}
      		else {
      			$(".product-thumb:first img").click();
      		}
      	});
      });
    </script>
    <script>
      $('.product-single__thumbnail').click(function (e) {
      	e.preventDefault();
      	$('.product__thumbnail--target-' + $(this).data('trigger')).trigger('click');
      	$('.product-single__thumbnail').removeClass('active');
      	$(".product-image-feature").attr("src", $(this).attr("href"));
      	$(".product-image-feature").attr("data-zoom-image", $(this).attr("href"));
      	$(this).addClass('active');
      })
      
    </script>
    <script>
      $('.swatch-element.color').click(function (e) {
      	var color_name = $(this).data("value");
      	console.log(color_name);
      	$(".item.product_variant_item[data-variant-color='" + color_name + "']").trigger('click');
      })
    </script>
    <script src='http://hstatic.net/0/0/global/option_selection.js' type='text/javascript'></script>
  </main>
</div>
@endsection