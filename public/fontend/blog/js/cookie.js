document.addEventListener('DOMContentLoaded', () => {
    const cookieHTML = `
        <div class="nJ cookie">
            <p>
                <span class="opacity">Our website uses cookies to improve your experience.</span>
                <a aria-label="Learn more" class="extL opacity" data-text="Learn more" href="#" rel="noreferrer" target="_blank">Learn more</a>
            </p>
            <div class="flex ft">
                <span class="acc">Accept!</span>
            </div>
        </div>
    `;

    document.getElementById('cookie-container').innerHTML = cookieHTML;

    const cookieBox = document.querySelector(".nJ.cookie");
    const acceptBtn = cookieBox.querySelector(".acc");

    acceptBtn.onclick = () => {
        document.cookie = "cookie=Notification; max-age=" + 60 * 60 * 24 * 30 * 90; // Thiết lập cookie với thời gian sống 90 ngày
        if (document.cookie.indexOf("cookie=Notification") !== -1) {
            cookieBox.classList.add("hidden"); // Ẩn thông báo cookie nếu cookie đã được thiết lập
        } else {
            alert("Cookie can't be set! Please unblock this site from the cookie setting of your browser.");
        }
    };

    if (document.cookie.indexOf("cookie=Notification") !== -1) {
        cookieBox.classList.add("hidden");
    } else {
        cookieBox.classList.remove("hidden");
    }
});