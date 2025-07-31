const d=(e,s="label",l=!0)=>{
    const t=document.createElement(s);if(t.classList.add("file"),t.innerHTML=`
    <input type="radio" name="item" class="peer" value="${e.key}" data-type="folder" data-name="${e.name}"/>
    <div class="peer-checked:!bg-blue-100 dark:peer-checked:!bg-blue-900">
        <img class="pointer-events-none" src="https://cdn.safefileku.com/icons/folder.svg" alt="folder"/>
        <div class="detail">
            <div class="name" title="${e.name}">${e.name}</div>
        </div>
    </div>
    `,!l)return t;t.addEventListener("dblclick",n=>{location.href=`/u/drive/${e.drive}/${e.key}`});let a,o,r=!1;return t.addEventListener("touchmove",n=>{r=!0,clearTimeout(a)}),t.addEventListener("touchstart",n=>{o=!1,r=!1,a=setTimeout(function(){clearTimeout(a),n.preventDefault(),o=!0,t.click()},500)}),t.addEventListener("touchend",n=>{if(clearTimeout(a),o||r){n.preventDefault();return}n.cancelable&&(n.preventDefault(),location.href=`/u/drive/${e.drive}/${e.key}`)}),t},i=(e,s="label")=>{let l=new Date(e.date);const t=document.createElement(s);if(t.classList.add("file"),t.innerHTML=`
    <input type="radio" name="item" class="peer" value="${e.key}" data-type="file" data-name="${e.name}" data-ext="${e.ext}" data-private="${e.is_private}"/>
    <div class="peer-checked:!bg-blue-100 dark:peer-checked:!bg-blue-900">
        <img class="pointer-events-none" src="https://cdn.safefileku.com/icons/${e.ext==""?"file":e.ext.toLowerCase()}.svg" onerror="this.src='https://cdn.safefileku.com/icons/file.svg';" alt="file"/>
        <div class="detail">
            <div>
                <div class="name" title="${e.name}${e.ext==""?"":"."+e.ext}">${e.name}${e.ext==""?"":"."+e.ext}</div>
                <div class="info"></div>
            </div>
            <div class="meta">
                <div class="size">${bytes(e.size)}</div>
                <div class="download">${e.downloads} Download${e.downloads>1?"s":""}</div>
                <div class="date">${l.getDate()} ${monthNames[l.getMonth()]} ${l.getFullYear()}</div>
            </div>
        </div>
    </div>`,!e.is_private){const a=document.createElement("div");a.innerHTML=`
        <svg class="text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"/>
            <path d="M7.99998 3H8.99998C7.04998 8.84 7.04998 15.16 8.99998 21H7.99998"/>
            <path d="M15 3C16.95 8.84 16.95 15.16 15 21"/>
            <path d="M3 16V15C8.84 16.95 15.16 16.95 21 15V16"/>
            <path d="M3 9.0001C8.84 7.0501 15.16 7.0501 21 9.0001"/>
        </svg>`,t.querySelector(".info").appendChild(a)}if(e.warning){const a=document.createElement("div");a.classList.add("warning"),a.innerHTML=`
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 7.75V13" stroke-width="1.5"/>
            <path d="M21.08 8.58003V15.42C21.08 16.54 20.48 17.58 19.51 18.15L13.57 21.58C12.6 22.14 11.4 22.14 10.42 21.58L4.47998 18.15C3.50998 17.59 2.90997 16.55 2.90997 15.42V8.58003C2.90997 7.46003 3.50998 6.41999 4.47998 5.84999L10.42 2.42C11.39 1.86 12.59 1.86 13.57 2.42L19.51 5.84999C20.48 6.41999 21.08 7.45003 21.08 8.58003Z" stroke="currentColor" stroke-width="1.5"/>
            <path d="M12 16.2V16.2999" stroke="currentColor" stroke-width="2"/>
        </svg>
        <span>${e.warning.length<=4?e.warning.toUpperCase():e.warning}</span>`,a.onclick=()=>{a.children[1].classList.toggle("!inline-block")},t.querySelector(".info").appendChild(a)}return t},c=(e=[])=>{e.forEach(s=>{switch(s){case"layout":const l=document.getElementById("tool-layout"),t=document.getElementById("filemanager");localStorage.getItem("layout")=="list"&&(l.querySelector("#tool-layout-card").classList.remove("hidden"),l.querySelector("#tool-layout-list").classList.add("hidden")),l.addEventListener("click",a=>{t.classList.toggle("list"),t.classList.toggle("card"),a.currentTarget.children[0].classList.toggle("hidden"),a.currentTarget.children[1].classList.toggle("hidden"),localStorage.setItem("layout",localStorage.getItem("layout")=="card"?"list":"card")});return}})};export{d as a,i as f,c as i};
