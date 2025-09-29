<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { type BreadcrumbItem } from '@/types';

const props = defineProps({
  posts: Object,
  flash: Object,
})

function formatDate(iso: string) {
  try { return new Date(iso).toLocaleString() } catch { return iso }
}

function escapeHtml(s: string) {
  return s?.replace(/[&<>"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;', "'":'&#39;'}[m] ?? '')) ?? s;
}

interface Post {
  id: number;
  title: string;
}

async function confirmDelete(post: Post) {
  const result = await Swal.fire({
    title: 'Hapus post?',
    html: `Anda yakin ingin menghapus <b>${escapeHtml(post.title)}</b>?`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, hapus',
    cancelButtonText: 'Batal',
    reverseButtons: true,
    focusCancel: true,
  })

  if (result.isConfirmed) {
    router.delete(`/posts/${post.id}`, {
      preserveScroll: true,
      onSuccess: () => {
        Swal.fire({
          title: 'Terhapus',
          text: 'Post berhasil dihapus.',
          icon: 'success',
          timer: 1500,
          showConfirmButton: false,
        })
      },
      onError: () => {
        Swal.fire({
          title: 'Gagal',
          text: 'Terjadi kesalahan saat menghapus.',
          icon: 'error',
        })
      }
    })
  }
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Posts',
        href: '/posts',
    },
];
</script>

<template>
    <Head title="Posts" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="w-full mx-auto p-6">
          <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold">Posts</h1>
            <Link href="/posts/create" class="px-4 py-2 rounded-2xl bg-slate-900 text-white hover:opacity-90">+ New Post</Link>
          </div>

          <div v-if="flash && flash.success" class="mb-4 rounded-xl bg-green-100 text-green-800 px-4 py-2">
            {{ flash.success }}
          </div>

          <div v-if="posts" class="overflow-x-auto rounded-2xl border border-slate-200">
            <table class="min-w-full text-sm">
              <thead class="bg-slate-50 text-slate-600">
                <tr>
                  <th class="px-4 py-3 text-left">Title</th>
                  <th class="px-4 py-3 text-left">Category</th>
                  <th class="px-4 py-3 text-left">Created</th>
                  <th class="px-4 py-3 text-left">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="post in posts.data" :key="post.id" class="border-t">
                  <td class="px-4 py-3 font-medium">{{ post.title }}</td>
                  <td class="px-4 py-3">{{ post.category?.name }}</td>
                  <td class="px-4 py-3">{{ formatDate(post.created_at) }}</td>
                  <td class="px-4 py-3 flex gap-2">
                    <Link :href="`/posts/${post.id}/edit`" class="px-3 py-1 rounded-xl border border-slate-300 hover:bg-slate-50">Edit</Link>
                    <button @click="confirmDelete(post)" class="px-3 py-1 rounded-xl bg-red-600 text-white hover:opacity-90">Delete</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div v-if="posts && posts.links && posts.links.length > 3" class="mt-4 flex flex-wrap gap-2">
            <Link v-for="link in posts.links" :key="link.label" :href="link.url || '#'" preserve-scroll :class="['px-3 py-1 rounded-xl border', link.active ? 'bg-slate-900 text-white' : 'bg-white text-slate-700 hover:bg-slate-50', !link.url && 'opacity-50 cursor-default']" v-html="link.label" />
          </div>
        </div>
    </AppLayout>
</template>
