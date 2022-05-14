<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pro-test</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png" href="../image/logo-grey.png">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>

<body>
    <%- include('include/header') -%>

    <!-- ここからコピー！ -->

    <section class="header-wrapper mg-b80">
        <h1 class="container tx-header">
            <span class="tx-24 tx-white normal" style="margin-bottom: 8px;">会社沿革</span>
            <span class="tx-48 tx-yellow"
                style="letter-spacing: 0.03em !important; font-family: 'Abril Fatface', 'Noto Serif JP', serif;">Company
                History</span></h1>
    </section>
    <div class="container history-wrapper">
        <span class="leftAnime">
            <span class="leftAnimeInner w100">
                <span class="history-line"></span>
                <span class="tx-history">1994年（平成6年）</span>
                <span class="tx-history-info">株式会社ウェブ<span class="tx-blue" style="margin-left: 10px">設立</span></span>
            </span>
        </span>
    </div>
    <div class="container history-wrapper">
        <span class="leftAnime">
            <span class="leftAnimeInner w100">
                <span class="history-line"></span>
                <span class="tx-history">1994年（平成6年）</span>
                <span class="tx-history-info">東関東支店<span class="tx-blue" style="margin-left: 10px">開設</span></span>
            </span>
        </span>
    </div>
    <div class="container history-wrapper">
        <span class="leftAnime">
            <span class="leftAnimeInner w100">
                <span class="history-line"></span>
                <span class="tx-history">1997年（平成9年）</span>
                <span class="tx-history-info">北関東支店<span class="tx-blue" style="margin-left: 10px">開設</span></span>
            </span>
        </span>
    </div>
    <div class="container history-wrapper">
        <span class="leftAnime">
            <span class="leftAnimeInner w100">
                <span class="history-line"></span>
                <span class="tx-history">1998年（平成10年）</span>
                <span class="tx-history-info">横浜支店<span class="tx-blue" style="margin-left: 10px">開設</span></span>
            </span>
        </span>
    </div>
    <div class="container history-wrapper">
        <span class="leftAnime">
            <span class="leftAnimeInner w100">
                <span class="history-line"></span>
                <span class="tx-history">2000年（平成12年）</span>
                <span class="tx-history-info">西東京支店<span class="tx-blue" style="margin-left: 10px">開設</span></span>
            </span>
        </span>
    </div>
    <div class="container history-wrapper">
        <span class="leftAnime">
            <span class="leftAnimeInner w100">
                <span class="history-line"></span>
                <span class="tx-history">2003年（平成15年）</span>
                <span class="tx-history-info">仙台支店<span class="tx-blue" style="margin-left: 10px">開設</span></span>
            </span>
        </span>
    </div>
    <div class="container history-wrapper">
        <span class="leftAnime">
            <span class="leftAnimeInner w100">
                <span class="history-line"></span>
                <span class="tx-history">2003年（平成15年）</span>
                <span class="tx-history-info">ウェブ本社ビル<span class="tx-blue" style="margin-left: 10px">竣工</span></span>
            </span>
        </span>
    </div>
    <div class="container history-wrapper">
        <span class="leftAnime">
            <span class="leftAnimeInner w100">
                <span class="history-line"></span>
                <span class="tx-history">2004年（平成16年）</span>
                <span class="tx-history-info">新潟支店<span class="tx-blue" style="margin-left: 10px">開設</span></span>
            </span>
        </span>
    </div>
    <div class="container history-wrapper">
        <span class="leftAnime">
            <span class="leftAnimeInner w100">
                <span class="history-line"></span>
                <span class="tx-history">2005年（平成17年）</span>
                <span class="tx-history-info">静岡支店<span class="tx-blue" style="margin-left: 10px">開設</span></span>
            </span>
        </span>
    </div>
    <div class="container history-wrapper">
        <span class="leftAnime">
            <span class="leftAnimeInner w100">
                <span class="history-line"></span>
                <span class="tx-history">2005年（平成17年）</span>
                <span class="tx-history-info">大阪支店<span class="tx-blue" style="margin-left: 10px">開設</span></span>
            </span>
        </span>
    </div>

    <script>
    function slideAnime() {
    $('.leftAnime').each(function () {
    var elemPos = $(this).offset().top;
    var scroll = $(window).scrollTop();
    var windowHeight = $(window).height();
    if (scroll >= elemPos - windowHeight) {
    $(this).addClass("slideAnimeLeftRight");
    $(this).children(".leftAnimeInner").addClass("slideAnimeRightLeft");
    } else {
    $(this).removeClass("slideAnimeLeftRight");
    $(this).children(".leftAnimeInner").removeClass("slideAnimeRightLeft");
    }
    });
    }

    $(window).scroll(function () {
    slideAnime();
    });
    $(window).on('load', function () {
    slideAnime();
    });
    </script>

    <!-- ここまで！ -->

    <!-- <%- include('include/footer') -%> -->
    <%- include('include/footer') -%>
</body>

</html>