<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @hasSection('meta_seo')
    @yield('meta_seo')
    @else
    <meta name="description"
        content="Free simple file sharing and storage. Upload your image, video, music, document, config, and app share with everyone." />
    <meta name="keywords" content="safefileku, file, cloud, storage" />
    <meta property="og:title" content="@yield('title', '')" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Safefileku" />
    <meta property="og:url" content="https://safefileku.com" />
    <meta property="og:image" content="https://cdn.safefileku.com/icon-250.png" />
    @endif

    <title>@yield('title', '')</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />
    <link rel="preload" as="style" href="https://safefileku.com/build/assets/B-2C-zsg.css" />
    <link rel="stylesheet" href="https://safefileku.com/build/assets/B-2C-zsg.css" />
    <link rel="preload" href="https://cdn.safefileku.com/hero.svg" as="image" type="image/svg+xml">
    <style>
       .circles{position:absolute;top:0;left:0;width:100%;height:100%;overflow:hidden}.circles li{border-radius:8px;position:absolute;display:block;list-style:none;width:20px;height:20px;background:rgba(255,255,255,.2);animation:25s linear infinite animate;bottom:-150px;display:flex;justify-content:center;align-items:center}.circles li:first-child{left:25%;width:80px;height:80px;animation-delay:0s}.circles li:nth-child(2){left:10%;width:20px;height:20px;animation-delay:2s;animation-duration:12s}.circles li:nth-child(3){left:70%;width:20px;height:20px;animation-delay:4s}.circles li:nth-child(4){left:40%;width:60px;height:60px;animation-delay:0s;animation-duration:18s}.circles li:nth-child(5){left:65%;width:20px;height:20px;animation-delay:0s}.circles li:nth-child(6){left:75%;width:110px;height:110px;animation-delay:3s}.circles li:nth-child(7){left:35%;width:150px;height:150px;animation-delay:7s}.circles li:nth-child(8){left:50%;width:25px;height:25px;animation-delay:15s;animation-duration:45s}.circles li:nth-child(9){left:20%;width:15px;height:15px;animation-delay:2s;animation-duration:35s}.circles li:nth-child(10){left:85%;width:150px;height:150px;animation-delay:0s;animation-duration:11s}@keyframes animate{0%{transform:translateY(0) rotate(0);opacity:1}100%{transform:translateY(-1000px) rotate(720deg);opacity:0}}
    </style>
</head>

<body class="flex h-full flex-col">
    <header class="bg-blue-600">
        <nav>
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-50 flex justify-between py-8">
                <div class="relative z-10 flex items-center gap-16">
                    <a aria-label="Home" href="/">
                        <svg width="170" viewBox="0 0 276 53" fill="none">
                            <path
                                d="M0 10C0 4.47715 4.47715 0 10 0H43C48.5228 0 53 4.47715 53 10V43C53 48.5228 48.5228 53 43 53H10C4.47715 53 0 48.5228 0 43V10Z"
                                fill="white" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M22.3212 13.0596C23.611 12.7832 24.9429 12.7668 26.2391 13.0114C27.5353 13.2559 28.7697 13.7565 29.87 14.4839C30.9704 15.2112 31.9147 16.1507 32.6476 17.2474C33.0863 17.9039 33.444 18.6088 33.7144 19.3466C34.4842 19.4549 35.2406 19.6536 35.9674 19.9399C37.1868 20.4201 38.299 21.1374 39.2395 22.0501C40.18 22.9629 40.9303 24.053 41.447 25.2575C41.9636 26.462 42.2364 27.7569 42.2495 29.0675C42.2626 30.378 42.0158 31.6782 41.5233 32.8928C41.0309 34.1074 40.3025 35.2123 39.3804 36.1437C38.4583 37.075 37.3608 37.8144 36.1512 38.319C34.9416 38.8235 33.644 39.0833 32.3333 39.0833H18.0833C15.8732 39.0833 13.7536 38.2054 12.1908 36.6426C10.628 35.0798 9.75003 32.9602 9.75 30.7501M25.4975 16.942C24.724 16.7961 23.9291 16.8059 23.1595 16.9708C22.3898 17.1358 21.6607 17.4526 21.0149 17.9027C20.3692 18.3528 19.8196 18.9272 19.3985 19.5922C18.9774 20.2573 18.6932 20.9996 18.5624 21.7759C18.4316 22.5521 18.457 23.3466 18.637 24.1129C18.759 24.6322 18.6685 25.1788 18.3855 25.631C18.1026 26.0832 17.6507 26.4037 17.1304 26.5212C16.1707 26.7378 15.3132 27.2745 14.6989 28.043C14.0846 28.8114 13.75 29.766 13.75 30.7499C13.75 31.8992 14.2065 33.0015 15.0192 33.8141C15.8319 34.6268 16.9341 35.0833 18.0833 35.0833H32.3333C33.1153 35.0833 33.8895 34.9283 34.6112 34.6273C35.3329 34.3262 35.9877 33.8851 36.5379 33.3294C37.0881 32.7737 37.5226 32.1145 37.8164 31.3898C38.1103 30.6651 38.2575 29.8894 38.2497 29.1075C38.2419 28.3256 38.0791 27.5529 37.7709 26.8343C37.4626 26.1157 37.015 25.4652 36.4538 24.9207C35.8926 24.3761 35.2291 23.9482 34.5015 23.6616C33.774 23.375 32.9968 23.2355 32.215 23.2512C31.2423 23.2706 30.3968 22.5874 30.2116 21.6323C30.0617 20.8595 29.7593 20.1244 29.3219 19.47C28.8845 18.8155 28.321 18.2548 27.6643 17.8208C27.0077 17.3867 26.271 17.088 25.4975 16.942ZM9.75 30.7501C9.74993 28.8584 10.3933 27.0229 11.5745 25.5453C12.3646 24.5569 13.3639 23.768 14.4913 23.2293C14.4578 22.5225 14.4999 21.8125 14.618 21.1114C14.8371 19.8107 15.3134 18.5667 16.0191 17.4523C16.7247 16.3379 17.6456 15.3754 18.7277 14.6212C19.8098 13.8669 21.0315 13.3361 22.3212 13.0596"
                                fill="#1072EB" />
                            <path
                                d="M81.6961 34.8458C81.6961 34.2524 81.6048 33.7197 81.4223 33.248C81.2548 32.761 80.9353 32.3196 80.4634 31.9238C79.9917 31.513 79.3297 31.1097 78.4774 30.714C77.6251 30.3183 76.5218 29.9074 75.1674 29.4813C73.6607 28.9943 72.2301 28.4464 70.8757 27.8377C69.5364 27.2288 68.3494 26.5211 67.3144 25.7147C66.2948 24.8928 65.4881 23.9417 64.8947 22.8611C64.3164 21.7806 64.0271 20.525 64.0271 19.0944C64.0271 17.7096 64.3317 16.454 64.9404 15.3278C65.5491 14.1864 66.4014 13.2124 67.4971 12.4058C68.5928 11.584 69.8864 10.9524 71.3778 10.5111C72.8845 10.0697 74.5358 9.84904 76.3317 9.84904C78.7818 9.84904 80.9201 10.2904 82.7463 11.1731C84.5725 12.0557 85.9878 13.2657 86.9924 14.8027C88.012 16.3398 88.5218 18.0977 88.5218 20.0761H81.7191C81.7191 19.1021 81.5137 18.2498 81.1027 17.5193C80.707 16.7736 80.0982 16.1877 79.2764 15.7616C78.4698 15.3354 77.4501 15.1224 76.2174 15.1224C75.0304 15.1224 74.0411 15.305 73.2498 15.6703C72.4584 16.0203 71.8648 16.4997 71.4691 17.1084C71.0735 17.702 70.8757 18.3716 70.8757 19.1173C70.8757 19.6804 71.0127 20.1901 71.2866 20.6467C71.5757 21.1033 72.0018 21.5294 72.565 21.9251C73.1281 22.3208 73.8205 22.6937 74.6424 23.0437C75.4641 23.3937 76.4153 23.7361 77.4958 24.071C79.3068 24.6188 80.8971 25.2353 82.2668 25.9201C83.6518 26.605 84.8084 27.3734 85.7368 28.2257C86.6651 29.078 87.3651 30.0444 87.837 31.1248C88.3087 32.2054 88.5447 33.4305 88.5447 34.8001C88.5447 36.246 88.2631 37.5397 87.7 38.681C87.1368 39.8224 86.3227 40.7888 85.2574 41.5801C84.1921 42.3715 82.9214 42.9727 81.4451 43.3837C79.9688 43.7944 78.3177 44 76.4914 44C74.8478 44 73.227 43.7868 71.629 43.3607C70.031 42.9194 68.5777 42.2574 67.2688 41.3747C65.9751 40.492 64.9404 39.3658 64.1641 37.9961C63.388 36.6264 63 35.0057 63 33.1337H69.8711C69.8711 34.1687 70.031 35.0437 70.3507 35.759C70.6701 36.4743 71.1191 37.0526 71.6974 37.494C72.291 37.9353 72.9911 38.2548 73.7977 38.4527C74.6194 38.6506 75.5174 38.7494 76.4914 38.7494C77.6784 38.7494 78.6524 38.5821 79.4134 38.2473C80.1895 37.9124 80.7603 37.4483 81.1254 36.8547C81.506 36.2611 81.6961 35.5916 81.6961 34.8458ZM106.122 37.9734V26.9701C106.122 26.1787 105.993 25.5016 105.734 24.9384C105.475 24.3601 105.072 23.9111 104.524 23.5916C103.992 23.272 103.299 23.1121 102.447 23.1121C101.716 23.1121 101.085 23.2416 100.552 23.5003C100.02 23.7437 99.6087 24.1014 99.3195 24.5731C99.0304 25.0297 98.8858 25.57 98.8858 26.194H92.3113C92.3113 25.144 92.5548 24.1471 93.0418 23.2034C93.5288 22.26 94.2364 21.4305 95.1648 20.7153C96.0931 19.9847 97.1965 19.414 98.4748 19.0031C99.7685 18.5923 101.214 18.3867 102.812 18.3867C104.73 18.3867 106.434 18.7064 107.926 19.3456C109.417 19.9847 110.589 20.9435 111.441 22.222C112.309 23.5003 112.742 25.0983 112.742 27.0158V37.5853C112.742 38.9397 112.826 40.0507 112.994 40.9181C113.161 41.7704 113.404 42.5161 113.724 43.1553V43.5434H107.081C106.761 42.8737 106.518 42.0367 106.351 41.0323C106.198 40.0127 106.122 38.993 106.122 37.9734ZM106.99 28.4997L107.035 32.2207H103.36C102.493 32.2207 101.739 32.3196 101.1 32.5174C100.461 32.7153 99.9358 32.9968 99.525 33.362C99.1141 33.7121 98.8097 34.123 98.6118 34.5947C98.4292 35.0665 98.338 35.584 98.338 36.1471C98.338 36.7101 98.4673 37.22 98.726 37.6766C98.9847 38.118 99.3575 38.468 99.8445 38.7267C100.332 38.9701 100.902 39.092 101.557 39.092C102.546 39.092 103.406 38.8941 104.136 38.4984C104.867 38.1027 105.43 37.6157 105.825 37.0374C106.236 36.4591 106.449 35.9111 106.465 35.3937L108.2 38.1787C107.956 38.8027 107.621 39.4495 107.195 40.1191C106.784 40.7888 106.259 41.4204 105.62 42.014C104.981 42.5921 104.212 43.0717 103.314 43.4521C102.416 43.8174 101.351 44 100.118 44C98.551 44 97.1281 43.688 95.8497 43.064C94.5865 42.4248 93.5821 41.5497 92.8364 40.4387C92.1058 39.3126 91.7407 38.0341 91.7407 36.6037C91.7407 35.31 91.9841 34.161 92.4711 33.1566C92.9581 32.1521 93.6734 31.3074 94.617 30.6227C95.5757 29.9227 96.7704 29.3976 98.201 29.0475C99.6315 28.6823 101.29 28.4997 103.177 28.4997H106.99ZM126.188 43.5434H119.568V16.6518C119.568 14.78 119.933 13.2047 120.664 11.9264C121.409 10.6328 122.452 9.65876 123.791 9.00439C125.146 8.33474 126.751 8 128.609 8C129.216 8 129.802 8.04566 130.367 8.13698C130.929 8.21303 131.476 8.31199 132.009 8.4337L131.941 13.3874C131.652 13.3113 131.347 13.258 131.027 13.2277C130.708 13.1971 130.335 13.182 129.91 13.182C129.118 13.182 128.44 13.319 127.878 13.5928C127.329 13.8516 126.912 14.2397 126.622 14.7571C126.333 15.2746 126.188 15.9061 126.188 16.6518V43.5434ZM131.119 18.8434V23.5003H115.893V18.8434H131.119ZM145.386 44C143.47 44 141.749 43.6956 140.228 43.0868C138.706 42.4628 137.412 41.603 136.346 40.5073C135.297 39.4114 134.49 38.1407 133.928 36.695C133.363 35.234 133.083 33.6817 133.083 32.038V31.1248C133.083 29.253 133.349 27.5408 133.881 25.9886C134.414 24.4363 135.174 23.0894 136.164 21.948C137.169 20.8066 138.386 19.9314 139.817 19.3227C141.247 18.6987 142.86 18.3867 144.656 18.3867C146.406 18.3867 147.959 18.676 149.314 19.2543C150.668 19.8326 151.801 20.6544 152.714 21.7197C153.643 22.785 154.343 24.0634 154.815 25.5548C155.287 27.031 155.522 28.6747 155.522 30.4857V33.2251H135.89V28.8421H149.063V28.3398C149.063 27.4267 148.894 26.6125 148.559 25.8973C148.24 25.1667 147.754 24.5884 147.099 24.1623C146.445 23.7361 145.608 23.5231 144.587 23.5231C143.721 23.5231 142.974 23.7134 142.351 24.0938C141.727 24.4743 141.216 25.007 140.82 25.6918C140.44 26.3767 140.152 27.1833 139.954 28.1116C139.772 29.0247 139.68 30.0291 139.68 31.1248V32.038C139.68 33.0273 139.817 33.9404 140.091 34.7774C140.379 35.6144 140.783 36.3373 141.3 36.9461C141.833 37.5548 142.472 38.0267 143.219 38.3614C143.979 38.6961 144.839 38.8637 145.798 38.8637C146.985 38.8637 148.089 38.6354 149.108 38.1787C150.143 37.707 151.033 36.9994 151.779 36.0557L154.975 39.5257C154.456 40.2714 153.749 40.9867 152.851 41.6714C151.969 42.3564 150.903 42.9194 149.655 43.3607C148.408 43.7868 146.985 44 145.386 44ZM167.485 43.5434H160.886V17.7247C160.886 15.6246 161.313 13.8516 162.166 12.4058C163.032 10.96 164.265 9.86432 165.864 9.11862C167.477 8.37277 169.425 8 171.708 8C173.001 8 174.257 8.12935 175.474 8.38804C176.692 8.63162 177.948 8.95109 179.241 9.34677L178.283 14.6201C177.444 14.3614 176.547 14.118 175.588 13.8897C174.63 13.6614 173.473 13.5473 172.118 13.5473C170.597 13.5473 169.44 13.9048 168.649 14.6201C167.873 15.3201 167.485 16.3551 167.485 17.7247V43.5434ZM172.392 18.8434V23.5003H157.212V18.8434H172.392ZM182.3 18.8434V43.5434H175.702V18.8434H182.3ZM194.741 8.47936V43.5434H188.144V8.47936H194.741ZM211.542 44C209.625 44 207.905 43.6956 206.384 43.0868C204.861 42.4628 203.568 41.603 202.503 40.5073C201.453 39.4114 200.646 38.1407 200.083 36.695C199.521 35.234 199.239 33.6817 199.239 32.038V31.1248C199.239 29.253 199.505 27.5408 200.038 25.9886C200.569 24.4363 201.331 23.0894 202.32 21.948C203.325 20.8066 204.542 19.9314 205.972 19.3227C207.403 18.6987 209.016 18.3867 210.813 18.3867C212.563 18.3867 214.115 18.676 215.469 19.2543C216.824 19.8326 217.958 20.6544 218.87 21.7197C219.799 22.785 220.498 24.0634 220.97 25.5548C221.443 27.031 221.678 28.6747 221.678 30.4857V33.2251H202.047V28.8421H215.218V28.3398C215.218 27.4267 215.05 26.6125 214.715 25.8973C214.396 25.1667 213.909 24.5884 213.255 24.1623C212.6 23.7361 211.763 23.5231 210.744 23.5231C209.876 23.5231 209.13 23.7134 208.506 24.0938C207.883 24.4743 207.373 25.007 206.978 25.6918C206.597 26.3767 206.307 27.1833 206.11 28.1116C205.927 29.0247 205.835 30.0291 205.835 31.1248V32.038C205.835 33.0273 205.972 33.9404 206.247 34.7774C206.535 35.6144 206.939 36.3373 207.456 36.9461C207.989 37.5548 208.628 38.0267 209.374 38.3614C210.135 38.6961 210.995 38.8637 211.954 38.8637C213.141 38.8637 214.244 38.6354 215.264 38.1787C216.298 37.707 217.188 36.9994 217.935 36.0557L221.131 39.5257C220.614 40.2714 219.906 40.9867 219.007 41.6714C218.125 42.3564 217.059 42.9194 215.812 43.3607C214.564 43.7868 213.141 44 211.542 44ZM231.996 8.45661V43.5434H225.423V8.45661H231.996ZM247.566 18.8434L236.837 31.0793L231.083 36.9004L228.686 32.1521L233.252 26.3538L239.667 18.8434H247.566ZM240.74 43.5434L233.435 32.1293L237.977 28.1573L248.319 43.5434H240.74ZM265.006 37.631V18.8434H271.581V43.5434H265.394L265.006 37.631ZM265.737 32.5631L267.677 32.5174C267.677 34.161 267.487 35.6904 267.107 37.1058C266.727 38.506 266.155 39.7234 265.394 40.7584C264.634 41.778 263.674 42.577 262.517 43.1553C261.361 43.7184 259.999 44 258.431 44C257.23 44 256.119 43.8325 255.099 43.4977C254.094 43.1477 253.226 42.6074 252.497 41.877C251.782 41.1311 251.217 40.1801 250.808 39.0234C250.412 37.8516 250.214 36.4438 250.214 34.8001V18.8434H256.789V34.8458C256.789 35.5764 256.871 36.1927 257.04 36.695C257.222 37.1971 257.473 37.6081 257.792 37.9277C258.112 38.2473 258.484 38.4755 258.911 38.6125C259.352 38.7494 259.84 38.818 260.371 38.818C261.726 38.818 262.792 38.544 263.568 37.9961C264.359 37.4483 264.914 36.7026 265.234 35.759C265.569 34.8001 265.737 33.735 265.737 32.5631Z"
                                fill="white" />
                        </svg>

                    </a>

                    @if ($menus->where('slug', 'home-header-menu')->first())
                        <div class="hidden lg:flex lg:gap-4" id="navbar-menu">
                            @foreach ($menus->where('slug', 'home-header-menu')->first()->items->sortBy('order') as $item)
                                <a href="{{ $item->url }}"
                                    class="relative rounded-lg px-3 py-2 text-sm text-blue-200 transition-colors delay-150 hover:text-white hover:bg-white/10 hover:delay-[0ms]">{{ $item->name }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="flex items-center gap-6">
                    @guest
                        <a href="{{ route('auth.login') }}"
                            class="rounded py-1.5 px-6 text-sm font-semibold outline-2 outline-offset-2 overflow-hidden !text-white border border-white">Log
                            in</a>
                        <a href="{{ route('auth.register') }}"
                            class="rounded py-1.5 px-6 text-sm font-semibold outline-2 outline-offset-2 overflow-hidden bg-white !text-blue-600 border border-white">Register</a>
                    @else
                        <a href="/u/drive/1/home"
                            class="relative rounded-lg px-3 py-2 text-sm text-blue-200 transition-colors delay-150 hover:text-white hover:bg-white/10 hover:delay-[0ms] hidden lg:inline-block">File
                            Manager</a>
                        <div class="dropdown">
                            <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Your profile</span>
                                <img class="rounded-full z-10 size-8 bg-blue-800 relative"
                                    src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220,0,20,20%22%20width=%2296%22%20height=%2296%22%3E%3Crect%20height=%2220%22%20width=%2220%22%20fill=%22hsl%28285,25%25,50%25%29%22/%3E%3Ctext%20fill=%22white%22%20x=%2210%22%20y=%2214.4%22%20font-size=%2212%22%20font-family=%22-apple-system,BlinkMacSystemFont,Trebuchet%20MS,Roboto,Ubuntu,sans-serif%22%20text-anchor=%22middle%22%3EN%3C/text%3E%3C/svg%3E"
                                    alt="profile">
                            </button>
                            <div class="dropdown-menu" role="menu" aria-orientation="vertical" tabindex="-1">
                                <div class="px-4 py-3" role="none">
                                    <p class="tm-sm" role="none">Signed in as</p>
                                    <p class="truncate text-sm font-medium text-black dark:text-white" role="none">{{ Auth::user()?->name ?? '' }}</p>
                                </div>
                                <div class="py-1" role="none">
                                    <a href="/u/account" class="dropdown-item" role="menuitem" tabindex="-1">Account
                                        settings</a>
                                    <button id="theme-switch" class="dropdown-item flex justify-between" role="menuitem">
                                        <div>Theme</div>
                                        <div id="current-theme" class="tm capitalize"></div>
                                    </button>
                                    <a href="/u/support" class="dropdown-item" role="menuitem"
                                        tabindex="-1">Support</a>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#feedback"
                                        class="dropdown-item" role="menuitem" tabindex="-1">Feedback</button>
                                </div>
                                <div class="py-1" role="none">
                                    <a href="{{ route('auth.logout') }}" class="dropdown-item" role="menuitem"
                                        tabindex="-1">Log out</a>
                                </div>
                            </div>
                        @endguest

                        <div class="lg:hidden leading-[0]">
                            <button
                                class="relative z-10 -m-2 inline-flex items-center rounded-lg stroke-white p-2 hover:bg-white/10 active:stroke-gray-300 [&amp;:not(:focus-visible)]:focus:outline-none"
                                aria-label="Toggle site navigation" type="button" aria-expanded="false"
                                aria-controls="menu-mobile-dropdown-content">
                                <span class="sr-only">Menu</span>
                                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true" class="h-6 w-6">
                                    <path d="M5 6h14M5 18h14M5 12h14" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <div class="hidden fixed inset-0 z-0 backdrop-blur transition-opacity animate-fade-in"
                                aria-hidden="true"></div>
                            <div class="hidden absolute inset-x-0 top-0 z-0 origin-top rounded-b-2xl bg-blue-600 px-6 pb-6 pt-32 shadow-2xl shadow-gray-900/20 animate-slide-in-top"
                                id="menu-mobile-dropdown-content" tabindex="-1">
                                @if ($menus->where('slug', 'home-header-menu')->first())
                                    <div class="space-y-1 -mx-6">
                                        @foreach ($menus->where('slug', 'home-header-menu')->first()->items->sortBy('order') as $item)
                                            <a href="{{ $item->url }}"
                                                class="block py-1.5 px-6 text-base leading-7 tracking-tight text-blue-200 hover:text-white transition-colors hover:bg-white/10 delay-150 hover:delay-[0ms]">{{ $item->name }}</a>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="mt-8 flex flex-col gap-4 text-center">
                                    <a href="/login"
                                        class="rounded py-1.5 px-6 text-sm font-semibold outline-2 outline-offset-2 overflow-hidden !text-white border border-white">Log
                                        in</a>
                                    <a href="/register"
                                        class="rounded py-1.5 px-6 text-sm font-semibold outline-2 outline-offset-2 overflow-hidden bg-white !text-blue-600 border border-white">Register</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </nav>
    </header>
    @yield('content')

    <footer class="bg-white">
        <div class="mx-auto max-w-7xl overflow-hidden px-6 py-20 sm:py-24 lg:px-8">
            @if ($menus->where('slug', 'home-foot-menu')->first())
                <nav class="-mb-6 flex justify-center gap-x-12 flex-wrap" aria-label="Footer">

                @foreach ($menus->where('slug', 'home-foot-menu')->first()->items->sortBy('order') as $item)
                    <div class="pb-6">
                        <a href="{{ $item->url }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">{{ $item->name }}</a>
                    </div>
                @endforeach
                </nav>
            @endif


            <div class="mt-10 text-center text-xs gap-6 columns-2 flex justify-center">
                <a href="/terms" class="leading-6 text-gray-500 hover:text-gray-900">Terms of Use</a>
                <a href="/privacy" class="leading-6 text-gray-500 hover:text-gray-900">Privacy Policy</a>
            </div>

            <p class="mt-4 text-center text-xs leading-5 text-gray-500">© 2023 Safefileku. All rights reserved.</p>
        </div>
    </footer>
    <link rel="modulepreload" href="https://safefileku.com/build/assets/DDzrBGya.js" />
    <link rel="modulepreload" href="https://safefileku.com/build/assets/D547OYeC.js" />
    <script type="module" src="https://safefileku.com/build/assets/DDzrBGya.js"></script> <!-- Google tag (gtag.js) -->

    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML =
                        "window.__CF$cv$params={r:'9639a901b8cf0a04',t:'MTc1MzI1Nzc5NC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName('head')[0].appendChild(d)
                }
            }
            if (document.body) {
                var a = document.createElement('iframe');
                a.height = 1;
                a.width = 1;
                a.style.position = 'absolute';
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = 'none';
                a.style.visibility = 'hidden';
                document.body.appendChild(a);
                if ('loading' !== document.readyState) c();
                else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        'loading' !== document.readyState && (document.onreadystatechange = e, c())
                    }
                }
            }
        })();
    </script>

</body>

</html>
