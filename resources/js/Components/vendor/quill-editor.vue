<script setup>
import { ref, onMounted, onBeforeUnmount, watch, nextTick } from 'vue'
import Quill from 'quill'
import 'quill/dist/quill.snow.css'

// ── Props & emits ─────────────────────────────────────────────────────────────
const props = defineProps({ modelValue: String })
const emit = defineEmits(['update:modelValue'])

const editorEl = ref(null)
let quill = null
let drag = null

// ── Drag-resize ──────────────────────────────────────────────────────────────
function onDocMouseMove(e) {
  if (!drag) return
  e.preventDefault()
  drag.el.style.width = Math.max(80, drag.el.offsetWidth + (e.clientX - drag.sx)) + 'px'
  drag.el.style.height = 'auto'
  drag.el.style.userSelect = 'none'
}
function onDocMouseUp() {
  if (!drag) return
  drag.el.style.userSelect = ''
  // Persist the new pixel width into the element attribute so Quill's
  // serializer (which walks attributes, not computed styles) sees it.
  drag.el.setAttribute('width', drag.el.style.width)
  drag = null
}
function onEditorMouseDown(e) {
  const el = e.target.closest('.ql-editor img, .ql-editor video')
  if (!el) return
  e.preventDefault()
  e.stopImmediatePropagation()
  drag = { el, sx: e.clientX, sw: el.offsetWidth }
}

// ── Upload helper ─────────────────────────────────────────────────────────────
function uploadFile(file, ok, fail) {
  const fd = new FormData()
  fd.append('file', file)
  fetch('/tiptap/upload', {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '' },
    body: fd,
  })
    .then(r => r.json())
    .then(d => d.url ? ok(d.url) : fail?.())
    .catch(() => fail?.())
}

// ── Toolbar actions ────────────────────────────────────────────────────────────
function insertImage() {
  const i = document.createElement('input'); i.type = 'file'; i.accept = 'image/*'
  i.onchange = e => { const f = e.target.files?.[0]; if (f) uploadFile(f, url => _emb('image', url)) }
  i.click()
}
function insertVideo() {
  const i = document.createElement('input'); i.type = 'file'; i.accept = 'video/*'
  i.onchange = e => { const f = e.target.files?.[0]; if (f) uploadFile(f, url => _emb('video', url)) }
  i.click()
}
function insertFile() {
  const i = document.createElement('input'); i.type = 'file'
  i.onchange = e => {
    const f = e.target.files?.[0]; if (!f) return
    uploadFile(f, url => _txt(url, f.name, url), () => _txt('#', f.name))
  }
  i.click()
}
function insertCodeBlock() {
  if (!quill) return
  const r = quill.getSelection(true) ?? { index: quill.getLength(), length: 0 }
  quill.insertText(r.index, '\n```\ncode here\n```\n', 'api')
  quill.setSelection(r.index + 4)
}
function openLinkDialog() {
  const url = prompt('Enter URL:')
  if (url && quill) {
    const r = quill.getSelection(true) ?? { index: quill.getLength(), length: 0 }
    if (r.length > 0) quill.format('link', url)
    else { quill.insertText(r.index, url, 'api'); quill.formatText(r.index, url.length, 'link', url) }
  }
}

function _emb(type, url) {
  if (!quill) return
  try {
    const i = (quill.getSelection() ?? { index: quill.getLength() }).index
    quill.insertEmbed(i, type, url)
    quill.setSelection(i + 1)
  } catch { /* noop */ }
}
function _txt(url, text, link) {
  if (!quill) return
  try {
    const i = (quill.getSelection() ?? { index: quill.getLength() }).index
    quill.insertText(i, text, 'api')
    if (link && link !== '#') quill.formatText(i, text.length, 'link', link)
  } catch { /* noop */ }
}

// ── Lifecycle ────────────────────────────────────────────────────────────────
onMounted(() => {
  document.addEventListener('mousemove', onDocMouseMove)
  document.addEventListener('mouseup', onDocMouseUp)

  quill = new Quill(editorEl.value, {
    theme: 'snow',
    modules: {
      toolbar: {
        container: [
          [{ header: [1, 2, 3, false] }],
          ['bold', 'italic', 'underline', 'strike'],
          [{ color: [] }, { background: [] }],
          [{ list: 'ordered' }, { list: 'bullet' }],
          [{ align: [] }],
          [{ indent: '-1' }, { indent: '+1' }],
          ['link', 'image', 'video'],
          ['code-block'],
          ['clean'],
        ],
        // Disable Quill's default link/image handlers — we intercept these
        // ourselves via the toolbar @click so there's no double-handling.
        handlers: {
          link: () => {},
          image: () => {},
          video: () => {},
        },
      },
    },
  })

  if (props.modelValue) quill.root.innerHTML = props.modelValue

  quill.on('text-change', () => {
    // Strip data:image base64 strings on every change — Quill may generate
    // them for clipboard images that bypass our paste handler.  Keeps the
    // payload sane (no giant blobs) regardless of how images enter the editor.
    const dirty = quill.root.innerHTML ?? ''
    const clean = dirty.replace(/src="data:image\/[^"]*"/g, 'src=""')
    emit('update:modelValue', clean)
  })

  /**
   * Intercept image drops & pastes — upload through the server instead of
   * letting Quill turn them into giant base64 data: URLs.
   */
  editorEl.value.addEventListener('paste', handlePaste, true)
  editorEl.value.addEventListener('drop', handleDrop, true)

  editorEl.value.quillInstance = quill
})

function handlePaste(e) {
  const items = [...(e.clipboardData?.items ?? [])]
  const imageItem = items.find(it => it.type.startsWith('image/'))
  if (!imageItem) return
  e.preventDefault()
  e.stopImmediatePropagation()
  uploadImageFile(imageItem.getAsFile())
}

function handleDrop(e) {
  const dt = e.dataTransfer
  if (!dt) return
  const items = [...(dt.items ?? [])]
  const imageItem = items.find(it => it.kind === 'file' && it.type.startsWith('image/'))
  if (!imageItem) return
  e.preventDefault()
  e.stopImmediatePropagation()
  uploadImageFile(imageItem.getAsFile())
}

function uploadImageFile(file) {
  if (!file) return
  uploadFile(file, url => _emb('image', url))
}

onBeforeUnmount(() => {
  document.removeEventListener('mousemove', onDocMouseMove)
  document.removeEventListener('mouseup', onDocMouseUp)
  drag = null
  if (quill) { quill.off('text-change'); quill = null }
})

watch(() => props.modelValue, async html => {
  if (!quill) return
  const cur = quill.root.innerHTML.trim()
  if (cur === (html ?? '').trim()) return
  quill.root.innerHTML = html ?? ''
  // Defer to after the DOM patch so Quill's internal DOM reference is valid.
  await nextTick()
  quill.setSelection(0, 0)
})
</script>

<template>
  <div class="qe-wrapper">
    <!-- Toolbar -->
    <div class="qe-toolbar ql-toolbar ql-snow">
      <span class="ql-formats">
        <select class="ql-header">
          <option value="1">H1</option>
          <option value="2">H2</option>
          <option value="3">H3</option>
          <option value="false">Paragraph</option>
        </select>
      </span>
      <span class="ql-formats">
        <button class="ql-bold" title="Bold" />
        <button class="ql-italic" title="Italic" />
        <button class="ql-underline" title="Underline" />
        <button class="ql-strike" title="Strikethrough" />
      </span>
      <span class="ql-formats">
        <input type="color" class="ql-color" title="Text colour" value="#000000" />
        <input type="color" class="ql-background" title="Highlight" value="#ffff00" />
      </span>
      <span class="ql-formats">
        <button class="ql-list" value="ordered" title="Numbered list" />
        <button class="ql-list" value="bullet" title="Bullet list" />
      </span>
      <span class="ql-formats">
        <button class="ql-align" value="" title="Left" />
        <button class="ql-align" value="center" title="Centre" />
        <button class="ql-align" value="right" title="Right" />
        <button class="ql-align" value="justify" title="Justify" />
      </span>
      <span class="ql-formats">
        <button class="ql-indent" value="-1" title="Outdent" />
        <button class="ql-indent" value="+1" title="Indent" />
      </span>
      <span class="ql-formats">
        <button class="ql-link" title="Insert link" @click.prevent="openLinkDialog" />
        <button title="Insert image" @click.prevent="insertImage">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <rect x="3" y="3" width="18" height="18" rx="2" /><circle cx="8.5" cy="8.5" r="1.5" /><polyline points="21 15 16 10 5 21" />
          </svg>
        </button>
        <button title="Insert video" @click.prevent="insertVideo">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polygon points="23 7 16 12 23 17 23 7" /><rect x="1" y="5" width="15" height="14" rx="2" />
          </svg>
        </button>
        <button title="Insert file" @click.prevent="insertFile">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" /><polyline points="14 2 14 8 20 8" />
          </svg>
        </button>
      </span>
      <span class="ql-formats">
        <button title="Code block" @click.prevent="insertCodeBlock">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <polyline points="16 18 22 12 16 6" /><polyline points="8 6 2 12 8 18" />
          </svg>
        </button>
        <button class="ql-clean" title="Remove formatting" />
      </span>
    </div>

    <!-- Editor body -->
    <div ref="editorEl" @mousedown="onEditorMouseDown" />
  </div>
</template>

<style scoped>
.qe-wrapper {
  border: 1.5px solid #e2e8f0;
  border-radius: 12px;
  overflow: hidden;
  background: #fff;
  transition: border-color 0.2s, box-shadow 0.2s;
}
.qe-wrapper:focus-within {
  border-color: #818cf8;
  box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
}

.qe-toolbar {
  background: #f8fafc;
  border-bottom: 1px solid #e2e8f0;
  padding: 6px 10px;
  flex-wrap: wrap;
  display: flex;
  align-items: center;
  gap: 2px;
}
.qe-toolbar .ql-formats {
  display: inline-flex;
  align-items: center;
  gap: 2px;
  margin-right: 4px !important;
}
.qe-toolbar button,
.qe-toolbar select,
.qe-toolbar input {
  border-radius: 6px;
  transition: background 0.15s;
  cursor: pointer;
}
.qe-toolbar button:hover { background: #eef2ff; }
.qe-toolbar button.ql-active { background: #e0e7ff; }

/* Quill overrides */
:deep(.ql-container) { border: none; font-family: inherit; }
:deep(.ql-editor) {
  min-height: 200px;
  padding: 14px 16px;
  line-height: 1.75;
  color: #334155;
  font-size: 14.5px;
}
:deep(.ql-editor h1) { font-size: 1.65rem; font-weight: 700; color: #0f172a; margin: 0.8rem 0 0.4rem; }
:deep(.ql-editor h2) { font-size: 1.3rem; font-weight: 600; color: #1e293b; margin: 0.7rem 0 0.35rem; }
:deep(.ql-editor h3) { font-size: 1.1rem; font-weight: 600; color: #334155; margin: 0.6rem 0 0.3rem; }
:deep(.ql-editor p) { margin: 0.4rem 0; }
:deep(.ql-editor ul),
:deep(.ql-editor ol) { padding-left: 1.5rem; margin: 0.4rem 0; }
:deep(.ql-editor li) { margin: 0.2rem 0; }
:deep(.ql-editor a) { color: #6366f1; text-decoration: underline; }
:deep(.ql-editor blockquote) {
  border-left: 3px solid #cbd5e1;
  padding-left: 12px;
  color: #64748b;
  margin: 8px 0;
  background: #f8fafc;
  border-radius: 0 6px 6px 0;
}
:deep(.ql-editor pre) {
  background: #1e293b;
  color: #e2e8f0;
  border-radius: 8px;
  padding: 12px 16px;
  font-family: monospace;
  font-size: 13px;
  overflow-x: auto;
}
:deep(.ql-editor code) {
  background: #f1f5f9;
  color: #be185d;
  border-radius: 4px;
  padding: 1px 5px;
  font-family: monospace;
  font-size: 13px;
}
:deep(.ql-editor img),
:deep(.ql-editor video) {
  max-width: 100%;
  border-radius: 8px;
  display: block;
  margin: 10px 0;
  cursor: ew-resize;
  transition: opacity 0.15s;
  vertical-align: middle;
}
:deep(.ql-editor img:hover),
:deep(.ql-editor video:hover) { opacity: 0.88; }
</style>
