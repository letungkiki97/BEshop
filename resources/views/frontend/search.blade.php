@extends('frontend.layouts.master')
@section('title', 'Tìm kiếm')
@section('Content')
<div id="PageContainer" class="is-moved-by-drawer" style="margin-top: 20px">
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
                                                <h1>Tất cả sản phẩm</h1>
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
                                                <script>
                                                    /*============================================================================
                                                        Inline JS because collection liquid object is only available
                                                        on collection pages and not external JS files
                                                      ==============================================================================*/
                                                    Haravan.queryParams = {};
                                                    if (location.search.length) {
                                                        for (var aKeyValue, i = 0, aCouples = location.search.substr(1).split('&'); i < aCouples.length; i++) {
                                                            aKeyValue = aCouples[i].split('=');
                                                            if (aKeyValue.length > 1) {
                                                                Haravan.queryParams[decodeURIComponent(aKeyValue[0])] = decodeURIComponent(aKeyValue[1]);
                                                            }
                                                        }
                                                    }
                                                    $(function () {
                                                        $('#SortBy')
                                                            .val('created-descending')
                                                            .bind('change', function () {
                                                                Haravan.queryParams.sort_by = jQuery(this).val();
                                                                location.search = jQuery.param(Haravan.queryParams);
                                                            }
                                                            );
                                                    });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="collection-body">
                                    <div>Kết quả tìm kiếm: {{$tim}} </div></br>
                                    <div class="grid-uniform product-list md-mg-left-5">
                                        @foreach($product as $k2=>$v2)
                                        <div class="grid__item large--one-third medium--one-third small--one-half md-pd-left5">
                                            <div class="product-item">
                                                <div class="product-img">
                                                    <a href="{{url('productdetail/'.@$v->id)}}">
                                                        <img id="{{@$v2->image->id}}" src="{{url('uploads/products/'.@$v2->image->name)}}"
                                                            title="{{@$v2->image->title}}" alt="{{@$v2->image->alt}}" />
                                                        <img id="{{@$v2->image->id}}" src="{{url('uploads/products/'.@$v2->image->name)}}"
                                                            title="{{@$v2->image->title}}" alt="{{@$v2->image->alt}}" />
                                                    </a>
                                                    <div class="product-actions medium--hide small--hide">
                                                        <div>
                                                            <button type="button" class="btnQuickView quick-view medium--hide small--hide"
                                                                data-handle="{{url('productdetail/'.@$v2->id)}}">
                                                                <span>
                                                                    <i class="fa fa-search-plus" aria-hidden="true"></i>
                                                                </span>
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="product-item-info">
                                                    <div class="product-title">
                                                        <a href="{{url('productdetail/'.@$v2->id)}}">
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
                                    <div class="pagination not-filter">
                                        <div id="pagination-" class="text-center clear-left">
                                            <div class="pagination-custom">
                                                <span class="page page-node current">1</span>
                                                <span class="page"><a class="page-node" href="all4658.html?page=2">2</a></span>
                                                <span class="nextPage"><a href="all4658.html?page=2"><i class="fa fa-angle-double-right"
                                                            aria-hidden="true"></i></a></span>
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