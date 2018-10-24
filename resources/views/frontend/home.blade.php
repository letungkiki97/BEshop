@extends('frontend.layouts.master')
@section('title', 'Trang chủ')
@section('Content')
@include('frontend.layouts.slide')
<style>
	@media (min-width: 992px){

	.sale-img img{width:376px;height:376px}
	.sanpham-img img{width:273px;height:273px}
	}
</style>
<div id="PageContainer" class="is-moved-by-drawer template-index">
	<main class="main-content" role="main">
		<section id="home-aboutus">
			<div class="inner">
				<div class="aboutus-head">
					<!-- <h2>
							Lịch sử
						</h2> -->
					<h3>
						Chào mừng đến với<span>Tuấn Nguyên</span>
					</h3>
				</div>
				<div class="aboutus-body clearfix">
					<div class="aboutus-img">
						<a href="collections/all.html">
							<img src="http://theme.hstatic.net/1000305059/1000394224/14/aboutus_img.jpg?v=3593" alt="Giới thiệu">
						</a>
					</div>
					<div class="aboutus-content">
						<div class="aboutus-content-wrapper">
							<h3>
								<span class="word1">Xuất hiện</span>
								<span class="word2"> Từ đầu năm 2012</span>
								<span class="word3">Dịch vụ khách hàng</span>
							</h3>
							<p>
								Công ty TNHH sản xuất và thương mại Tuấn Nguyên đã có 5 năm kinh nghiệm may thảm 4D,5D,6D và bắt đầu từ ngày
								14/04/2016 Công ty chúng tôi mở rộng thêm lĩnh vực chuyển giao công nghệ cho các xưởng sản xuất mới thành lập.
							</p>
							<p>
								Logo Công ty TNHH sản xuất và thương mại Tuấn Nguyên với slogan “ tất cả vì xế yêu của bạn “
							</p>
							<!-- <div class="author">
								<h4 class="name">
									Phạm Ngọc Kha
								</h4>
								<img src="http://theme.hstatic.net/1000305059/1000394224/14/aboutus_img_author.jpg?v=3593" alt="">
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="home-banner">
			<div class="wrapper">
				<div class="inner">
					<div class="grid md-mg-left-10">
						<div class="grid__item large--one-third medium--one-third small--one-whole md-pd-left10">
							<a href="productcategory/o-to" class="banner-item">
								<div class="banner-img">
									<img src="http://theme.hstatic.net/1000305059/1000394224/14/banner_img1.jpg?v=3593" alt="Phụ kiện xe hơi 2019">
								</div>
								<div class="banner-content">
									<span class="word1">Sản phẩm mới</span>
									<span class="word2">Mẫu thảm ôtô 2019</span>
									<span class="word3"></span>
								</div>
							</a>
						</div>
						<div class="grid__item large--one-third medium--one-third small--one-whole md-pd-left10">
							<a href="productcategory/o-to" class="banner-item">
								<div class="banner-img">
									<img src="http://theme.hstatic.net/1000305059/1000394224/14/banner_img2.jpg?v=3593" alt="Phụ kiện công suất tốt">
								</div>
								<div class="banner-content">
									<span class="word1">Chất Lượng</span>
									<span class="word2">Máy Móc & Công nghệ</span>
									<span class="word3"></span>
								</div>
							</a>
						</div>
						<div class="grid__item large--one-third medium--one-third small--one-whole md-pd-left10">
							<a href="productcategory/nguyen-lieu-vat-tu" class="banner-item">
								<div class="banner-img">
									<img src="http://theme.hstatic.net/1000305059/1000394224/14/banner_img3.jpg?v=3593" alt="Khuyến mãi tháng 9">
								</div>
								<div class="banner-content">
									<span class="word1">Hoàn Hảo</span>
									<span class="word2">Nguyên liệu vật tư</span>
									<span class="word3"></span>
								</div>
							</a>
						</div>


					</div>
				</div>
			</div>
		</section>
		<section id="home-flash-sale">
			<div class="wrapper">
				<div class="inner">
					<div class="home-section-head">
						<h2 class="section-title">
							<span>Khuyến mãi</span>
						</h2>
					</div>
					<div class="home-section-body">
						<div class="section-desc">
							Tất cả các sản phẩm khuyến mãi của cửa hàng chúng tôi
						</div>

						<div class="home-collection-countdown">
							<div class="countdown-days">
								<div id="days">
									0
								</div>
								<div>
									Ngày
								</div>
							</div>
							<div class="countdown-hrs">
								<div id="hrs">
									0
								</div>
								<div>
									Giờ
								</div>
							</div>
							<div class="countdown-mins">
								<div id="mins">
									0
								</div>
								<div>
									Phút
								</div>
							</div>
							<div class="countdown-secs">
								<div id="secs">
									0
								</div>
								<div>
									Giây
								</div>
							</div>
						</div>

						<div class="hfs-product-wrapper">
							<div id="owl-home-flash-sale" class="owl-carousel owl-theme">
								@foreach($productmaymocs as $k=>$v)
								<div class="item">
									<div class="product-item">
										<div class="product-img sale-img">

											<a href="{{url('san-pham/'.@$v->id)}}">
												<img class="lazyload" src="{{url('uploads/products/'.@$v->image->name)}}" data-src="{{url('uploads/products/'.@$v->image->name)}}"
												 title="{{@$v->image->title}}" alt="{{@$v->image->alt}}" />

												<img class="lazyload" src="{{url('uploads/products/'.@$v->image->name)}}" data-src="{{url('uploads/products/'.@$v->image->name)}}"
												 title="{{@$v->image->title}}" alt="{{@$v->image->alt}}" />
											</a>
											<div class="product-actions medium--hide small--hide">
												<div>
													<button type="button" class="btnQuickView quick-view medium--hide small--hide" data-handle="/products/suplo-gas-gasoline-petrol-fuel-filter-oe-23300-31100-186100-4730-replacement-parts-for-toyota-prado-4700-2700-3400-land-cruiser-3">
														<span>
															<i class="fa fa-search-plus" aria-hidden="true"></i></span>
													</button>
												</div>
											</div>

											<div class="tag-saleoff-img text-center">
												-0%
											</div>

										</div>
										<div class="product-item-info">
											<div class="product-title">
												<a href="products/suplo-gas-gasoline-petrol-fuel-filter-oe-23300-31100-186100-4730-replacement-parts-for-toyota-prado-4700-2700-3400-land-cruiser-3.html">{{@$v->product_name}}</a>
											</div>
											<div class="product-desc">
												{{str_limit(@$v->description, $limit = 150, $end = '...')}}
											</div>
										</div>
										<div class="product-buynow">
											<button type="button" class="btnAddToCart add-to-cart  medium--hide small--hide" data-id="{{@$v->id}}"><span>
													<i class="fa fa-cart-plus" aria-hidden="true"></i>
													Thêm vào giỏ</span></button>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="home-reviews">
			<div class="wrapper">
				<div class="inner">
					<div id="owl-home-reviews" class="owl-carousel owl-theme">


						<div class="item">
							<div class="review-item">
								<div class="review-img">
									<img src="http://suachuabepdien.com/mediacenter/media/files/2582/banners/334_1536137248_5335b8f98206d61f.jpg" alt="Chị: Mai Anh">
								</div>
								<div class="review-content">
									Sản phẩm rất tốt, thời gian giao hàng nhanh, rất chuyên nghiệp.
								</div>
								<div class="review-username">
									Chị: Mai Anh
								</div>

								<div class="review-user-add">

									(Ba Đình, Hà Nội)

								</div>

							</div>
						</div>

						<div class="item">
							<div class="review-item">
								<div class="review-img">
									<img src="http://suachuabepdien.com/mediacenter/media/files/2582/banners/794_1536137231_155b8f980fb7402.jpg" alt="Phạm Ngọc Kha">
								</div>
								<div class="review-content">
									Đã mua nhiều lần sản phẩm bên công ty , tôi cảm thấy rất tốt về cả chất lượng và phong cách phục vụ. Chú quý công ty ngày càng phát triển.
								</div>
								<div class="review-username">
									Phạm Ngọc Kha
								</div>

								<div class="review-user-add">

									(Vũ Thư, Thái Bình)

								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
		</section>
		<section id="home-product" class="home-product">
			<div class="wrapper">
				<div class="inner">
					<div class="home-section-head">
						<h2 class="section-title">
							<span>Sản phẩm</span>
						</h2>
					</div>
					<div class="home-section-body">
						<div class="section-desc">
							Cùng tham quan các sản phẩm nỏi bật mới nhất của chúng tôi
						</div>
						<div class="tab clearfix text-center">
							@foreach($categoryparents as $k=>$v)
							<button class="pro-tablinks" onclick="openProTabs(event, 'collection{{$k}}')" id="defaultOpenProTabs">
								{{strtoupper($v->name)}}
							</button>
							@endforeach
						</div>
						@foreach($categoryparents as $k=>$v)
						<div id="collection{{$k}}" class="pro-tabcontent">
							<div class="grid-uniform md-mg-left-15">
								@foreach($v->products as $k2=>$v2)
								<div class="grid__item large--one-quarter medium--one-third small--one-half md-pd-left15">
									<div class="product-item">
										<div class="product-img ">
											<a href="{{url('san-pham/'.@$v2->id)}}">
											
												<img id="{{@$v2->image->id}}" class="only-one lazyload" src="{{url('uploads/products/'.@$v2->image->name)}}"
												 data-src="{{url('uploads/products/'.@$v2->image->name)}}" title="{{@$v2->image->title}}" alt="{{@$v2->image->alt}}" />
											</a>
											<div class="product-actions medium--hide small--hide">
												<div>
													<button type="button" class="btnQuickView quick-view medium--hide small--hide" data-handle="{{url('san-pham/'.@$v2->id)}}">
														<span> <i class="fa fa-search-plus" aria-hidden="true"></i></span>
													</button>
												</div>
											</div>
										</div>
										<div class="product-item-info">
											<div class="product-title">
												<a href="{{url('san-pham/'.@$v2->id)}}">
													{{$v2->product_name}}</a>
											</div>
											<div class="product-desc" style="display: block">
												{{str_limit(@$v2->description, $limit = 150, $end = '...')}}
											</div>
										</div>
										<div class="product-buynow">
											<button type="button" {{$v2->made_to_order?"":"disabled"}} class="btnAddToCart  medium--hide small--hide"
											 data-id=""><span>{{$v2->made_to_order?"Còn hàng":"Hết hàng"}}</span></button>
										</div>
									</div>
								</div>
								@endforeach
								@foreach($v->categories as $k1=>$v1)
								@foreach($v1->products as $k2=>$v2)
								<div class="grid__item large--one-quarter medium--one-third small--one-half md-pd-left15">
									<div class="product-item">
										<div class="product-img  sanpham-img">
											<a href="{{url('san-pham/'.@$v2->id)}}">
											
												<img id="{{@$v2->image->id}}" class="only-one lazyload" src="{{url('uploads/products/'.@$v2->image->name)}}"
												 data-src="{{url('uploads/products/'.@$v2->image->name)}}" title="{{@$v2->image->title}}" alt="{{@$v2->image->alt}}" />
											</a>
											<div class="product-actions medium--hide small--hide">
												<div>
													<button type="button" class="btnQuickView quick-view medium--hide small--hide" data-handle="/products/suplo-smart-gravity-holder-cute-mount-10w-fast-wireless-car-charger-bracket-car-accessories-7">
														<span> <i class="fa fa-search-plus" aria-hidden="true"></i></span>
													</button>
												</div>
											</div>
										</div>
										<div class="product-item-info">
											<div class="product-title">
												<a href="{{url('san-pham/'.@$v2->id)}}">
													{{$v2->product_name}}</a>
											</div>
											<div class="product-desc" style="display: block">
												{{str_limit(@$v2->description, $limit = 150, $end = '...')}}
											</div>
										</div>
										<div class="product-buynow">
											<button type="button" {{$v2->made_to_order?"":"disabled"}} class="btnAddToCart  medium--hide small--hide"
											 data-id=""><span>{{$v2->made_to_order?"Còn hàng":"Hết hàng"}}</span></button>
										</div>
									</div>
								</div>
								@endforeach
								@endforeach
							</div>

							<div class="collection-btn">
								<a href="{{url('categorys/'.$v->slug)}}" class="btn btnViewMore">Xem tất cả</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</section>
		<section id="home-collection">
			<div class="grid mg-left-0">
				<div class="grid__item large--one-half medium--one-half small--one-whole pd-left0">
					<div class="collection-item">
						<a href="#">
							<div class="collection-img">
								<img src="http://theme.hstatic.net/1000305059/1000394224/14/home_col_img1.jpg?v=3593" alt="Sản phẩm mới">
							</div>
							<div class="collection-text text-center">
								<div class="collection-title">
									Sản phẩm mới
								</div>
								<div class="collection-desc">
									Thời trang và hiện đại
								</div>
								<div class="collection-content">
									Sau một vài hình ảnh hé lộ trước đó, hãng xe Mỹ vừa chính thức giới thiệu Chevrolet Orlando 2019 ra thị
									trường Trung Quốc với thiết kế hoàn toàn mới.
								</div>
								<div class="collection-btn">
									<span class="col-btn">Xem thêm<span><i class="fas fa-chevron-right"></i></span></span>
								</div>
							</div>
						</a>
					</div>
				</div>
				<div class="grid__item large--one-half medium--one-half small--one-whole pd-left0">
					<div class="collection-item">
						<a href="#">
							<div class="collection-img">
								<img src="http://theme.hstatic.net/1000305059/1000394224/14/home_col_img2.jpg?v=3593" alt="Sản phẩm hot">
							</div>
							<div class="collection-text text-center">
								<div class="collection-title">
									Sản phẩm hot
								</div>
								<div class="collection-desc">
									Mạnh mẽ và cá tính
								</div>
								<div class="collection-content">
									Sau một vài hình ảnh hé lộ trước đó, hãng xe Mỹ vừa chính thức giới thiệu Chevrolet Orlando 2019 ra thị
									trường Trung Quốc với thiết kế hoàn toàn mới.
								</div>
								<div class="collection-btn">
									<span class="col-btn">Xem thêm<span><i class="fas fa-chevron-right"></i></span></span>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</section>
		<section id="home-policy">
			<div class="wrapper">
				<div class="inner">
					<div class="grid-uniform">
						<div class="grid__item large--one-third medium--one-third small--one-whole">
							<div class="policy-item">
								<div class="policy-content">
									<h2 class="policy-title">
										<a href="pages/about-us.html">Giao hàng</a>
									</h2>
									<div class="policy-desc">
										Giao hàng nhanh chóng chính xác . Miễn phí giao hàng
									</div>
								</div>
								<div class="policy-icon">
									<img src="http://theme.hstatic.net/1000305059/1000394224/14/policy_icon1.png?v=3593" alt="Giao hàng">
								</div>
							</div>
						</div>
						<div class="grid__item large--one-third medium--one-third small--one-whole">
							<div class="policy-item">
								<div class="policy-content">
									<h2 class="policy-title">
										<a href="pages/about-us.html">Thanh toán</a>
									</h2>
									<div class="policy-desc">
										Chấp nhận thanh toán bằng thẻ, tiền mặt hoặc các hình thức khác
									</div>
								</div>
								<div class="policy-icon">
									<img src="http://theme.hstatic.net/1000305059/1000394224/14/policy_icon2.png?v=3593" alt="Thanh toán">
								</div>
							</div>
						</div>
						<div class="grid__item large--one-third medium--one-third small--one-whole">
							<div class="policy-item">
								<div class="policy-content">
									<h2 class="policy-title">
										<a href="pages/about-us.html">Hỗ trợ</a>
									</h2>
									<div class="policy-desc">
										Luôn luôn hỗ trợ online khách hàng 24/7 với tổng đài của chúng tôi
									</div>
								</div>
								<div class="policy-icon">
									<img src="http://theme.hstatic.net/1000305059/1000394224/14/policy_icon3.png?v=3593" alt="Hỗ trợ">
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>
		<section id="home-articles">
			<div class="wrapper">
				<div class="inner">
					<div class="home-section-head">
						<h2 class="section-title">
							<span>Tin tức</span>
						</h2>
					</div>
					<div class="home-section-body">
						<div class="section-desc">
							Các tin tức mới nhất và hot nhất về thế giới công nghệ xe hơi
						</div>

						<div id="owl-home-articles" class="owl-carousel owl-theme">

							<div class="item">
								<div class="article-item">
									<div class="grid mg-left-10">
										<div class="grid__item large--one-half medium--one-whole small--one-whole pd-left10">
											<div class="article-img">
												<a href="#">
													<img src="http://file.hstatic.net/1000305059/article/article_img711_large.jpg" alt="Siêu xe nửa triệu USD có nguy cơ rơi bánh ra đường" />
												</a>
											</div>
										</div>
										<div class="grid__item large--one-half medium--one-whole small--whole pd-left10">
											<div class="article-info-wrapper">
												<div class="article-info">
													<div class="article-date">
														<span class="article-day">17</span>/
														<span>08</span>/
														<span>2018</span>
													</div>
													<div class="article-title">
														<a href="#">Siêu xe nửa triệu USD có
															nguy cơ rơi bánh ra đường</a>
													</div>
													<div class="article-author">
														<i class="far fa-edit"></i> Đăng bởi: <span>Suplo Bạc</span>
													</div>
													<div class="article-comment">
														<i class="far fa-comments"></i> <span class="fb-comments-count" data-href="#"></span>
													</div>
												</div>
												<div class="article-desc medium--hide small--hide">

													Thông thường những mẫu xe thương mại sẽ dựa trên một bản concept khi sản xuất, tuy nhiên một số khác lại
													có gốc gác là những chiếc xe đua...

												</div>
												<a href="#" class="article-btn">Xem thêm</a>
											</div>
										</div>
									</div>
								</div>


							</div>

							<div class="item">
								<div class="article-item">
									<div class="grid mg-left-10">
										<div class="grid__item large--one-half medium--one-whole small--one-whole pd-left10">
											<div class="article-img">
												<a href="#">
													<img src="http://file.hstatic.net/1000305059/article/article_img6111_large.jpg" alt="BMW i8 hầm hố của xưởng độ AC Schnitzer" />
												</a>
											</div>
										</div>
										<div class="grid__item large--one-half medium--one-whole small--whole pd-left10">
											<div class="article-info-wrapper">
												<div class="article-info">
													<div class="article-date">
														<span class="article-day">17</span>/
														<span>08</span>/
														<span>2018</span>
													</div>
													<div class="article-title">
														<a href="#">BMW i8 hầm hố của xưởng độ AC
															Schnitzer</a>
													</div>
													<div class="article-author">
														<i class="far fa-edit"></i> Đăng bởi: <span>Suplo Bạc</span>
													</div>
													<div class="article-comment">
														<i class="far fa-comments"></i> <span class="fb-comments-count" data-href="#"></span>
													</div>
												</div>
												<div class="article-desc medium--hide small--hide">

													Thông thường những mẫu xe thương mại sẽ dựa trên một bản concept khi sản xuất, tuy nhiên một số khác lại
													có gốc gác là những chiếc xe đua...

												</div>
												<a href="#" class="article-btn">Xem thêm</a>
											</div>
										</div>
									</div>
								</div>


							</div>

							<div class="item">
								<div class="article-item">
									<div class="grid mg-left-10">
										<div class="grid__item large--one-half medium--one-whole small--one-whole pd-left10">
											<div class="article-img">
												<a href="blogs/news/lexus-lc-co-them-ban-gioi-han-se-xuat-hien-tai-paris-motor-show.html">
													<img src="http://file.hstatic.net/1000305059/article/article_img511_large.jpg" alt="Lexus LC có thêm bản giới hạn, sẽ xuất hiện tại Paris Motor Show Thông thường những mẫu xe thương mại sẽ dựa trên một bản concept" />
												</a>
											</div>
										</div>
										<div class="grid__item large--one-half medium--one-whole small--whole pd-left10">
											<div class="article-info-wrapper">
												<div class="article-info">
													<div class="article-date">
														<span class="article-day">16</span>/
														<span>08</span>/
														<span>2018</span>
													</div>
													<div class="article-title">
														<a href="blogs/news/lexus-lc-co-them-ban-gioi-han-se-xuat-hien-tai-paris-motor-show.html">Lexus LC có
															thêm bản giới hạn, sẽ xuất hiện tại Paris Motor Show Thông thườ...</a>
													</div>
													<div class="article-author">
														<i class="far fa-edit"></i> Đăng bởi: <span>Suplo Bạc</span>
													</div>
													<div class="article-comment">
														<i class="far fa-comments"></i> <span class="fb-comments-count" data-href="blogs/news/lexus-lc-co-them-ban-gioi-han-se-xuat-hien-tai-paris-motor-show.html"></span>
													</div>
												</div>
												<div class="article-desc medium--hide small--hide">

													Thông thường những mẫu xe thương mại sẽ dựa trên một bản concept khi sản xuất, tuy nhiên một số khác lại
													có gốc gác là những chiếc xe đua...

												</div>
												<a href="blogs/news/lexus-lc-co-them-ban-gioi-han-se-xuat-hien-tai-paris-motor-show.html" class="article-btn">Xem
													thêm</a>
											</div>
										</div>
									</div>
								</div>


							</div>

							<div class="item">
								<div class="article-item">
									<div class="grid mg-left-10">
										<div class="grid__item large--one-half medium--one-whole small--one-whole pd-left10">
											<div class="article-img">
												<a href="blogs/news/xe-dua-dien-spice-x-sx1-gia-binh-dan-tu-italy.html">
													<img src="http://file.hstatic.net/1000305059/article/article_img4111_large.jpg" alt="Xe đua điện Spice-X SX1 giá bình dân từ Italy" />
												</a>
											</div>
										</div>
										<div class="grid__item large--one-half medium--one-whole small--whole pd-left10">
											<div class="article-info-wrapper">
												<div class="article-info">
													<div class="article-date">
														<span class="article-day">16</span>/
														<span>08</span>/
														<span>2018</span>
													</div>
													<div class="article-title">
														<a href="blogs/news/xe-dua-dien-spice-x-sx1-gia-binh-dan-tu-italy.html">Xe đua điện Spice-X SX1 giá bình
															dân từ Italy</a>
													</div>
													<div class="article-author">
														<i class="far fa-edit"></i> Đăng bởi: <span>Suplo Bạc</span>
													</div>
													<div class="article-comment">
														<i class="far fa-comments"></i> <span class="fb-comments-count" data-href="blogs/news/xe-dua-dien-spice-x-sx1-gia-binh-dan-tu-italy.html"></span>
													</div>
												</div>
												<div class="article-desc medium--hide small--hide">

													Thông thường những mẫu xe thương mại sẽ dựa trên một bản concept khi sản xuất, tuy nhiên một số khác lại
													có gốc gác là những chiếc xe đua...

												</div>
												<a href="blogs/news/xe-dua-dien-spice-x-sx1-gia-binh-dan-tu-italy.html" class="article-btn">Xem thêm</a>
											</div>
										</div>
									</div>
								</div>


							</div>

							<div class="item">
								<div class="article-item">
									<div class="grid mg-left-10">
										<div class="grid__item large--one-half medium--one-whole small--one-whole pd-left10">
											<div class="article-img">
												<a href="blogs/news/ban-mot-chiec-sieu-xe-ferrari-thu-loi-80-000-usd.html">
													<img src="http://file.hstatic.net/1000305059/article/article_img311_large.jpg" alt="Bán một chiếc siêu xe, Ferrari thu lời 80.000 USD" />
												</a>
											</div>
										</div>
										<div class="grid__item large--one-half medium--one-whole small--whole pd-left10">
											<div class="article-info-wrapper">
												<div class="article-info">
													<div class="article-date">
														<span class="article-day">16</span>/
														<span>08</span>/
														<span>2018</span>
													</div>
													<div class="article-title">
														<a href="blogs/news/ban-mot-chiec-sieu-xe-ferrari-thu-loi-80-000-usd.html">Bán một chiếc siêu xe,
															Ferrari thu lời 80.000 USD</a>
													</div>
													<div class="article-author">
														<i class="far fa-edit"></i> Đăng bởi: <span>Suplo Bạc</span>
													</div>
													<div class="article-comment">
														<i class="far fa-comments"></i> <span class="fb-comments-count" data-href="blogs/news/ban-mot-chiec-sieu-xe-ferrari-thu-loi-80-000-usd.html"></span>
													</div>
												</div>
												<div class="article-desc medium--hide small--hide">

													Thông thường những mẫu xe thương mại sẽ dựa trên một bản concept khi sản xuất, tuy nhiên một số khác lại
													có gốc gác là những chiếc xe đua...

												</div>
												<a href="blogs/news/ban-mot-chiec-sieu-xe-ferrari-thu-loi-80-000-usd.html" class="article-btn">Xem thêm</a>
											</div>
										</div>
									</div>
								</div>


							</div>

							<div class="item">
								<div class="article-item">
									<div class="grid mg-left-10">
										<div class="grid__item large--one-half medium--one-whole small--one-whole pd-left10">
											<div class="article-img">
												<a href="blogs/news/anh-mitsubishi-xpander-gia-tot-thiet-ke-dep-dong-co-nho-1.html">
													<img src="http://file.hstatic.net/1000305059/article/article_img2_large.jpg" alt="Ảnh Mitsubishi Xpander: Giá tốt, thiết kế đẹp, động cơ nhỏ" />
												</a>
											</div>
										</div>
										<div class="grid__item large--one-half medium--one-whole small--whole pd-left10">
											<div class="article-info-wrapper">
												<div class="article-info">
													<div class="article-date">
														<span class="article-day">10</span>/
														<span>08</span>/
														<span>2018</span>
													</div>
													<div class="article-title">
														<a href="blogs/news/anh-mitsubishi-xpander-gia-tot-thiet-ke-dep-dong-co-nho-1.html">Ảnh Mitsubishi
															Xpander: Giá tốt, thiết kế đẹp, động cơ nhỏ</a>
													</div>
													<div class="article-author">
														<i class="far fa-edit"></i> Đăng bởi: <span>Suplo Bạc</span>
													</div>
													<div class="article-comment">
														<i class="far fa-comments"></i> <span class="fb-comments-count" data-href="blogs/news/anh-mitsubishi-xpander-gia-tot-thiet-ke-dep-dong-co-nho-1.html"></span>
													</div>
												</div>
												<div class="article-desc medium--hide small--hide">

													Thông thường những mẫu xe thương mại sẽ dựa trên một bản concept khi sản xuất, tuy nhiên một số khác lại
													có gốc gác là những chiếc xe đua...

												</div>
												<a href="blogs/news/anh-mitsubishi-xpander-gia-tot-thiet-ke-dep-dong-co-nho-1.html" class="article-btn">Xem
													thêm</a>
											</div>
										</div>
									</div>
								</div>


							</div>

							<div class="item">
								<div class="article-item">
									<div class="grid mg-left-10">
										<div class="grid__item large--one-half medium--one-whole small--one-whole pd-left10">
											<div class="article-img">
												<a href="blogs/news/bo-doi-peugeot-5008-3008-tang-thoi-han-bao-hanh-chinh-hang-len-5-nam.html">
													<img src="http://file.hstatic.net/1000305059/article/article_img1_large.jpg" alt="10 mẫu xe thương mại có xuất thân từ xe đua" />
												</a>
											</div>
										</div>
										<div class="grid__item large--one-half medium--one-whole small--whole pd-left10">
											<div class="article-info-wrapper">
												<div class="article-info">
													<div class="article-date">
														<span class="article-day">10</span>/
														<span>08</span>/
														<span>2018</span>
													</div>
													<div class="article-title">
														<a href="blogs/news/bo-doi-peugeot-5008-3008-tang-thoi-han-bao-hanh-chinh-hang-len-5-nam.html">10 mẫu xe
															thương mại có xuất thân từ xe đua</a>
													</div>
													<div class="article-author">
														<i class="far fa-edit"></i> Đăng bởi: <span>Suplo Bạc</span>
													</div>
													<div class="article-comment">
														<i class="far fa-comments"></i> <span class="fb-comments-count" data-href="blogs/news/bo-doi-peugeot-5008-3008-tang-thoi-han-bao-hanh-chinh-hang-len-5-nam.html"></span>
													</div>
												</div>
												<div class="article-desc medium--hide small--hide">

													Thông thường những mẫu xe thương mại sẽ dựa trên một bản concept khi sản xuất, tuy nhiên một số khác lại
													có gốc gác là những chiếc xe đua...

												</div>
												<a href="blogs/news/bo-doi-peugeot-5008-3008-tang-thoi-han-bao-hanh-chinh-hang-len-5-nam.html" class="article-btn">Xem
													thêm</a>
											</div>
										</div>
									</div>
								</div>


							</div>

						</div>

					</div>
				</div>
			</div>
		</section>
		<section id="home-service">
			<div class="home-section-head">
				<div class="wrapper">
					<div class="inner">
						<h2 class="section-title">
							<span>Dịch vụ</span>
						</h2>
					</div>
				</div>
			</div>
			<div class="section-desc text-center">
				<div class="wrapper">
					<div class="inner">
						Dịch vụ chăm sóc khách hàng đa dạng và phong phú
					</div>
				</div>
			</div>
			<div class="home-section-body">
				<div class="service-video medium--hide small--hide">
					<iframe width="100%" allowfullscreen="1" src="https://www.youtube.com/embed/5J-V4hAZt74?&amp;autoplay=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;loop=1&amp;mute=1"
					 frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
				</div>
				<div class="service-bg medium--hide small--hide"></div>
				<div class="wrapper">
					<div class="inner">
						<div id="owl-service" class="owl-carousel owl-theme">
							<div class="item">
								<div class="service-item">
									<div class="service-img">
										<img class="not-hover" src="http://theme.hstatic.net/1000305059/1000394224/14/service_img1.png?v=3593" alt="Thay dầu">
										<img class="hover" src="http://theme.hstatic.net/1000305059/1000394224/14/service_img_hover1.png?v=3593" alt="Thay dầu">
									</div>
									<div class="service-content">
										<div class="service-title">
											Nội thất xế yêu
										</div>
										<div class="service-desc">
											Dịch vụ chăm sóc khách hàng đa dạng và phong phú
										</div>
										<a href="productcategory/o-to" class="service-viewmore">
											Xem thêm
										</a>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="service-item">
									<div class="service-img">
										<img class="not-hover" src="http://theme.hstatic.net/1000305059/1000394224/14/service_img2.png?v=3593" alt="Lắp camera">
										<img class="hover" src="http://theme.hstatic.net/1000305059/1000394224/14/service_img_hover2.png?v=3593" alt="Lắp camera">
									</div>
									<div class="service-content">
										<div class="service-title">
											Máy móc & công nghệ
										</div>
										<div class="service-desc">
											Dịch vụ chăm sóc khách hàng đa dạng và phong phú
										</div>
										<a href="#" class="service-viewmore">
											Xem thêm
										</a>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="service-item">
									<div class="service-img">
										<img class="not-hover" src="http://theme.hstatic.net/1000305059/1000394224/14/service_img3.png?v=3593" alt="Bọc xe">
										<img class="hover" src="http://theme.hstatic.net/1000305059/1000394224/14/service_img_hover3.png?v=3593" alt="Bọc xe">
									</div>
									<div class="service-content">
										<div class="service-title">
											Vật tư nguyên liệu
										</div>
										<div class="service-desc">
											Dịch vụ chăm sóc khách hàng đa dạng và phong phú
										</div>
										<a href="productcategory/nguyen-lieu-vat-tu" class="service-viewmore">
											Xem thêm
										</a>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="service-item">
									<div class="service-img">
										<img class="not-hover" src="http://theme.hstatic.net/1000305059/1000394224/14/service_img4.png?v=3593" alt="Bổ xe">
										<img class="hover" src="http://theme.hstatic.net/1000305059/1000394224/14/service_img_hover4.png?v=3593" alt="Bổ xe">
									</div>
									<div class="service-content">
										<div class="service-title">
											Bảo dưỡng máy móc
										</div>
										<div class="service-desc">
											Dịch vụ chăm sóc khách hàng đa dạng và phong phú
										</div>
										<a href="productcategory/nguyen-lieu-vat-tu" class="service-viewmore">
											Xem thêm
										</a>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="service-item">
									<div class="service-img">
										<img class="not-hover" src="http://theme.hstatic.net/1000305059/1000394224/14/service_img5.png?v=3593" alt="Bảo dưỡng">
										<img class="hover" src="http://theme.hstatic.net/1000305059/1000394224/14/service_img_hover5.png?v=3593" alt="Bảo dưỡng">
									</div>
									<div class="service-content">
										<div class="service-title">
											Liên Hệ Tư Vấn
										</div>
										<div class="service-desc">
											Dịch vụ chăm sóc khách hàng đa dạng và phong phú
										</div>
										<a href="lien-he" class="service-viewmore">
											Xem thêm
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="home-brand">
			<div class="wrapper">
				<div class="inner">
					<div class="home-section-head">
						<h2 class="section-title">
							<span>Thương hiệu</span>
						</h2>
					</div>
					<div class="home-section-body">
						<div class="section-desc">
							Các thương hiệu mà cửa hàng chúng tôi đang cung cấp
						</div>
						<div id="owl-brand" class="owl-carousel owl-theme">
							<div class="item">
								<a href="" class="brand-item">
									<img src="http://theme.hstatic.net/1000305059/1000394224/14/brand_img1.png?v=3593" alt="Brand 1">
								</a>
							</div>
							<div class="item">
								<a href="" class="brand-item">
									<img src="http://theme.hstatic.net/1000305059/1000394224/14/brand_img2.png?v=3593" alt="Brand 2">
								</a>
							</div>
							<div class="item">
								<a href="" class="brand-item">
									<img src="http://theme.hstatic.net/1000305059/1000394224/14/brand_img3.png?v=3593" alt="Brand 3">
								</a>
							</div>
							<div class="item">
								<a href="" class="brand-item">
									<img src="http://theme.hstatic.net/1000305059/1000394224/14/brand_img4.png?v=3593" alt="Brand 4">
								</a>
							</div>
							<div class="item">
								<a href="" class="brand-item">
									<img src="http://theme.hstatic.net/1000305059/1000394224/14/brand_img5.png?v=3593" alt="Brand 5">
								</a>
							</div>
							<div class="item">
								<a href="" class="brand-item">
									<img src="http://theme.hstatic.net/1000305059/1000394224/14/brand_img6.png?v=3593" alt="Brand 6">
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="home-newsletters">
			<div class="wrapper">
				<div class="inner">
					<div class="newsletters-text">
						<div class="newsletters-title1">
							Những sản phẩm đặc biệt
						</div>
						<div class="newsletters-title2">
							<h2>
								Đăng kí nhận tin tức cùng chúng tôi
							</h2>
						</div>
						<div class="newsletters-desc">
							Nhập email để đăng kí nhận những tin tức về sản phẩm mới nhất của chúng tôi nhé
						</div>
					</div>
					<div class="sub-wrapper">

						<form accept-charset='UTF-8' action='https://suplo-car-accesories.myharavan.com/account/contact' class='contact-form'
						 method='post'>
							<input name='form_type' type='hidden' value='customer'>
							<input name='utf8' type='hidden' value='✓'>



							<input type="email" value="" placeholder="Nhập email..." name="contact[email]" id="Email" aria-label="email@example.com">
							<input type="hidden" name="contact[tags]" value="newsletter">
							<button type="submit" name="subscribe" id="subscribe" value="GỬI"><i class="fa fa-angle-right"></i></button>


						</form>

					</div>
				</div>
			</div>
		</section>
	</main>
</div>
@endsection