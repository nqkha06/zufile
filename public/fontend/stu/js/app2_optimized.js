/*<![CDATA[*/

// Constants and configuration
const CONFIG = {
    STU_KEY: '_STU',
    CLICK_KEY: '_CLICK',
    RD_KEY: '_RD',
    OLD_KEY: '_OLD',
    ALIAS_KEY: '_ALIAS',
    FAVICON_URL: "https://link4sub.com/images/favicon.png",
    CACHE_TIMEOUT: 3600 * 1000 * 2, // 2 hours
    COOKIE_MAX_AGE: 86400 * 1000, // 1 day
    BUTTON_TIMEOUT: 6000,
    API_TIMEOUT: 1500
};

var stSTU = {
    'aApi': {
        'userId': [40, 'user'],
        'lAPI': [
            'https://yeumoney.com/QL_api.php?token=5b539c82581a36409cab82695111565f5df92ee284414b49d4d22ff7990efefb&url='
        ]
    },
};

// Utility functions
const Utils = {
    dcSTU(s) {
        if (!s || typeof s !== 'string') return false;
        try {
            const decoded = decodeURIComponent(atob(s));
            return decoded !== null ? decoded : false;
        } catch (e) {
            return false;
        }
    },

    ecSTU(s) {
        try {
            return btoa(encodeURIComponent(s)) ?? null;
        } catch (e) {
            return null;
        }
    },

    randomSelect(arr) {
        return arr[Math.floor(Math.random() * arr.length)];
    },

    debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    },

    distributeActions(actions, T) {
        let isObject = false;
        if (!Array.isArray(actions)) {
            if (typeof actions === 'object' && actions !== null) {
                isObject = true;
                actions = Object.entries(actions);
            } else {
                throw new Error('Invalid input: actions must be an array or an object');
            }
        }

        const N = actions.length;
        const q = Math.floor(N / T);
        const r = N % T;
        const steps = [];
        let startIndex = 0;

        for (let i = 0; i < T; i++) {
            const numActions = q + (i < r ? 1 : 0);
            const stepEntries = actions.slice(startIndex, startIndex + numActions);

            if (isObject) {
                const stepObject = Object.fromEntries(stepEntries);
                steps.push(stepObject);
            } else {
                steps.push(stepEntries);
            }

            startIndex += numActions;
        }

        return steps;
    }
};

// Enhanced xQK utility object
const xQK = {
    getCookie(name) {
        const match = document.cookie.match(new RegExp('(?:^|; )' + name.replace(/([.$?*|{}()[\]/+^])/g, '$1') + '=([^;]*)'));
        return match ? decodeURIComponent(match[1]) : undefined;
    },

    setCookie(name, value, options = {}) {
        const defaultOptions = {
            path: '/',
            ...options,
        };

        if (defaultOptions.expires instanceof Date) {
            defaultOptions.expires = defaultOptions.expires.toUTCString();
        }

        let cookie = `${encodeURIComponent(name)}=${encodeURIComponent(value)}`;

        for (const [key, val] of Object.entries(defaultOptions)) {
            cookie += `; ${key}`;
            if (val !== true) {
                cookie += `=${val}`;
            }
        }

        document.cookie = cookie;
    },

    deleteCookie(name) {
        this.setCookie(name, '', { 'max-age': -1 });
    },

    getLocalStorage(key) {
        try {
            const jsonString = localStorage.getItem(key);
            return jsonString ? JSON.parse(jsonString) : null;
        } catch (e) {
            console.warn(`Error parsing localStorage key "${key}":`, e);
            return null;
        }
    },

    setLocalStorage(key, value) {
        try {
            const jsonString = JSON.stringify(value);
            localStorage.setItem(key, jsonString);
            return true;
        } catch (e) {
            console.error(`Error setting localStorage key "${key}":`, e);
            return false;
        }
    },

    deleteLocalStorage(key) {
        localStorage.removeItem(key);
    },

    async fetchData(url, options = {}) {
        const defaultOptions = {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
            ...options
        };

        try {
            const response = await fetch(url, defaultOptions);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            return await response.json();
        } catch (error) {
            console.error('Fetch error:', error);
            throw error;
        }
    },

    showError(error) {
        const element = document.querySelector('#stuC .stu-box-wrap');
        if (element?.querySelector('.loading-stu')) {
            element.innerHTML = '<div style="font-size: 30px;color: #f00;font-weight: bold;">Oops!! Đã có lỗi xảy ra, vui lòng thử lại sau..</div>';
        }
    },

    async loadExternalScript(src) {
        return new Promise((resolve, reject) => {
            if (document.querySelector(`script[src="${src}"]`)) {
                resolve(src);
                return;
            }

            const script = document.createElement('script');
            script.src = src;
            script.onload = () => resolve(src);
            script.onerror = () => reject(new Error(`Failed to load script: ${src}`));
            document.head.appendChild(script);
        });
    },

    async executeScripts(containerElement) {
        const scripts = containerElement.querySelectorAll('script');

        for (const script of scripts) {
            try {
                if (script.src) {
                    await this.loadExternalScript(script.src);
                } else {
                    const newScript = document.createElement('script');
                    [...script.attributes].forEach(attr => newScript.setAttribute(attr.name, attr.value));
                    newScript.textContent = script.textContent;
                    script.parentNode.replaceChild(newScript, script);
                }
            } catch (error) {
                console.error('Script execution error:', error);
            }
        }
    },

    async updateContent(htmlContent, selector) {
        try {
            const container = document.querySelector(selector ?? '#topAd');
            if (!container) {
                throw new Error(`Container element "${selector}" not found`);
            }

            container.innerHTML = htmlContent;
            await this.executeScripts(container);
            console.log('Content updated and scripts executed successfully');
        } catch (error) {
            console.error('Error updating content:', error);
        }
    },

    getParam(key) {
        return new URLSearchParams(window.location.search).get(key);
    }
};

// Language management
const LanguageManager = {
    async reloadLanguage(lang) {
        try {
            const stuData = xQK.getLocalStorage(CONFIG.STU_KEY);
            if (!stuData) return false;

            const data = await xQK.fetchData(
                `/api/${stuData.data.info.alias}/fetch-data?lang=${lang}`
            );

            xQK.setLocalStorage(CONFIG.STU_KEY, data.data);
            main();
            return true;
        } catch (error) {
            console.error('Error loading language:', error);
            return false;
        }
    },

    getCurrentLanguage() {
        const savedLang = xQK.getLocalStorage('selectedLanguage');
        return savedLang || (navigator.language || navigator.userLanguage || 'en').split('-')[0];
    },

    setupLanguageDropdown() {
        const currentLang = this.getCurrentLanguage();
        const languageButton = document.getElementById('languageButton');
        const languageDropdown = document.getElementById('languageDropdown');
        const currentLanguageText = document.getElementById('currentLanguage');
        const languageItems = document.querySelectorAll('.header__language-item');

        if (!languageButton || !languageDropdown) return;

        const languageMap = {
            'vi': 'Tiếng Việt',
            'en': 'English',
            'ja': 'Japanese',
            'id': 'Indonesia'
        };

        // Set current language display
        if (languageMap[currentLang]) {
            currentLanguageText.textContent = languageMap[currentLang];
        }

        // Update active state
        languageItems.forEach(item => {
            const langCode = item.getAttribute('data-lang');
            item.classList.toggle('header__language-item--active', langCode === currentLang);
        });

        // Event listeners
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
                this.reloadLanguage(langCode);
            });
        });
    }
};

// STU validation and setup
const STUManager = {
    async checkSTU() {
        const getStorageSTU = xQK.getLocalStorage(CONFIG.STU_KEY);
        const getStorageALIAS = xQK.getParam('a') || xQK.getLocalStorage(CONFIG.ALIAS_KEY);

        // Clean URL parameters
        this.cleanURL(['a', 'sttSTU']);

        if (getStorageALIAS) {
            return await this.fetchNewSTUData(getStorageALIAS);
        }

        // Check cache validity
        if (getStorageSTU?.data?.info?.timestamp &&
            (Date.now() - getStorageSTU.data.info.timestamp <= CONFIG.CACHE_TIMEOUT)) {
            return true;
        }

        return false;
    },

    async fetchNewSTUData(alias) {
        try {
            const currentLang = LanguageManager.getCurrentLanguage();
            const getSTT = this.parseSTTFromURL();

            const data = await xQK.fetchData(`/api/${alias}/fetch-data?lang=${currentLang}`);

            if (!data || data.status !== 'success') {
                document.body.classList.remove('onSTU');
                return false;
            }

            xQK.deleteCookie(CONFIG.OLD_KEY);
            xQK.setLocalStorage(CONFIG.STU_KEY, data.data);
            xQK.setLocalStorage(CONFIG.ALIAS_KEY, alias);

            if (getSTT) {
                xQK.setCookie(CONFIG.OLD_KEY, JSON.stringify(getSTT));
            }

            return true;
        } catch (error) {
            xQK.showError(error);
            return false;
        }
    },

    parseSTTFromURL() {
        try {
            const sttParam = xQK.getParam('sttSTU');
            return sttParam ? JSON.parse(Utils.dcSTU(sttParam)) : null;
        } catch (error) {
            console.warn('Error parsing sttSTU parameter:', error);
            return null;
        }
    },

    cleanURL(params) {
        const url = new URL(window.location.href);
        params.forEach(param => url.searchParams.delete(param));
        window.history.replaceState({}, '', url.toString());
    }
};

// Configuration and state management
function handleConfig(configs, data) {
    const format_config = {};

    Object.entries(configs).forEach(([key, types]) => {
        if (key === 'click2') {
            format_config[key] = types;
        } else {
            format_config[key] = Utils.randomSelect(types);
        }
    });

    return format_config;
}

// State management
const StateManager = {
    initializeState(linkData) {
        return {
            config: linkData?.config ? handleConfig(linkData.config, linkData.data) : null,
            data: linkData?.data ?? null,
            old: JSON.parse(xQK.getCookie(CONFIG.OLD_KEY) || '{}'),
            rd: JSON.parse(xQK.getCookie(CONFIG.RD_KEY) || '{}'),
            click: JSON.parse(xQK.getCookie(CONFIG.CLICK_KEY) || '{}'),
        };
    },

    setSTT(state, tag = null, key = null) {
        state.btn ??= {};
        state.adclick ??= {};

        switch (tag) {
            case 'btn':
            case 'adclick':
                state[tag][key] = true;
                break;
            case 'curr_page':
                state.btn.curr_page = (state.btn.curr_page ?? 1) + 1;
                break;
            default:
                state[tag] = true;
        }

        xQK.setCookie(CONFIG.OLD_KEY, JSON.stringify(state), {
            secure: 1,
            'max-age': 1800 * 1000 * 2 // 60 minutes
        });
    }
};

// UI Handlers
const UIHandlers = {
    init(STATE) {
        this.setupButtonHandlers(STATE);
        this.setupClickHandlers(STATE);
        this.setupAdHandlers(STATE);
    },

    setupButtonHandlers(STATE) {
        // Implementation for button handlers
        this.handleButtonClicks(STATE);
    },

    setupClickHandlers(STATE) {
        // Implementation for click handlers
        this.handleSTUClicks(STATE);
    },

    setupAdHandlers(STATE) {
        // Implementation for ad handlers
        this.handleAds(STATE);
    },

    handleButtonClicks(STATE) {
        document.addEventListener('click', (e) => {
            const button = e.target.closest('.stu-btn');
            if (!button) return;

            this.processButtonClick(button, STATE);
        });
    },

    handleSTUClicks(STATE) {
        const container = document.querySelector('.stu-container');
        if (!container) return;

        container.addEventListener('click', (e) => {
            const btn = e.target.closest('.stu-btn');
            if (!btn) return;

            this.handleSpecialClicks(btn, STATE);
        });
    },

    handleSpecialClicks(btn, STATE) {
        // Pop-under handler
        if (btn.dataset.pop !== undefined) {
            e.preventDefault();
            delete btn.dataset.pop;
            const { link } = this.getUnitPopunder(STATE);
            window.open(link, '_blank');
            return;
        }

        // Direct redirect handler
        if (btn.href && btn.dataset.direct !== undefined) {
            delete btn.dataset.direct;
            const { link, timer } = this.getUnitDirect(STATE);
            if (link && timer) {
                setTimeout(() => (window.location.href = link), timer);
            }
        }

        // Count click handler
        if (btn.href && btn.dataset.dest !== undefined) {
            fetch(STATE?.data?.info?.url_count).catch(console.error);
        }

        // Verify handler
        if (btn.href && btn.dataset.verify !== undefined) {
            delete btn.dataset.verify;
            StateManager.setSTT(STATE.old, 'verify');
        }

        // Next page handler
        if (btn.href && (btn.dataset.next !== undefined || btn.dataset.btn !== undefined)) {
            StateManager.setSTT(STATE.old, 'curr_page');
        }
    },

    processButtonClick(button, STATE) {
        if (button.classList.contains('done') || button.querySelector('i')?.classList.contains('load')) {
            return;
        }

        const iconElmt = button.querySelector('i');
        const spanElmt = button.querySelector('span');

        if (iconElmt) {
            iconElmt.innerHTML = iconSTU['loader'];
            iconElmt.classList.add('load');
        }

        if (!button.classList.contains('ad-click')) {
            if (spanElmt) spanElmt.innerText = stSTU.txt?.load || 'Loading...';

            StateManager.setSTT(STATE.old, 'btn', button.getAttribute('data-id'));

            setTimeout(() => {
                this.completeButton(button);
            }, CONFIG.BUTTON_TIMEOUT);
        } else {
            this.handleAdClick(button, STATE);
        }
    },

    completeButton(button, text = stSTU.txt?.done || 'Done', icon = ['', 'check']) {
        const [lftI, rgtI] = icon;
        const iconElt = button.querySelector('i');
        const span = button.querySelector('span');

        if (iconElt) {
            iconElt.classList.remove('load');
            iconElt.innerHTML = iconSTU?.[rgtI] || '';
        }

        button.classList.add('done');

        if (span) {
            span.innerText = text;
        }

        return true;
    },

    handleAdClick(button, STATE) {
        // Ad click implementation
        const { config } = STATE;
        const configCAd = config?.click;

        if (!configCAd) {
            setTimeout(() => this.completeButton(button), CONFIG.API_TIMEOUT);
            return;
        }

        const spanElmt = button.querySelector('span');
        if (spanElmt) spanElmt.innerText = 'Đang xác minh...';

        // Check for visible ads
        const isAdVisible = (selectors) => {
            const shuffled = selectors.sort(() => 0.5 - Math.random());
            return shuffled.find(pos => {
                const adE = document.querySelector(pos);
                return adE?.offsetHeight >= 100;
            }) || false;
        };

        const sAd = isAdVisible(configCAd.select.split(','));

        if (sAd) {
            this.setupAdVerification(button, sAd, STATE);
        } else {
            setTimeout(() => this.completeButton(button), CONFIG.API_TIMEOUT);
        }
    },

    setupAdVerification(button, adSelector, STATE) {
        const eltAd = document.querySelector(adSelector);
        const notificationText = `
            <p id="notif-ad" class="note">
                <span class="point-down">👇</span> Vui lòng nhấp vào quảng cáo bên dưới, chờ khoảng 10 giây trên trang đó rồi quay lại để tiếp tục.!
            </p>
        `;

        eltAd.insertAdjacentHTML('beforebegin', notificationText);

        const scrollToElement = (element, delay = 0) =>
            new Promise(resolve =>
                setTimeout(() => {
                    element.scrollIntoView({ behavior: "smooth", block: "center" });
                    resolve();
                }, delay)
            );

        const rmAd = () => {
            StateManager.setSTT(STATE.old, 'btn', button.getAttribute('data-id'));
            this.updateClickState(STATE);
            eltAd.removeAttribute('mark-ad');
            document.getElementById('notif-ad')?.remove();
            console.log('Ad clicked..');
            scrollToElement(button, 500).then(() => this.completeButton(button));
        };

        scrollToElement(document.getElementById('notif-ad'))
            .then(() => scrollToElement(eltAd))
            .then(() => {
                eltAd.setAttribute('mark-ad', 'true');
                eltAd.addEventListener('click', rmAd, { once: true });
                window.addEventListener("blur", () => {
                    if (document.activeElement === eltAd) rmAd();
                });
            });
    },

    updateClickState(STATE) {
        const level = Utils.dcSTU(STATE.data?.oth?.lv);
        const obj = STATE.click;
        const currT = new Date().getTime();

        obj[level] = [1, currT];
        xQK.setCookie(CONFIG.CLICK_KEY, JSON.stringify(obj), {
            secure: 1,
            'max-age': CONFIG.COOKIE_MAX_AGE * 5
        });
    },

    getUnitDirect(STATE) {
        const cfObj = STATE.config['direct'];
        const links = cfObj.link.split(',').map(link => link.trim());
        return {
            'link': Utils.randomSelect(links),
            'timer': cfObj.timer ?? 1
        };
    },

    getUnitPopunder(STATE) {
        const cfObj = STATE.config['popunder'];
        const links = cfObj.link.split(',').map(link => link.trim());
        return {
            'link': Utils.randomSelect(links)
        };
    },

    handleAds(STATE) {
        if (STATE.config?.['banner']) {
            const cfAd = STATE.config['banner'];
            const selectors = cfAd.select.split(",");

            selectors.forEach(select => {
                xQK.updateContent(cfAd.html, select);
            });
        }
    }
};

// STU Renderer
class STURenderer {
    constructor(STATE) {
        this.STATE = STATE;
        this.IS_PWD = false;
    }

    render() {
        const { direct, popunder, setting, next, click, click2, step } = this.STATE.config;
        const { btn, info, oth, lnk } = this.STATE.data;

        const totalPages = parseInt(setting?.['total_page'] ?? 1) || 1;
        const currentPage = this.STATE.old?.btn?.curr_page || 1;

        // Check expiration
        if (oth.exp && Date.parse(new Date(Utils.dcSTU(oth.exp))) > Date.parse(new Date().toISOString().slice(0, 16))) {
            alert('The link has expired..');
            location.href = 'https://link4sub.com/';
            return;
        }

        document.title = Utils.dcSTU(oth.ttl);

        // Handle verification or main content
        if (!this.STATE.old?.verify && this.STATE.config?.verify) {
            this.renderVerification();
        } else {
            this.renderMainContent(totalPages, currentPage);
        }

        this.setupEventListeners();
        this.initializeProgress();
        LanguageManager.setupLanguageDropdown();
    }

    renderVerification() {
        const cfVerify = this.STATE.config.verify;
        const container = document.getElementById('stuC');
        if (container) {
            container.innerHTML = this.generateVerifyHTML(
                Utils.randomSelect(cfVerify.links.split(',').map(link => link.trim())),
                this.STATE.config?.direct?.active
            );
        }
    }

    renderMainContent(totalPages, currentPage) {
        const container = document.getElementById('stuC');
        if (container) {
            container.innerHTML = this.generateMainHTML(totalPages, currentPage);
        }

        this.setupPasswordForm();
    }

    generateVerifyHTML(link, direct = true) {
        return `
            <div class="stu-box-wrap">
                <div class="hmv alt" id="content">
                    <div class="hmvH">
                        <div class="hmvH-icon" id="icon">
                            <svg class="line safe" viewBox="0 0 24 24">
                                <path d="M13.0601 10.9399C15.3101 13.1899 15.3101 16.8299 13.0601 19.0699C10.8101 21.3099 7.17009 21.3199 4.93009 19.0699C2.69009 16.8199 2.68009 13.1799 4.93009 10.9399"></path>
                                <path d="M10.59 13.4099C8.24996 11.0699 8.24996 7.26988 10.59 4.91988C12.93 2.56988 16.73 2.57988 19.08 4.91988C21.43 7.25988 21.42 11.0599 19.08 13.4099"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="hmvB">
                        <div class="hmvB-title" id="title-popup">${stSTU.txt?.verify?.title || 'Verify'}</div>
                    </div>
                    <div class="hmvF">
                        <a class="button pstL stu-btn" data-verify ${direct ? 'target="_blank" data-direct="true"' : ''} href="${link}">
                            ${stSTU.txt?.verify?.btn || 'Verify'}
                        </a>
                    </div>
                </div>
            </div>
        `;
    }

    generateMainHTML(totalPages, currentPage) {
        const { btn, info, oth, lnk } = this.STATE.data;
        const { direct, popunder, setting, next, click, click2, step } = this.STATE.config;

        const actions = Utils.distributeActions(btn, totalPages)[currentPage - 1];

        let htmlBtn = '';
        let htmlBtnC = '';
        let htmlDest = '';

        // Generate buttons
        if (actions && Object.keys(actions).length) {
            htmlBtn = Object.entries(actions)
                .map(([key, { ic, url, name }]) =>
                    this.createBtn(key, Utils.dcSTU(url), Utils.dcSTU(name), Utils.dcSTU(ic))
                )
                .join('');
        }

        // Generate ad click buttons
        if (click && this.shouldShowAd(click, currentPage)) {
            const eltAdClick = this.createAD('ad-click', click.name, 'ad-click', iconSTU[click.icon], iconSTU.chevr);
            htmlBtn = (click.position === 'last') ? htmlBtn + eltAdClick : eltAdClick + htmlBtn;
        }

        // Generate step buttons
        if (step && this.shouldShowStep(step, currentPage)) {
            const link = Utils.randomSelect(step.links.split(","));
            const eltAdClick = this.createBtn('ad-step-add', link, step.name, step.icon, iconSTU.chevr);
            htmlBtn = (step.position === 'last') ? htmlBtn + eltAdClick : eltAdClick + htmlBtn;
        }

        // Generate destination
        htmlDest = this.generateDestination(currentPage, totalPages, next, lnk, info, oth);

        // Generate click2 buttons
        if (click2) {
            htmlBtnC = this.generateClick2Buttons(click2, currentPage);
        }

        const eltThumb = (currentPage === 2 || !oth.thmb) ? '' : this.createThumb(Utils.dcSTU(oth.thmb));

        return `
            <div class='note'>${Utils.dcSTU(oth.note)}</div>
            <div class='stu-box-wrap s${oth.sty ? Utils.dcSTU(oth.sty) : 1}'>
                <div class='t'>
                    <h2 class='t-title'>${Utils.dcSTU(oth.ttl)}</h2>
                    <h3 class='t-s-title'>${Utils.dcSTU(oth.sttl)}</h3>
                </div>
                <div class='i'>${eltThumb}</div>
                <div class='b' id='actionGroups'>${htmlBtn}</div>
                <div class='c' id='adClickBtns'>${htmlBtnC}</div>
                <div class='p' id='pg'></div>
                <div class='d ${this.IS_PWD ? 'p' : ''}'>${htmlDest}</div>
                <div class="f">
                    <div class="ft">
                        <span>${stSTU.txt?.ft?.created_with || 'Created with'} </span>
                        <img src="${stSTU.txt?.ft?.i_url || CONFIG.FAVICON_URL}">
                        <a href='${stSTU.txt?.ft?.url || 'https://link4sub.com/'}'> ${stSTU.txt?.ft?.name || 'Link4Sub'}</a>
                    </div>
                </div>
            </div>
        `;
    }

    shouldShowAd(click, currentPage) {
        const page_appears = click.page_appear.split(",").map(i => parseInt(i.trim()));
        return this.rdmV(click.appr_rate) && this.checkClick(Utils.dcSTU(this.STATE.data.oth.lv), 'c') && page_appears.includes(currentPage);
    }

    shouldShowStep(step, currentPage) {
        const page_appears = step.page_appear.split(",").map(i => parseInt(i.trim()));
        return page_appears.includes(currentPage);
    }

    generateDestination(currentPage, totalPages, next, lnk, info, oth) {
        let destAttrs = {};
        let htmlDest = '';

        if (this.STATE.config.direct) {
            destAttrs['data-direct'] = true;
            destAttrs['target'] = '_blank';
        }
        if (this.STATE.config.popunder) {
            destAttrs['data-pop'] = true;
        }

        if (currentPage < totalPages) {
            destAttrs['data-btn'] = true;
            const link = Utils.randomSelect(next.links.split(",").map(s => s.trim())) || [window.location.href];
            htmlDest = `
                <div class='cl'>
                    ${this.createDest(Utils.ecSTU(link), `${stSTU?.txt?.next_step ?? ''} ${(currentPage <= totalPages) ? '(' + (currentPage) + '/' + totalPages + ')' : ''}`, iconSTU['link'], iconSTU['lock'], destAttrs)}
                </div>
            `;
        } else if (next && currentPage === totalPages) {
            destAttrs['data-next'] = true;
            const link = Utils.randomSelect(next.links.split(",").map(s => s.trim())) || [window.location.href];
            htmlDest = `
                <div class='cl'>
                    ${this.createDest(Utils.ecSTU(link), stSTU?.txt?.next_step ?? '', iconSTU['link'], iconSTU['lock'], destAttrs)}
                </div>
            `;
        } else {
            destAttrs['data-dest'] = true;
            if (oth.pwd) {
                this.IS_PWD = true;
            }
            htmlDest = '<div class="cl">';
            for (const [_, value] of Object.entries(lnk)) {
                const href = stSTU.aApi && stSTU.aApi.userId.includes(Number(info.userId))
                    ? Utils.ecSTU(`${Utils.randomSelect(stSTU.aApi.lAPI)}${Utils.dcSTU(value.url)}`)
                    : value.url;
                htmlDest += this.createDest(href, stSTU.txt?.continue || 'Continue', iconSTU['link'], iconSTU['lock'], destAttrs);
            }
            htmlDest += `</div><div class='cp'>${this.IS_PWD ? this.createPasswordForm() : ''}</div>`;
        }

        return htmlDest;
    }

    generateClick2Buttons(click2, currentPage) {
        return click2.map(item => {
            const page_appears = item.page_appear.split(",").map(i => parseInt(i.trim()));
            if (page_appears.includes(currentPage)) {
                const link = Utils.randomSelect((item.links).split(','));
                return this.createBtn(item.type, link, item.name, item.icon);
            }
            return '';
        }).join('');
    }

    createBtn(id, link, name, rightIcon, leftIcon = null) {
        return `
            <a class='stu-btn ${rightIcon}' data-id='${id}' href='${link}' data-name='${name}' target='_blank'>
                ${iconSTU?.[rightIcon] || ''}
                <span>${name}</span>
                <i class='lft-i'>${iconSTU?.chevr || ''}</i>
            </a>
        `;
    }

    createDest(link, name, rightIcon, leftIcon, attrs) {
        let attributes = '';
        for (const key in attrs) {
            if (attrs.hasOwnProperty(key)) {
                attributes += `${key}='${attrs[key]}' `;
            }
        }

        return `
            <a class='stu-btn link' data-href='${link}' ${attributes}>
                ${leftIcon || ''}
                <span>${name}</span>
                <i class='lft-i'>${rightIcon || ''}</i>
            </a>
        `;
    }

    createAD(dataId, name, className, leftIcon, rightIcon) {
        return `
            <a class='stu-btn ${className}' data-id='${dataId}'>
                ${leftIcon || ''}
                <span>${name}</span>
                <i class='lft-i'>${rightIcon || ''}</i>
            </a>
        `;
    }

    createThumb(urlThumb) {
        return `
            <div class='thumbyt'>
                <div class='lazy' style='background-image:url(${urlThumb})'></div><br>
            </div>
        `;
    }

    createPasswordForm() {
        return `
            <form>
                <div class="stu_dc_pwd_group">
                    <label class="stu_dc_pwd_label">${stSTU.txt?.password || 'Password'}</label>
                    <input class="stu_dc_pwd_input" type="text" autocomplete="off" name="stu_pwd" placeholder="${stSTU.txt?.enter_password || 'Enter password'}" required />
                </div>
                <p>${stSTU.txt?.enter_password_war || 'Please enter the correct password'}</p>
                <button type="submit">${stSTU.txt?.confirm_password || 'Confirm'}</button>
            </form>
        `;
    }

    setupPasswordForm() {
        if (!this.IS_PWD) return;

        const pwdForm = document.querySelector(".stu-box-wrap>.d .cp form");
        if (!pwdForm) return;

        pwdForm.addEventListener("submit", (event) => {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            const pwd = Utils.dcSTU(this.STATE.data.oth.pwd);
            const inp_pwd = formData.get("stu_pwd");

            if (inp_pwd === pwd) {
                const pSection = document.querySelector(".stu-box-wrap>.d");
                if (pSection) {
                    pSection.classList.remove("p");
                }
            } else {
                alert("Mật khẩu không đúng!");
                pwdForm.reset();
                pwdForm.querySelector("input")?.focus();
            }
        });
    }

    setupEventListeners() {
        // Process completed buttons
        this.processCompletedButtons();

        // Setup button click handlers
        this.setupButtonClickHandlers();
    }

    processCompletedButtons() {
        // Process buttons in STATE
        this.processButtons(this.STATE.old.btn, '.b > a');
        this.processButtons(this.STATE.old.adclick, '.c > a');
    }

    processButtons(group, selector) {
        for (const key in group) {
            if (group.hasOwnProperty(key) && group[key]) {
                const button = document.querySelector(`${selector}[data-id="${key}"]`);
                if (button) {
                    UIHandlers.completeButton(button);
                }
            }
        }
    }

    setupButtonClickHandlers() {
        // Button group B handlers
        document.querySelectorAll('.stu-box-wrap >.b a.stu-btn').forEach(button => {
            button.addEventListener('click', () => {
                UIHandlers.processButtonClick(button, this.STATE);
            });
        });

        // Button group C handlers
        document.querySelectorAll('.stu-box-wrap >.c a.stu-btn').forEach(button => {
            button.addEventListener('click', () => {
                UIHandlers.processButtonClick(button, this.STATE);
            });
        });
    }

    initializeProgress() {
        this.renderProgress();
    }

    renderProgress() {
        const { totalB, doneB } = this.getBtnCounts();

        if (totalB > 0) {
            const percent = Math.floor((doneB / totalB) * 100);
            const progressText = stSTU.txt?.unlock_progress || 'Progress';
            const progressCount = `<span id="prog01">${doneB}</span>/<span id="prog02">${totalB}</span>`;

            const progressElement = document.getElementById('pg');
            if (progressElement) {
                progressElement.innerHTML = this.buildProgressHTML(percent, progressText, progressCount);
            }
        }

        // Check if all buttons are done
        if (totalB === doneB) {
            this.unlockButtons(document.querySelectorAll('.stu-box-wrap .d a'));
        }
    }

    getBtnCounts() {
        return {
            totalB: document.querySelectorAll('.stu-box-wrap>.b a.stu-btn, .stu-box-wrap>.c a.stu-btn').length,
            doneB: document.querySelectorAll('.stu-box-wrap a.stu-btn.done').length,
        };
    }

    buildProgressHTML(percent, text, count) {
        const sClass = (percent === 100) ? 's' : '';
        return `
            <div>${text} ${count}</div>
            <div class="stu-progs">
                <div id="stuBar" class="${sClass}" style="width:${percent}%"></div>
            </div>
        `;
    }

    unlockButtons(buttons, lftI = 'unlock', rgtI = '') {
        buttons.forEach(button => {
            const destDtHref = button.getAttribute('data-href');
            if (Utils.dcSTU(destDtHref) && !button.getAttribute('data-dest')) {
                const decodedHref = Utils.dcSTU(destDtHref);
                let urlDirect;

                if (new URL(decodedHref).hostname === location.hostname) {
                    urlDirect = decodedHref;
                } else {
                    let cloneStateOld = { ...JSON.parse(xQK.getCookie(CONFIG.OLD_KEY) || '{}') };
                    cloneStateOld.btn = cloneStateOld.btn || {};
                    cloneStateOld.btn.curr_page = (cloneStateOld.btn.curr_page || 1) + 1;

                    let params = {
                        a: this.STATE?.data?.info?.alias,
                        sttSTU: Utils.ecSTU(JSON.stringify(cloneStateOld || '{}'))
                    };

                    urlDirect = new URL(decodedHref);
                    for (let key in params) {
                        urlDirect.searchParams.set(key, params[key]);
                    }
                }
            } else {
                urlDirect = Utils.dcSTU(destDtHref);
            }

            if (destDtHref) {
                button.setAttribute('href', urlDirect);
            }

            button.classList.remove('lock');
            button.classList.add('unlock');

            if (button.firstElementChild?.tagName === 'svg') {
                button.removeChild(button.firstElementChild);
            }

            button.innerHTML = (iconSTU?.[lftI] || '') + button.innerHTML;
        });

        return true;
    }

    rdmV(probability) {
        const adData = this.STATE.rd;
        const currentTime = Date.now();
        const level = Utils.dcSTU(this.STATE.data.oth.lv);

        // Check if ad data exists for current level
        if (adData[level]) {
            const [lastAdTime, adShown] = adData[level];
            if (adShown && currentTime - lastAdTime < this.STATE.config.click['reset_time'] * 1000) {
                return true;
            }
        }

        // Calculate whether to show ad based on probability
        const showAd = Math.random() * 100 <= probability;
        adData[level] = [currentTime, showAd];

        xQK.setCookie(CONFIG.RD_KEY, JSON.stringify(adData), {
            secure: 1,
            'max-age': CONFIG.COOKIE_MAX_AGE
        });

        return showAd;
    }

    checkClick(level, act) {
        const obj = this.STATE.click;
        const currT = new Date().getTime();
        const config = this.STATE.config['click'];

        if (act === 'c') {
            if (this.STATE.old.ad1 || Object.keys(obj).length === 0 || !obj[level] ||
                currT - obj[level][1] >= config['exist_time'] * 1000) {
                return true;
            } else {
                return false;
            }
        } else if (act === 'u') {
            obj[level] = [1, currT];
            xQK.setCookie(CONFIG.CLICK_KEY, JSON.stringify(obj), {
                secure: 1,
                'max-age': CONFIG.COOKIE_MAX_AGE * 5
            });
        }
    }
}

function loadHeader() {
    const headerElement = document.getElementById('Header1');
    if (headerElement) {
        headerElement.innerHTML = `
            <div class="headInnr">
                <h1 class="headH">
                    <bdi>
                        <span class="headLogo">
                            <img src="https://lh3.googleusercontent.com/-qzkf_sbFl_0/Y95VM5PDmKI/AAAAAAAAOyM/LVwC7BpFV_wGG6oLzCmoLAqPqBKwCcWPwCNcBGAsYHQ/link4sub-com.png" width="35">
                        </span>
                        <span class="headTtl">Link4Sub</span>
                    </bdi>
                </h1>
            </div>
        `;
    }
}

function setFavicon(url) {
    let faviconLink = document.querySelector('link[rel="icon"]');
    if (faviconLink) {
        faviconLink.href = url;
    } else {
        faviconLink = document.createElement("link");
        faviconLink.rel = "icon";
        faviconLink.href = url;
        document.head.appendChild(faviconLink);
    }
}

function generateLayoutHTML() {
    return `
        <body class="onSTU" style="">
            <script>
                (localStorage.getItem('mode')) === 'darkmode' ? document.querySelector('body').classList.add('drK'): document.querySelector('body').classList.remove('drK')
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
                                    <path class="f" d="M12 18.5C15.5899 18.5 18.5 15.5899 18.5 12C18.5 8.41015 15.5899 5.5 12 5.5C8.41015 5.5 5.5 8.41015 5.5 12C5.5 15.5899 8.41015 18.5 12 18.5Z"></path>
                                    <path d="M19.14 19.14L19.01 19.01M19.01 4.99L19.14 4.86L19.01 4.99ZM4.86 19.14L4.99 19.01L4.86 19.14ZM12 2.08V2V2.08ZM12 22V21.92V22ZM2.08 12H2H2.08ZM22 12H21.92H22ZM4.99 4.99L4.86 4.86L4.99 4.99Z" stroke-width="2"></path>
                                </g>
                            </svg>
                        </button>
                        <div class="header__language-wrapper">
                            <button class="header__language" id="languageButton">
                                <span class="header__language-icon">
                                    <span id="currentLanguage">Tiếng Việt</span>
                                </span>
                            </button>
                            <div class="header__language-dropdown" id="languageDropdown">
                                <div class="header__language-item header__language-item--active" data-lang="vi">
                                    <span class="header__language-flag">
                                        <img src="http://localhost:8000/core/img/flags/vn.svg" class="header__language-flag-img" loading="lazy" alt="vi flag">
                                    </span>
                                    Tiếng Việt
                                </div>
                                <div class="header__language-item" data-lang="en">
                                    <span class="header__language-flag">
                                        <img src="http://localhost:8000/core/img/flags/us.svg" class="header__language-flag-img" loading="lazy" alt="en flag">
                                    </span>
                                    English
                                </div>
                                <div class="header__language-item" data-lang="ja">
                                    <span class="header__language-flag">
                                        <img src="http://localhost:8000/core/img/flags/jp.svg" class="header__language-flag-img" loading="lazy" alt="ja flag">
                                    </span>
                                    Japanese
                                </div>
                                <div class="header__language-item" data-lang="id">
                                    <span class="header__language-flag">
                                        <img src="http://localhost:8000/core/img/flags/id.svg" class="header__language-flag-img" loading="lazy" alt="id flag">
                                    </span>
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
                        <div class="note">Tham gia kiếm tiền cùng Link4Sub, có ngay 500k/ngày. <a href="https://link4sub.com/" target="__blank">(Tham gia)</a></div>
                        <div class="stu-box-wrap s1">
                            <div class="t">
                                <h2 class="t-title">Unlock Link</h2>
                                <h3 class="t-s-title">Hoàn thành các bước để mở khóa link, bạn chỉ mất 30 giây.</h3>
                            </div>
                            <div class="i"></div>
                            <div class="b" id="actionGroups"></div>
                            <div class="c" id="adClickBtns"></div>
                            <div class="p" id="pg"></div>
                            <div class="d ">
                                <div class="cl">
                                    <a class="stu-btn link unlock" data-href="aHR0cHMlM0ElMkYlMkZ3d3cuc3ViczR1bmxvY2suaWQlMkY=" data-dest="true" href="https://www.subs4unlock.id/">
                                        <svg fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18 10H9V7c0-1.654 1.346-3 3-3s3 1.346 3 3h2c0-2.757-2.243-5-5-5S7 4.243 7 7v3H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2Zm-7.939 5.499A2.002 2.002 0 0 1 14 16a1.99 1.99 0 0 1-1 1.723V20h-2v-2.277a1.992 1.992 0 0 1-.939-2.224Z"></path>
                                        </svg>
                                        <span>Tiếp tục</span>
                                        <i class="lft-i">
                                            <svg fill="currentColor" viewBox="0 0 640 512">
                                                <defs><style>.fa-secondary{opacity:.4}</style></defs>
                                                <path class="fa-primary" d="M41.41 270.7l133.3-133.3C202.3 109.8 238.5 96 274.6 96s72.36 13.8 99.96 41.41C402.2 165 415.1 201.2 416 237.4c.0004 36.18-13.8 72.36-41.41 99.97l-14.18 14.18c-18.78-1.197-36.33-8.753-49.75-22.18c-3.154-3.154-5.855-6.626-8.382-10.19l27.06-27.06c14.61-14.61 22.66-34.04 22.66-54.71s-8.049-40.1-22.66-54.71C314.7 168 295.3 160 274.6 160C253.1 160 234.5 168 219.9 182.7L86.66 315.9c-14.62 14.61-22.66 34.04-22.66 54.71s8.047 40.1 22.66 54.71C101.3 439.1 120.7 448 141.4 448c20.67 0 40.1-8.047 54.71-22.66l60.59-60.59c2.779 3.355 5.584 6.7 8.731 9.846c12.72 12.72 27.39 22.17 42.91 29.02l-66.98 66.98C213.7 498.2 177.6 512 141.4 512c-36.18 0-72.36-13.8-99.97-41.41C-13.8 415.4-13.8 325.9 41.41 270.7z"></path>
                                                <path class="fa-secondary" d="M598.6 241.3l-133.3 133.3C437.7 402.2 401.6 416 365.4 416s-72.36-13.8-99.96-41.41c-26.63-26.63-40.42-61.25-41.36-96.15C223 241 236.8 203.2 265.4 174.7L279.6 160.5c18.78 1.197 36.33 8.753 49.75 22.18c3.154 3.154 5.854 6.626 8.382 10.19L310.7 219.9c-14.61 14.61-22.66 34.04-22.66 54.71s8.049 40.1 22.66 54.71C325.3 343.1 344.7 352 365.4 352c20.67 0 40.1-8.049 54.71-22.66l133.3-133.3c14.62-14.61 22.66-34.04 22.66-54.71S567.1 101.3 553.3 86.66C538.7 72.05 519.3 64 498.6 64c-20.67 0-40.1 8.047-54.71 22.66l-60.59 60.59c-2.779-3.355-5.584-6.7-8.73-9.846c-12.72-12.72-27.39-22.17-42.91-29.02l66.98-66.98C426.3 13.8 462.4 0 498.6 0c36.18 0 72.36 13.8 99.96 41.41c27.11 27.11 40.9 62.48 41.39 98C640.5 176.2 626.7 213.2 598.6 241.3z"></path>
                                            </svg>
                                        </i>
                                    </a>
                                </div>
                                <div class="cp"></div>
                            </div>
                            <div class="f">
                                <div class="ft">
                                    <span>Created with </span>
                                    <img src="https://link4sub.com/images/favicon.png">
                                    <a href="https://link4sub.com/"> Link4Sub</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin: 25px 0" id="botAd"></div>
                </div>
            </main>

            <footer class="footer">
                <div class="footer__copyright">
                    © 2025 - <a href="#" class="footer__copyright-link">LINK4SUB</a>
                </div>
            </footer>

            <noscript>
                <input class='nJs hidden' id='forNoJS' type='checkbox' />
                <div class='noJs' data-text='Link4Sub works best with JavaScript enabled'>
                    <label for='forNoJS'></label>
                </div>
            </noscript>

            <script>
                function darkMode() {
                    localStorage.setItem("mode", "darkmode" === localStorage.getItem("mode") ? "light" : "darkmode");
                    "darkmode" === localStorage.getItem("mode") ?
                        document.querySelector("body").classList.add("drK") :
                        document.querySelector("body").classList.remove("drK");
                }
            </script>
        </body>
    `;
}

function renderSTU(data) {
    // Initialize state
    const STATE = StateManager.initializeState(data);
    stSTU.txt = data?.data.txt;

    if (!STATE.config || !STATE.data) {
        xQK.showError('Invalid configuration');
        return;
    }

    // Set favicon
    setFavicon(CONFIG.FAVICON_URL);

    // Initialize UI handlers
    UIHandlers.init(STATE);

    // Initialize layout
    document.body.innerHTML = generateLayoutHTML();

    // Initialize functionality
    const renderer = new STURenderer(STATE);
    renderer.render();
}

// Main application initialization
async function main() {
    try {
        const isValid = await STUManager.checkSTU();
        const linkData = isValid ? xQK.getLocalStorage(CONFIG.STU_KEY) : null;

        // Handle page loading animation
        handlePageLoading();

        console.log('Link4Sub - STU');

        if (linkData) {
            loadHeader();
            renderSTU(linkData);
            document.body.classList.add('onSTU');
        } else {
            xQK.deleteLocalStorage(CONFIG.STU_KEY);
        }
    } catch (error) {
        console.error('Main initialization error:', error);
        xQK.showError(error);
    }
}

function handlePageLoading() {
    document.querySelector("html").style.overflow = "hidden";

    setTimeout(() => {
        const pageLoading = document.querySelector(".pageLoading");
        if (pageLoading) {
            pageLoading.classList.add("done");
            pageLoading.addEventListener("transitionend", () => {
                document.querySelector("html").style.overflow = "auto";
                pageLoading.remove();
            });
        }
    }, 100);
}

// Auto-close VIP ads
const closeVipAd = setInterval(() => {
    const closeVipAdElt = document.querySelector('brde>brde:nth-child(2)');
    if (closeVipAdElt) {
        closeVipAdElt.click();
        closeVipAdElt.querySelector('a')?.click();
        closeVipAdElt.querySelector('img')?.click();
        clearInterval(closeVipAd);
    }
}, 1000);

// Initialize the application
main();

/*]]>*/
