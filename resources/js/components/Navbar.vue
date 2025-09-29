<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
</script>

<template>
  <div class="flex gap-4">
    <Link href="/" class="text-2xl font-semibold">Home</Link>
    <Link href="/about" class="text-2xl font-semibold">About</Link>
    <Link href="/contact" class="text-2xl font-semibold">Contact</Link>
    <Link href="/learn" class="text-2xl font-semibold">Learn</Link>
  </div>
</template>
