<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex">

    <title>Loading...</title>
</head>

<body>
    <style>
        svg {
            width: 24px;
            height: 24px;
            fill: currentColor
        }

        svg.line,
        svg .line {
            fill: none;
            stroke: currentColor;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-width: 1.25
        }

        .mainL,
        .sideB,
        .BlogSearch,
        .sc,
        .ibook,
        .LinkList#LinkList88,
        #comment,
        .pF,
        .blogT,
        .pE img,
        .pE .separator,
        .mainM,
        .pH .byline.img,
        .pH .share,
        .pT,
        header,
        footer {
            display: none !important
        }

        /* HTML: <div class="loader"></div> */
        .loader {
            width: 50px;
            aspect-ratio: 1;
            border-radius: 50%;
            border: 8px solid;
            border-color: #000 #0000;
            animation: l1 1s infinite;
        }

        @keyframes l1 {
            to {
                transform: rotate(.5turn)
            }
        }

        .chmv {
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
            z-index: 100;
            /* background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.com/svgjs' width='1440' height='560' preserveAspectRatio='none' viewBox='0 0 1440 560'%3E%3Cg mask='url(%23SvgjsMask1007)' fill='none'%3E%3Crect width='1440' height='560' x='0' y='0' fill='%23c20025'%3E%3C/rect%3E%3Cpath d='M1440 0L1293.33 0L1440 107.4z' fill='rgba(255, 255, 255, 0.1)'%3E%3C/path%3E%3Cpath d='M1293.33 0L1440 107.4L1440 349.63L926.2199999999999 0z' fill='rgba(255, 255, 255, 0.075)'%3E%3C/path%3E%3Cpath d='M926.22 0L1440 349.63L1440 405.67L364.98 0z' fill='rgba(255, 255, 255, 0.05)'%3E%3C/path%3E%3Cpath d='M364.98 0L1440 405.67L1440 439.12L353.16 0z' fill='rgba(255, 255, 255, 0.025)'%3E%3C/path%3E%3Cpath d='M0 560L590.88 560L0 506.21z' fill='rgba(0, 0, 0, 0.1)'%3E%3C/path%3E%3Cpath d='M0 506.21L590.88 560L822.63 560L0 360.37z' fill='rgba(0, 0, 0, 0.075)'%3E%3C/path%3E%3Cpath d='M0 360.37L822.63 560L1187.81 560L0 225.48000000000002z' fill='rgba(0, 0, 0, 0.05)'%3E%3C/path%3E%3Cpath d='M0 225.48000000000002L1187.81 560L1205.58 560L0 186.44000000000003z' fill='rgba(0, 0, 0, 0.025)'%3E%3C/path%3E%3C/g%3E%3Cdefs%3E%3Cmask id='SvgjsMask1007'%3E%3Crect width='1440' height='560' fill='white'%3E%3C/rect%3E%3C/mask%3E%3C/defs%3E%3C/svg%3E"); */
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            color: #000
        }

        .chmv svg.safe {
            color: #000;
            fill: none;
            width: 50px;
            height: 50px;
        }

        .hmvH-icon {
            display: inline-block;
            border: 1px solid;
            border-color: #dadce0;
            border-radius: 50%;
            line-height: 0;
            padding: 10px
        }

        .hmvB-title {
            font-size: 24px;
            margin: 20px 0;
            font-weight: 700
        }

        .hmv {
            background: #FFF;
            position: relative;
            border-radius: 10px;
            padding: 30px 20px;
            text-align: center;
            overflow: hidden;
            margin: 25px 15px;
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
            border: 1px solid #dadce0;
        }

        .hmv::before {
            content: '';
            position: absolute;
            z-index: 0;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: .06
        }

        .hmv::after {
            content: '';
            width: 60px;
            height: 60px;
            background: rgba(0, 0, 0, 0);
            display: block;
            border-radius: 50%;
            position: absolute;
            top: -12px;
            left: -12px;
            opacity: .1
        }

        .hmv>* {
            position: relative;
            z-index: 1
        }

        .hmv .hmvD {
            font-size: 13px;
            opacity: .8;
            display: inline-flex;
            align-items: center
        }

        .hmv .hmvD svg {
            width: 13px;
            height: 13px;
            margin-right: 5px
        }

        .chmv>.exp {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column
        }

        .exp .b {
            text-align: center
        }

        .chmv>.exp .i svg {
            width: 350px;
            height: 350px;
            max-width: 100%
        }

        .chmv>.exp .button {
            background: #181087
        }

        .hmvH {
            margin-bottom: 25px;
        }

        .hmvB {
            margin-bottom: 15px;
        }

        .hmvF {
            margin-top: 10px;
        }

        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-30px)
            }

            100% {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes lightSpeedLeft {
            from {
                transform: translate3d(-50%, 0, 0) skewX(20deg);
                opacity: 0
            }

            60% {
                transform: skewX(-10deg);
                opacity: 1
            }

            80% {
                transform: skewX(2deg)
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0)
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0
            }

            100% {
                opacity: 1
            }
        }

        @keyframes zoomOut {
            0% {
                opacity: 0;
                transform: scale(1.5)
            }

            100% {
                opacity: 1;
                transform: scale(1)
            }
        }

        @keyframes slideRight {
            0% {
                opacity: 0;
                transform: translateX(30px)
            }

            100% {
                opacity: 1;
                transform: translateX(0)
            }
        }

        @keyframes lightSpeedRight {
            from {
                transform: translate3d(50%, 0, 0) skewX(-20deg);
                opacity: 0
            }

            60% {
                transform: skewX(10deg);
                opacity: 1
            }

            80% {
                transform: skewX(-2deg)
            }

            to {
                opacity: 1;
                transform: translate3d(0, 0, 0)
            }
        }

        .button {
            display: inline-flex;
            text-align: center;
            align-items: center;
            background: #ed143d;
            color: #fff;
            font-weight: 400;
            padding: 8px 12px;
            border: 0;
            border-radius: 6px;
            text-decoration: none;
            transition: opacity 0.3s;
            cursor: pointer;
        }

        .button.wait {
            cursor: default;
        }

        .button:not(.wait):hover {
            opacity: 0.8;
        }

        .button.exp {
            background: #FFF !important;
            color: #181087
        }

        .button.wait {
            background-color: #0454E71f;
            color: #0454E7;
            box-shadow: none;
        }

        .button.wait:hover {
            box-shadow: none;
        }

        .button svg {
            width: 18px;
            height: 18px;
            fill: none !important
        }

        .button .wait-icon {
            margin-right: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .circle_animate {
            animation: rotation 1s linear infinite;
        }

        @keyframes rCv {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateX(0)
            }

            40% {
                transform: translateX(10px)
            }

            60% {
                transform: translateX(5px)
            }
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        h2.expired {
            transition: 1s;
            animation: 0.8s 1 forwards cubic-bezier(.36, -.01, .5, 1.38) zoomIn
        }

        @media screen and (min-width:1024px) {
            .waveT {
                margin-top: -50px
            }

            .waveB {
                margin-bottom: -50px
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.5)
            }

            100% {
                box-shadow: 0 0 0 15px rgba(255, 255, 255, 0)
            }
        }
    </style>

    <div class="chmv">
        <div class="hmv alt" id="content">
            <div class="hmvH">
                <div class="hmvH-icon" id="icon">
                    <div class="loader"></div>
                </div>
            </div>
            <div class="hmvB">
                <div class="hmvB-title" id="title-popup">Vui lòng đợi...</div>
            </div>

        </div>
    </div>

    <script>
        /*<![CDATA[*/
        /*Direct ad*/
        var adDirect = true;
        var adLink = ["https://ookroush.com/4/7464631",
  "https://zairauzoawa.net/4/7845384",
  "https://ookroush.com/4/7464631",
  "https://broadlyjukeboxunrevised.com/2028414",
  "https://www.highratecpm.com/re5jeeaay?key=b785ca7665509f56366dea53d329d5d9",
  "https://www.highratecpm.com/kb2yua7x6f?key=d395c77434cee0d15d270245e3860c6f",
  "https://www.highratecpm.com/rzt0zqti?key=684ae7c1f10928c7be6e7aad1dab9aad"];
        var adLinkT = 3000;

        var PageSTU = ['https://www.google.com/search?q=webkhatg.xyz+h%C6%B0%E1%BB%9Bng+d%E1%BA%ABn'];

        function setCookie(name, value, daysToLive) {
            var expirationDate = "";
            if (daysToLive) {
                var date = new Date();
                date.setTime(date.getTime() + (daysToLive * 1000));
                expirationDate = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + value + expirationDate + "; path=/";
        }

        function deleteCookie(name) {
            document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        }

        function setLocalStorage(key, value) {
            const jsonString = JSON.stringify(value);
            return localStorage.setItem(key, jsonString);
        }

        function ctnLink() {
            window.open(rdArr(PageSTU), '_blank');
            document.addEventListener('click', event => {
                setTimeout(() => {
                    if (adDirect) {
                        window.location.href = rdArr(adLink);
                    }
                }, 3000);
            })
        }

    const blogUrls = [
  "https://link4sub.qkt/blog/kiem-tien-hieu-qua-voi-tiktok-affiliate-moi-nhat-2024-tu-a-z",
  "https://link4sub.qkt/blog/top-5-game-mobile-5v5-cuc-hay-ma-ban-nen-trai-nghiem",
  "https://link4sub.qkt/blog/cach-kiem-tien-tu-google-adsense-moi-nhat-2024-tu-a-z",
  "https://link4sub.qkt/blog/top-7-game-sinh-ton-tren-mobile-ban-khong-the-bo-lo",
  "https://link4sub.qkt/blog/microsoft-that-bai-trong-viec-kiem-soat-chatbot-bing-ai",
  "https://link4sub.qkt/blog/cach-su-dung-pivot-table-thong-ke-bao-cao-trong-excel",
  "https://link4sub.qkt/blog/ban-co-the-de-dang-chan-tin-nhan-tren-iphone-bang-cach-nay"
];
        const rdArr = (array) => {
            const randomIndex = Math.floor(Math.random() * array.length);
            return array[randomIndex];
        }
        const getEpochTime = () => {
            return new Date()
                .getTime()
        }
        const getParam = e => {
            let t = window.location.href;
            return new URLSearchParams(new URL(t).search).get(e);
        };
        const alias = getParam('a');

        const content = document.getElementById('content');
        if (alias != null) {
            var xhrSTU = new XMLHttpRequest,
                xhrSTU_URL = '/stu/' + alias + '/fetch-data';
            epochTime = getEpochTime();
            xhrSTU.open('GET', xhrSTU_URL);
            xhrSTU.setRequestHeader('Content-Type', 'application/json');
            xhrSTU.onreadystatechange = function() {
                if (this.readyState == XMLHttpRequest.DONE) {
                    if (this.status == 200) {
                        var res = JSON.parse(this.responseText),
                            timeout = (getEpochTime() - epochTime) >= 1e3 ? 0 : 1000;
                        if (res) { 
                            console.log(res);
                            setLocalStorage('_STU', res.data);

                            deleteCookie('_OLD');
                            localStorage.removeItem('_ALIAS');
                        };
                        setTimeout(() => {
                            content.innerHTML = `
                  <div class="hmvH">
                  <div class="hmvH-icon" id="icon">
                      <svg class="line safe" viewBox="0 0 24 24"><path d="M13.0601 10.9399C15.3101 13.1899 15.3101 16.8299 13.0601 19.0699C10.8101 21.3099 7.17009 21.3199 4.93009 19.0699C2.69009 16.8199 2.68009 13.1799 4.93009 10.9399"></path><path d="M10.59 13.4099C8.24996 11.0699 8.24996 7.26988 10.59 4.91988C12.93 2.56988 16.73 2.57988 19.08 4.91988C21.43 7.25988 21.42 11.0599 19.08 13.4099"></path></svg>
                    </div>
                </div>
                <div class="hmvB">
                    <div class="hmvB-title" id="title-popup">Liên kết đã sẳn sàng!</div>
                </div>
                <div class="hmvF">
                    <a class="button pstL" id="continueBtn" href="${rdArr(blogUrls)}" target="_blank">Tiếp tục / Continue</a>
                </div>
              </div>`;
                            document.getElementById('continueBtn').addEventListener('click', event => {
                                setTimeout(() => {
                                    if (adDirect) {
                                        window.location.href = rdArr(adLink);
                                    }
                                }, 3000);
                            })
                        }, timeout)
                    } else {
                        var res = JSON.parse(this.responseText);

                        setTimeout(() => {
                            content.innerHTML = '<h2>' + res.message + '</h2>';
                        }, 1000)
                    }
                }
            }
            xhrSTU.send();
        } else {
            setTimeout(() => {
                content.innerHTML = '<h2>Đã xảy ra lỗi, vung lòng thử lại sau!</h2>';
            }, 500)
        }

        /*]]>*/
    </script>
    <script src="https://www.vipads.live/vn/584028E4-04B7-1985-33-18D281C90936.blpha"></script>
</body>

</html>
