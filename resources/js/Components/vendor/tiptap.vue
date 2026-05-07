<script setup>
import { onBeforeUnmount, watch } from 'vue'
import { EditorContent, useEditor } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Link from '@tiptap/extension-link'
import Underline from '@tiptap/extension-underline'
import BulletList from '@tiptap/extension-bullet-list'
import OrderedList from '@tiptap/extension-ordered-list'
import ListItem from '@tiptap/extension-list-item'

// Tip: we also import these list extensions explicitly so toggling lists always works


const props = defineProps({
  modelValue: String,
})

const emit = defineEmits(['update:modelValue'])

const editor = useEditor({
  content: props.modelValue || '',
  extensions: [
    StarterKit,
    // Ensure list extensions are always present (for bullet/ordered list toggles)
    BulletList,
    OrderedList,
    ListItem,
    Underline,
    Link.configure({ openOnClick: false }),
  ],
  onUpdate: ({ editor }) => {
    emit('update:modelValue', editor.getHTML())
  },
})

/**
 * 🔥 IMPORTANT: Handle external updates (edit mode)
 */
watch(
  () => props.modelValue,
  (value) => {
    if (editor.value && value !== editor.value.getHTML()) {
      editor.value.commands.setContent(value || '', false)
    }
  },
)

/**
 * 🔥 CRITICAL: Prevent memory leaks in SPA
 */
onBeforeUnmount(() => {
  editor.value?.destroy()
})
</script>

<template>
  <div class="border rounded-lg">
    <!-- Toolbar -->
    <div class="flex flex-wrap gap-2 p-2 border-b">
      <button @click="editor.chain().focus().toggleBold().run()">B</button>
      <button @click="editor.chain().focus().toggleItalic().run()">I</button>
      <button @click="editor.chain().focus().toggleUnderline().run()">U</button>
      <button @click="editor.chain().focus().toggleBulletList().run()">• List</button>
      <button @click="editor.chain().focus().toggleOrderedList().run()">1. List</button>
    </div>

    <!-- Editor -->
    <EditorContent :editor="editor" class="tiptap-prosemirror p-3 min-h-[150px]" />
  </div>
</template>