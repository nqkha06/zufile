
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Link4Sub')</title>

    <link href="{{ asset('/fontend/stu/css/app.css') }}" rel="stylesheet" />

    <style>
:root {
    --color-bg: #f5f5f5;
    --color-text: #08102b;
    --color-header-bg: #fff;
    --color-header-border: #e0e0e0;
    --color-logo-text: #000;
    --color-icon-fill: #666;
    --color-icon-hover-bg: #f0f0f0;
    --color-dropdown-bg: #fff;
    --color-dropdown-border: #ddd;
    --color-dropdown-hover: #f9f9f9;
    --color-dropdown-active: #f0f0f0;
    --color-notice-bg: #fff;
    --color-notice-text: #333;
    --color-link: #1a73e8;
    --color-footer-text: #666;
    --color-footer-hover: #333;
    --color-shadow: rgba(0, 0, 0, 0.1);
}

.drK {
    --color-bg: #121212;
    --color-text: #e0e0e0;
    --color-header-bg: #1f1f1f;
    --color-header-border: #333;
    --color-logo-text: #fff;
    --color-icon-fill: #ccc;
    --color-icon-hover-bg: #2c2c2c;
    --color-dropdown-bg: #1f1f1f;
    --color-dropdown-border: #333;
    --color-dropdown-hover: #2a2a2a;
    --color-dropdown-active: #2c2c2c;
    --color-notice-bg: #1f1f1f;
    --color-notice-text: #ccc;
    --color-link: #90caf9;
    --color-footer-text: #aaa;
    --color-footer-hover: #fff;
    --color-shadow: rgba(255, 255, 255, 0.05);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    background-color: var(--color-bg);
    color: var(--color-text);
}

svg {
    width: 22px;
    height: 22px;
    fill: var(--color-text);
}

svg.line, svg .line {
    fill: none !important;
    stroke: var(--color-text);
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-width: 1;
}

.tDL .d2, .drK .tDL .d1 {
    display: none;
}

.drK .tDL .d2 {
    display: block;
}

.header {
    background-color: var(--color-header-bg);
    border-bottom: 1px solid var(--color-header-border);
    padding: 1rem 0;
}

.header__container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header__logo {
    display: flex;
    align-items: center;
    text-decoration: none;
    gap: 8px;
}

.header__logo-icon {
    width: 35px;
    height: 35px;
}

.header__logo-icon img {
    width: 35px;
}

.header__logo-text {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--color-logo-text);
}

.header__actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.header__theme-toggle {
    background: none;
    border: none;
    cursor: pointer;
    padding: 8px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.header__theme-toggle:hover {
    background-color: var(--color-icon-hover-bg);
}

.header__theme-toggle svg {
    width: 20px;
    height: 20px;
    fill: var(--color-icon-fill);
}

/* Language dropdown styles */
.header__language-wrapper {
    position: relative;
}

.header__language {
    background-color: var(--color-dropdown-bg);
    border: 1px solid var(--color-dropdown-border);
    padding: 8px 12px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 0.875rem;
    color: var(--color-text);
    cursor: pointer;
    min-width: 100px;
    justify-content: space-between;
}

.header__language:hover {
    background-color: var(--color-dropdown-hover);
}

.header__language::after {
    content: '';
    width: 0;
    height: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 6px solid var(--color-icon-fill);
    margin-left: 8px;
}

.header__language.active::after {
    border-top: none;
    border-bottom: 6px solid var(--color-icon-fill);
}

.header__language-icon {
    display: flex;
    align-items: center;
    gap: 5px;
}

.header__language-dropdown {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    background-color: var(--color-dropdown-bg);
    border: 1px solid var(--color-dropdown-border);
    border-radius: 8px;
    min-width: 150px;
    box-shadow: 0 4px 12px var(--color-shadow);
    z-index: 100;
    display: none;
}

.header__language-dropdown--open {
    display: block;
}

.header__language-item {
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: background-color 0.2s;
    color: var(--color-text);
}

.header__language-item:hover {
    background-color: var(--color-dropdown-hover);
}

.header__language-item:first-child {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}

.header__language-item:last-child {
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
}

.header__language-item--active {
    background-color: var(--color-dropdown-active);
}

.header__language-flag {
    width: 24px;
    height: 16px;
    object-fit: cover;
    border-radius: 2px;
}

/* Main content area */
.main {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.notice-box {
    background-color: var(--color-notice-bg);
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 1px 3px var(--color-shadow);
}

.notice-box__text {
    color: var(--color-notice-text);
    font-size: 0.9rem;
}

.notice-box__link {
    color: var(--color-link);
    text-decoration: none;
}

/* Footer */
.footer {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.footer__copyright {
    color: var(--color-footer-text);
    font-size: 0.875rem;
}

.footer__copyright-link {
    color: var(--color-link);
    text-decoration: none;
    margin-left: 4px;
}

.footer__top {
    color: var(--color-footer-text);
    font-size: 0.875rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
}

.footer__top:hover {
    color: var(--color-footer-hover);
}

.footer__top-icon {
    display: inline-block;
}

    </style>
</head>
<body>
    <script>
        /*<![CDATA[*/
        (localStorage.getItem('mode')) === 'darkmode' ? document.querySelector('body').classList.add('drK'): document
            .querySelector('body').classList.remove('drK') /*]]>*/
    </script>

    <header class="header">
        <div class="header__container">
            <a href="/" class="header__logo">
                <span class="header__logo-icon">
                    <img src="https://lh3.googleusercontent.com/-qzkf_sbFl_0/Y95VM5PDmKI/AAAAAAAAOyM/LVwC7BpFV_wGG6oLzCmoLAqPqBKwCcWPwCNcBGAsYHQ/link4sub-com.png" width="35">

                </span>
                <span class="header__logo-text">Link4Sub</span>
            </a>
            <div class="header__actions">
                <button class="header__theme-toggle tDL" onclick="darkMode()">
                    <svg class="line" viewBox="0 0 24 24">
                        <g class="d1">
                            <path d="M183.72453,170.371a10.4306,10.4306,0,0,1-.8987,3.793,11.19849,11.19849,0,0,1-5.73738,5.72881,10.43255,10.43255,0,0,1-3.77582.89138,1.99388,1.99388,0,0,0-1.52447,3.18176,10.82936,10.82936,0,1,0,15.118-15.11819A1.99364,1.99364,0,0,0,183.72453,170.371Z" transform="translate(-169.3959 -166.45548)"></path>
                        </g>
                        <g class="d2">
                            <path class="f" d="M12 18.5C15.5899 18.5 18.5 15.5899 18.5 12C18.5 8.41015 15.5899 5.5 12 5.5C8.41015 5.5 5.5 8.41015 5.5 12C5.5 15.5899 8.41015 18.5 12 18.5Z">
                            </path>
                            <path d="M19.14 19.14L19.01 19.01M19.01 4.99L19.14 4.86L19.01 4.99ZM4.86 19.14L4.99 19.01L4.86 19.14ZM12 2.08V2V2.08ZM12 22V21.92V22ZM2.08 12H2H2.08ZM22 12H21.92H22ZM4.99 4.99L4.86 4.86L4.99 4.99Z" stroke-width="2"></path>
                        </g>
                    </svg>
                </button>
                <div class="header__language-wrapper">
                    <button class="header__language" id="languageButton">
                        <span class="header__language-icon">
                            <svg class="line" viewBox="0 0 24 24"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"></path><path d="M7.99998 3H8.99998C7.04998 8.84 7.04998 15.16 8.99998 21H7.99998"></path><path d="M15 3C16.95 8.84 16.95 15.16 15 21"></path><path d="M3 16V15C8.84 16.95 15.16 16.95 21 15V16"></path><path d="M3 9.0001C8.84 7.0501 15.16 7.0501 21 9.0001"></path></svg>
                            <span id="currentLanguage">...</span>
                        </span>
                    </button>
                    <div class="header__language-dropdown" id="languageDropdown">
                        <div class="header__language-item header__language-item--active" data-lang="vi">
                            <span class="header__language-flag">🇻🇳</span>
                            Tiếng Việt
                        </div>
                        <div class="header__language-item" data-lang="en">
                            <span class="header__language-flag">🇺🇸</span>
                            English
                        </div>
                        <div class="header__language-item" data-lang="ja">
                            <span class="header__language-flag">ja</span>
                            Janpanese
                        </div>
                        <div class="header__language-item" data-lang="id">
                            <span class="header__language-flag">🇮🇩</span>
                            Indonesia
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="bg_stu">
            <div id="topAd"></div>
            <div class="stu-container" id="stuC">
                <div class='stu-box-wrap '>
                    <div class="loading-stu"></div>
                </div>
            </div>
            <div style="margin: 25px 0" id="botAd"></div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer__copyright">
            © 2025 - <a href="#" class="footer__copyright-link">LINK4SUB</a>
        </div>
        <div class="footer__top" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">
            Top <span class="footer__top-icon">
                <svg class='line' viewBox='0 0 24 24'>
                    <g transform="translate(12.000000, 12.000000) rotate(-180.000000) translate(-12.000000, -12.000000) translate(5.000000, 8.500000)">
                        <path d="M14,0 C14,0 9.856,7 7,7 C4.145,7 0,0 0,0"></path>
                    </g>
                </svg>
            </span>
        </div>
    </footer>

    <noscript>
        <input class='nJs hidden' id='forNoJS' type='checkbox' />
        <div class='noJs' data-text='{{ env('APP_NAME') }} works best with JavaScript enabled'>
            <label for='forNoJS'></label>
        </div>
    </noscript>

    <script>
const savedLang = localStorage.getItem('selectedLanguage');
const currentLang = savedLang || (navigator.language || navigator.userLanguage || 'en').split('-')[0];

const languageButton = document.getElementById('languageButton');
const languageDropdown = document.getElementById('languageDropdown');
const currentLanguageText = document.getElementById('currentLanguage');
const languageItems = document.querySelectorAll('.header__language-item');

// Mapping of language codes to display text
const languageMap = {
    'vi': 'Tiếng Việt',
    'en': 'English',
    'ja': 'Japanese',
    'id': 'Indonesia'
};

if (languageMap[currentLang]) {
    currentLanguageText.textContent = languageMap[currentLang];

    languageItems.forEach(item => {
        const langCode = item.getAttribute('data-lang');
        if (langCode === currentLang) {
            item.classList.add('header__language-item--active');
        } else {
            item.classList.remove('header__language-item--active');
        }
    });
}

languageButton.addEventListener('click', (e) => {
    e.stopPropagation();
    languageDropdown.classList.toggle('header__language-dropdown--open');
    languageButton.classList.toggle('active');
});

document.addEventListener('click', (e) => {
    if (!languageButton.contains(e.target) && !languageDropdown.contains(e.target)) {
        languageDropdown.classList.remove('header__language-dropdown--open');
        languageButton.classList.remove('active');
    }
});

languageItems.forEach(item => {
    item.addEventListener('click', () => {
        const langCode = item.getAttribute('data-lang');
        currentLanguageText.textContent = languageMap[langCode];

        languageItems.forEach(i => i.classList.remove('header__language-item--active'));
        item.classList.add('header__language-item--active');

        languageDropdown.classList.remove('header__language-dropdown--open');
        languageButton.classList.remove('active');

        localStorage.setItem('selectedLanguage', langCode);

    });
});

    </script>
    
    @stack('scripts')
    <script>
        function darkMode() {
            localStorage.setItem("mode", "darkmode" === localStorage.getItem("mode") ? "light" : "darkmode"), "darkmode" ===
                localStorage.getItem("mode") ? document.querySelector("body").classList.add("drK") : document
                .querySelector("body").classList.remove("drK")
        };
    </script>

    <script src="{{ asset('/fontend/stu/js/app2.js?v=' . time()) }}"></script>
</body>
</html>