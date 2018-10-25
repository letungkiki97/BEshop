@extends('frontend.layouts.master')
@section('title', 'Sản phẩm theo danh mục')
@section('Content')
@include('frontend.layouts.breadcrumb')
<div id="PageContainer" class="is-moved-by-drawer">
    <main class="main-content" role="main">
        <section id="collection-wrapper">
            <div class="wrapper">
                <div class="inner">
                    <div class="grid">
                        <div class="grid__item large--three-quarters medium--one-whole small--one-whole float-right">
                            <div class="collection-content-wrapper">
                                <div class="collection-head">
                                    <div class="grid">
                                        <div class="grid__item large--seven-twelfths medium--one-half small--one-whole">
                                            <div class="collection-title">
                                                <h1>Danh mục: {{$slug}}</h1>
                                            </div>
                                        </div>
                                        <div class="grid__item large--five-twelfths medium--one-half small--one-whole">
                                            <div class="collection-sorting-wrapper large--text-right medium--text-right">
                                                <!-- /snippets/collection-sorting.liquid -->
                                                <div class="form-horizontal">
                                                    <label for="SortBy">Sắp xếp</label>
                                                    <select name="SortBy" id="SortBy">
                                                        <option value="manual">Tùy chọn</option>
                                                        <option value="best-selling">Sản phẩm bán chạy</option>
                                                        <option value="title-ascending">Theo bảng chữ cái từ A-Z</option>
                                                        <option value="title-descending">Theo bảng chữ cái từ Z-A</option>
                                                        <option value="price-ascending">Giá từ thấp tới cao</option>
                                                        <option value="price-descending">Giá từ cao tới thấp</option>
                                                        <option value="created-descending">Mới nhất</option>
                                                        <option value="created-ascending">Cũ nhất</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="collection-body">
                                    <div class="grid-uniform product-list md-mg-left-5">
                                        @foreach($product as $k2=>$v2)
                                        <div class="grid__item large--one-third medium--one-third small--one-half md-pd-left5">
                                            <div class="product-item">
                                                <div class="product-img">
                                                    <a href="{{url('san-pham/'.@$v2->slug)}}">
                                                        <img id="{{@$v2->image->id}}" src="{{url('uploads/products/'.@$v2->image->name)}}"
                                                            title="{{@$v2->image->title}}" alt="{{@$v2->image->alt}}" />
                                                        <img id="{{@$v2->image->id}}" src="{{url('uploads/products/'.@$v2->image->name)}}"
                                                            title="{{@$v2->image->title}}" alt="{{@$v2->image->alt}}" />
                                                    </a>
                                                    <div class="product-actions medium--hide small--hide">
                                                        <div>
                                                            <button type="button" class="btnQuickView quick-view medium--hide small--hide"
                                                                data-handle="{{url('san-pham/'.@$v2->slug)}}">
                                                                <span>
                                                                    <i class="fa fa-search-plus" aria-hidden="true"></i>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="product-item-info">
                                                    <div class="product-title">
                                                        <a href="{{url('san-pham/'.@$v2->slug)}}">
                                                                {{$v2->product_name}}</a>
                                                    </div>
                                                    <div class="product-desc" style="display: block">
                                                            {{str_limit(@$v2->description, $limit = 150, $end = '...')}}
                                                    </div>
                                                    <div class="product-buynow">
                                                        <button type="button" class="btnAddToCart add-to-cart  medium--hide small--hide"
                                                        data-id="1031663692">
                                                        <span><i class="fa fa-cart-plus"
                                                                aria-hidden="true"></i> Thêm vào giỏ</span>
                                                            </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <style type="text/css">
                                        .pagination-custom > span.current a{
                                            color: unset;
                                            border:unset;
                                            background: unset;
                                        }
                                    </style>
                                    <div class="pagination not-filter">
                                        <div id="pagination-" class="text-center clear-left">
                                            <div class="pagination-custom">
                                                @if ($product->lastPage() > 1)
                                                @for ($i = 1; $i <= $product->lastPage(); $i++)
                                                 <span class="page {{ ($product->currentPage() == $i) ? ' current' : '' }}">
                                                    <a href="{{ $product->url($i) }}">{{ $i }}</a>
                                                </span>
                                                @endfor
                                                    @if(!($product->currentPage() == $product->lastPage()))
                                                    <span class="nextPage">
                                                        <a href="{{ $product->url($product->currentPage()+1) }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                                    </span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('frontend.layouts.sidebar')
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
@endsection