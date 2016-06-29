@extends('Home.wechat.layout.application')
@section('content')
<div class="page-index" id="home" data-log="首页">
        <div class="index-header">
            <div class="search_bar">
                <a href="/1/#/search/index">
                    <span class="icon icon-search"></span>
                    <span class="text">搜索商品名称</span>
                </a>
            </div>
            <div class="search_bottom"></div>
        </div>

        <!--焦点图-->
        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li>
                        <a href=""><img src="http://i8.mifile.cn/v1/a1/T1_1W_BgVv1RXrhCrK!720x360.jpg"/></a>
                    </li>
                    <li>
                        <img src="http://i8.mifile.cn/v1/a1/T12LdgBXZv1RXrhCrK!720x360.jpg"/>
                    </li>
                    <li>
                        <img src="http://i8.mifile.cn/v1/a1/T1zgZvBgK_1RXrhCrK!720x360.jpg"/>
                    </li>
                    <li>
                        <img src="http://i8.mifile.cn/v1/a1/T1m4bgBsdv1RXrhCrK!720x360.jpg"/>
                    </li>
                    <li>
                        <img src="http://i8.mifile.cn/v1/a1/T17XD_Bjxv1RXrhCrK!720x360.jpg"/>
                    </li>
                </ul>
            </div>
        </section>

        <!--推荐商品-->
        <div class="list">
            <div class="section">
                <div class="mcells_auto_fill">
                    <div class="body">
                        <div>
                            <div class="items">
                                <img src="http://i8.mifile.cn/v1/a1/T1lJdgB7hv1RXrhCrK.jpg">
                            </div>
                        </div>
                        <div>
                            <div class="items">
                                <img src="http://i8.mifile.cn/v1/a1/T1a9hgB7_v1RXrhCrK.jpg">
                            </div>
                        </div>
                        <div>
                            <div class="items">
                                <img src="http://i8.mifile.cn/v1/a1/T1F6WgBQYv1RXrhCrK.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section">
                <div>
                    <div class="item">
                        <div class="img">
                            <img class="ico" src="http://i8.mifile.cn/v1/a1/T14xJTByZ_1RXrhCrK.jpg">
                            <img class="tag " src="http://c1.mifile.cn/f/i/f/mishop/iic/xp.png">
                        </div>
                        <div class="info">
                            <div class="name"><p>小米手机5</p></div>
                            <div class="brief"><p>骁龙820处理器 / 4GB 内存 / 128GB 闪存 / 4轴防抖相机 / 3D陶瓷机身</p></div>
                            <div class="price"><p>1999元 起</p></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section">
                <div>
                    <div class="item">
                        <div class="img">
                            <img class="ico" src="http://i8.mifile.cn/v1/a1/T14xJTByZ_1RXrhCrK.jpg">
                            <img class="tag " src="http://c1.mifile.cn/f/i/f/mishop/iic/xp.png">
                        </div>
                        <div class="info">
                            <div class="name"><p>小米手机5</p></div>
                            <div class="brief"><p>骁龙820处理器 / 4GB 内存 / 128GB 闪存 / 4轴防抖相机 / 3D陶瓷机身</p></div>
                            <div class="price"><p>1999元 起</p></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section">
                <div>
                    <div class="item">
                        <div class="img">
                            <img class="ico" src="http://i8.mifile.cn/v1/a1/T14xJTByZ_1RXrhCrK.jpg">
                            <img class="tag " src="http://c1.mifile.cn/f/i/f/mishop/iic/xp.png">
                        </div>
                        <div class="info">
                            <div class="name"><p>小米手机5</p></div>
                            <div class="brief"><p>骁龙820处理器 / 4GB 内存 / 128GB 闪存 / 4轴防抖相机 / 3D陶瓷机身</p></div>
                            <div class="price"><p>1999元 起</p></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section">
                <div>
                    <div class="item">
                        <div class="img">
                            <img class="ico" src="http://i8.mifile.cn/v1/a1/T14xJTByZ_1RXrhCrK.jpg">
                            <img class="tag " src="http://c1.mifile.cn/f/i/f/mishop/iic/xp.png">
                        </div>
                        <div class="info">
                            <div class="name"><p>小米手机5</p></div>
                            <div class="brief"><p>骁龙820处理器 / 4GB 内存 / 128GB 闪存 / 4轴防抖相机 / 3D陶瓷机身</p></div>
                            <div class="price"><p>1999元 起</p></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section">
                <div>
                    <div class="item">
                        <div class="img">
                            <img class="ico" src="http://i8.mifile.cn/v1/a1/T14xJTByZ_1RXrhCrK.jpg">
                            <img class="tag " src="http://c1.mifile.cn/f/i/f/mishop/iic/xp.png">
                        </div>
                        <div class="info">
                            <div class="name"><p>小米手机5</p></div>
                            <div class="brief"><p>骁龙820处理器 / 4GB 内存 / 128GB 闪存 / 4轴防抖相机 / 3D陶瓷机身</p></div>
                            <div class="price"><p>1999元 起</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       @include('Home.wechat.layout._footer')
</div>
@endsection

@section('js')
<script defer src="/wechat/flexslider/jquery.flexslider.js"></script>
<script type="text/javascript">
    $(window).load(function () {
        $('.flexslider').flexslider({
            animation: "slide",
            directionNav: false
        });
    });
</script>
@endsection