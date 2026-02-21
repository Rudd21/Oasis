<template>
  <div class="flex flex-col min-h-screen">
    <AppNavigation />
    <main class="flex-grow">
      <NuxtPage />
    </main>
    <AppFooter />
  </div>
</template>

<style>
html, body {
  font-family: 'Comic sans', sans-serif;
  @apply antialiased text-gray-800;
}
</style>