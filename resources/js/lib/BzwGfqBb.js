/* ----------------  BzwGfqBb.js  ---------------- */

/** Lưu / áp dụng class layout ('list' | 'card' …) */
export function initLayout(keys) {
  keys.forEach((k) => {
    const val = localStorage.getItem(k);
    if (val) document.documentElement.classList.add(val);
  });
}

/** Trả về DOM `<label>` đại diện 1 folder */
export function folderDom(f) {
  const tpl = document.createElement('template');
  tpl.innerHTML = `
<label class="file">
  <input type="radio" name="item" data-type="folder" value="${f.key}">
  <div class="d-flex align-items-center gap-2">
    <img src="https://cdn.safefileku.com/icons/folder.svg">
    <span class="name">${f.name}</span>
  </div>
</label>`;
  return /** @type {HTMLLabelElement} */ (tpl.content.firstElementChild);
}

/** Trả về DOM `<label>` đại diện 1 file */
export function fileDom(f) {
  const tpl = document.createElement('template');
  tpl.innerHTML = `
<label class="file">
  <input type="radio" name="item" data-type="file"
         data-ext="${f.ext}" data-private="${f.is_private}"
         value="${f.key}">
  <div class="d-flex align-items-center gap-2">
    <img src="https://cdn.safefileku.com/icons/${f.ext || 'file'}.svg">
    <span class="name">${f.name}.${f.ext}</span>
  </div>
</label>`;
  return /** @type {HTMLLabelElement} */ (tpl.content.firstElementChild);
}
