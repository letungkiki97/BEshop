<div class="header-desktop">
	<div class="inner">
		<div class="header-logo">
			<h1>
				<a href="{{url('/')}}">
					{{@Settings::get('site_name')}}
					@if (Settings::get('site_logo'))
						<img src="{{asset('uploads/site'). '/' . Settings::get('site_logo')}}" style="max-height: 45px">
					@else
					<img src="http://theme.hstatic.net/1000305059/1000394224/14/logo.png?v=3593"
					 alt="Suplo Car | Cửa hàng phụ kiện,đồ chơi, nội thất xe hơi chính hãng" />
					@endif
				</a>
			</h1>
		</div>
		<div class="header-navbar-wrapper">
			<div class="header-navbar text-right">
				<ul class="no-bullets">
					<li class="active ">
						<a href="{{url('/')}}" class="text-center">
							<span>Trang chủ</span>
						</a>
					</li>
					<li class=" megamenu">
						<a href="" class="text-center">
							<span>Sản phẩm của chúng tôi</span>
							<i class="fas fa-caret-down"></i>
						</a>

						<ul class="no-bullets megamenu-menu clearfix">
                            @foreach($categorys as $k=>$v)
								@if(empty($v->parent_id))
								<li>
								<a href="{{url('productcategory/'.$v->slug)}}">
								   {{$v->name}}
								</a>
									<ul class="no-bullets">
										@foreach($v->categories as $k1=>$v1)
											<li>
												<a href="{{url('productcategory/'.$v1->slug)}}"> {{$v1->name}}</a>
											</li>
										@endforeach
									</ul>
								</li>
								@endif
                            @endforeach
						</ul>
					</li>
					<li class=" ">
						<a href="{{url('/lien-he')}}" class="text-center">
							<span>Liên hệ</span>
						</a>
					</li>
					<li class=" dropdown">
						<a href="{{url('/blog')}}" class="text-center">
							<span>Blog</span>
							<i class="fas fa-caret-down"></i>
						</a>

						<ul class="no-bullets dropdown-menu">

							<li>
								<a href="blogs/news.html">
									Công nghệ ô tô
									<i class="fas fa-caret-right"></i>
								</a>

								<ul class="no-bullets">

									<li>
										<a href="blogs/news.html"> Thế giới siêu xe</a>
									</li>

									<li>
										<a href="blogs/news.html"> Độ xe</a>
									</li>

								</ul>

							</li>

							<li>
								<a href="blogs/tin-sieu-xe.html">
									Siêu xe

								</a>

							</li>

							<li>
								<a href="blogs/hoi-choi-xe.html">
									Hội chơi xe
									<i class="fas fa-caret-right"></i>
								</a>

								<ul class="no-bullets">

									<li>
										<a href="blogs/hoi-choi-xe.html"> Hội chơi xe Hà Nội</a>
									</li>

									<li>
										<a href="blogs/hoi-choi-xe.html"> Hội chơi xe Sài Gòn</a>
									</li>

								</ul>

							</li>

							<li>
								<a href="blogs/huong-dan-bao-quan-xe.html">
									Bảo quản ô tô

								</a>

							</li>

						</ul>
					</li>
					<li class=" ">
						<a href="{{url('/gioi-thieu')}}" class="text-center">
							<span>Về chúng tôi</span>
						</a>
					</li>
					<li class=" ">
						<a href="#" class="text-center">
							<span>Hướng dẫn mua hàng</span>
						</a>
					</li>
					<li class=" ">
						<a href="#" class="text-center">
							<span>Hệ thống cửa hàng</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="header-right">
			<div class="header-search text-right">
				<a href="javascript:void(0)" class="text-center" id="search-btn">
					<span id="btn-s"><i class="fas fa-search"></i></span><span class="hide" id="btn-t"><i class="fas fa-times"></i></span>
				</a>
				<div class="dropdown-menu" id="search-dropdown">
					<div class="search-form-wrapper">
						<form method="get" action="{{url('search')}}" class="searchform-categoris ultimate-search">
							<div class="wpo-search">
								<div class="wpo-search-inner">
									<select class="select-collection" id="select-collection" name="product_type">
										<option value="0">Tất cả</option>
										@foreach($categotype as $k=>$v)
										<option value="{{$k}}">{{$v}}</option>
										@endforeach
									</select>
									<div class="input-group">
										<input id="searchtext" name="q" maxlength="40" class="form-control input-search" type="text" size="20"
										 placeholder="Tìm kiếm ...">
										<span class="input-group-btn">
											<button type="submit"><i class="fas fa-search"></i></button>
										</span>
									</div>
								</div>
							</div>
						</form>
					</div>

					<script>

						function selectSuggest(act) {

							cur = $('.smart-search-wrapper > .select').index();

							length = $('.smart-search-wrapper > a').length;

							if (act == 38) {

								if (cur == -1 || cur == 0)

									cur = length - 1;

								else

									cur = cur - 1;

							}


							if (act == 40) {

								if (cur == -1 || cur == length - 1)

									cur = 0;

								else

									cur = cur + 1;
							}

							$('.smart-search-wrapper>a').removeClass('select');

							$('.smart-search-wrapper>a:nth-child(' + (cur + 1) + ')').addClass('select');


							$('.ultimate-search input[name=q]').val($('.smart-search-wrapper>.select').attr('data-title'));
							return false;
						}


						(function ($) {
							$.fn.smartSearch = function (_option) {


								var o, issending = false,

									timeout = null;

								var option = {
									smartoffset: true, //auto calc offset

									searchoperator: '**', //** contain, *= begin with, =* end with

									searchfield: "title",

									searchwhen: 'keyup', //0: after keydown, 1: after keypress, after space

									searchdelay: 500, //delay time before load data

								};

								if (typeof (_option) !== 'undefined') {

									$.each(_option, function (i, v) {

										if (typeof (_option[i]) !== 'undefined') option[i] = _option[i];

									})
								}

								o = $(this);

								o.attr('autocomplete', 'off');

								this.bind(option.searchwhen, function (event) {

									if (event.keyCode == 38 || event.keyCode == 40) {

										return selectSuggest(event.keyCode);

									} else {

										$(".smart-search-wrapper." + option.wrapper).remove();

										clearTimeout(timeout);

										timeout = setTimeout(l, option.searchdelay, $(this).val());

									}

								});

								var l = function (t) {

									if (issending) return this;

									issending = true;

									coll = ''

									if (option.collection != null)

										coll = $(option.collection).val() + "&&";

									$.ajax({

										url: "/search?q=filter=(" + coll + "(" + option.searchfield + ":product" + option.searchoperator + t + "))&view=ultimate-search",

										dataType: "JSON",

										async: false,

										success: function (data) {

											if ($('.smart-search-wrapper.' + option.wrapper).length == 0) {

												$('.search-form-wrapper').append("<div class='smart-search-wrapper " + option.wrapper + "'></div>");

											}

											p();

											$.each(data, function (i, v) {

												$(".smart-search-wrapper." + option.wrapper).append("<a data-title='" + v.title + "'class='thumbs' href='" + v.url + "'> <img src='" + Haravan.resizeImage(v.featured_image, 'icon') + "'/></a><a data-title='" + v.title + "' href='" + v.url + "'>" + v.title + "<span class='price-search'>" + Haravan.formatMoney(v.price, '') + "đ</span></a>");

											});

											issending = false;

										},

										error: function (xhr, ajaxOptions, thrownError) {

											//alert(xhr.status);

											//alert(thrownError);

										}

									});

								}

								$(window).resize(function () {

									p();

								});

								$(window).scroll(function () {

									p();

								});

								$(this).blur(function () {

									$('.smart-search-wrapper.' + option.wrapper).slideUp();

								});

								var p = function () {

									if (!o.offset()) {

										return;

									}


									$(".smart-search-wrapper." + option.wrapper).css("width", "100%");

									$(".smart-search-wrapper." + option.wrapper).css("left", o.offset().left + "px");

									if (option.smartoffset) {


										h = $(".smart-search-wrapper." + option.wrapper).height();

										if (h + o.offset().top - $(window).scrollTop() + o.outerHeight() > $(window).height()) {

											$(".smart-search-wrapper." + option.wrapper).css('top', '');


											$(".smart-search-wrapper." + option.wrapper).css('bottom', ($(window).scrollTop() + $(window).height() - o.offset().top) + "px");

										} else {

											$(".smart-search-wrapper." + option.wrapper).css('bottom', '');

											$(".smart-search-wrapper." + option.wrapper).css('top', (o.offset().top - $(window).scrollTop() + o.outerHeight()) + "px");

										}

									} else {

										$(".smart-search-wrapper." + option.wrapper).css('top', h + o.offset().top);

									}

								}

								return this;

							};
						}(jQuery));



						jQuery('.ultimate-search input[name=q]').smartSearch({ searchdelay: 400, wrapper: 'search-wrapper', collection: '.collection_id' });


					</script>

					<style>
						.smart-search-wrapper>a.thumbs {
							width: 32px;
							display: inline-block;
							padding: 5px 0px;
						}



						.smart-search-wrapper>a.thumbs img {
							position: absolute;
							top: 0px;
							width: 32px;
							height: 35px;
							left: 0px;
						}

						.smart-search-wrapper {
							position: absolute;
							left: 0 !important;
							right: 0 !important;
							top: 100% !important;
							background: #fff;
							border: 1px solid rgb(215, 215, 215);
							border-top: none;
							z-index: 999;
						}

						.smart-search-wrapper>a {
							width: calc(100% - 32px);
							float: left;
							text-overflow: ellipsis;
							overflow: hidden;
							white-space: pre;
							color: #686767 !important;
							text-decoration: none;
							line-height: 29px;
							font-size: 13px;
							font-family: sans-serif;
							padding: 5px 160px 5px 5px;
							position: relative;
							height: 35px;
						}

						.smart-search-wrapper>a.select,
						.smart-search-wrapper>a:hover {
							background: -webkit-linear-gradient(left, #fff, #EAEAEA);
							/* For Safari 5.1 to 6.0 */
							background: -o-linear-gradient(left, #fff, #EAEAEA);
							/* For Opera 11.1 to 12.0 */
							background: -moz-linear-gradient(left, #fff, #EAEAEA);
							/* For Firefox 3.6 to 15 */
							background: linear-gradient(left, #fff, #EAEAEA);
							/* Standard syntax (must be last) */
							color: #000;
						}

						.smart-search-wrapper>a>span.price-search {
							position: absolute;
							right: 5px;
							top: 0px;
						}
					</style>




				</div>
			</div>
			<div class="header-account">
				<a href="javascript:void(0)" class="text-center" id="account-btn">
					<i class="fas fa-user"></i>
				</a>
				<div class="dropdown-menu" id="account-dropdown">
					<ul class="no-bullets">

						<li><a href="account/login.html">Đăng nhập</a></li>
						<li><a href="account/register.html">Đăng kí</a></li>

					</ul>
				</div>
			</div>
			<div class="desktop-cart-wrapper">
				<a href="javascript:void(0)" class="hd-cart">
					<i class="fas fa-shopping-cart"></i>
					<span class="hd-cart-count">0</span>
				</a>
				<div class="quickview-cart">
					<h3>

						Giỏ hàng trống

						<span class="btnCloseQVCart"><i class="fa fa-times" aria-hidden="true"></i></span>
					</h3>
					<ul class="no-bullets">

						<li>Bạn chưa có sản phẩm nào trong giỏ hàng!</li>

					</ul>

				</div>
			</div>
		</div>
	</div>
</div>
<div class="header-mobile">
	<div class="wrapper">
		<div class="inner">
			<div class="grid">
				<div class="grid__item large--one-third medium--one-third small--one-third">
					<div class="hd-logo text-left">

						<a href="index.html">
							<img src="{{asset('uploads/site'). '/' . Settings::get('site_logo')}}" alt="Tuấn Nguyên" />
						</a>

					</div>
				</div>
				<div class="clearfix grid__item large--two-thirds medium--two-thirds small--two-thirds clearfix text-right">
					<div class="hd-btnMenu">
						<a href="javascript:void(0)" class="icon-fallback-text site-nav__link js-drawer-open-right" aria-controls="NavDrawer"
						 aria-expanded="false">
							<i class="fas fa-bars"></i>
						</a>
					</div>
					<div class="desktop-cart-wrapper1">
						<a href="javascript:void(0)" class="hd-cart">
							<i class="fas fa-shopping-cart"></i>
							<span class="hd-cart-count">0</span>
						</a>
						<div class="quickview-cart">
							<h3>

								Giỏ hàng trống

								<span class="btnCloseQVCart"><i class="fa fa-times" aria-hidden="true"></i></span>
							</h3>
							<ul class="no-bullets">

								<li>Bạn chưa có sản phẩm nào trong giỏ hàng!</li>

							</ul>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>