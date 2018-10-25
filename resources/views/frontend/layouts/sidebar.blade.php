<style>
	.grid__item.large--one-whole.medium--one-half.small--one-whole.pd-left10 ul li a{color: #000000;}
</style>
<div class="grid__item large--one-quarter medium--one-whole small--one-whole">
					<div class="collection-sidebar-wrapper">
	<div class="grid-uniform mg-left-10">
		
		
		<div class="grid__item large--one-whole medium--one-half small--one-whole pd-left10">
			<div class="collection-categories">
				<button class="accordion cs-title col-sb-trigger">
					<span>Danh mục</span>
				</button>
				<div class="">
					<ul class="no-bullets">
						<li>
							<a href="{{url('/')}}">Trang chủ</a>
						</li>
						
						<li>
							<a href="#">Sản phẩm của chúng tôi</a>
							
							<ul class="no-bullets">
								@foreach($categorys as $k=>$v)
								@if(empty($v->parent_id))
									<li>
									<a href="{{url('productcategory/'.$v->slug)}}">
									   - {{$v->name}}
									</a>
									<ul class="no-bullets">
										@foreach($v->categories as $k1=>$v1)
											<li>
												+<a href="{{url('productcategory/'.$v1->slug)}}"> {{$v1->name}}</a>
											</li>
										@endforeach
									</ul>
									</li>
								@endif
                            @endforeach
							</ul>
							
						</li>
						
						<li>
							<a href="{{url('/lien-he')}}">Liên hệ</a>
							
						</li>
						
						<li>
							<a href="{{url('/lien-he')}}">Blog</a>
							
							<ul class="no-bullets">
								
								
								<li>
									<a href="../blogs/news.html">- Công nghệ ô tô</a>
								</li>
								
								
								<li>
									<a href="../blogs/tin-sieu-xe.html">- Siêu xe</a>
								</li>
								
								
								<li>
									<a href="../blogs/hoi-choi-xe.html">- Hội chơi xe</a>
								</li>
								
								
								<li>
									<a href="../blogs/huong-dan-bao-quan-xe.html">- Bảo quản ô tô</a>
								</li>
								
							</ul>
							
						</li>
						
						<li>
							<a href="{{url('gioi-thieu')}}">Về chúng tôi</a>
							
						</li>
						
						<li>
							<a href="#">Hướng dẫn mua hàng</a>
							
						</li>
						
						<li>
							<a href="#">Hệ thống cửa hàng</a>
							
						</li>
						
					</ul>
				</div>
			</div>
		</div>
		
		

		
	</div>
</div>
</div>