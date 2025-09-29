<template>
  <div class="max-w-3xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-semibold">Edit Post</h1>
      <Link href="/posts" class="text-slate-600 hover:underline">Back</Link>
    </div>

    <form @submit.prevent="form.put(`/posts/${post.id}`)" class="space-y-5">
      <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input v-model="form.title" type="text" class="w-full rounded-2xl p-2 border border-slate-300 focus:border-slate-400 focus:ring-0" />
        <p v-if="form.errors.title" class="text-red-600 text-sm mt-1">{{ form.errors.title }}</p>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Category</label>
        <select v-model="form.category_id" class="w-full rounded-2xl p-2 border border-slate-300 focus:border-slate-400 focus:ring-0">
          <option disabled value="">-- choose --</option>
          <option v-for="c in categories" :key="c.id" :value="c.id">{{ c.name }}</option>
        </select>
        <p v-if="form.errors.category_id" class="text-red-600 text-sm mt-1">{{ form.errors.category_id }}</p>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Body</label>
        <textarea v-model="form.body" rows="8" class="w-full rounded-2xl p-2 border border-slate-300 focus:border-slate-400 focus:ring-0"></textarea>
        <p v-if="form.errors.body" class="text-red-600 text-sm mt-1">{{ form.errors.body }}</p>
      </div>

      <div class="flex items-center gap-3">
        <button :disabled="form.processing" type="submit" class="px-4 py-2 rounded-2xl bg-slate-900 text-white hover:opacity-90 disabled:opacity-60">Update</button>
        <Link href="/posts" class="px-4 py-2 rounded-2xl border border-slate-300 hover:bg-slate-50">Cancel</Link>
      </div>
    </form>
  </div>
</template>

<script setup lang="ts">
import { Link, useForm } from '@inertiajs/vue3'

const props = defineProps({
  post: Object,
  categories: Array,
})

const form = useForm({
  title: props.post.title,
  body: props.post.body,
  category_id: props.post.category_id,
})
</script>
