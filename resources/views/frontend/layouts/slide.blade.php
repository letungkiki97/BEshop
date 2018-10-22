<div id="main-slider">
    <form id="search-collection-form" accept-charset="UTF-8" action="https://suplo-car-accesories.myharavan.com/search"
        class="search-form" method="get">
        <select class="mobile-select-collection">
            <option value="0">Tất cả</option>



            <option value="1001373418">Phụ kiện xe hơi</option>


            <option value="1001373419">Đồ chơi xe hơi</option>


            <option value="1001373421">Nội thất xe hơi</option>


            <option value="1001373422">Các sản phẩm khác</option>


            <option value="1001358763">Sản phẩm khuyến mãi</option>


            <option value="1001365286">Sản phẩm mới về</option>

        </select>
        <div class="input-group">
            <input type="text" value="" placeholder="Tìm kiếm ..." name="q">
            <input type="hidden" value="product" name="type">
            <span class="input-group-btn">
                <button type="submit"><i class="fas fa-search"></i></button>
            </span>
        </div>
    </form>

    <script>
        $('#search-collection-form').submit(function (e) {
            e.preventDefault();
            if ($('.mobile-select-collection').val() == 0) {
                window.location = '/search?q=filter=(' + '(collectionid:product>=' + $('.mobile-select-collection').val() + ')' + '&&(title:product**' + $(this).find('input[name="q"]').val() + '))';
            } else {
                window.location = '/search?q=filter=(' + '(collectionid:product=' + $('.mobile-select-collection').val() + ')' + '&&(title:product**' + $(this).find('input[name="q"]').val() + '))';
            }
        })
    </script>
    <div id="owl-main-slider" class="owl-carousel owl-theme">
        <div class="item">
            <div class="ms-img">
                <img src="http://theme.hstatic.net/1000305059/1000394224/14/ms_banner_img1.jpg?v=3593" alt="Các mẫu xe thể thao" />
                <div class="ms-desc">
                    <div class="line-1 wow fadeInLeft" data-wow-duration="0.75s" data-wow-delay="0.5s">
                        Các mẫu xe thể thao
                    </div>
                    <div class="line-2 wow fadeInRight" data-wow-duration="0.75s" data-wow-delay="0.5s">
                        Bằng tất cả tâm huyết, năng lực vượt trội và quy mô không ngừng phát triển, Suplo cam kết nỗ
                        lực
                        hết mình nhằm
                        cung cấp sản phẩm và dịch vụ đúng với những giá trị mà khách hàng mong đợi.
                    </div>
                    <a href="collections/all.html" class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="1.5s">Xem
                        thêm</a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ms-img">
                <img src="http://theme.hstatic.net/1000305059/1000394224/14/ms_banner_img2.jpg?v=3593" alt="Các mẫu xe động cơ khỏe" />
                <div class="ms-desc">
                    <div class="line-1 wow fadeInLeft" data-wow-duration="0.75s" data-wow-delay="0.5s">
                        Các mẫu xe động cơ khỏe
                    </div>
                    <div class="line-2 wow fadeInRight" data-wow-duration="0.75s" data-wow-delay="0.5s">
                        Bằng tất cả tâm huyết, năng lực vượt trội và quy mô không ngừng phát triển, Suplo cam kết nỗ
                        lực
                        hết mình nhằm
                        cung cấp sản phẩm và dịch vụ đúng với những giá trị mà khách hàng mong đợi.
                    </div>
                    <a href="collections/all.html" class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="1.5s">Mua
                        ngay</a>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="ms-img">
                <img src="http://theme.hstatic.net/1000305059/1000394224/14/ms_banner_img3.jpg?v=3593" alt="Các mẫu xe quý tộc" />
                <div class="ms-desc">
                    <div class="line-1 wow fadeInLeft" data-wow-duration="0.75s" data-wow-delay="0.5s">
                        Các mẫu xe quý tộc
                    </div>
                    <div class="line-2 wow fadeInRight" data-wow-duration="0.75s" data-wow-delay="0.5s">
                        Bằng tất cả tâm huyết, năng lực vượt trội và quy mô không ngừng phát triển, Suplo cam kết nỗ
                        lực
                        hết mình nhằm
                        cung cấp sản phẩm và dịch vụ đúng với những giá trị mà khách hàng mong đợi.
                    </div>
                    <a href="collections/all.html" class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="1.5s">Bộ
                        sưu tập</a>
                </div>
            </div>
        </div>




    </div>
</div>