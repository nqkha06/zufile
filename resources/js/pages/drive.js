// drive.js ‑ phiên bản Vite **full tính năng** như file rip gốc
// -----------------------------------------------------------------------------
// • Vẫn giữ nguyên API /u/folders, /u/files …
// • Phải có các modal #modal-move, #modal-rename … ngoài HTML y hệt bản cũ.
// • Cần có các helper SVG/CSS giống giao diện cũ (không nhắc lại ở đây).
// -----------------------------------------------------------------------------

import axios                   from 'axios';
import { Tooltip, Modal }      from 'bootstrap';
import { initLayout,          // khôi phục layout list/card
         folderDom,
         fileDom }             from '../lib/BzwGfqBb.js';

/* ---------- Tiny DOM helper ---------- */
const $ = (sel) => /** @type {HTMLElement} */ (document.querySelector(sel));

/* ---------- Định nghĩa state ---------- */
const p    = location.pathname.split('/');
const q    = new URLSearchParams(location.search);
const state = {
  driveId   : p[3] ?? '1',
  dir       : (p[2] === 'drive' && p[4] && p[4] !== 'home') ? p[4] : 'root',
  searchKey : q.get('q'),
  viewReady : { folder:false, file:false }
};
if (p[2] === 'drive' && p[3] !== 'search') {
  localStorage.setItem('last_drive', p[3]);
}

/* ---------- DOM refs ---------- */
const elFileMgr   = $('#filemanager');
const elLoading   = $('#loading');
const elFolders   = $('#folders');
const elFiles     = $('#files');
const elEmpty     = $('#empty');
const elToolsWrap = $('#tools');
const elToolShare = /** @type {HTMLButtonElement} */ ($('#tool-share'));

/* ---------- Init layout ---------- */
initLayout(['layout']);
elFileMgr.classList.add(localStorage.getItem('layout') ?? 'list');

// highlight Upload khi có #nav_to_upload
if (location.hash === '#nav_to_upload') {
  const lbl = $('label[for="file"]');
  const tip = Tooltip.getOrCreateInstance(lbl);
  setTimeout(() => {
    lbl.classList.add('transition-all','outline');
    tip.show();
  }, 800);
}

/* ---------- Helpers ---------- */
function toast(msg, color = 'gray') {
  const wrap = $('#toast');
  if (!wrap) return alert(msg); // fallback
  const div     = document.createElement('div');
  div.className = `toast text-${color}-600 bg-${color}-100`;
  div.textContent = msg;
  wrap.appendChild(div);
  setTimeout(() => div.remove(), 3000);
}
function loadingElement() {
  const d   = document.createElement('div');
  d.role    = 'alert';
  d.className = 'py-3 text-center text-gray-500';
  d.textContent = 'Loading…';
  return d;
}
function errorHandler(err, code='') {
  console.error(err);
  toast(`Lỗi ${code || ''}.`, 'red');
}
function updateEmpty() {
  if (!state.viewReady.folder || !state.viewReady.file) return;
  const hasItem = elFolders.childElementCount + elFiles.childElementCount > 0;
  elEmpty?.classList.toggle('hidden', hasItem);
  elLoading.classList.add('hidden');
  elFileMgr.classList.remove('hidden');
}

/* ---------- Axios ---------- */
const http = axios.create({
  baseURL : '/u',
  headers : { Accept:'application/json' }
});

/* ---------- Fetch folders ---------- */
async function fetchFolders(offset = 0) {
  const params = { offset };
  if (state.searchKey) params.name = state.searchKey;
  else Object.assign(params, { dir: state.dir, d: state.driveId });

  const { data } = await http.get('/folders', { params });
  data.items.forEach((item) => elFolders.append(folderDom(item)));

  if (offset + 25 < data.total) addShowMore(() => fetchFolders(offset + 1), elFolders);

  state.viewReady.folder = true;
  updateEmpty();
}

/* ---------- Fetch files + infinite scroll ---------- */
let fileOffset = 0;
async function fetchFiles(offset = 0) {
  const params = { offset };
  if (state.searchKey) params.name = state.searchKey;
  else Object.assign(params, { dir: state.dir, d: state.driveId });

  const { data } = await http.get('/files', { params });
  data.items.forEach((item) => elFiles.append(fileDom(item)));

  if (offset + 25 < data.total) {
    window.addEventListener('scroll', onFileScroll, { passive:true });
  }
  state.viewReady.file = true;
  updateEmpty();
}
function onFileScroll() {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 100) {
    window.removeEventListener('scroll', onFileScroll);
    elFiles.after(loadingElement());
    fetchFiles(++fileOffset).catch((e)=>errorHandler(e,'006'))
      .finally(()=>{
        document.querySelector('[role="alert"]')?.remove();
      });
  }
}

/* ---------- helper: show‑more button for folder ---------- */
function addShowMore(cb, afterEl) {
  const btn = document.createElement('button');
  btn.className = 'w-full text-sm text-center text-gray-600 py-2';
  btn.textContent = 'Show more';
  btn.onclick = () => {
    btn.replaceWith(loadingElement());
    cb().catch((e)=>errorHandler(e,'007'))
      .finally(()=> document.querySelector('[role="alert"]')?.remove());
  };
  afterEl.after(btn);
}

/* ---------- Initial load ---------- */
fetchFolders().catch((e)=>errorHandler(e,'007'));
fetchFiles().catch((e)=>errorHandler(e,'006'));

/* ---------- Search banner ---------- */
if (state.searchKey && p[3] === 'search') {
  const banner = document.createElement('p');
  banner.className = 'text-center text-xs text-gray-400 p-4';
  banner.textContent = `Showing search results for "${state.searchKey}"`;
  elFileMgr.prepend(banner);
}

/* ---------- Pick / unpick ---------- */
let picked = null;
function enableTools(enable, item={}) {
  elToolsWrap?.querySelectorAll('button').forEach((btn) => {
    if (btn.id === 'tool-move' && item.type==='folder' && state.dir==='root') {
      btn.disabled = true; return; // ví dụ: cấm move root‑folder
    }
    if ((btn.id==='tool-share' || btn.id==='tool-download') && item.type==='folder') {
      btn.disabled = true; return;
    }
    btn.disabled = !enable;
  });
}

// disable all từ đầu
elToolsWrap?.querySelectorAll('button').forEach((b)=>b.disabled = true);

document.body.addEventListener('click', (ev) => {
  const tgt = /** @type {HTMLElement} */ (ev.target);
  if (tgt.getAttribute('name') === 'item') {
    picked = {
      key     : tgt.value,
      element : tgt.closest('li'),
      type    : tgt.dataset.type,
      name    : tgt.dataset.name,
      ext     : tgt.dataset.ext,
      private : tgt.dataset.private === 'true'
    };
    elToolShare.dataset.key     = picked.key;
    elToolShare.dataset.private = String(picked.private);
    enableTools(true, picked);
  } else if (!tgt.closest('#tools') && !document.body.classList.contains('modal-open')) {
    document.querySelector('[name="item"]:checked')?.removeAttribute('checked');
    picked = null;
    enableTools(false);
  }
});

/* ---------- Download ---------- */
$('#tool-download')?.addEventListener('click', () => {
  if (picked?.type === 'file') window.open(`/u/files/${picked.key}/download`);
});

/* ---------- Trash ---------- */
$('#tool-trash')?.addEventListener('click', () => {
  if (!picked) return;
  http.delete(`/u/${picked.type}s/${picked.key}`)
    .then(()=>{
      toast('File moved to trash','green');
      picked.element.remove();
      picked=null;
      enableTools(false);
      updateEmpty();
    })
    .catch((e)=>errorHandler(e,'005'));
});

/* ---------- New folder ---------- */
const formNewFolder = $('#form-new-folder');
formNewFolder?.addEventListener('submit', (e) => {
  e.preventDefault();
  const btn   = formNewFolder.querySelector('[type="submit"]');
  btn.disabled = true;
  const fd = new FormData(formNewFolder);
  fd.append('dir', state.dir);
  fd.append('drive', state.driveId);
  http.post('/folders', fd)
    .then(({data})=>{
      elFolders.prepend(folderDom(data));
      toast('Folder created','green');
      formNewFolder.querySelector('[data-bs-dismiss]')?.click();
      formNewFolder.reset();
      updateEmpty();
    })
    .catch((e)=>errorHandler(e))
    .finally(()=>btn.disabled=false);
});

/* ---------- Rename modal ---------- */
const modalRename = $('#modal-rename');
modalRename?.querySelector('form')?.addEventListener('submit', (ev)=>{
  ev.preventDefault();
  if (!picked) return;
  const form = ev.target;
  const btn  = form.querySelector('[type="submit"]');
  btn.disabled = true;
  const fd = new FormData(form);
  http.post(`/u/${picked.type}s/${picked.key}`, fd)
    .then(()=>{
      const newName = fd.get('name');
      picked.element.querySelector('.name').innerText = picked.type==='file' ? `${newName}.${picked.ext}` : newName;
      picked.name = newName;
      form.querySelector('[data-bs-dismiss]')?.click();
    })
    .catch((e)=>errorHandler(e))
    .finally(()=>btn.disabled=false);
});
modalRename?.addEventListener('show.bs.modal', (ev)=>{
  if (ev.relatedTarget.disabled) { ev.preventDefault(); return; }
  modalRename.querySelector('[name="name"]').value = picked?.name ?? '';
});

/* ---------- Move modal ---------- */
const modalMove = $('#modal-move');
modalMove?.addEventListener('show.bs.modal', (ev)=>{
  if (ev.relatedTarget.disabled) { ev.preventDefault(); return; }
  buildMoveModal();
});
modalMove?.addEventListener('hidden.bs.modal', ()=>{
  modalMove.querySelector('ul').innerHTML = '';
  modalMove.querySelector('[loading]').classList.remove('hidden');
  modalMove.querySelector('form').classList.add('hidden');
});
modalMove?.querySelector('form')?.addEventListener('submit', (ev)=>{
  ev.preventDefault();
  if (!picked) return;
  const btn = ev.target.querySelector('[type="submit"]');
  btn.disabled = true;
  const fd = new FormData(ev.target);
  http.post(`/u/${picked.type}s/${picked.key}`, fd)
    .then(()=>{
      picked.element.remove();
      picked=null;
      enableTools(false);
      updateEmpty();
    })
    .catch((e)=>errorHandler(e,'004'))
    .finally(()=>{
      btn.disabled=false;
      ev.target.querySelector('[data-bs-dismiss]')?.click();
    });
});

function buildMoveModal() {
  const ul     = modalMove.querySelector('ul');
  const form   = modalMove.querySelector('form');
  const submit = form.querySelector('[type="submit"]');
  const loader = modalMove.querySelector('[loading]');
  const title  = modalMove.querySelector('[title]');

  let cwd   = 'root';
  let stack = [];
  let driveSel = state.driveId;

  title.textContent = `Move "${picked.name}"`;
  loader.classList.add('hidden');
  form.classList.remove('hidden');
  submit.disabled = true;

  function list(offset=0) {
    const params = { d:driveSel, dir:cwd, offset, count_nest:true };
    http.get('/folders', { params })
      .then(({data})=>{
        // Back button
        if (stack.length>0) {
          const back = document.createElement('button');
          back.className = 'flex items-center gap-1 p-1.5 w-full text-left text-zinc-600 hover:bg-zinc-100 rounded-md';
          back.innerHTML = `<svg class="size-4" viewBox="0 0 24 24" fill="none"><path d="M15.0001 19.9201L8.48009 13.4001C7.71009 12.6301 7.71009 11.3701 8.48009 10.6001L15.0001 4.08008" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg><span>Back</span>`;
          back.onclick = ()=>{
            submit.disabled=true; ul.innerHTML=''; cwd = stack.pop(); list(0);
          };
          ul.append(back);
        }

        // Home option when đang không ở root hoặc drive khác
        if ((state.dir!=='root' || driveSel!==state.driveId) && cwd==='root') {
          const li = document.createElement('li');
          li.innerHTML = `<label class="file small"><input type="radio" name="location" class="peer" value="root"/><div class="peer-checked:!bg-blue-100"><img src="https://cdn.safefileku.com/icons/folder_home.svg"/><div class="meta"><div class="name" title="Home">Home</div></div></div></label>`;
          ul.append(li);
        }

        // Child folders
        data.items.forEach((o)=>{
          if (picked.type==='folder' && picked.key===o.key) return; // skip self
          const li = document.createElement('li');
          li.innerHTML = `<label class="file small"><input type="radio" name="location" class="peer" value="${o.key}" ${state.dir===o.key?'disabled':''}/><div class="peer-checked:!bg-blue-100"><img src="https://cdn.safefileku.com/icons/folder.svg"/><div class="meta overflow-hidden"><div class="name truncate" title="${o.name}">${o.name}</div></div></div></label>`;
          // if has children → navigate
          if (o.total_folder>0) {
            const nav = document.createElement('button');
            nav.className='ml-auto';
            nav.innerHTML = `<svg class="size-4" viewBox="0 0 24 24" fill="none"><path d="M10.74 15.53L14.26 12L10.74 8.46997" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>`;
            nav.onclick = (ev)=>{
              ev.preventDefault(); submit.disabled=true; ul.innerHTML=''; stack.push(cwd); cwd=o.key; list(0);
            };
            li.querySelector('.meta').append(nav);
          }
          ul.append(li);
        });

        // Show more
        if (offset+25 < data.total) {
          const btn = document.createElement('button');
          btn.className='text-sm w-full text-gray-600';
          btn.textContent='Show more';
          btn.onclick = ()=>{ btn.remove(); list(offset+1); };
          ul.append(btn);
        }

        // enable submit when choose radio
        ul.querySelectorAll('input[name="location"]').forEach((inp)=>{
          inp.onchange = ()=>{ submit.disabled=false; };
        });
      })
      .catch((e)=>errorHandler(e,'007'));
  }
  list(0);
}

/* ---------- Private / Public toggle ---------- */
$('#set-private')?.addEventListener('click', (ev)=>{
  const btn = ev.currentTarget;
  btn.disabled = true;
  http.post(`/u/files/${picked.key}`, { is_private:true })
    .then(()=>{
      picked.private=true;
      picked.element.querySelector('[name="item"]').dataset.private='true';
      $('#share-public')?.classList.add('hidden');
      $('#share-private')?.classList.remove('hidden');
      picked.element.querySelector('.info').children[0]?.remove();
      toast('File set to private','green');
    })
    .catch((e)=>errorHandler(e,'003'))
    .finally(()=>btn.disabled=false);
});

$('#set-public')?.addEventListener('click', (ev)=>{
  const btn = ev.currentTarget;
  btn.disabled = true;
  http.post(`/u/files/${picked.key}`, { is_private:false })
    .then(()=>{
      picked.private=false;
      picked.element.querySelector('[name="item"]').dataset.private='false';
      $('#share-public')?.classList.remove('hidden');
      $('#share-private')?.classList.add('hidden');
      const globe = document.createElement('div');
      globe.innerHTML = `<svg class="text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"/><path d="M7.99998 3H8.99998C7.04998 8.84 7.04998 15.16 8.99998 21H7.99998"/><path d="M15 3C16.95 8.84 16.95 15.16 15 21"/><path d="M3 16V15C8.84 16.95 15.16 16.95 21 15V16"/><path d="M3 9.0001C8.84 7.0501 15.16 7.0501 21 9.0001"/></svg>`;
      picked.element.querySelector('.info').prepend(globe);
      toast('File set to public','green');
    })
    .catch((e)=>errorHandler(e,'003'))
    .finally(()=>btn.disabled=false);
});

/* ---------- Search result banner đã thêm ở trên ---------- */

// HẾT FILE
